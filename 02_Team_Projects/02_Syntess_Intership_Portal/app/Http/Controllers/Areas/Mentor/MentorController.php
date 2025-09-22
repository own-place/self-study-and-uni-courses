<?php

namespace App\Http\Controllers\Areas\Mentor;

use App\Events\Message;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Comment;
use App\Models\Document;
use App\Models\MentorAssigned;
use App\Models\Role;
use App\Models\User;
use App\Notifications\CandidateApprovedNotification;
use App\Notifications\RejectedCandidate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Nette\Schema\ValidationException;

class MentorController extends Controller
{
    public function candidatesList()
    {
        $mentorId = auth()->id();
        $assignedCandidates = MentorAssigned::where('mentor_id', $mentorId)->pluck('student_id');
        $mentorApplications = Application::whereIn('user_id', $assignedCandidates)->get();

        $unreviewedCandidates = $mentorApplications->whereNull('mentor_approval')->load('user');
        $reviewedCandidates = $mentorApplications->whereNotNull('mentor_approval')->load('user');

        return view('dashboards.mentor.candidateList', compact('unreviewedCandidates', 'reviewedCandidates'));
    }

    /**
     * @throws AuthorizationException
     */
    public function createMessage(Request $request)
    {
        $user = $request->user();

        $this->authorize('isMentor', User::class);

        try {
            $val = $request->validate(['content' => ['required', 'max:100']]);
            $mess = $user->messages()->create($val);

            event(new Message(
                ['photo' => $user->photo,
                    'fullname' => $user->full_name,
                    'created_at' => $mess->created_at->format('l \, h:i A'),
                    'content' => $mess->content,
                    'sender' => strtolower($user->full_name)
                ]));

            return response(['success' => 'Message sent successfully!'], 200);
        } catch (ValidationException $e) {

            if ($request->ajax()) {
                return response(content: ['errors' => $e->errors()], status: 422);
            }

            throw $e;
        }
    }

    public function review($id)
    {
        $application = Application::where('user_id', $id)->first();

        $user = User::where('role_id', 5)->get();
        $documents = Document::all();
        $comments = Comment::all();
        $latestComment = Comment::orderBy('created_at', 'desc')->first();
        $mentors = User::where('role_id', 2)->get();

        return view('dashboards.mentor.review', [
            'user' => $user,
            'documents' => $documents,
            'application' => $application,
            'comments' => $comments,
            'latestComment' => $latestComment,
            'mentors' => $mentors,
        ]);
    }

    public function initialAcceptApplication($id)
    {
        $application = Application::findOrFail($id);
        $application->mentor_approval = true;
        $application->current_step = 1;
        $application->save();

        $hr = User::where('role_id', Role::HR)->get();
        Notification::send($hr, new CandidateApprovedNotification($application));

        return redirect()->route('dashboards.candidates')->with('success', 'Application accepted successfully.');
    }


    public function initialRejectApplication($id)
    {
        $application = Application::findOrFail($id);
        $application->mentor_approval = false;
        $application->current_step = 1;
        if ($application->admin_approval == 0) {
            $user = $application->user;
            $user->role_id = Role::STUDENT;
            $user->save();
        }
        $application->save();

        if ($application->admin_approval == true) {
            $hr = User::where('role_id', Role::HR)->get();
            Notification::send($hr, new CandidateApprovedNotification($application));
        } else {
            Notification::send($application->user, new RejectedCandidate($application));
        }

        return redirect()->route('dashboards.candidates')->with('success', 'Application rejected successfully.');
    }
}

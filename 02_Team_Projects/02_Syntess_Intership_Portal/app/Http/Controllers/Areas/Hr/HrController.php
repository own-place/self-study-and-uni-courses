<?php

namespace App\Http\Controllers\Areas\Hr;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Comment;
use App\Models\Document;
use App\Models\Interview;
use App\Models\MentorAssigned;
use App\Models\Role;
use App\Models\User;
use App\Notifications\InterviewScheduled;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class HrController extends Controller
{
    public function applicationsDashboard()
    {
        $applications = Application::with(['user', 'assignedMentor'])->get();
        $admin = User::where('role_id', 1)->first();
        $assignedMentor = [];

        foreach ($applications as $application) {
            $assignedMentor = MentorAssigned::where('student_id', $application->user_id)
                ->with('mentor')
                ->first();
        }

        $notApprovedCandidates = Application::where('current_step', 0)->with('user')->get();
        $waitingForSchedulingCandidates = Application::where('current_step', 1)->with(['user', 'assignedMentor'])->get();
        $scheduledCandidates = Application::whereIn('id', Interview::pluck('application_id'))->with('user')->get();
        $waitingForContractCandidates = Application::where('current_step', 4)->where('final_approval', 1)->whereNull('contract_document')->with('user')->get();

        return view('dashboards.hr.applications', compact('applications', 'admin', 'notApprovedCandidates', 'assignedMentor', 'waitingForSchedulingCandidates', 'scheduledCandidates', 'waitingForContractCandidates'));
    }


    public function showApplication($id)
    {
        $application = Application::findOrFail($id);
        $documents = Document::where('user_id', $application->user_id)->get();

        $mentorAssignment = MentorAssigned::where('student_id', $application->user_id)
            ->with('mentor')
            ->first();

        return view('dashboards.hr.show', [
            'application' => $application,
            'documents' => $documents,
            'assignedMentor' => $mentorAssignment ? $mentorAssignment->mentor : null,
        ]);
    }

    public
    function downloadDocument($document, $id)
    {
        $application = Application::findOrFail($id);

        switch ($document) {
            case 'cv':
                $filePath = $application->cv;
                break;
            case 'resume':
                $filePath = $application->resume;
                break;
            case 'letter_of_enrollment':
                $filePath = $application->letter_of_enrollment;
                break;
            default:
                abort(404);
        }

        return Storage::download($filePath);
    }

    public function scheduleInterview(Request $request)
    {
        $request->validate([
            'application_id' => 'required|exists:applications,id',
            'date' => 'required|date',
            'time' => 'required',
            'mentor_id' => 'required|exists:users,id',
            'candidate_id' => 'required|exists:users,id',
            'admin_id' => 'required|exists:users,id',
        ]);
        $application = Application::findOrFail($request->application_id);

        $interview = new Interview();
        $interview->application_id = $application->id;
        $interview->date = $request->input('date');
        $interview->time = $request->input('time');
        $interview->mentor_id = $request->input('mentor_id');
        $interview->candidate_id = $request->input('candidate_id');
        $interview->save();

        $application->current_step = 2;
        $application->save();

        $admin = User::where('role_id', Role::ADMIN)->get();
        $candidate = $application->user;
        $mentor = User::findOrFail($request->input('mentor_id'));
        $recipients = $admin->merge([$candidate, $mentor]);
        Notification::send($recipients, new InterviewScheduled($application));

        return redirect()->route('hr.applications.dashboard')->with('success', 'Interview scheduled successfully.');
    }
}

<?php

namespace App\Http\Controllers\Areas\Intern;

use App\Events\ApplicationSubmitted;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Document;
use App\Models\Internship;
use App\Models\MentorAssigned;
use App\Models\Review;
use App\Models\Role;
use App\Models\User;
use App\Notifications\ApplicationSubmittedNotification;
use App\Notifications\ReviewNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InternController extends Controller
{
    public function create(Internship $internship)
    {
        $user = Auth::user();
        if ($user->application) {
            abort(403, 'You have a pending application');
        }

        return view('internships.apply', ['internship' => $internship]);
    }

    public function viewCards(Internship $internships)
    {
        return view('dashboards.user.index', ['internships' => $internships]);
    }

    public function apply(Request $request, Internship $internship)
    {
        $user = Auth::user();
        if ($user->application) {
            abort(403, 'You have a pending application');
        }

        $validatedData = $request->validate([
            'preference' => ['required', 'max:100'],
            'cv' => ['required', 'file', 'mimes:pdf,doc,docx'],
            'resume' => ['required', 'file', 'mimes:pdf,doc,docx'],
            'letter_of_enrollment' => ['required', 'file', 'mimes:pdf,doc,docx']
        ]);

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $cvUrl = Storage::disk('local')->putFileAs(
                '/' . $user->full_name . $user->id . '/docs',
                $file,
                str()->uuid() . '.' . $file->extension()
            );
        }

        if ($request->hasFile('resume')) {
            $file = $request->file('resume');
            $resumeUrl = Storage::disk('local')->putFileAs(
                '/' . $user->full_name . $user->id . '/docs',
                $file,
                str()->uuid() . '.' . $file->extension()
            );
        }

        if ($request->hasFile('letter_of_enrollment')) {
            $file = $request->file('letter_of_enrollment');
            $enrollmentUrl = Storage::disk('local')->putFileAs(
                '/' . $user->full_name . $user->id . '/docs',
                $file,
                str()->uuid() . '.' . $file->extension()
            );
        }

        $grad = $request['graduation'] == 'true';

        $app = $internship->applications()->create(array_merge($validatedData, [
            'user_id' => $user->id,
            'graduation' => $grad
        ]));

        $user->role_id = Role::CANDIDATE;
        $user->application_id = $app->id;
        $user->update();

        Document::create([
            'user_id' => $user->id,
            'cv_url' => $cvUrl,
            'resume_url' => $resumeUrl,
            'enrollment_url' => $enrollmentUrl
        ]);

        $applicationData = array_merge($validatedData, [
            'user_id' => $user->id,
            'graduation' => $grad
        ]);

        $app->current_step = 0;
        $app->save();

        // Notify HR and Admin
        $hrAndAdminUsers = User::whereIn('role_id', [Role::HR, Role::ADMIN])->get();
        Notification::send($hrAndAdminUsers, new ApplicationSubmittedNotification($app));

        return redirect()->route('redirectBasedOnRole');
    }

    public function review(Request $request)
    {
        $this->authorize('isIntern', User::class);
        $user = Auth::user();

        $val = request()->validate(
            [
                'star-rating' => 'required',
                'review' => 'max:300',
            ]);

        Review::create([
            'rating' => $val['star-rating'],
            'review' => $request['review'] ?? null,
            'anonymous' => (bool)$request['graduation'],
            'user_id' => $user->id,
            'internship_id' => $user->application->internship_id
        ]);

        $mentor_id = MentorAssigned::query()
            ->where('student_id', '=', $user->id)->pluck('mentor_id')
            ->take(1);

        Notification::send(User::find($mentor_id),
            new ReviewNotification(Internship::find($user->application->internship_id), $val['star-rating']));

        return back();
    }
}

<?php

namespace App\Http\Controllers\Areas\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Mail\Verified;
use App\Models\Application;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Document;
use App\Models\Internship;
use App\Models\Language;
use App\Models\Technology;
use App\Models\User;
use App\Models\YearLevel;
use App\Models\MentorAssigned;
use App\Models\Role;
use App\Notifications\ApplicationReviewNotification;
use App\Notifications\FinalApproval;
use App\Notifications\RejectedCandidate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
//    public function verify(User $user): RedirectResponse
//    {
//        $this->authorize('verifyUser', User::class);
//
//        if ($user->verified) {
//            abort(403, "Bad Request");
//        }
//
//        $user->verified = true;
//        $user->work_email = strtolower($user->first_name)[0].".".strtolower($user->last_name)."@syntess.nl";
//        $user->update();
//
//        $admin = auth()->user();
//        Mail::to($user)->send(new Verified($admin->work_email, $user->work_email, $admin->full_name));
//        return back();
//    }

    public function reviewUser($id)
    {
        $application = Application::where('user_id', $id)->first();

        $mentorAssignment = MentorAssigned::where('student_id', $application->user_id)
            ->with('mentor')
            ->first();

        $user = User::where('role_id', 5)->get();
        $documents = Document::all();
        $comments = Comment::all();
        $latestComment = Comment::orderBy('created_at', 'desc')->first();
        $mentors = User::where('role_id', 2)->get();

        return view('dashboards.admin.review', [
            'user' => $user,
            'documents' => $documents,
            'application' => $application,
            'comments' => $comments,
            'latestComment' => $latestComment,
            'mentors' => $mentors,
            'assignedMentor' => $mentorAssignment ? $mentorAssignment->mentor : null,
        ]);
    }

    /**
     * Display a listing of the internships.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $internships = Internship::latest()->paginate(8);
        return view('dashboards.admin.internships.index', compact('internships'));
    }

    /**
     * Show the form for creating a new internship.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $languages = Language::all();
        $technologies = Technology::all();
        $categories = Category::all();
        $yearLevels = YearLevel::all();

        return view('dashboards.admin.internships.create', compact('languages', 'technologies', 'categories', 'yearLevels'));
    }

    /**
     * Store a newly created internship in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'techstack' => 'required|array',
            'techstack.*' => 'exists:technologies,id',
            'language_id' => 'required|exists:languages,id',
            'category_id' => 'required|exists:categories,id',
            'year_level_id' => 'required|exists:year_levels,id',
            'salary' => 'required|numeric',
            'passed' => 'nullable|boolean',
        ]);

        $internship = Internship::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'language_id' => $validatedData['language_id'],
            'category_id' => $validatedData['category_id'],
            'year_level_id' => $validatedData['year_level_id'],
            'salary' => $validatedData['salary'],
            'passed' => $request->has('passed'),
        ]);

        $internship->technologies()->attach($request->input('techstack'));

        return redirect()->route('admin.internships.index')
            ->with('success', 'Internship created successfully.');
    }

    /**
     * Display the specified internship.
     *
     * @param  \App\Models\Internship  $internship
     * @return \Illuminate\View\View
     */
    public function show(Internship $internship)
    {
        $internship->load('language', 'category', 'yearLevel', 'technologies');

        return view('dashboards.admin.internships.show', compact('internship'));
    }

    /**
     * Show the form for editing the specified internship.
     *
     * @param  \App\Models\Internship  $internship
     * @return \Illuminate\View\View
     */
    public function edit(Internship $internship)
    {
        $technologies = Technology::all();
        $categories = Category::all();
        $languages = Language::all();
        $yearLevels = YearLevel::all();

        return view('dashboards.admin.internships.edit', compact('internship', 'technologies', 'categories', 'languages', 'yearLevels'));
    }

    /**
     * Update the specified internship in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Internship  $internship
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Internship $internship)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'language_id' => 'required|exists:languages,id',
            'year_level_id' => 'required|exists:year_levels,id',
            'salary' => 'required|numeric',
            'techstack' => 'required|array',
            'techstack.*' => 'exists:technologies,id',
            'passed' => 'nullable|boolean',
        ]);

        $internship->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'language_id' => $request->input('language_id'),
            'year_level_id' => $request->input('year_level_id'),
            'salary' => $request->input('salary'),
            'passed' => $request->has('passed'),
        ]);

        $internship->technologies()->sync($request->input('techstack'));

        return redirect()->route('admin.internships.index')
            ->with('success', 'Internship updated successfully.');
    }

    /**
     * Remove the specified internship from storage.
     *
     * @param  \App\Models\Internship  $internship
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Internship $internship)
    {
        $internship->delete();

        return redirect()->route('admin.internships.index')
            ->with('success', 'Internship deleted successfully.');
    }

    public function initialAcceptApplication($id, $mentorId)
    {
        $application = Application::findOrFail($id);
        $application->admin_approval = true;
        $application->save();

        $mentorAssigned = new MentorAssigned();
        $mentorAssigned->student_id = $application->user_id;
        $mentorAssigned->mentor_id = $mentorId;
        $mentorAssigned->save();

        $mentor = User::findOrFail($mentorId);
        Notification::send($mentor, new ApplicationReviewNotification($application));


        return redirect()->back()->with('success', 'Application accepted successfully. Mentor has been notified.');
    }


    public function initialRejectApplication($id, $mentorId)
    {
        $application = Application::findOrFail($id);
        $application->admin_approval = false;
        $application->save();

        $mentorAssigned = new MentorAssigned();
        $mentorAssigned->student_id = $application->user_id;
        $mentorAssigned->mentor_id = $mentorId;
        $mentorAssigned->save();

        $mentor = User::findOrFail($mentorId);
        Notification::send($mentor, new ApplicationReviewNotification($application));

        return redirect()->back()->with('success', 'Application rejected successfully.');
    }

    public function finalChoice($userId, $choice)
    {
        $application = Application::where('user_id', $userId)->firstOrFail();
        $application->final_approval = $choice;

        if ($choice == 1) {
            $user = $application->user;
            $user->role_id = Role::INTERN;
            $application->current_step = 4;
            $user->save();
            $hr = User::where('role_id', Role::HR)->get();
            Notification::send($hr, new FinalApproval($application));
        } elseif ($choice == 0) {
            $user = $application->user;
            $user->role_id = Role::STUDENT;
            Notification::send($user, new RejectedCandidate($application));
            $user->save();
        }
        $application->save();

        return redirect()->back()->with('status', 'Final choice has been updated successfully.');
    }
}

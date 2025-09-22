<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Areas\Admin\AdminController;
use App\Http\Controllers\Areas\Hr\HrController;
use App\Http\Controllers\Areas\Intern\InternController;
use App\Http\Controllers\Areas\Mentor\MentorController;
use App\Http\Controllers\Areas\Mentor\MentorMessageController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\TwoFactorAuthController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Models\Role;
use App\Http\Controllers\HobbiesController;
use App\Http\Controllers\UserHobbiesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\GoogleLoginController;


/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [InternshipController::class, 'welcome'])->name('welcome');
Route::get('/internships', [InternshipController::class, 'startInternships'])->name('internships.index');
Route::get('/passed/internships', [InternshipController::class, 'passedInternships'])->name('internships.passed');
Route::get('/internships/search', [InternshipController::class, 'searchInternships'])->name('internships.search');
Route::get('/internships/sort', [InternshipController::class, 'sortInternships'])->name('internships.sort');
Route::get('/internships/{internship}/show', [InternshipController::class, 'show'])->name('internships.show');
Route::get('/dashboard', function () {
    return view('dashboards.user.index');
})->middleware(['auth', 'verified', 'twofa'])->name('dashboard');

Route::get('/BeforeLoggingIn.about', function () {
    return view('BeforeLoggingIn.about');
})->name('BeforeLoggingIn.about');
Route::get('/BeforeLoggingIn.contact', function () {
    return view('BeforeLoggingIn.contact');
})->name('BeforeLoggingIn.contact');
Route::middleware(['auth', 'twofa'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/{user}/2fa', [ProfileController::class, 'manage'])->name('manage.2fa');
    Route::post('/profile/{user}/photo', [ProfileController::class, 'managePhoto'])->name('manage.photo');
});

Route::middleware(['admin', 'twofa'])->group(function () {
    Route::put('/admin/{user}/verify', [AdminController::class, 'verify'])->name('verify.user');
});

// routes for the user dashboard
Route::middleware(['auth', 'verified', 'twofa'])->group(function () {
    Route::get('/user/dashboard', function() {
        return view('dashboards.user.index');
    })->name('dashboards.user.index');

    Route::post('/hobbies', [HobbiesController::class, 'save'])->name('quiz.save');
});

// routes for the intern dashboard
Route::middleware(['auth', 'verified', 'twofa'])->group(function () {
    Route::get('/intern/dashboard',
        [InternshipController::class, 'set'
        ])->name('dashboards.intern.index');
    Route::post('/intern/checklist/update',
        [InternshipController::class, 'updateChecklist'
        ])->name('intern.checklist.update');
});

// routes for the admin dashboard
Route::middleware(['auth', 'twofa', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function() {
        return view('dashboards.admin.index');
    })->name('dashboards.admin.index');
    Route::get('/admin/student/{userId}/recommended', [HobbiesController::class, 'show'])->name('admin.recommended');
    Route::resource('admin/internships', AdminController::class)->names([
        'index' => 'admin.internships.index',
        'create' => 'admin.internships.create',
        'store' => 'admin.internships.store',
        'show' => 'admin.internships.show',
        'edit' => 'admin.internships.edit',
        'update' => 'admin.internships.update',
        'destroy' => 'admin.internships.destroy',
    ]);
    Route::get('/admin/mentorList', function() {
        return view('dashboards.admin.mentor_list');
    })->name('dashboards.mentor.list');
    Route::get('/admin/internList', function() {
        return view('dashboards.admin.intern_list');
    })->name('dashboards.intern.list');
    Route::get('/admin/candidateList', function() {
        return view('dashboards.admin.candidate_list');
    })->name('dashboards.candidate.list');
    Route::post('/admin/applications/{id}/accept/{mentorId}', [AdminController::class, 'initialAcceptApplication'])->name('admin.accept');
    Route::post('/admin/applications/{id}/reject/{mentorId}', [AdminController::class, 'initialRejectApplication'])->name('admin.reject');
    Route::post('/final-choice/{userId}/{choice}', [AdminController::class, 'finalChoice'])->name('final.choice');
});

// routes for the mentor dashboard
Route::middleware(['auth', 'twofa', 'mentor'])->group(function () {
    Route::get('/mentor/dashboard', function() {
        return view('dashboards.mentor.index');
    })->name('dashboards.mentor.index');
    Route::get('/mentor/candidateList', [MentorController::class, 'candidatesList'])->name('dashboards.candidates');

    Route::post('/hobbies', [HobbiesController::class, 'save'])->name('quiz.save');

    Route::post('/mentor/accept/{id}', [MentorController::class, 'accept'])->name('mentor.accept');
    Route::post('/mentor/reject/{id}', [MentorController::class, 'reject'])->name('mentor.reject');
    Route::post('/mentor/applications/{id}/accept', [MentorController::class, 'initialAcceptApplication'])->name('mentor.accept');
    Route::post('/mentor/applications/{id}/reject', [MentorController::class, 'initialRejectApplication'])->name('mentor.reject');

    Route::get('/mentor/hub', function() {
        return view('dashboards.mentor.hub');
    })->name('mentor.hub');
});

//Route::middleware(['auth', 'twofa', 'mentor_or_candidate'])->group(function () {
//    Route::post('/hobbies', [HobbiesController::class, 'save'])->name('quiz.save');
//});

// routes for the hr dashboard
Route::middleware(['auth', 'twofa', 'hr'])->group(function () {
    Route::get('/hr/dashboard', function() {
        return view('dashboards.hr.index');
    })->name('dashboards.hr.index');
    Route::get('/hr/applications', [HrController::class, 'applicationsDashboard'])->name('hr.applications.dashboard');
    Route::get('/hr/applications/{id}', [HrController::class, 'showApplication'])->name('hr.show');
    Route::post('/interviews/schedule', [HrController::class, 'scheduleInterview'])->name('interviews.schedule');
    Route::post('/contracts/store/{id}', [ContractController::class, 'store'])->name('contracts.store');
});

// redirection based on role - for the login
Route::middleware(['auth', 'twofa'])->get('/redirectBasedOnRole', function () {
    if (Auth::user()->role_id === Role::ADMIN) {
        return redirect()->route('dashboards.admin.index');
    } else if (Auth::user()->role_id === Role::INTERN) {
        return redirect()->route('dashboards.intern.index');
    } else if (Auth::user()->role_id === Role::MENTOR) {
        return redirect()->route('dashboards.mentor.index');
    } else if (Auth::user()->role_id === Role::STUDENT) {
        return redirect()->route('dashboards.user.index');
    } else if (Auth::user()->role_id === Role::CANDIDATE) {
        return redirect()->route('dashboards.user.index');
    } else if (Auth::user()->role_id === Role::HR) {
        return redirect()->route('dashboards.hr.index');
    }
})->name('redirectBasedOnRole');

Route::group(['middleware' => ['auth', 'twofa']], function () {
    Route::get('/apply/{internship}', [InternController::class, 'create'])->name('apply.form');
    Route::post('/apply/{internship}', [InternController::class, 'apply'])->name('submit.apply.form');
});

//2fa auth routes. Creating a code and sending, checking and resending, respectively.
//Route::get('/{user}/login/2fa', [AuthenticatedSessionController::class, 'create2fa'])->name('request.2fa');
//Route::post('/{user}/login/2fa', [AuthenticatedSessionController::class, 'check2fa'])->name('verify.2fa');
//Route::post('/{user}/2fa/resend', [AuthenticatedSessionController::class, 'resend2fa'])->name('resend.2fa');
Route::post('/post/message', [MentorController::class, 'createMessage'])->name('post.message')->middleware('mentor');
require __DIR__.'/auth.php';

// show review page
Route::get('/dashboard/admin/review/{user}/', [AdminController::class,'reviewUser'])->name('review.user');
Route::post('/assign-mentor/{application}', [ApplicationController::class, 'assignMentor'])->name('assignMentor');
Route::get('/dashboard/mentor/review/{application}', [MentorController::class, 'review'])->name('mentor.review');

// make the cards in the student's dashboard could be viewed
Route::get('/user/dashboard', [InternController::class,'viewCards'])->name('dashboards.user.index');

// for admin to leave comments
Route::resource('/comments', \App\Http\Controllers\CommentController::class);
// delete the chosen comment
Route::get('/comments/{comment}/delete', [\App\Http\Controllers\CommentController::class, 'delete'])->name('comments.delete');

// retrieving and serving the specified file from storage
Route::get('{user}/{id}/docs/{filename}', function ($user, $id, $filename) {
    $path = $user.$id.'/docs/'.$filename;

    if (!Storage::exists($path)) {
        abort(404);
    }

    $file = Storage::get($path);
    $type = Storage::mimeType($path);

    return response($file, 200)->header('Content-Type', $type);
})->where('filename', '.*');

// for admin to download the files
Route::get('/download/cv/{document}',[\App\Http\Controllers\DownloadController::class,'downloadCv'])->name('download.cv');
Route::get('/download/resume/{document}',[\App\Http\Controllers\DownloadController::class,'downloadResume'])->name('download.resume');
Route::get('/download/enrollment/{document}',[\App\Http\Controllers\DownloadController::class,'downloadEnrollment'])->name('download.enrollment');

Route::get('/admin/statistics', [StatisticsController::class, 'index'])->name('admin.statistics');
Route::get('/notifications/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

Route::get('/login/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/login/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');
Route::post('/intern/review', [InternController::class, 'review'])->name('intern.review')->middleware('intern');
Route::get('/internship/getMoreReviews', [InternshipController::class, 'getMoreReviews'])->name('internship.getMoreReviews');

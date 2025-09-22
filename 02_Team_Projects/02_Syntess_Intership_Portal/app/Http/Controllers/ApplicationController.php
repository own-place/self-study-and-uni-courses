<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Events\ApplicationReviewNotification;

class ApplicationController extends Controller
{

    public function assignMentor(Request $request, Application $application)
    {
        $request->validate([
            'mentor_id' => 'required|exists:users,id',
        ]);

        $application->user->mentor_id = $request->mentor_id;
        $application->user->save();

        $mentor = User::find($request->mentor_id);

        event(new ApplicationReviewNotification($application));
        Notification::send($mentor, new ApplicationReviewNotification($application));

        return redirect()->back()->with('success', 'Mentor assigned successfully');
    }

    public function checkAndUpdateStep()
    {
        $user = Auth::user();
        $application = $user->application;

        if ($application && $application->current_step === 2) {
            $interview = $application->interview;

            if ($interview) {

                $interviewDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $interview->date . ' ' . $interview->time);

                if ($interviewDateTime->isPast()) {
                    $application->current_step = 3;
                    $application->save();
                }
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Application;
use Carbon\Carbon;
use App\Models\Internship;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class StatisticsController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);
        $earliest = Application::orderBy('created_at', 'asc')->first();
        $startYear = $earliest ? Carbon::parse($earliest->created_at)->year : Carbon::now()->year;

        $applications = Application::selectRaw('COUNT(*) as count, MONTH(created_at) as month')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $details = Application::join('users', 'applications.user_id', '=', 'users.id')
            ->select('users.first_name', 'users.last_name', 'applications.created_at')
            ->whereYear('applications.created_at', $year)
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('m'); // grouping by month
            });

        $applicationsPerInternship = Application::select('internships.title', DB::raw('COUNT(*) as count'))
            ->join('internships', 'applications.internship_id', '=', 'internships.id')
            ->whereYear('applications.created_at', $year)
            ->groupBy('internships.title')
            ->orderBy('count', 'desc')
            ->get();

        $months = [];
        $counts = [];

//        dd($details);
        foreach ($applications as $application) {
            $months[] = Carbon::create()->month($application->month)->format('F');
            $counts[] = $application->count;
        }
//        $user = Auth::user();
//        if($user->role_id === Role::ADMIN){
//            return view('dashboards.admin.statistics', compact('months', 'counts', 'applicationsPerInternship', 'year', 'details', 'startYear'));
//        } elseif ($user->role_id === Role::STUDENT){
//            return view('dashboards.user.index', compact('applicationsPerInternship'));
//        }

         return view('dashboards.admin.statistics', compact('months', 'counts', 'applicationsPerInternship', 'year', 'details', 'startYear'));
    }
}

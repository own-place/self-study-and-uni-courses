<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Hobby;
use Illuminate\Support\Facades\Auth;

class HobbiesController extends Controller
{
    public function save(Request $request)
    {
        $hobbies = $request->input('hobbies', []);
        $user = Auth::user();
        foreach ($hobbies as $hobby) {
            $user->hobbies()->create(['name' => $hobby]);
        }
        return redirect()->route('dashboards.mentor.index')->with('success', 'Hobbies saved');
    }

    public function show($userId)
    {
        $student = User::whereIn('role_id', [Role::STUDENT, Role::CANDIDATE])
            ->with('hobbies')
            ->findOrFail($userId);
        $mentors = User::where('role_id', Role::MENTOR)
            ->with('hobbies')
            ->get();
        $studentHobbies = $student->hobbies->pluck('name')->toArray();
        $matches = [];

        foreach ($mentors as $mentor) {
            $mentorHobbies = $mentor->hobbies->pluck('name')->toArray();
            $commonHobbies = array_intersect($studentHobbies, $mentorHobbies);
            $commonCount = count($commonHobbies);
            if ($commonCount > 0) {
                $percentage = ($commonCount / count($studentHobbies)) * 100;
                $matches[] = [
                    'mentor' => $mentor,
                    'common_hobbies' => array_values($commonHobbies),
                    'percentage' => $percentage
                ];
            }
        }
        usort($matches, function($a, $b) {
            return $b['percentage'] <=> $a['percentage'];
        });
        return response()->json([
            'student' => $student,
            'matches' => array_slice($matches, 0, 3)
        ]);
    }
}

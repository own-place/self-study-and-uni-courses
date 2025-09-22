<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Internship;
use App\Models\Language;
use App\Models\Technology;
use App\Models\UserChecklist;
use App\Models\YearLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;


class InternshipController extends Controller
{
    public function welcome()
    {
        $topInternships = Internship::orderBy('salary', 'desc')->take(3)->get();

        return view('welcome', [
            'internships' => $topInternships
        ]);
    }

    public function startInternships(Request $request)
    {
        $internships = Internship::query();

        if ($request->filled('category')) {
            $internships->where('category_id', $request->category);
        }

        $internships = $internships->get();

        $categories = Category::all();
        $yearLevels = YearLevel::all();
        $technologies = Technology::all();
        $languages = Language::all();

        return view('internships.index', [
            'internships' => $internships,
            'categories' => $categories,
            'yearLevels' => $yearLevels,
            'technologies' => $technologies,
            'languages' => $languages,
        ]);
    }

    public function searchInternships(Request $request)
    {
        $internships = Internship::query();

        if ($request->filled('category')) {
            $internships->where('category_id', $request->category);
        }
        if ($request->filled('year_level')) {
            $internships->where('year_level_id', $request->year_level);
        }
        if ($request->filled('tech_stack')) {
            $internships->whereHas('technologies', function ($query) use ($request) {
                $query->whereIn('name', $request->tech_stack);
            });
        }
        if ($request->filled('language')) {
            $internships->whereIn('language_id', $request->language);
        }
        if ($request->filled('min_salary')) {
            $internships->where('salary', '>=', $request->min_salary);
        }
        if ($request->filled('sort_by')) {
            if ($request->sort_by == 'lowest_salary') {
                $internships->orderBy('salary', 'asc');
            } elseif ($request->sort_by == 'highest_salary') {
                $internships->orderBy('salary', 'desc');
            }
        }

        $internships = $internships->get();

        return view('internships.partials.internship_list', compact('internships'))->render();
    }

    protected $checklistItems = [
        'complete_profile' => 'Complete Your Profile',
        'submit_documents' => 'Submit Required Documents',
        'read_handbook' => 'Read the Intern Handbook',
    ];

    public function set()
    {
        $user = Auth::user();
        $checklist = $user->checklist()->get()->keyBy('item_key');

        $items = [];
        foreach ($this->checklistItems as $key => $title) {
            $items[$key] = [
                'title' => $title,
                'completed' => isset($checklist[$key]) ? (bool)$checklist[$key]->completed : false,
            ];
        }

        return view('dashboards.intern.index', ['checklistItems' => $items]);
    }

    public function updateChecklist(Request $request)
    {
        $user = Auth::user();
        $data = $request->input('completed', []);

        foreach ($this->checklistItems as $key => $title) {
            $completed = in_array($key, $data);
            $existingRecord = UserChecklist::where('user_id', $user->id)
                ->where('item_key', $key)
                ->first();

            if ($existingRecord) {
                $existingRecord->update(['completed' => $completed]);
            } else {
                UserChecklist::create([
                    'user_id' => $user->id,
                    'item_key' => $key,
                    'completed' => $completed
                ]);
            }
        }

        return back()->with('status', 'Checklist updated successfully.');
    }

    public function index()
    {
        $internships = Internship::all();
        $categories = Category::all();
        $yearLevels = YearLevel::all();
        $technologies = Technology::all();

        return view('internships.index', compact('internships', 'categories', 'yearLevels', 'technologies'));
    }

    public function show(Internship $internship)
    {
        $techStack = $internship->technologies->pluck('name')->toArray();
        $reviews = $internship->reviews->take(3);
        return view('internships.show', ['internship' => $internship, 'tech_stack' => $techStack, 'reviews' => $reviews]);
    }

    public function getMoreReviews(Request $request)
    {
        $internship = Internship::find($request['id']);
        $count = (int)$request['count'];
        if (3 + $count > count($internship->reviews)) {
            $reviews = $internship->reviews;
        } else {
            $reviews = $internship->reviews->take(3 + $count);
        }
        return view('internships.partials.reviews', ['reviews' => $reviews, 'internship' => $internship])
            ->render();
    }

    public function passedInternships()
    {
        $passedInternships = Internship::where('passed', true)->get();
        return view('internships.passed', compact('passedInternships'));
    }
}

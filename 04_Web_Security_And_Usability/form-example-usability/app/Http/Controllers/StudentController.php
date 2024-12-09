<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function form()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => ['required', 'regex:/^[1-9][0-9]{8}$/'],
            'gender' => 'required|in:Male,Female|not_in:-',
            'message' => 'nullable|string|max:1000',
        ], [
            'email.email' => 'Please enter a valid email address following the format: username@domain.com.',
            'phone.regex' => 'The phone number must be 9 digits and cannot start with 0. Please check and re-enter.',
            'gender.not_in' => 'Please select your gender.',
        ]);

        $student = Student::create($validated);

        return redirect()->route('welcome')->with('success', 'Form submitted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContractController extends Controller
{
    public function store(Request $request, $applicationId)
    {
        $request->validate([
            'contract_document' => 'required|file|mimes:pdf,doc,docx',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $application = Application::findOrFail($applicationId);

        if ($request->hasFile('contract_document')) {
            $file = $request->file('contract_document');
            $path = Storage::disk('local')->putFileAs(
                '/' . $application->user->full_name . '/' . $application->user->id . '/docs',
                $file,
                Str::uuid() . '.' . $file->getClientOriginalExtension()
            );
            $application->contract_document = $path;
        }

        $application->start_date = $request->start_date;
        $application->end_date = $request->end_date;
        $application->save();

        return redirect()->route('hr.applications.dashboard')->with('success', 'Contract added successfully.');
    }
}

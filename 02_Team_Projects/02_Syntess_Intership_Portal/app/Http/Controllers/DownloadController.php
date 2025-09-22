<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function downloadCv(Document $document)
    {
        $user = auth()->user();
        $cvUrl = $document->cv_url;
        return Storage::disk('local')->download($cvUrl);
    }

    public function downloadResume(Document $document)
    {
        $user = auth()->user();
        $resumeUrl = $document->resume_url;
        return Storage::disk('local')->download($resumeUrl);
    }

    public function downloadEnrollment(Document $document)
    {
        $user = auth()->user();
        $enrollmentUrl = $document->enrollment_url;
        return Storage::disk('local')->download($enrollmentUrl);
    }
}

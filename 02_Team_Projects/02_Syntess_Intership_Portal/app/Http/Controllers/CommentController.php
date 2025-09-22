<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Comment;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $applicationId = $request->input('application_id');

        return view('dashboards.admin.review', [
            'user' => $userId,
            'application' => $applicationId,
            'comments' => Comment::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'application_id' => 'required|exists:applications,id',
            'comment' => 'required|string|max:255',
        ]);

        $userId = $request->user()->id;

        $application = Application::where('user_id', $userId)->first();

        if ($application) {
            $applicationID = $application->id;

            Comment::create([
                'application_id' => $request->input('application_id'),
                'comment' => $request->input('comment'),
            ]);

            $user = User::where('application_id', $applicationID)->get();
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
            ])->with('success', 'Comment created successfully.');
        } else {
            return redirect()->back()->with('error', 'Application not found for the user.');
        }
    }


    public function edit(Comment $comment)
    {
        return view('comments.edit', ['comment' => $comment]);
    }

    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'comment' => 'required',
        ]);

        $comment->comment = $validated['comment'];
        $comment->save();

        return redirect()->route('comments.index', $comment)->with('success', 'Comment successfully updated');
    }

    public function delete(Comment $comment)
    {
        return view('comments.delete', ['comment' => $comment]);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'Comment successfully deleted');
    }
}

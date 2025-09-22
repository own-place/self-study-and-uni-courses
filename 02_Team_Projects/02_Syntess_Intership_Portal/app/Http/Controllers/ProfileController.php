<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use JetBrains\PhpStorm\NoReturn;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function managePhoto(User $user, Request $request): JsonResponse
    {
        Log::info('managePhoto called');
        $request->validate([
            'profile-picture' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg']
        ]);

        Log::info('Validation passed');

        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
            Log::info('Old photo deleted: ' . $user->photo);
        }

        if ($request->hasFile('profile-picture')) {
            Log::info('File received');
            $photo = $request->file('profile-picture');
            $filename = str()->uuid().'.'.$photo->getClientOriginalExtension();
            $path = 'profile-pictures/' . $filename;

            $img = imagecreatefromstring(file_get_contents($photo->getRealPath()));
            if (!$img) {
                Log::error('Failed to create image from string');
                return response()->json(['status' => 'error', 'message' => 'Image processing failed']);
            }

            $width = imagesx($img);
            $height = imagesy($img);
            $newWidth = 200;
            $newHeight = 200;

            $tmpImg = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($tmpImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            imagejpeg($tmpImg, public_path('storage/' . $path));

            imagedestroy($img);
            imagedestroy($tmpImg);

            $user->photo = $path;
            $user->update();

            Log::info('Photo updated: ' . $path);

            return new JsonResponse(['status' => 'success']);
        } else {
            Log::warning('No file uploaded');
            return response()->json(['status' => 'profile-picture-not-uploaded']);
        }
    }
}

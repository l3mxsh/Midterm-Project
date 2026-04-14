<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __invoke(Request $request)
    {
        $profile = User::find(Auth::id());
        return view('Dashboard/settings', compact('profile'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'             => 'sometimes|string|max:255',
            'email'            => 'sometimes|email|max:255|unique:users,email,' . $user->id,
            'address'          => 'sometimes|string|max:255',
            'gender'           => 'sometimes|in:Male,Female',
            'current_password' => 'nullable|string',
            'new_password'     => 'nullable|min:8|confirmed',
        ], [
            'new_password.min'       => 'New password must be at least 8 characters.',
            'new_password.confirmed' => 'New password confirmation does not match.',
        ]);

        $changed = array_filter(
            array_intersect_key($request->only(['name', 'email', 'address', 'gender']),
                array_flip(['name', 'email', 'address', 'gender'])),
            fn($value, $key) => $value !== $user->$key,
            ARRAY_FILTER_USE_BOTH
        );

        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
            if (!$request->filled('new_password')) {
                return back()->withErrors(['new_password' => 'Please enter a new password.']);
            }
            $changed['password'] = Hash::make($request->new_password);
        }

        if (!empty($changed)) {
            $user->update($changed);
        }

        return redirect()->route('dashboard.settings')->with('success', 'Profile updated successfully.');
    }

    public function updateImg(Request $request, User $user)
    {
        $request->validate([
            'imgpath' => 'required|image|mimes:jpg,jpeg,png|max:5120'
        ], [
            'imgpath.required' => 'Please select an image.',
            'imgpath.image'    => 'The file must be an image.',
            'imgpath.mimes'    => 'Only JPG, JPEG, and PNG files are allowed.',
            'imgpath.max'      => 'Image size must not exceed 5MB.',
            'imgpath.uploaded' => 'Image size must not exceed 5MB.',
        ]);

        if ($request->hasFile('imgpath')) {
            $oldPath = public_path($user->imgpath);
            if ($user->imgpath !== 'images/default.jpg' && file_exists($oldPath)) {
                unlink($oldPath);
            }

            $file = $request->file('imgpath');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/profile_images'), $filename);

            $user->imgpath = 'images/profile_images/' . $filename;
            $user->save();
        }

        return redirect()->route('dashboard.settings')->with('success', 'Image updated successfully.');
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __invoke(Request $request)
    {
        $search = $request->input('search');
        $users = User::query()
            ->where('id', '!=', Auth::id())
            ->when(
                $search,
                fn($q) =>
                $q->where(
                    fn($q) =>
                    $q->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                )
            )
            ->get();
        return view('Dashboard/users', compact('users', 'search'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'address'  => 'required|string|max:255',
            'gender'   => 'required|in:Male,Female',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'address'  => $request->address,
            'gender'   => $request->gender,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dashboard.users')->with('success', 'User Registration successfully.');
    }

    public function delete(User $user)
    {
        if ($user->imgpath && $user->imgpath !== 'images/default.jpg') {
            $path = public_path($user->imgpath);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $user->delete();
        return redirect('/dashboard/users')->with('success-red', "{$user->name} deleted successfully.");
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'    => 'sometimes|string|max:255',
            'email'   => 'sometimes|email|max:255|unique:users,email,' . $user->id,
            'address' => 'sometimes|string|max:255',
            'gender'  => 'sometimes|in:Male,Female',
        ]);

        $user->update($data);
        return redirect('/dashboard/users')->with('success', "{$user->name} updated successfully.");
    }
}

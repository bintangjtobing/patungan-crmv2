<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::all(); // Retrieve all users
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('dashboard.users.create'); // Show the form for creating a new user
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'username' => 'nullable|string',
            'name' => 'required|string',
            'alamat' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'type' => 'required|boolean',
            'no_hp' => 'required|unique:users,no_hp',
            'password' => 'required|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Prepare data for insertion
        $data = $request->only(['username', 'name', 'alamat', 'email', 'type', 'no_hp', 'is_active']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['password'] = bcrypt($request->password);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('profile_picture')->getRealPath())->getSecurePath();
            $data['profile_picture'] = $uploadedFileUrl;
        }

        // Create the user
        User::create($data);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); // Retrieve the user by ID
        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'username' => 'nullable|string',
            'name' => 'required|string',
            'alamat' => 'nullable|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'type' => 'required|boolean',
            'no_hp' => 'required|unique:users,no_hp,' . $id,
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::findOrFail($id);
        $data = $request->only(['username', 'name', 'alamat', 'email', 'type', 'no_hp', 'is_active']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        // If password is provided, hash and update it
        if ($request->filled('password')) {
            $request->validate(['password' => 'confirmed']);
            $data['password'] = bcrypt($request->password);
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture from Cloudinary if it exists
            if ($user->profile_picture) {
                $publicId = basename($user->profile_picture, '.' . pathinfo($user->profile_picture, PATHINFO_EXTENSION));
                Cloudinary::destroy($publicId);
            }

            // Upload the new profile picture to Cloudinary
            $uploadedFileUrl = Cloudinary::upload($request->file('profile_picture')->getRealPath())->getSecurePath();
            $data['profile_picture'] = $uploadedFileUrl;
        }

        // Update the user data
        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }


    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Delete the profile picture from Cloudinary if it exists
        if ($user->profile_picture) {
            $publicId = basename($user->profile_picture, '.' . pathinfo($user->profile_picture, PATHINFO_EXTENSION));
            Cloudinary::destroy($publicId);
        }

        // Delete the user
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
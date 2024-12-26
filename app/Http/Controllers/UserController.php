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
        $users = User::with(['transactions', 'sessions', 'kredentialCustomers'])
            ->get()
            ->map(function ($user) {
                // Cek apakah user memiliki kredential customer (status active)
                $user->is_active = $user->kredentialCustomers()->exists() ? 'Active' : 'Inactive';
    
                // Hitung durasi langganan berdasarkan transaksi pertama
                $firstTransaction = $user->transactions()->orderBy('created_at', 'asc')->first();
                $user->subscription_start_date = $firstTransaction ? $firstTransaction->created_at : null;
    
                // Durasi dalam bulan
                $user->subscription_duration_months = $firstTransaction
                    ? now()->diffInMonths($firstTransaction->created_at)
                    : 0;
    
                return $user;
            });
    
        // Hitung statistik pengguna
        $totalUsers = $users->count();
        $activeUsers = $users->where('is_active', 'Active')->count();
    
        // Notifikasi informatif
        notify()->success("User list loaded successfully! Total users: $totalUsers, Active users: $activeUsers", 'Success');
    
        // Kirim data ke view
        return view('dashboard.users.index', compact('users', 'totalUsers', 'activeUsers'));
    }
    

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        notify()->info('Fill out the form to create a new user.', 'Info');
        return view('dashboard.users.create');
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

        $data = $request->only(['username', 'name', 'alamat', 'email', 'type', 'no_hp', 'is_active']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['password'] = bcrypt($request->password);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            try {
                $uploadedFileUrl = Cloudinary::upload($request->file('profile_picture')->getRealPath())->getSecurePath();
                $data['profile_picture'] = $uploadedFileUrl;
            } catch (\Exception $e) {
                notify()->error('Failed to upload profile picture. Please try again.', 'Error');
                return redirect()->back();
            }
        }

        User::create($data);

        notify()->success('User created successfully!', 'Success');
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        notify()->info('Edit user details below.', 'Info');
        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'nullable|string',
            'name' => 'required|string',
            'alamat' => 'nullable|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'type' => 'required|boolean',
            'no_hp' => 'required|unique:users,no_hp,' . $id,
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['username', 'name', 'alamat', 'email', 'type', 'no_hp', 'is_active']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->filled('password')) {
            $request->validate(['password' => 'confirmed']);
            $data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('profile_picture')) {
            try {
                if ($user->profile_picture) {
                    $publicId = basename($user->profile_picture, '.' . pathinfo($user->profile_picture, PATHINFO_EXTENSION));
                    Cloudinary::destroy($publicId);
                }

                $uploadedFileUrl = Cloudinary::upload($request->file('profile_picture')->getRealPath())->getSecurePath();
                $data['profile_picture'] = $uploadedFileUrl;
            } catch (\Exception $e) {
                notify()->error('Failed to upload profile picture. Please try again.', 'Error');
                return redirect()->back();
            }
        }

        $user->update($data);

        notify()->success('User updated successfully!', 'Success');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->profile_picture) {
            try {
                $publicId = basename($user->profile_picture, '.' . pathinfo($user->profile_picture, PATHINFO_EXTENSION));
                Cloudinary::destroy($publicId);
            } catch (\Exception $e) {
                notify()->error('Failed to delete profile picture. Please try again.', 'Error');
                return redirect()->back();
            }
        }

        $user->delete();

        notify()->success('User deleted successfully!', 'Success');
        return redirect()->route('users.index');
    }
}
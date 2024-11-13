<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class RekeningController extends Controller
{
    // Display list of rekenings
    public function index()
    {
        $rekenings = Rekening::all();
        return view('dashboard.rekenings.index', compact('rekenings'));
    }

    // Show form to create a new rekening
    public function create()
    {
        return view('dashboard.rekenings.create');
    }

    // Store a new rekening in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'no_rek' => 'nullable|string|max:255',
            'type' => 'required|string|in:bank,emoney,qris',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Optional image
        ]);

        $data = $request->only(['name', 'bank', 'no_rek', 'type']);

        // Upload image to Cloudinary with transformation if provided
        if ($request->hasFile('image')) {
            $uploadedFileUrl = cloudinary()->upload($request->file('image')->getRealPath(), [
                'folder' => 'rekening',
            ])->getSecurePath();
            $data['image'] = $uploadedFileUrl;
        }

        Rekening::create($data);

        return redirect()->route('rekenings.index')->with('success', 'Rekening created successfully.');
    }

    // Show form to edit an existing rekening
    public function edit(Rekening $rekening)
    {
        return view('dashboard.rekenings.edit', compact('rekening'));
    }

    // Update an existing rekening in the database
    public function update(Request $request, Rekening $rekening)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'no_rek' => 'nullable|string|max:255',
            'type' => 'required|string|in:bank,emoney,qris',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['name', 'bank', 'no_rek', 'type']);

        // Handle image upload to Cloudinary if provided
        if ($request->hasFile('image')) {
            // Check if a previous image exists and delete it
            if ($rekening->image) {
                $publicId = basename($rekening->image, '.' . pathinfo($rekening->image, PATHINFO_EXTENSION));
                cloudinary()->destroy($publicId);
            }

            // Upload new image with transformation
            $uploadedFileUrl = cloudinary()->upload($request->file('image')->getRealPath(), [
                'folder' => 'rekening',
            ])->getSecurePath();
            $data['image'] = $uploadedFileUrl;
        }

        $rekening->update($data);

        return redirect()->route('rekenings.index')->with('success', 'Rekening updated successfully.');
    }

    // Delete a rekening from the database
    public function destroy(Rekening $rekening)
    {
        // Delete image from Cloudinary if it exists
        if ($rekening->image) {
            $publicId = basename($rekening->image, '.' . pathinfo($rekening->image, PATHINFO_EXTENSION));
            cloudinary()->destroy($publicId);
        }

        $rekening->delete();

        return redirect()->route('rekenings.index')->with('success', 'Rekening deleted successfully.');
    }
}
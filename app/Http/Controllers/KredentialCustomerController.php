<?php

namespace App\Http\Controllers;

use App\Models\KredentialCustomer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class KredentialCustomerController extends Controller
{
    /**
     * Display a listing of the customer credentials.
     */
    public function index()
    {
        $groupedCredentials = KredentialCustomer::with(['user', 'product'])
            ->get()
            ->groupBy('email_akses');

        notify()->success('Customer credentials loaded successfully!');
        return view('dashboard.kredential_customers.index', compact('groupedCredentials'));
    }

    /**
     * Show the form for creating a new customer credential.
     */
    public function create()
    {
        $users = User::whereHas('transactions', function ($query) {
            $query->where('status', 1); // Assuming status 1 means "paid"
        })->get();

        notify()->success('Ready to add new customer credentials!');
        return view('dashboard.kredential_customers.create', compact('users'));
    }

    /**
     * Store a newly created customer credential in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_uuid' => 'required|exists:products,uuid',
            'email_akses' => 'required|string',
            'profil_akes' => 'nullable|string',
            'pin' => 'nullable|string',
        ]);

        KredentialCustomer::create($request->all());

        notify()->success('Customer credential added successfully!');
        return redirect()->route('kredential_customers.index')->with('success', 'Credential created successfully.');
    }

    /**
     * Show the form for editing the specified customer credential.
     */
    public function edit(KredentialCustomer $kredentialCustomer)
    {
        $users = User::whereHas('transactions', function ($query) {
            $query->where('status', 1);
        })->get();

        notify()->success('Editing customer credentials!');
        return view('dashboard.kredential_customers.edit', compact('kredentialCustomer', 'users'));
    }

    /**
     * Update the specified customer credential in storage.
     */
    public function update(Request $request, KredentialCustomer $kredentialCustomer)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_uuid' => 'required|exists:products,uuid',
            'email_akses' => 'required|string',
            'profil_akes' => 'nullable|string',
            'pin' => 'nullable|string',
        ]);

        $kredentialCustomer->update($request->all());

        notify()->success('Customer credential updated successfully!');
        return redirect()->route('kredential_customers.index')->with('success', 'Credential updated successfully.');
    }

    /**
     * Remove the specified customer credential from storage.
     */
    public function destroy(KredentialCustomer $kredentialCustomer)
    {
        $kredentialCustomer->delete();

        notify()->success('Customer credential deleted successfully!');
        return redirect()->route('kredential_customers.index')->with('success', 'Credential deleted successfully.');
    }

    /**
     * Fetch products associated with a user.
     */
    public function getProductsForUser($userId)
    {
        $products = Product::whereHas('transactions', function ($query) use ($userId) {
            $query->where('user_id', $userId)->where('status', 1);
        })->get();

        notify()->success('Products for the user fetched successfully!');
        return response()->json($products);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    /**
     * Display a listing of the suppliers.
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('created_at', 'DESC')->get();
        notify()->success('Supplier list loaded successfully!');
        return view('dashboard.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new supplier.
     */
    public function create()
    {
        notify()->info('Ready to create a new supplier.');
        return view('dashboard.suppliers.create');
    }

    /**
     * Store a newly created supplier in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
            'is_active' => 'boolean',
        ]);

        // Create the supplier record
        Supplier::create([
            'uuid' => Uuid::uuid4(),
            'name' => $request->name,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'address' => $request->address,
            'website' => $request->website,
            'is_active' => $request->has('is_active') ? $request->is_active : false,
        ]);

        // Notify and redirect
        notify()->success('Supplier created successfully!');
        return redirect()->route('suppliers.index');
    }


    /**
     * Display the specified supplier.
     */
    public function show(Supplier $supplier)
    {
        notify()->info('Viewing details for supplier: ' . $supplier->name);
        return view('dashboard.suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified supplier.
     */
    public function edit(Supplier $supplier)
    {
        notify()->info('You are editing the supplier: ' . $supplier->name);
        return view('dashboard.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified supplier in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
            'is_active' => 'boolean',
        ]);

        // Update the supplier record
        $supplier->update([
            'name' => $request->name,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'address' => $request->address,
            'website' => $request->website,
            'is_active' => $request->has('is_active') ? $request->is_active : false,
        ]);

        // Notify and redirect
        notify()->success('Supplier updated successfully!');
        return redirect()->route('suppliers.index');
    }

    /**
     * Remove the specified supplier from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        notify()->success('Supplier deleted successfully!');
        return redirect()->route('suppliers.index');
    }
}

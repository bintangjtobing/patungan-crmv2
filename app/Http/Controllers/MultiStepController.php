<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\KredentialCustomer;
use App\Models\Product;

class MultiStepController extends Controller
{
    public function showForm()
    {
        $customers = User::where('type', 1)->get(); // Only customers
        $products = Product::all();
        return view('dashboard.multi-step-form', compact('customers','products'));
    }

    public function submitForm(Request $request)
    {
        // Validate form data
        $request->validate([
            'customer_type' => 'required|in:existing,new',
            'user_id' => 'required_if:customer_type,existing|nullable|exists:users,id',
            'new_customer_name' => 'required_if:customer_type,new|string|max:255',
            'new_customer_email' => 'required_if:customer_type,new|email|unique:users,email',
            'new_customer_phone' => 'required_if:customer_type,new|string|max:20',
            'product_uuid' => 'required|exists:products,uuid',
            'jumlah' => 'required|integer|min:1',
            'email_akses' => 'required|email',
        ]);

        // Determine if this is a new or existing customer
        if ($request->customer_type === 'new') {
            $customer = User::create([
                'name' => $request->new_customer_name,
                'email' => $request->new_customer_email,
                'no_hp' => $request->new_customer_phone,
                'type' => 1, // Assuming 'type' 1 represents customers
                'is_active' => true,
                'password' => bcrypt('default_password'), // Set a default password or prompt user to set it later
            ]);
        } else {
            $customer = User::find($request->user_id);
        }

        // Retrieve product and calculate price
        $product = Product::where('uuid', $request->product_uuid)->first();
        $totalPrice = $product->harga_jual * $request->jumlah;

        // Create transaction record
        $transaction = Transaction::create([
            'user_id' => $customer->id,
            'jenis_transaksi' => 1, // Assuming 1 represents 'penjualan' (sale)
            'product_uuid' => $product->uuid,
            'jumlah' => $request->jumlah,
            'harga' => $totalPrice,
            'status' => 1, // Set as paid if required
            'bukti_transaksi' => null, // Optional, can be updated later if necessary
        ]);

        // Create credential record for the customer
        KredentialCustomer::create([
            'user_id' => $customer->id,
            'product_uuid' => $product->uuid,
            'email_akses' => $request->email_akses,
            'profil_akes' => $request->profil_akes ?? '',
            'pin' => $request->pin ?? '',
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction and credentials created successfully.');
    }

}
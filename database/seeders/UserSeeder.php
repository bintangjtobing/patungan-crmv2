<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        User::create([
            'username' => 'bintangjtobing',
            'no_hp' => '081262845980',
            'alamat' => 'Sambina Taman Palem',
            'type' => 0, // 0 for admin
            'is_active'=>true,
            'name' => 'Bintang Tobing',
            'email' => 'bintang@patunganyuk.com',
            'password' => 'libra2110',
            'email_verified_at'=>Carbon::now(), // Replace with a secure password
        ]);
    }
}

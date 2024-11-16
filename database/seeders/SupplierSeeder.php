<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;
use Ramsey\Uuid\Uuid;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = [
            [
                'name' => 'Netflix Inc.',
                'contact_email' => 'support@netflix.com',
                'contact_phone' => '+1-800-123-4567',
                'address' => '100 Winchester Circle, Los Gatos, CA 95032, USA',
                'website' => 'https://www.netflix.com',
                'is_active' => true,
            ],
            [
                'name' => 'Microsoft Corporation',
                'contact_email' => 'support@microsoft.com',
                'contact_phone' => '+1-800-642-7676',
                'address' => 'One Microsoft Way, Redmond, WA 98052, USA',
                'website' => 'https://www.microsoft.com',
                'is_active' => true,
            ],
            [
                'name' => 'Spotify AB',
                'contact_email' => 'support@spotify.com',
                'contact_phone' => '+46-8-123-4567',
                'address' => 'Regeringsgatan 19, Stockholm, 111 53, Sweden',
                'website' => 'https://www.spotify.com',
                'is_active' => true,
            ],
            [
                'name' => 'Amazon Prime Video',
                'contact_email' => 'support@amazon.com',
                'contact_phone' => '+1-888-280-4331',
                'address' => '410 Terry Ave N, Seattle, WA 98109, USA',
                'website' => 'https://www.primevideo.com',
                'is_active' => true,
            ],
            [
                'name' => 'Disney+',
                'contact_email' => 'support@disneyplus.com',
                'contact_phone' => '+1-888-905-7888',
                'address' => '500 S. Buena Vista St., Burbank, CA 91521, USA',
                'website' => 'https://www.disneyplus.com',
                'is_active' => true,
            ],
            [
                'name' => 'HBO Max',
                'contact_email' => 'support@hbomax.com',
                'contact_phone' => '+1-855-442-6629',
                'address' => '30 Hudson Yards, New York, NY 10001, USA',
                'website' => 'https://www.hbomax.com',
                'is_active' => true,
            ],
        ];

        foreach ($suppliers as $data) {
            Supplier::create(array_merge($data, ['uuid' => (string) Uuid::uuid4()]));
        }
    }
}
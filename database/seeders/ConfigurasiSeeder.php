<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConfigurasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('configurasis')->delete();

        DB::table('configurasis')->insert([
            'title' => 'My Website',
            'logo' => 'storage/logos/default-logo.png',
            'favicon' => 'storage/favicons/default-favicon.ico',
            'email' => 'info@example.com',
            'email2' => 'support@example.com',
            'phone' => '+1234567890',
            'alamat' => '123 Main Street, Anytown, USA',
            'map' => 'https://maps.google.com/?q=123+Main+Street,+Anytown,+USA',
            'footer' => '© 2024 My Website. All rights reserved.',
            'instagram' => 'https://instagram.com/example',
            'facebook' => 'https://facebook.com/example',
            'twitter' => 'https://twitter.com/example',
            'youtube' => 'https://youtube.com/example',
            'whatsapp' => 'https://wa.me/1234567890',
            'linkedin' => 'https://linkedin.com/company/example',
            'overview' => 'Welcome to My Website, where we offer the best services in the industry.',
            'metakeyword' => 'website, services, example',
            'metadeskripsi' => 'My Website offers a range of services and products. Contact us for more details.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'status' => 'admin',
            'name' => 'Ricko Haikal',
            'email' => 'rickohaikal@gmail.com',
            'password' => Hash::make('ricko123'),
            'address' => 'Jl. Simo Kwagean Kuburan No 70',
            'phone_number' => '082131591516'
        ]);

        Barang::create([
            'item_name' => 'Batik Prada Pink',
            'image' => 'batik_pink',
            'price' => 55000,
            'stock' => 5,
            'size' => '2.10 x 1.10'
        ]);

        Barang::create([
            'item_name' => 'Batik Prada Hijau',
            'image' => 'batik_hijau',
            'price' => 60000,
            'stock' => 10,
            'size' => '2.10 x 1.10'
        ]);

        Barang::create([
            'item_name' => 'Batik Prada Kuning',
            'image' => 'batik_kuning',
            'price' => 50000,
            'stock' => 8,
            'size' => '2.10 x 1.10'
        ]);
    }
}

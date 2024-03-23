<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        User::create([
            'name' => 'Fajar Haqqy Ashbahanie',
            'username' => 'haki',
            'unit' => 'ADMIN',
            'password' => Hash::make('bebek')
        ]);

        User::create([
            'name' => 'Toton Dwi Antoko',
            'username' => 'toton',
            'unit' => 'CASEMIX',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Faried Abimanyu Bhakti Nusantara',
            'username' => 'abim',
            'unit' => 'TEKNIK UMUM',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Saiful Fahmi',
            'username' => 'fahmi',
            'unit' => 'AKREDITASI',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Talia Kamil',
            'username' => 'talia',
            'unit' => 'PERSONALIA',
            'password' => Hash::make('password')
        ]);
    }
}

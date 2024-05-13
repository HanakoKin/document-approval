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
            'jabatan' => 'ADMIN',
            'password' => Hash::make('password'),
            'NIK' => 1
        ]);

        User::create([
            'name' => 'Toton Dwi Antoko',
            'username' => 'toton',
            'jabatan' => 'CASEMIX',
            'password' => Hash::make('password'),
            'NIK' => 2
        ]);

        User::create([
            'name' => 'Faried Abimanyu Bhakti Nusantara',
            'username' => 'abim',
            'jabatan' => 'TEKNIK UMUM',
            'password' => Hash::make('password'),
            'NIK' => 3
        ]);

        User::create([
            'name' => 'Saiful Fahmi',
            'username' => 'fahmi',
            'jabatan' => 'AKREDITASI',
            'password' => Hash::make('password'),
            'NIK' => 4
        ]);

        User::create([
            'name' => 'Talia Kamil',
            'username' => 'talia',
            'jabatan' => 'PERSONALIA',
            'password' => Hash::make('password'),
            'NIK' => 5
        ]);

        User::create([
            'name' => 'Dr. Erani Soengkono, MARS',
            'username' => 'erani',
            'jabatan' => 'Direktur Utama',
            'password' => Hash::make('password'),
            'NIK' => 105733031
        ]);

        User::create([
            'name' => 'Thomas Seto Ananto, S.E',
            'username' => 'tommy',
            'jabatan' => 'Ka.Unit Hardware dan Jaringan',
            'password' => Hash::make('password'),
            'NIK' => 405743040
        ]);

        User::create([
            'name' => 'Andreas Prasetyo',
            'username' => 'andreas',
            'jabatan' => 'Ka.Div Teknologi Informasi',
            'password' => Hash::make('password'),
            'NIK' => 405833041
        ]);

        User::create([
            'name' => 'Dr. Albert Wijaya, S.P. K.P.',
            'username' => 'albert',
            'jabatan' => 'Ka.Unit Casemix',
            'password' => Hash::make('password'),
            'NIK' => 123884550
        ]);
    }
}

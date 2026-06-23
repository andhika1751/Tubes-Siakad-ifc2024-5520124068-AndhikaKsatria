<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@siakad.test',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'npm'      => null,
        ]);

        Mahasiswa::all()->each(function (Mahasiswa $mhs) {
            User::create([
                'name'     => $mhs->nama,
                'email'    => $mhs->npm.'@siakad.test',
                'password' => Hash::make($mhs->npm),
                'role'     => 'mahasiswa',
                'npm'      => $mhs->npm,
            ]);
        });
    }
}

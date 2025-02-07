<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Zaki Adam',
            'email' => 'zakiadam@upi.edu',
            'password' => Hash::make('123123123'),
            'is_admin' => true,
        ]);
        User::create([
            'name' => 'Nowin',
            'email' => 'nowin@gmail.com',
            'password' => Hash::make('123')
        ]);
        User::create([
            'name' => 'Ika',
            'email' => 'ika@gmail.com',
            'password' => Hash::make('123')
        ]);
    }
}

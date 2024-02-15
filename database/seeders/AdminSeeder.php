<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
           'name' => 'Admin',
           'email' => 'admin@gmail.com',
           'password' => Hash::make(value:'123456'),
           'users_id' =>1,
        ];

        User::create($data);
    }
}

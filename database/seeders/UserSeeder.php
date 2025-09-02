<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            [
                'phone' => "+9779746892002",
                'email' => "app@rohan.info.np",
                'username' => "rohan",
            ],
            [
                'full_name' => "Rohan Adhikari",
                'password' =>  bcrypt('Rohan@567'),
            ]
        );
        // $user->assignRole('super_admin');
    }
}

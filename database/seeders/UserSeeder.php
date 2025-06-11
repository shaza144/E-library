<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $users = [
            ['username' => 'admin1', 'email' => 'admin1@mail.com', 'password' => Hash::make('123456'), 'fname' => 'Omar', 'lname' => 'Nasser', 'is_admin' => true],
            ['username' => 'user1', 'email' => 'user1@mail.com', 'password' => Hash::make('123456'), 'fname' => 'Layla', 'lname' => 'Yousef', 'is_admin' => false],
            ['username' => 'user2', 'email' => 'user2@mail.com', 'password' => Hash::make('123456'), 'fname' => 'Ahmad', 'lname' => 'Rami', 'is_admin' => false],
            ['username' => 'admin2', 'email' => 'admin2@mail.com', 'password' => Hash::make('123456'), 'fname' => 'Salma', 'lname' => 'Bitar', 'is_admin' => true],
            ['username' => 'user3', 'email' => 'user3@mail.com', 'password' => Hash::make('123456'), 'fname' => 'Nada', 'lname' => 'Ali', 'is_admin' => false],
            ['username' => 'user4', 'email' => 'user4@mail.com', 'password' => Hash::make('123456'), 'fname' => 'Kareem', 'lname' => 'Haddad', 'is_admin' => false],
            ['username' => 'user5', 'email' => 'user5@mail.com', 'password' => Hash::make('123456'), 'fname' => 'Rana', 'lname' => 'Issa', 'is_admin' => false],
            ['username' => 'user6', 'email' => 'user6@mail.com', 'password' => Hash::make('123456'), 'fname' => 'Bilal', 'lname' => 'Fares', 'is_admin' => false],
            ['username' => 'user7', 'email' => 'user7@mail.com', 'password' => Hash::make('123456'), 'fname' => 'Tarek', 'lname' => 'Hani', 'is_admin' => false],
            ['username' => 'user8', 'email' => 'user8@mail.com', 'password' => Hash::make('123456'), 'fname' => 'Noor', 'lname' => 'Jaber', 'is_admin' => false],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
    }


<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $authors = [
            ['fname' => 'John', 'lname' => 'Doe', 'country' => 'Syria', 'city' => 'Damascus', 'address' => 'Al-Mazzeh Street'],
            ['fname' => 'Mary', 'lname' => 'Smith', 'country' => 'Lebanon', 'city' => 'Beirut', 'address' => 'Hamra St.'],
            ['fname' => 'Omar', 'lname' => 'Khateeb', 'country' => 'Syria', 'city' => 'Homs', 'address' => 'Al-Kossour'],
            ['fname' => 'Mona', 'lname' => 'Hatem', 'country' => 'Egypt', 'city' => 'Cairo', 'address' => 'Ramsis'],
            ['fname' => 'Samir', 'lname' => 'Salem', 'country' => 'Jordan', 'city' => 'Amman', 'address' => 'University Street'],
            ['fname' => 'Lina', 'lname' => 'Hassan', 'country' => 'Syria', 'city' => 'Aleppo', 'address' => 'Shahba'],
            ['fname' => 'Huda', 'lname' => 'Youssef', 'country' => 'Iraq', 'city' => 'Baghdad', 'address' => 'Al-Karada'],
            ['fname' => 'Rami', 'lname' => 'Jamil', 'country' => 'Syria', 'city' => 'Tartous', 'address' => 'Corniche St.'],
            ['fname' => 'Dana', 'lname' => 'Fadel', 'country' => 'Tunisia', 'city' => 'Tunis', 'address' => 'Habib Bourguiba Ave.'],
            ['fname' => 'Ziad', 'lname' => 'Amine', 'country' => 'Morocco', 'city' => 'Rabat', 'address' => 'Hassan II Blvd.'],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Publisher;


class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $publishers = [
            ['pname' => 'Knowledge House', 'city' => 'Damascus'],
            ['pname' => 'Arabic Readers', 'city' => 'Cairo'],
            ['pname' => 'Future Books', 'city' => 'Amman'],
            ['pname' => 'Wisdom Press', 'city' => 'Beirut'],
            ['pname' => 'Digital Library Co.', 'city' => 'Tunis'],
            ['pname' => 'Horizon Publishing', 'city' => 'Aleppo'],
            ['pname' => 'Elite Books', 'city' => 'Rabat'],
            ['pname' => 'Nile Publications', 'city' => 'Khartoum'],
            ['pname' => 'Open Knowledge', 'city' => 'Baghdad'],
            ['pname' => 'Syrian Book Center', 'city' => 'Latakia'],
        ];

        foreach ($publishers as $pub) {
            Publisher::create($pub);
        }
    }
}

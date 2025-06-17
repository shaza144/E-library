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
          $arabicCities = [
            'Damascus', 'Cairo', 'Amman', 'Beirut', 'Tunis',
            'Aleppo', 'Rabat', 'Khartoum', 'Baghdad', 'Latakia',
            'Alexandria', 'Dubai', 'Riyadh', 'Muscat', 'Doha'
        ];

        $publisherTypes = [
            'House', 'Press', 'Publications', 'Publishing', 'Books',
            'Library', 'Center', 'Media', 'Print', 'Editions'
        ];

        $publisherPrefixes = [
            'Knowledge', 'Arabic', 'Future', 'Wisdom', 'Digital',
            'Horizon', 'Elite', 'Nile', 'Open', 'Golden',
            'Modern', 'United', 'Global', 'Creative', 'Advanced'
        ];

        for ($i = 0; $i < 15; $i++) {
            $publisherName = $this->generatePublisherName($publisherPrefixes, $publisherTypes);

            Publisher::create([
                'pname' => $publisherName,
                'city' => fake()->randomElement($arabicCities),
            ]);
        }
    }

    protected function generatePublisherName(array $prefixes, array $types): string
    {
        $name = fake()->randomElement($prefixes) . ' ' . fake()->randomElement($types);

        // 30% chance to add a suffix
        if (fake()->boolean(30)) {
            $suffixes = ['Co.', 'Ltd.', 'Inc.', 'Group', 'International'];
            $name .= ' ' . fake()->randomElement($suffixes);
        }

        return $name;
    }
}

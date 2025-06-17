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

        $countries = ['Syria', 'Lebanon', 'Egypt', 'Jordan', 'Iraq', 'Tunisia', 'Morocco', 'Algeria', 'Saudi Arabia', 'UAE'];
        $syrianCities = ['Damascus', 'Aleppo', 'Homs', 'Latakia', 'Tartous', 'Hama', 'Daraa'];
        $lebanonCities = ['Beirut', 'Tripoli', 'Sidon', 'Tyre', 'Byblos'];
        $egyptCities = ['Cairo', 'Alexandria', 'Giza', 'Luxor', 'Aswan'];
        $jordanCities = ['Amman', 'Zarqa', 'Irbid', 'Aqaba'];
        $iraqCities = ['Baghdad', 'Basra', 'Mosul', 'Erbil'];
        $tunisiaCities = ['Tunis', 'Sfax', 'Sousse', 'Kairouan'];
        $moroccoCities = ['Rabat', 'Casablanca', 'Marrakesh', 'Fes'];

        for ($i = 0; $i < 30; $i++) {
            $country = fake()->randomElement($countries);

            Author::create([
                'fname' => fake()->firstName(),
                'lname' => fake()->lastName(),
                'country' => $country,
                'city' => $this->getCityByCountry($country, $syrianCities, $lebanonCities, $egyptCities, $jordanCities, $iraqCities, $tunisiaCities, $moroccoCities),
                'address' => $this->generateAddress(),
            ]);
        }
    }

    protected function getCityByCountry($country, $syrianCities, $lebanonCities, $egyptCities, $jordanCities, $iraqCities, $tunisiaCities, $moroccoCities)
    {
        return match($country) {
            'Syria' => fake()->randomElement($syrianCities),
            'Lebanon' => fake()->randomElement($lebanonCities),
            'Egypt' => fake()->randomElement($egyptCities),
            'Jordan' => fake()->randomElement($jordanCities),
            'Iraq' => fake()->randomElement($iraqCities),
            'Tunisia' => fake()->randomElement($tunisiaCities),
            'Morocco' => fake()->randomElement($moroccoCities),
            default => fake()->city(),
        };
    }

    protected function generateAddress(): string
    {
        $streetTypes = ['St.', 'Street', 'Ave.', 'Avenue', 'Blvd.', 'Road', 'Square'];
        $prefixes = ['Al-', 'Ibn ', 'Prince ', 'King ', 'Sheikh '];

        return fake()->randomElement($prefixes) .
               fake()->word() . ' ' .
               fake()->randomElement($streetTypes);
    }
}

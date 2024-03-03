<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PragmaRX\Countries\Package\Countries;
use Exception;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = new Countries();
        $allCountries = $countries->all();

        foreach ($allCountries as $country) {
            try {
                \DB::table('countries')->insert([
                    'name' => $country->name->common,
                    'iso_alpha_2' => $country->cca2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } catch (Exception $e) {
                // Log or handle the error as needed
                continue; // Skip to the next iteration if an error occurs
            }
        }
    }
}
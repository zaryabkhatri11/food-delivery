<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Karachi',
            'Lahore',
            'Islamabad',
            'Rawalpindi',
            'Faisalabad',
            'Multan',
            'Peshawar',
            'Quetta',
            'Hyderabad',
            'Sialkot',
            'Gujranwala',
            'Bahawalpur',
            'Sargodha',
            'Sukkur',
            'Larkana',
            'Sheikhupura',
            'Rahim Yar Khan',
            'Abbottabad',
            'Mardan',
            'Gwadar',
            'Other'
        ];


        foreach ($cities as $city) {
            City::create(['name' => $city]);
        }
    }
}

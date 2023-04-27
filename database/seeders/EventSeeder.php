<?php

namespace Database\Seeders;

use App\Models\Events;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 5; $i++) {  
        $events = new Events;
        $events->event_name = $faker->sentence(5); 
        $events->event_location = "1670352002.png";
        $events->event_category = "M";
        $events->event_status = "A";
        $events->event_price = $faker->numberBetween($min = 500, $max = 8000);
        $events->event_description = $faker->sentence(50);
        $events->save();
     }
    }
}

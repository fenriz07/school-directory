<?php

use Illuminate\Database\Seeder;
use App\Models\OpeningTime;
use App\Models\Listing;

class ListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();


        $openingtimes = [];

        $openingtimes[] = new OpeningTime(['weekday' => 'Sunday', 'start' => '00:00:00', 'end' => '02:00:00']);
        $openingtimes[] = new OpeningTime(['weekday' => 'Monday', 'start' => '00:00:00', 'end' => '02:00:00']);
        
        $listing = Listing::create([
            'title'  => 'Listing 1',
            'slug'   => $faker->slug,
            'description' => 'Descripción 1',
            'address' => $faker->address,
            'service_area' => $faker->address,
            'email' => $faker->email,
            'website' => $faker->domainName,
            'facebook' => $faker->word,
            'twitter' => $faker->word,
            'phone' => $faker->phoneNumber,
            'phone_afterhours' => $faker->phoneNumber,
            'verified' => 1,
            'approved' => 1,
            'spam' => false,
        ]);

        $listing->openingtimes()->saveMany($openingtimes);


        $listing->categories()->attach(2);
        $listing->categories()->attach(3);
        $listing->categories()->attach(4);

        $listing = Listing::create([
            'title'  => 'Listing 2',
            'slug'   => $faker->slug,
            'description' => 'Descripción 2',
            'address' => $faker->address,
            'service_area' => $faker->address,
            'email' => $faker->email,
            'website' => $faker->domainName,
            'facebook' => $faker->word,
            'twitter' => $faker->word,
            'phone' => $faker->phoneNumber,
            'phone_afterhours' => $faker->phoneNumber,
            'verified' => 1,
            'approved' => 1,
            'spam' => false,
        ]);

        $listing->openingtimes()->saveMany($openingtimes);

        $listing->categories()->attach(2);
        $listing->categories()->attach(4);
    }
}

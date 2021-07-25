<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ApartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment(['local', 'development', 'staging'])) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('apartments')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $faker = Faker\Factory::create();

            for($i = 0; $i < 50; $i++) {
                $apartmentName = "Apartement " . $faker->company(20);
                DB::table('apartments')->insert([
                    'name' => $apartmentName,
                    'slug' => Str::slug($apartmentName, '_'),
                    'price' => mt_rand(50000, 200000),
                    'currency' => env("DEFAULT_CURRENCY", "EUR"),
                    'description' => $faker->realText(200),
                    'properties' => json_encode(
                        [
                            'size' => mt_rand(30, 400),
                            'numberOfBalconies' => mt_rand(1, 3),
                            'balconySize' => mt_rand(2, 15),
                            'location' => $faker->address()
                        ]
                    ),
                    'category_id' => mt_rand(1, 3),
                    'created_at' => \Carbon\Carbon::now()
                ]);
            }
        }
    }
}

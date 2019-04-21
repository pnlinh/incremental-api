<?php

use App\Lesson;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lesson::truncate();

        $faker = Faker::create();

        foreach (range(1, 30) as $index) {
            Lesson::create([
                'title' => $faker->sentence(5),
                'body' => $faker->paragraph(4),
                'some_bool' => $faker->boolean,
            ]);
        }
    }
}

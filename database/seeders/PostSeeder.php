<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator;

class PostSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    $faker = app(Generator::class);

    for($i = 0; $i < 10; $i++) {
      $data = [
        'title' => ucwords($faker->catchPhrase .' '.$faker->bs),
        'content' => $faker->realText(),
        'created_by' => 1,
        'updated_by' => 1
      ];

      \App\Models\Post::create($data);
    }
       
  }
}

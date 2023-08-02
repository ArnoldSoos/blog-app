<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator;

class TagSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    $words = ['green', 'laptop', 'apple', 'bike', 'chair', 'tall', 'correct', 'sun', 'light', 'top', 'music', 'classic', 'volvo', 'house', 'young'];
    foreach($words as $word) {
        \App\Models\Tag::create(['tag' => $word]);
    }
       
  }
}


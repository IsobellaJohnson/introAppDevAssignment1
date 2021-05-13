<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RatingSeeder::class);
        $this->call(ReviewerSeeder::class);
        $this ->call(MovieSeeder::class);

    }
}

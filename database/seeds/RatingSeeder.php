<?php

use Illuminate\Database\Seeder;
use App\Rating;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json_file = File::get('database/data/rating-data.json');
        DB::table('ratings')->delete();
        $data = json_decode($json_file);
        foreach($data as $obj){
            Rating::create(array(
                'rating' => $obj->rating,
                'ratingDate' => $obj->ratingDate
             ));
        }
    }
}

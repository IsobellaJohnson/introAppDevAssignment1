<?php

use Illuminate\Database\Seeder;
use App\Movie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json_file = File::get('database/data/movie-data.json');
        DB::table('movies')->delete();
        $data = json_decode($json_file);
        foreach($data as $obj){
            Movie::create(array(
                'title' => $obj->title,
                'genre' => $obj->genre,
                'year' => $obj->year,
                'director' => $obj->director,
            ));
        }
    }
}

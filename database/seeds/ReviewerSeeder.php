<?php

use Illuminate\Database\Seeder;
use App\Reviewer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ReviewerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json_file = File::get('database/data/reviewer-data.json');
        DB::table('reviewers')->delete();
        $data = json_decode($json_file);
        foreach($data as $obj){
            Reviewer::create(array(
                'first_name' => $obj->first_name,
                'last_name' => $obj->last_name
            ));
        }
    }
}

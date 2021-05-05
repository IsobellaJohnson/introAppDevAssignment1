<?php

namespace Tests\Feature;

use App\Movie;
use App\Reviewer;
use App\Rating;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function setUp(): void{
        parent::setUp();

        // Movie::create([
        //     'title' => 'testMov1',
        //     'year' => "2000",
        //     'director' => 'testDir1',
        //     'genre' => 'testGen1'
        // ]);

        Reviewer::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe'
        ]);

        Rating::create([
            'rating' => '4',
            'ratingDate' => '01-01-2000',
            'movie_id' => 3,
            'reviewer_id' => 2
        ]);
    }



        public function testPOSTMovies(){
            $payload = [
                'title' => 'testMov2',
                'year' => '2001',
                'director' => 'testDir2',
                'genre' => 'testGen3'
            ];
            $response = $this->post('api/movies', $payload);
            $response
                ->assertStatus(201)
                ->assertJSON([
                    "message" => "Movie created."
                ]);
        }
        public function testUpdateMovies(){
            $payload = [
                'title' => 'updatedMovie',
                'year' => '1900',
                'director' => 'Jon Jones',
                'genre' => 'Action'
            ];

            $response = $this->put('/api/movies/2', $payload);
            $response
                ->assertStatus(200)
                ->assertJson([
                    "message" => "Movie updated."
               ]);
        }
        public function testGETMovies(){
            $response = $this->get('/api/movies');
            $response
                ->assertStatus(200)
                ->assertJsonStructure(
                    [
                        '*' => [
                            'title',
                            'year',
                            'director',
                            'genre'
                        ]
                    ]
            );
        }
        public function testGETMovie(){
            $response = $this->get('/api/movies/4');
            $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'title' => 'Inception'
            ]);
        }
        public function testDELETEMovie()
        {
            $response = $this->delete('/api/movies/1');
            $response
                ->assertStatus(202)
                ->assertJson([
                    "message" => "Movie deleted."
                ]);
        }
        // public function testDELETEMovieNotFound(){
        //     $response = $this->delete('/api/movies/2');
        //     $response
        //     ->assertStatus(404)
        //     ->assertJson([
        //         "message" => "Movie not found."
        //     ]);
            
        // }
}

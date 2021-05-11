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
    //use RefreshDatabase;
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

        Movie::create([ //shows up 7 times??
            'title' => 'Avatar',
            'year' => "2009",
            'director' => 'James Cameron',
            'genre' => 'Sci-fi'
        ]);

        Reviewer::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe'
        ]);

        // Rating::create([
        //     'rating' => '4',
        //     'ratingDate' => '01-01-2000',
        //     'movie_id' => 120,
        //     'reviewer_id' => 122
        // ]);
    }

        public function testPOSTMovies(){
            $payload = [
                'title' => 'Tenet',
                'year' => '2020',
                'director' => 'Christopher Nolan',
                'genre' => 'Action'
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
                'title' => 'Get Out',
                'year' => '2016',
                'director' => 'Jordan Peele',
                'genre' => 'Thriller'
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
        public function testDELETEMovieNotFound(){
            $response = $this->delete('/api/movies/3');
            $response
            ->assertStatus(202)
            ->assertJson([
                "message"=>"Movie deleted." //need to change this to movie not found in the controller so it works
            ]);
        }
        public function testPOSTReviewer(){
            $payload = [
                'first_name' => 'Humpty',
                'last_name' => 'Dumpty'
            ];
            $response = $this->post('/api/reviewers', $payload);
            $response
            ->assertStatus(201)
            ->assertJson([
                "message" => "Reviewer created" //change in controller to having a fullstop
            ]);

        }
     
}

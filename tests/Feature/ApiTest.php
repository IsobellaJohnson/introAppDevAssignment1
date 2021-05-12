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

        // Movie::create([ //shows up 7 times??
        //     'title' => 'Avatar',
        //     'year' => "2009",
        //     'director' => 'James Cameron',
        //     'genre' => 'Sci-fi',
        //     'reviewer_id' =>  6,
        //     'rating_id' => 7

        // ]);

        // Reviewer::create([
        //     'first_name' => 'Jane',
        //     'last_name' => 'Doe'
        // ]);

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
                'genre' => 'Action',
                'reviewer_id' =>  9,
                'rating_id' => 1
            ];
            $response = $this->post('api/movies', $payload);
            $response
                ->assertStatus(201)
                ->assertJSON([
                    "message" => "Movie created."
                ]);

                $payload2 = [
                    'title' => 'Wall-e',
                    'year' => '2007',
                    'director' => 'Andrew Stanton',
                    'genre' => 'Animation',
                    'reviewer_id' =>  8,
                    'rating_id' => 2
                ];
                $response = $this->post('api/movies', $payload2);
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
                'genre' => 'Thriller',
                'reviewer_id' => 9,
                'rating_id' => 3
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
                            'id',
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
            $response = $this->delete('/api/movies/23');
            $response
            ->assertStatus(404)
            ->assertJson([
                "message"=>"Movie not found." //need to change this to movie not found in the controller so it works
            ]);
        }
        public function testPOSTReviewers(){
            $payload = [
                'first_name' => 'Calvin',
                'last_name' => 'Klein'
            ];
            $response = $this->post('/api/reviewers', $payload);
            $response
            ->assertStatus(201)
            ->assertJson([
                "message" => "Reviewer created" //change in controller to having a fullstop
            ]);
            $payload2 = [
                'first_name' => 'Marc',
                'last_name' => 'Jacobs'
            ];
            $response = $this->post('/api/reviewers', $payload2);
            $response
            ->assertStatus(201)
            ->assertJson([
                "message" => "Reviewer created" //change in controller to having a fullstop
            ]);
        }
        public function testUpdateReviewers(){
            $payload = [
                'first_name' => 'Kamaru',
                'last_name' => 'Usman'
            ];

            $response = $this->put('/api/reviewers/3', $payload);
            $response
                ->assertStatus(200)
                ->assertJson([
                    "message" => "Reviewer updated"
               ]);
        }
        public function testGETReviewers(){
            $response = $this->get('/api/reviewers');
            $response
                ->assertStatus(200)
                ->assertJsonStructure(
                    [
                        '*' => [
                            'id',
                            'first_name',
                            'last_name'
                        ]
                    ]
            );
        }
        public function testGETReviewer(){
            $response = $this->get('/api/reviewers/8');
            $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'first_name' => 'Colby'
            ]);
        }
        public function testDELETEReviewer()
        {
            $response = $this->delete('/api/reviewers/1');
            $response
                ->assertStatus(202)
                ->assertJson([
                    "message" => "Reviewer deleted"
                ]);
        }
        public function testDELETEReviewerNotFound(){
            $response = $this->delete('/api/reviewers/17');
            $response
            ->assertStatus(404)
            ->assertJson([
                "message"=>"Reviewer not found" 
            ]);
        }
        public function testPOSTRatings(){
            $payload = [
                'rating' => '2',
                'ratingDate' => '11-11-2011',
            ];
            $response = $this->post('api/ratings', $payload);
            $response
                ->assertStatus(201)
                ->assertJSON([
                    "message" => "Rating created"
                ]);
                $payload2 = [
                    'rating' => '5',
                    'ratingDate' => '22-01-1981',
                ];
                $response = $this->post('api/ratings', $payload2);
                $response
                    ->assertStatus(201)
                    ->assertJSON([
                        "message" => "Rating created"
                    ]);
        }
         public function testUpdateRatings(){
            $payload = [
                'rating' => '4',
                'ratingDate' => '01-01-2021' //showing up as 4
            ];

            $response = $this->put('/api/ratings/4', $payload);
            $response
                ->assertStatus(200)
                ->assertJson([
                    "message" => "Rating updated"
               ]);
        }
        public function testGETRatings(){
            $response = $this->get('/api/ratings');
            $response
                ->assertStatus(200)
                ->assertJsonStructure(
                    [
                        '*' => [
                            'rating',
                            'ratingDate'
                        ]
                    ]
            );
        }
        public function testGETRating(){
            $response = $this->get('/api/ratings/1');
            $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'rating' => 4
            ]);
        }
        public function testDELETERating()
        {
            $response = $this->delete('/api/ratings/6');
            $response
                ->assertStatus(202)
                ->assertJson([
                    "message" => "Rating deleted"
                ]);
        }
        public function testDELETERatingNotFound(){
            $response = $this->delete('/api/ratings/50');
            $response
            ->assertStatus(404)
            ->assertJson([
                "message" => "Rating not found" 
            ]);
        }

     
}

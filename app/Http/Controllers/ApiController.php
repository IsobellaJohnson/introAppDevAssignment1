<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Rating;
use Validator;

class ApiController extends Controller
{
    //movie CRUD

    public function createMovie(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'genre' => 'required',
            'year' => 'required',
            'director' => 'required'

        ]);

        if ($validator->fails()){
            return response()->json(['message' => $validator->errors()], 403);
        } else{
            Movie::create($request->all());
            return response()->json(['message' => 'Movie created.'], 201);
        }
    }

    public function updateMovie(Request $request, $id){
    $movies = Movie::query();
    if($movies->where('id', $id)->exists()){
        $movie = $movies->find($id);
        $movie->title = is_null($request->title) ? $movie->title : $request->title;
        $movie->genre = is_null($request->genre) ? $movie->genre : $request->genre;
        $movie->year= is_null($request->year) ? $movie->year : $request->year;
        $movie->director = is_null($request->director) ? $movie->director : $request->director;
        $movie->save();
        return response()->json(['message' =>  'Movie updated.'], 200);
    } else{
        return response()->json(['message' =>  'Movie not found.'], 404);
    }
    }
    public function deleteMovie($id){
        $movies = Movie::query();
        if($movies->where('id', $id)->exists()){
            $movie = $movies->find($id);
            $movie->delete();
            return response()->json(['message' =>  'Movie deleted.'], 202);
        }else{
            return response()->json(['message' =>  'Movie not found.'], 404);
        }
    }

    public function getAllMovies(Request $request){
        $movies = Movie::query();
        if($request->get('title')){
            $movies->where('title', '=', $request->get('title'))->get();
        }
        return $movies->get();

    }
    public function getMovie($id){
        $movies = Movie::query();
        if($movies-> where('id', $id)->exists()){
            $movie = $movies->where('id', $id)->get();
            return response($movie, 200);
        } else{
            return response()->json(['message'=>'Movie not found.'], 404);
        }

    }

    //rating CRUD -- remember movies = ratings movie =trating

    // public function createRating(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         'rating' => 'required',
    //         'ratingDate' => 'required'
    //     ]);

    //     if($validator->fails()){
    //         return response()->json(['message' => $validator->errors()], 403);
    //     } else{
    //         Rating::create($request->all());
    //         return response()->json(['message' => 'Rating created'], 201);
    //     }
    // }

    // public function updateRating(Request $request, $id){
    //     $ratings = Rating::query();
    //     if($ratings-> where('id', $id)->exists()){
    //         $trating = $ratings->find($id);
    //         $trating->rating = is_null($request->rating) ? $trating->rating : $request->trating;
    //         $trating->ratingDate = is_null($request->ratingDate) ? $trating->ratingDate : $request->trating;
    //         $trating->save();
    //         return response()->json(['message' => 'Rating updated'], 200);
    //     }else{
    //         return response()->json(['message' => 'Rating not found'], 404);
    //     }
    // }

    // public function deleteRating($id){
    //     $ratings = Rating::query();
    //     if($ratings->where('id', $id)->exists()){
    //         $trating = $ratings->find($id);
    //         $trating->delete();
    //         return response()->json(['message', 'Rating deleted.'], 202);
    //     } else{
    //         return response()->json(['message', 'Rating not found.'], 404);
    //     }
    // }
    
    public function getAllRatings(Request $request){
        return Rating::with(['movies'])->get();
    //     $ratings = Rating::query();
    //     if($request->get('rating')){
    //         $ratings->where('rating', '=', $request->get('rating'))->get();
    //     }
    //     return $ratings->get();
     }
    
    // public function getRating($id){
    //     $ratings = Rating::query();
    //     if($ratings->where('id', $id)->exists()){
    //         $trating = $ratings->where('id',$id)->get();
    //         return response($trating, 200);
    //     }else{
    //         return response()->json(['message' => 'Rating not found.'], 404);
    //     }
    // }
}

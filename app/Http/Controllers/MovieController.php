<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Validator;

class movieController extends Controller
{
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
        return Movie::with(['ratings', 'reviewers'])->get();
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

}

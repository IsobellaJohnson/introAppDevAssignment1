<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Rating;
use App\Reviewer;
use Validator;

class RatingController extends Controller
{
    //rating CRUD -- remember movies = ratings movie =trating

     public function createRating(Request $request){
        $validator = Validator::make($request->all(), [
            'rating' => 'required',
            'ratingDate' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['message' => $validator->errors()], 403);
        } else{
            Rating::create($request->all());
            return response()->json(['message' => 'Rating created'], 201);
        }
    }

    public function updateRating(Request $request, $id){
        $ratings = Rating::query();
        if($ratings-> where('id', $id)->exists()){
            $rating = $ratings->find($id);
            $rating->rating = is_null($request->rating) ? $rating->rating : $request->rating;
            $rating->ratingDate = is_null($request->ratingDate) ? $rating->ratingDate : $request->rating;
            $rating->save();
            return response()->json(['message' => 'Rating updated'], 200);
        }else{
            return response()->json(['message' => 'Rating not found'], 404);
        }
    }

    public function deleteRating($id){
        $ratings = Rating::query();
        if($ratings->where('id', $id)->exists()){
            $rating = $ratings->find($id);
            $rating->delete();
            return response()->json(['message', 'Rating deleted'], 202);
        } else{
            return response()->json(['message', 'Rating not found'], 404);
        }
    }
    
    public function getAllRatings(Request $request){ 
       // return Rating::with(['movies', 'reviewers'])->get();
         $ratings = Rating::query();
         if($request->get('rating')){ //tihs might need to be changed later cos get rating
             $ratings->where('rating', '=', $request->get('rating'))->get();
         }
         return $ratings->get();
     }
    
     public function getRating($id){
         $ratings = Rating::query();
         if($ratings->where('id', $id)->exists()){
             $rating = $ratings->where('id',$id)->get();
            return response($rating, 200);
         }else{
             return response()->json(['message' => 'Rating not found.'], 404);
         }
     }
}

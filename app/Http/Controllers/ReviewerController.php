<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reviewer;
use Validator;

class ReviewerController extends Controller
{
    public function createReviewer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['message' => $validator->errors()], 403);
        } else{
            Reviewer::create($request->all());
            return response()->json(['message' => 'Reviewer created'], 201);
        }
    }
    public function updateReviewer(Request $request, $id){
        $reviewers = Reviewer::query();
        if($reviewers-> where('id', $id)->exists()){
            $reviewer = $reviewers->find($id);
            $reviewer->first_name = is_null($request->first_name) ? $reviewer->first_name : $request->first_name;
            $reviewer->last_name = is_null($request->last_name) ? $reviewer->last_name : $request->last_name;
            $reviewer->save();
            return response()->json(['message' => 'Reviewer updated'], 200);
        } else{
            return response()->json(['message' => 'Reviewer not found'], 404);
        }
    }
    public function deleteReviewer($id){
        $reviewers = Reviewer::query();
        if($reviewers->where('id', $id)->exists()){
            $reviewer = $reviewers->find($id);
            $reviewer->delete();
            return response()->json(['message' => 'Reviewer deleted'], 202);
        } else{
            return response()->json(['message' => 'Reviewer not found'], 404);
        }

    }
    public function getAllReviewers(Request $request)
    {
        $reviewers = Reviewer::query();
        if($request->get('first_name')){
            $reviewers->where('first_name', '=', $request->get('first_name'))->get();         
        }
        if($request->get('last_name')){
            $reviewers->where('last_name', '=', $request->get('last_name'))->get();         
        }
        return $reviewers->get();
    }
    public function getReviewer($id){
        $reviewers = Reviewer::query();
        if($reviewers -> where('id', $id)->exists()){
            $reviewer = $reviewers->where('id', $id)->get();
            return response($reviewer, 200);
        } else{
            return response()->json(['message'=> 'Reviewer not found', 404]);
        }
    }
}

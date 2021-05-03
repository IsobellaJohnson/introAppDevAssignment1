<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reviewer;
use validator;

class ReviewerController extends Controller
{
    public function getAllReviewers(Request $request)
    {
        $reviewers = Reviewer::query();
        if($request->get('name')){
            $reviewers->where('name', '=', $request->get('name'))->get();
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

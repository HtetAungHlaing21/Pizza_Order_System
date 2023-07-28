<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    //Save the pizza ratings
    public function rate(Request $request){
        $this->checkValidation($request);
        $data = $this->getData($request);
        Rating::create($data);
        return back()->with(['reviewSuccess'=>'Successfully given a review!']);
    }

    //Private functions
    //Validate
    private function checkValidation($request){
        Validator::make($request->all(), [
            'rating' => 'required',
            'review' => 'required|min:10'
        ])->validate();
    }

    //Get data
    private function getData($request){
        return [
            'user_id' => $request->userID,
            'product_id' => $request->productID,
            'rating_count' => $request->rating,
            'review' => $request->review,
        ];
    }
}

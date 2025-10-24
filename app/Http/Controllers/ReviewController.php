<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function Review(){
        return view('reviews.review');
    }
    public function StoreReview(Request $request){
        $request->validate([
'name'=>'required|string',
'phone'=>'required|string',
'email'=>'required|string',
'subject'=>'required|string',
'message'=>'required'
        ]);
        Review::create([
'name'=>$request->name,
'phone'=>$request->phone,
'email'=>$request->email,
'subject'=>$request->subject,
'message'=>$request->message,
        ]);
        return redirect('/reviews');
    }

    public function ShowReviews(){
        $reviews=Review::all();
        // return view('reviews.showreviews',compact('reviews'));
        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       if(Auth::user()){
        session::put('username',auth()->user()->name);
       }
        $categories=Category::all();
        return view('welcome',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        $products=Product::all();
       return view('category',compact('categories','products'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function AddCategory(){
        return view('category.addcategory');
    }
 public function storecategory(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2068'
    ]);

    $category = new Category();
    $category->name = $validated['name'];
    $category->description = $validated['description'];

    // رفع الصورة وتخزين المسار
    $path = $request->file('image')->move(
        'photoscategory',
        Str::uuid()->toString() . '-' . $request->file('image')->getClientOriginalName()
    );
    $category->imagepath = $path;

    $category->save();

    return redirect('/')->with('success', 'تم إضافة القسم بنجاح');
}

public function delete($categoryid){
$category=Category::find($categoryid);
$category->delete();
return redirect('/');
}
}

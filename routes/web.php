<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TestController;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/category',[CategoryController::class,'create']);
Route::get('/',[CategoryController::class,'index'])->middleware('customauth');
Route::get('add_category',[CategoryController::class,'AddCategory'])->name('add.category');
Route::post('store_category',[CategoryController::class,'storecategory'])->name('store.category');
Route::get('/delete_category/{categoryid?}',[CategoryController::class,'delete'])->name('delete.category');

Route::get('/product/{cat_id?}',[ProductController::class,'index']);
Route::get('add_product',[ProductController::class,'AddProduct'])->name('add.product');
Route::post('store_product',[ProductController::class,'storeproduct'])->name('store.product');
Route::get('edit_product/{productid?}',[ProductController::class,'editproduct'])->name('edit.product');
Route::post('update_product',[ProductController::class,'updateproduct'])->name('update.product');
Route::get('/delete_product/{productid?}',[ProductController::class,'delete'])->name('delete.product');

Route::get('/AddProductImages/{productid}',[ProductController::class,'addproductimages']);
Route::get('/removeproductimage/{productid}',[ProductController::class,'deleteproductimage']);
Route::post('/storeproductimage',[ProductController::class,'storeproductimage']);

Route::get('/review',[ReviewController::class,'Review'])->name('product.review');
Route::post('/storereview',[ReviewController::class,'StoreReview'])->name('store.review');
Route::get('/reviews',[ReviewController::class,'ShowReviews']);

Route::get('/cart',[CartController::class,'viewcart'])->name('cart')->middleware('auth');
Route::get('/addproducttocart/{productid}',[CartController::class,'AddProductToCart'])->middleware('auth');
Route::get('deletecartitem/{cartid}',[CartController::class,'delete']);

Route::get('completeorder',[CartController::class,'CompleteOrder'])->middleware('auth');
Route::post('addorder',[CartController::class,'AddOrder'])->middleware('auth');

Route::post('/search',function(Request $request){
$products=Product::where('name','like','%'.$request->search.'%')->get();
return view('product',compact('products'));

});
Route::post('/lang', function (Request $request) {
    session()->put('locale', $request->locale);
    app()->setLocale($request->locale);
    return redirect()->back();
})->name('changelanguage');


Route::get('test',[TestController::class,'test']);

Route::get('admin/login',function(){
return view('auth.login');
});

Route::get('admin/index',function(){
return view('admin.home');
})->middleware('CheckRole:admin')->name('admin.index');

Route::get('admin/chart',function(){
return "admin charts";
})->middleware('CheckRole:admin,salesman');

Route::get('admin/bills',function(){
return "admin bills";
})->middleware('CheckRole:salesman');

Route::get('admin/getusers',[AdminController::class,'getuser'])->name('admin.getusers')->middleware('CheckRole:admin');
Route::get('admin/update/{id}',[AdminController::class,'adminupdate'])->name('admin.updateuser');
Route::post('admin/edit/{id}',[AdminController::class,'adminedit'])->name('admin.edituser')->middleware('CheckRole:admin');
Route::get('admin/deleteuser/{id}',[AdminController::class,'admindelete'])->name('admin.deleteuser')->middleware('CheckRole:admin');

Route::get('admin/search',[AdminController::class,'search'])->name('admin.search');
Route::get('admin/index',[AdminController::class,'getearning'])->name('admin.index');


Route::get('payment',[PaymentController::class,'payment'])->name('payment');
Route::get('cancel',[PaymentController::class,'cancel'])->name('payment.cancel');
Route::get('payment/sucess',[PaymentController::class,'success'])->name('payment.success');

Route::get('admin/getallorders',[AdminController::class,'Getallorders'])->name('admin.getallorders');

Route::group(['prefix'=>'ajax-offers'],function(){
Route::get('offers',[OfferController::class,'index'])->name('ajax-offers.index');
Route::get('insert',[OfferController::class,'create'])->name('ajax-offers.insert');
Route::post('store',[OfferController::class,'store'])->name('ajax-offers.store');
});

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function viewcart(){
        $user_id=auth()->user()->id;
        $carts=Cart::where('user_id',$user_id)->with('product')->get();

        return view('cart.cart',compact('carts'));
    }
    public function AddProductToCart($productid){
        $user_id=auth()->user()->id;
   $result=Cart::where('user_id',$user_id)->where('product_id',$productid)->first();
   if($result){
$result->quantity +=1;
$result->save();
return redirect('/cart');
   }
   else{
   $newcart=new Cart();
   $newcart->product_id=$productid;
   $newcart->user_id=auth()->user()->id;
   $newcart->quantity=1;
   $newcart->save();
   return redirect('/cart');
   }
    }

    public function delete($cartid){
$cart=Cart::findOrFail($cartid);
$cart->delete();
return redirect('/cart');
    }

    public function CompleteOrder(){
        $user_id=auth()->user()->id;
        $carts=Cart::where('user_id',$user_id)->with('product')->get();
        return view('order.completeorder',compact('carts'));
    }

    public function AddOrder(Request $request){
$order=new Order();
$user_id=auth()->user()->id;
$order->name=$request->name;
$order->address=$request->address;
$order->email=$request->email;
$order->phone=$request->phone;
$order->note=$request->note;
$order->user_id=$user_id;
$order->save();
$carts=Cart::where('user_id',$user_id)->with('product')->get();
foreach($carts as $cart){
    $neworderdetails=new OrderDetails();
    $neworderdetails->product_id=$cart->product_id;
    $neworderdetails->price=$cart->product->price;
    $neworderdetails->quantity=$cart->product->quantity;
    $neworderdetails->order_id=$order->id;
    $neworderdetails->save();
}
Cart::where('user_id',$user_id)->delete();

return redirect('/');
    }
}

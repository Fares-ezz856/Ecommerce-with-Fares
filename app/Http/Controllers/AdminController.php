<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getuser(){
        $users=User::all();
        return view('admin.users',compact('users'));
    }
    public function adminupdate($id){
        $user=User::find($id);
        return view('admin.updateuser',compact('user'));
    }
   public function adminedit(Request $request, $id)
{
    // Validate البيانات
    $request->validate([
        'role' => 'required|string',
    ]);

    // جيب اليوزر
    $user = User::find($id);

    if ($user) {
        $user->role = $request->role;
        $user->save();
    }

    return redirect()->route('admin.index')->with('success', 'Updated Successfully');
}

public function admindelete($id){
$user=User::findOrFail($id);
$user->delete();
return redirect()->route('admin.index')->with('success', 'Deleted Successfully');
}

public function search(Request $request){
     $query = $request->input('query');

    $users = User::when($query, function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                     ;
                })
                ->get();

    return view('admin.users', compact('users'));
}

public function getearning(){
    $Monthlyearnings=OrderDetails::whereMonth('created_at', now()->month)
                                         ->sum('price');
    $Yearlyearnings=OrderDetails::whereYear('created_at', now()->year)
                                        ->sum('price');
    return view('admin.home',compact('Monthlyearnings','Yearlyearnings'));
}

public function Getallorders(){
    // 1. جلب كل الطلبات وتحميل تفاصيلها (details) والمنتج المرتبط بكل تفصيلة (product)
    // *يجب أن تكون العلاقة اسمها 'details' في موديل Order*
    $orders = Order::with('details.product')->get();
             
    // 2. نحذف المتغير $orderdetails تماماً

    return view('admin.order', compact('orders'));
}

}

<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        // ✅ عرض أحدث عرض لكل منتج
        $products = Product::with('latestOffer')->get();
        return view('offer.offers', compact('products'));
    }

    public function create()
    {
        // ✅ جلب كل المنتجات لاختيار المنتج الذي سيضاف له العرض
        $products = Product::all();
        return view('offer.create', compact('products'));
    }

    public function store(Request $request)
    {
        // ✅ تحقق من صحة البيانات
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'product_id' => 'required|exists:products,id',
        ]);

        // ✅ إنشاء عرض جديد
        $offer = new Offer();
        $offer->name = $request->name;
        $offer->price = $request->price;
        $offer->product_id = $request->product_id;
        $offer->save();

        // ✅ تحديث سعر المنتج في جدول products
        $product = Product::find($request->product_id);
        if ($product) {
            // لو عندك عمود للسعر الأصلي احتفظ به أول مرة فقط
            if (!$product->original_price) {
                $product->original_price = $product->price;
            }

            $product->price = $offer->price; // السعر بعد الخصم أو السعر الجديد
            $product->save();
        }

        // ✅ بعد الحفظ، رجع للصفحة مع رسالة نجاح
        return redirect()->route('ajax-offers.index')->with('success', 'تم إضافة العرض وتحديث سعر المنتج بنجاح');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPhoto;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Milon\Barcode\DNS1D;

class ProductController extends Controller
{
    public function index($cat_id=null){
        if($cat_id==null){
            $products=Product::with('latestoffer')->paginate(6);
            return view('product',compact('products'));
        }
        else{
            $products=Product::with('latestoffer')->where('category_id',$cat_id)->paginate(6);
            return view('product',compact('products'));
        }

    }
    public function AddProduct(){
        $categories=Category::all();
        return view('product.addproduct',compact('categories'));
    }
    public function storeproduct(Request $request){

$data=$request->validate([
'name'=>'required|string|max:255|unique:products',
'description'=>'string',
'image'=>'required|image|max:2068',
'price'=>'required',
'quantity'=>'required|numeric',


],
[
'name.unique'=>'هذا المنتج موجود بالفعل ',
'quantity.required'=>'يرجى ادخال كمية المنتج',
// 'quantity.max'=>'الكمية لايجب أن تزيد عن 5 أرقام',
'name.required'=>'يرجى ادخال اسم المنتج',
'price.required'=>'يرجى ادخال سعر المنتج'
]);

$products=new Product();
$products->name=$request->name;
$products->description=$request->description;
$products->price=$request->price;
$path = $request->image->move('photos', Str::uuid()->toString() . '-' . $request->file('image')->getClientOriginalName());
$products->imagepath = $path;
$products->quantity=$request->quantity;
$products->category_id=$request->category_id;
$products->save();

return redirect('/');

    }
    public function delete($productid=null){
        // dd($productid);
if($productid){
    $product=Product::find($productid);
    $product->delete();
    return redirect('/product');
}
else{
    echo abort(403,'This Product Not Found');
}
    }
    public function editproduct($productid=null){
        $products=Product::find($productid);
        $categories=Category::all();


        $qrcode=QrCode::size(200)->generate('www.Fares7.com');
        // $barcode=new DNS1D();
        $barcodeGenerator = new DNS1D();
        $barcode = $barcodeGenerator->getBarcodeHTML('0020000051400', 'C39');
        if($productid){
        return view('product.editproduct',compact('categories','products','qrcode','barcode'));
        }
        elseif($products == null){
            abort(403);
        }
        else{
            return redirect('/add_product');
        }
    }
    public function updateproduct(Request $request)
    {

        $data=$request->validate([
            'name'=>'required|string|max:255',
            'description'=>'string',
            'image'=>'image|max:2084',
            'price'=>'required',
            'quantity'=>'required|numeric',

            ],
            [

                'quantity.required'=>'يرجى ادخال كمية المنتج',
            'name.required'=>'يرجى ادخال اسم المنتج',
            'price.required'=>'يرجى ادخال سعر المنتج'
            ]);

            $product = Product::find($request->id);

            if ($product) {
                $product->name = $request->name;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->quantity = $request->quantity;
                $product->category_id = $request->category_id;


                if ($request->has('image')) {
                    $path = $request->image->move(
                        'photos',
                        Str::uuid()->toString() . '-' . $request->file('image')->getClientOriginalName()
                    );
                    $product->imagepath = $path;
                }




                $product->save();




            return redirect('/product')->with('success', 'Product updated successfully!');
        } else {

            return redirect('/product')->with('error', 'Product not found.');
        }
    }

    public function addproductimages($productid){
     $products=Product::find($productid);
     $productimage=ProductPhoto::where('product_id',$productid)->get();
     return view('product.addproductimage',compact('products','productimage','productid'));
    }

    public function deleteproductimage($productid){
        $product=ProductPhoto::findOrFail($productid);
        $product->delete();
        return view('product.addproductimage');
    }

    public function storeproductimage(Request $request){
$request->validate([
    'product_id'=>'required',
'imagepath'=>'required|image|mimes:png,jpg',
]);
$photo=new ProductPhoto();
$photo->product_id=$request->product_id;
if ($request->has('photo')) {
    $path = $request->image->move(
        'photos',
        Str::uuid()->toString() . '-' . $request->file('image')->getClientOriginalName()
    );
    $photo->imagepath = $path;
}
$photo->save();

return view('product.addproductimage');
    }



    }


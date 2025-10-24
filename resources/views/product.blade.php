@extends('layouts.master')

@section('content')

<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">جميع</span> المنتجات</h3>
                    <p>هذه جميع منتجاتنا التى تتوافر</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($products as $product)
            <div class="col-lg-4 col-md-6 text-center">
                <div class="single-product-item">
                    <div class="product-image">
                        <a href="single-product.html">
                            <img src="{{ asset($product->imagepath) }}" alt="image" style="max-height: 250px; min-height: 250px">
                        </a>
                    </div>

                    <h3>{{ session('locale') == 'ar' ? $product->name : $product->nameEN }}</h3>
                    <p class="product-description">
                        {{ session('locale') == 'ar' ? $product->description : $product->descriptionEN }}
                    </p>

                    {{-- ✅ السعر بعد الخصم --}}
                    @if($product->latestOffer)
                        <p class="product-price">
                            <span style="text-decoration: line-through; color: #888;">
                                {{ $product->original_price }}$
                            </span>
                            <span style="color:red; font-weight:bold;">
                                {{ $product->latestOffer->price }}$
                            </span>
                        </p>
                    @else
                        <p class="product-price">{{ $product->price }}$</p>
                    @endif

                    <p class="product-quantity">الكمية: {{ $product->quantity }}</p>

                    <span style="display: inline">
                        <a href="/addproducttocart/{{ $product->id }}" class="cart-btn">
                            <i class="fas fa-shopping-cart"></i> اضافة الى السلة
                        </a>

                        {{-- صلاحيات الأدمن والبائع --}}
                        @if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'salesman'))
                            <a href="/AddProductImages/{{ $product->id }}" class="cart-btn">
                                <i class="fas fa-image"></i> اضافة صور للمنتج
                            </a>

                            <p class="mt-3">
                                <a href="/edit_product/{{ $product->id }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> تعديل
                                </a>
                                <a href="/delete_product/{{ $product->id }}" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> حذف
                                </a>
                            </p>
                        @endif
                    </span>
                </div>
            </div>
            @endforeach

            <div style="text-align: center; margin: 0 auto;">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    svg {
        height: 50px;
    }
</style>

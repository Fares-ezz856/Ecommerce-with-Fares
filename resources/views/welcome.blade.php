@extends('layouts.master')
@section('content')
{{-- {{ session('username') }} --}}
<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">أقسام</span> الموقع</h3>
                    <p>متعة التسوق عبر فروعنا</p>
                </div>
            </div>
        </div>
        <div class="row">
       @foreach ($categories as $category)
       <div class="col-lg-4 col-md-6 text-center">
        <div class="single-product-item">
            <div class="product-image">
                <a href="/product/{{$category->id}}"><img src="{{ $category->imagepath }}" alt="image" style="max-height: 250px !important ; min-height: 250px ! important;"></a>
            </div>
            <h3>{{ $category->name }}</h3>
            <p class="product-price"> {{ $category->description }} </p>

            {{-- <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a> --}}
        </div>
    </div>
       @endforeach




            {{-- <div class="col-lg-4 col-md-6 text-center">
                <div class="single-product-item">
                    <div class="product-image">
                        <a href="single-product.html"><img src="assets/img/products/product-img-2.jpg" alt=""></a>
                    </div>
                    <h3>Berry</h3>
                    <p class="product-price"> 70$ </p>
                    {{-- <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a> --}}
                </div>
            </div> --}}
            {{-- <div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0 text-center">
                <div class="single-product-item">
                    <div class="product-image">
                        <a href="single-product.html"><img src="assets/img/products/product-img-3.jpg" alt=""></a>
                    </div>
                    <h3>Lemon</h3>
                    <p class="product-price"> 35$ </p>
                    {{-- <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a> --}}
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection

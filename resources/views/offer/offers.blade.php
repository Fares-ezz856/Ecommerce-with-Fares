@extends('layouts.master')

@section('content')
<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">أحدث</span> العروض</h3>
                    <p>آخر عرض متاح لكل منتج</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($products as $product)
                @if($product->latestOffer)
                    <div class="col-lg-4 col-md-6 text-center">
                        <div class="single-product-item">
                            <div class="product-image">
                                @if($product->imagepath)
                                    <img src="{{ asset($product->imagepath) }}" alt="{{ $product->name }}" style="max-height: 250px; min-height: 250px;">
                                @endif
                            </div>
                            <h2>{{ $product->name }}</h2>
                            <h3>{{ $product->latestOffer->name }}</h3>
                            <p class="product-price">{{ $product->latestOffer->price }}$</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection

<style>
    svg {
        height: 50px;
    }
</style>

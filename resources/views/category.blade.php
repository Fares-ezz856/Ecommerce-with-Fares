@extends('layouts.master')

@section('content')

<div class="product-section mt-150 mb-150">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2>الأقسام</h2>
                </div>
            </div>
        </div>

        <div class="row product-lists">
            @foreach ($categories as $category)
            <div class="col-lg-4 col-md-6 text-center mb-4">
                <div class="single-product-item">
                    <div class="product-image">
                        <a href="{{ url('category/'.$category->id) }}">
                            <img style="max-height: 250px; min-height: 250px" src="{{ asset($category->imagepath) }}" alt="image">
                        </a>
                    </div>
                    <h3>{{ $category->name }}</h3>
                    <p>{{ $category->description }}</p>
                    
                       <p class="mt-3">
                    <a href="/delete_category/{{$category->id}}" class="btn btn-danger"><i class="fas fa-trash "></i>حذف</a>
                    </p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>
@endsection

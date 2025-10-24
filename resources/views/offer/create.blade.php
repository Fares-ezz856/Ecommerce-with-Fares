@extends('layouts.master');
@section('content')
@if (auth()->check())


<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">اضافة</span> عروض</h3>

                </div>
            </div>
        </div>


            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div  class="form-title" >


                    </div>
                     <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="post" action="{{ route('ajax-offers.store') }}" dir="rtl" enctype="multipart/form-data">
                            @csrf
                            <p>
                                <input type="text" placeholder="الاسم" name="name" id="name" style="width: 100%" value="{{ old('name') }}" required>
                                <span class="text-danger">
                                    @error('name')
                                    {{ $message }}
                                    @enderror
                                </span>

                            </p>
                            <p style="display: flex">

                                <input type="number" placeholder="السعر" name="price" id="price" style="width: 50%" value="{{ old('price') }}" required>
                                <span class="text-danger">
                                @error('price')
                                {{ $message }}

                                @enderror
                            </span>

                            </p>


                            <select class="form-control" name="product_id" id="product_id">
                                @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach

                            </select>
                            </p>
                            <span>
                            @error('product_id')
                             {{ $message }}
                            @enderror
                        </span>


                            <p><input type="submit" value="حفظ"></p>
                        </form>
                    </div>
                </div>

            </div>
</div>

@else

{{ abort(403,'من فضلك قم بتسجيل الدخول حتى تستطيع اضافة منتج') }}

@endif

@endsection






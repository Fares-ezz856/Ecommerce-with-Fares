@extends('layouts.master');
@section('content')
<div class="m-5">
    {!! $barcode !!}
</div>
<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">تعديل</span> منتجات</h3>
                    <img src="data:image/svg+xml;base64,{{ base64_encode($qrcode) }}" alt="Qr_Code">



                </div>
            </div>
        </div>


            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div  class="form-title" >


                    </div>
                     <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="post" action="{{ route('update.product') }}" dir="rtl" enctype="multipart/form-data">
                            @csrf
                            <p>
                                <input type="hidden" placeholder="id" name="id" id="name" style="width: 100%" value="{{ $products->id }}">



                                <input type="text" placeholder="الاسم" name="name" id="name" style="width: 100%" value="{{ $products->name }}">
                                <span class="text-danger">
                                    @error('name')
                                    {{ $message }}
                                    @enderror
                                </span>

                            </p>
                            <p style="display: flex">
                                <input type="number" placeholder="الكمية" name="quantity" id="quantity" style="width: 50% ; margin-left: 4px" value="{{$products->quantity }}">
                                <span>
                                @error('quantity')
                                {{ $message }}
                                @enderror
                                </span>
                                <input type="number" placeholder="السعر" name="price" id="price" style="width: 50%" value="{{ $products->price}}">
                                <span class="text-danger">
                                @error('price')
                                {{ $message }}

                                @enderror
                            </span>
                            </p>
                            <p><textarea name="description" id="description" cols="30" rows="10" placeholder="الوصف" >{{ $products->description}}</textarea></p>
                            <span>
                            @error('description')
                            {{ $message }}
                            @enderror
                            </span>
                            <p>

                            <select class="form-control" name="category_id" id="category_id">
                                @foreach ($categories as $category)
                                @if ($category->id == $products->category_id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                                @endforeach

                            </select>
                            </p>
                            <span>
                            @error('category_id')
                             {{ $message }}
                            @enderror
                        </span>

                        <p>
                            <input type="file" class="form-control" name="image">
                        </p>
                        <span>
                            @error('image')
                             {{ $message }}
                            @enderror
                        </span>

                        <p>
                            <img src="{{ asset($products->imagepath) }}" alt="image" width="250" height="250" style="float: right">
                        </p>

                            <p><input style= " margin-bottom:30px" type="submit" value="حفظ"></p>
                        </form>
                    </div>
                </div>

            </div>
</div>

@endsection






@extends('layouts.master');
@section('content')
@if (auth()->check())


<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">اضافة</span> منتجات</h3>

                </div>
            </div>
        </div>


            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div  class="form-title" >


                    </div>
                     <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="post" action="{{ route('store.product') }}" dir="rtl" enctype="multipart/form-data">
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
                                <input type="number" placeholder="الكمية" name="quantity" id="quantity" style="width: 50% ; margin-left: 4px" value="{{ old('quantity') }}" required>
                                <span>
                                @error('quantity')
                                {{ $message }}
                                @enderror
                                </span>
                                <input type="number" placeholder="السعر" name="price" id="price" style="width: 50%" value="{{ old('price') }}" required>
                                <span class="text-danger">
                                @error('price')
                                {{ $message }}

                                @enderror
                            </span>

                            </p>
                            <p><textarea name="description" id="description" cols="30" rows="10" placeholder="الوصف" >{{ old('description') }}</textarea></p>
                            <span>
                            @error('description')
                            {{ $message }}
                            @enderror
                            </span>
                            <p>

                            <select class="form-control" name="category_id" id="category_id">
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>
                            </p>
                            <span>
                            @error('category_id')
                             {{ $message }}
                            @enderror
                        </span>
                        <p>
                            <input type="file" class="form-control" name="image" id="">
                        </p>
                        <span>
                            @error('image')
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






@extends('layouts.master')

@section('content')
<div class="container mt-5 mb-5" style="text-align: center">


        <form action="/storeproductimage" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="product_id" id="product_id" value="{{ $productid}}">
            <div class="row" class="mt-5">
<input type="file" name="photo" id="photo" class="col-8">
<p><input type="submit" value="حفظ"class="col-12" ></p>
<span class="text-danger">
    @error('photo')
    {{ $message }}
    @enderror
</span>
        </form>

    </div>
 <div class="row">
@foreach ($productimage as $image)
<div class="col-4">
<img class="m-2" src="{{ asset($image->imagepath) }}" alt="" width="300" height="300">
<a href="/removeproductimage/{{ $image->id }}" class="btn btn-danger"  >
    <i class="fas fa-trash"> </i>
    حذف صورةالمنتج
</a>
</div>
@endforeach
    </div>

</div>
@endsection

@extends('layouts.master')

@section('content')
{{-- {{ session('username') }} --}}
<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">أراء</span> العملاء</h3>

                </div>
            </div>
        </div>


            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div  class="form-title" >


                    </div>
                     <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="post" action="/storereview"  dir="rtl">
                            @csrf
                            <p>
                                <input type="text" placeholder="الاسم" name="name" id="name" style="width: 100%" value="{{ old('name') }}" required>
                                <span class="text-danger">
                                    @error('name')
                                    {{ $message }}
                                    @enderror
                                </span>

                            </p>
                            <p >
                                <input type="text" placeholder="التليفون" name="phone" id="phone" style="width: 100% ; margin-bottom: 8px" value="{{ old('phone') }}" required>
                                <span>
                                @error('phone')
                                {{ $message }}
                                @enderror
                                </span>
                                <input type="email" placeholder="البريد الالكترونى" name="email" id="email" style="width: 100%" value="{{ old('email') }} " required>
                                <span>
                                @error('email')
                                {{ $message }}

                                @enderror
                            </span>
                            </p>

                            <p >
                                <input type="subject" placeholder="العنوان" name="subject" id="subject" style="width: 100% " value="{{ old('subject') }}" required>
                                <span>
                                @error('subject')
                                {{ $message }}
                                @enderror
                                </span>



                                <p><textarea name="message" id="message" cols="30" rows="10" placeholder="الوصف" >{{ old('message') }}</textarea></p>
                                <span>
                                @error('message')
                                {{ $message }}
                                @enderror
                                </span>
                                <p>



                            <p><input type="submit" value="حفظ"></p>
                        </form>
                    </div>
                </div>

            </div>
</div>

@endsection

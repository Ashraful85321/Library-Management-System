@extends('layout')
@section('title', 'Login')
@section('content')

@php
$loginTextClass = "text-2xl font-bold content-center text-center mb-0 text-emerald-50
bg-gradient-to-b from-emerald-400
via-emerald-700 to-emerald-800 w-[100px] h-[100px] rounded-full border-2 z-10 ms-[110px] -translate-y-[100px]";
$labelClass = "block text-xl font-bold text-emerald-50 mb-2";
$inputClass = "mb-1 px-4 w-full h-[40px] bg-fuchsia-200";
$styleClip = "clip-path: polygon(2.5% 0%, 100% 0%, 97.5% 100%, 0% 100%);";
$smallClass = "warning text-red-200 font-semibold";
$buttonClass = "bg-gradient-to-b from-emerald-400 via-emerald-700 to-emerald-800 hover:bg-gradient-to-t font-medium
text-white text-bold p-3 w-full mt-4";
@endphp

<div class="bg-book5 bg-cover flex flex-col items-center min-h-screen max-h-full relative">
    @if(session('error'))
    <div id="errorAlert"
        class="absolute content-center border-2 border-black rounded-lg alert alert-danger h-[80px] w-[384px] bg-slate-100 mt-[40px] mb-[40px]">
        <p class="text-bold font-medium text-[15px] text-center">{{ session('error') }}</p>
    </div>
    @endif

    <div
        class="absolute bg-emerald-800 ps-8 pe-8 pb-8 pt-[45px] mt-[190px] rounded-lg w-96 bg-opacity-50 shadow-2xl shadow-black border-[2px] border-emerald-700">
        <div class="absolute flex justify-center">
            <h1 class="{{$loginTextClass}}">Login</h1>
        </div>
        <form class="" action="{{route('newloginp')}}" method="POST">
            @csrf
            @method('POST')
            <div class="mb-4">
                <label for="email" class="{{$labelClass}}">Email</label>
                <small id="email-warning" class="{{$smallClass}}"></small>
                <input type="email" id="email" name="email" value="" class="{{$inputClass}}" style="{{$styleClip}}">
            </div>
            <div class="mb-4">
                <label for="password" class="{{$labelClass}}">Password</label>
                <small id="password-warning" class="{{$smallClass}}"></small>
                <input type="password" id="password" name="password" value="" class="{{$inputClass}}"
                    style="{{$styleClip}}">
            </div>

            <button type="submit" class="{{$buttonClass}}" style="{{$styleClip}}">Login</button>
        </form>


    </div>

</div>

<script src="{{ asset('my-js/functions.js') }}" type="module"></script>
<script src="{{ asset('my-js/newlogin.js') }}" type="module"></script>

@endsection

{{-- @foreach(range(1, 4) as $i)
<p>This is paragraph {{ $i }}</p>
@endforeach --}}
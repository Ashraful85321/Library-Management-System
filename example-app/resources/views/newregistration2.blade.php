@extends('layout')
@section('title', 'Add Librarian')
@section('content')
@php
$labelClass ="block text-[16px] font-bold text-emerald-50";
$inputClass = "mt-1 p-2 w-full h-[38px] rmd:h-[34px] bg-fuchsia-100 rounded-lg";
$inputClassFile = "mt-1 p-2 h-[100px] w-[94px] bg-fuchsia-100 rounded-lg";
$fileClass = "file:m-1 file:rounded-lg file:border-1 file:border-violet-700 file:text-[12px]
file:font-semibold
file:bg-green-200 file:text-violet-700 hover:file:bg-green-400 file:w-[80px] file:h-[20px]";
$imageClass ="mt-1 h-[100px] w-[94px] shadow-sm shadow-slate-800 rounded-lg text-sm object-cover";
@endphp

<div class="bg-book5 bg-cover flex items-center justify-center min-h-screen max-h-full">
    @include('pagelayout.sidebarr', ['asideColor' => 'bg-emerald-400', 'border' => 'border-emerald-400'])

    @if(session('error'))
    <div>{{ session('error') }}</div>
    @endif

    <div
        class="rmd:hidden rounded-l-lg w-[380px] h-[680px] bg-emerald-400 p-8 my-4 shadow-lg shadow-black border-t-2 border-b-2 border-l-2 border-lime-700">
        <h1 class="text-2xl font-bold text-center mb-4 text-emerald-50">Add Another Librarian</h1>
    </div>

    <div
        class="bg-emerald-400 p-6 my-4 rounded-r-lg rmd:rounded-lg w-[380px] h-[680px] shadow-lg shadow-black rmd:border-2 border-t-2 border-b-2 border-r-2 border-lime-700">
        <div class="">
            <h1 class="md:hidden text-2xl font-bold text-center mb-4 rmd:mb-2 text-emerald-50">Add Another Librarian
            </h1>
            <form class="" action="{{route('newregistration2p')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="mb-4">
                    <label for="name" class="{{$labelClass}}">Name</label>
                    <input type="text" id="name" name="name" value="" class="{{$inputClass}}">
                </div>
                <div class="mb-4">
                    <label for="email" class="{{$labelClass}}">Email</label>
                    <input type="email" id="email" name="email" value="" class="{{$inputClass}}">
                </div>
                <div class="mb-4">
                    <label for="phone_number" class="{{$labelClass}}">Phone Number</label>
                    <input type="tel" id="phone_number" name="phone_number" pattern="\d{11}" maxlength="11" value=""
                        class="{{$inputClass}}">
                </div>
                <div class="mb-4">
                    <label for="current_address" class="{{$labelClass}}">Current Address</label>
                    <input type="text" id="current_address" name="current_address" value="" class="{{$inputClass}}">
                </div>
                <div class="mb-4">
                    <label for="permanent_address" class="{{$labelClass}}">Parmenant
                        Address</label>
                    <input type="text" id="permanent_address" name="permanent_address" value="" class="{{$inputClass}}">
                </div>
                <div class="mb-4">
                    <label for="password" class="{{$labelClass}}">Password</label>
                    <input type="password" id="password" name="password" value="" class="{{$inputClass}}">
                </div>
                <div class="mb-4">
                    <label for="image" class="{{$labelClass}}">Image</label>
                    <input type="file" id="image" name="image" value="" class="{{$inputClass}} {{$fileClass}}">
                </div>
                <button type="submit"
                    class="bg-emerald-950 font-medium text-white p-2 w-full rounded-xl mt-2">Add</button>
            </form>
            {{-- <div>
                <a href="{{ route('newhome') }}"><button type="button"
                        class=" bg-emerald-950 font-medium text-white p-3 w-full rounded-full mt-3">Goto
                        Home</button></a>

            </div> --}}
        </div>
    </div>

</div>


@endsection
@extends('layout')
@section('title', 'User information')
@section('content')
@php
$labelClass ="block text-[16px] font-bold text-stone-950";
$inputClass = "mt-1 p-2 w-full h-[38px] bg-fuchsia-100 rounded-lg";
$inputClassFile = "mt-1 p-2 h-[100px] w-[94px] bg-fuchsia-100 rounded-lg";
$fileClass = "file:mr-0 file:py-1 file:px-0 file:rounded-lg file:border-1 file:border-violet-700 file:text-[12px]
file:font-semibold
file:bg-green-200 file:text-violet-700 hover:file:bg-green-400 file:w-full";
$imageClass ="mt-1 h-[100px] w-[94px] shadow-sm shadow-slate-800 rounded-lg text-sm object-cover";
@endphp

<div class="flex justify-center items-center min-h-screen w-screen bg-green-200">
    @include('pagelayout.sidebarr', ['asideColor' => 'bg-green-400', 'border' => 'border-green-400'])

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    dd($user);
    @endif
    <div
        class="relative bg-green-400 p-4 my-6 rounded-l-lg w-[370px] h-[680px] shadow-md shadow-black border-green-700 border-l-2 border-t-2 border-b-2 border-bg-gray-800 rmd:hidden">
        <h1 class="text-2xl font-bold text-center mb-4 mt-2">Edit Your Profile</h1>
        <img src="{{ asset($user->image) }}" alt="user"
            class="absolute top-[65px] start-[114px] h-[140px] w-[140px] border-[4px] border-teal-400 object-cover justify-center rounded-full text-sm">

    </div>

    <div
        class="bg-green-400 p-8 my-4 border-2 border-green-700 rounded-r-lg rmd:rounded-lg  w-[370px] h-[680px] shadow-md shadow-black">

        <form method="POST" action="{{route('updateprofile', ['user' => $user])}}" enctype="multipart/form-data">
            <h1 class="md:hidden text-2xl rmd:text-xl font-bold text-center mb-4 mt-2 rmd:mb-2 rmd:mt-1">Edit Your
                Profile</h1>
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="{{$labelClass}}">Name</label>
                <input type="text" id="name" name="name" value="{{$user -> name}}" class="{{$inputClass}}">
            </div>

            <div class="mb-4">
                <label for="email" class="{{$labelClass}}">Email</label>
                <input type="email" id="email" name="email" value="{{$user -> email}}" class="{{$inputClass}}">
            </div>

            <div class="mb-4">
                <label for="phone_number" class="{{$labelClass}}">Phone Number</label>
                <input type="tel" id="phone_number" name="phone_number" pattern="\d{11}" maxlength="11"
                    value="{{$user -> phone_number}}" class="{{$inputClass}}">
            </div>

            <div class="mb-4">
                <label for="current_address" class="{{$labelClass}}">Current Address</label>
                <input type="text" id="current_address" name="current_address" value="{{$user -> current_address}}"
                    class="{{$inputClass}}">
            </div>

            <div class="mb-4">
                <label for="permanent_address" class="{{$labelClass}}">Permanent Address</label>
                <input type="text" id="permanent_address" name="permanent_address"
                    value="{{$user -> permanent_address}}" class="{{$inputClass}}">
            </div>

            <div class="mb-4 grid rmd:grid-cols-2 grid-cols-1">
                <div class="md:hidden"> <label for="" class="{{$labelClass}}">Image</label>
                    <img src="{{ asset($user->image) }}" alt="user" class="{{$imageClass}}">
                </div>
                <div class=""> <label for="image" class="{{$labelClass}}">Update
                        new Image</label>
                    <input type="file" id="image" name="image" class="{{$inputClassFile}} {{$fileClass}}">
                </div>
            </div>

            <div>
                <button type="submit"
                    class="text-white w-full bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">update</button>
            </div>
        </form>

    </div>


</div>



@endsection
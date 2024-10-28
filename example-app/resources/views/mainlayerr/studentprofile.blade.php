@extends('layout')
@section('title', 'Student information')
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

<div class="flex justify-center items-center min-h-screen w-screen bg-gray-400">
    @include('pagelayout.sidebarr', ['asideColor' => 'bg-sky-400', 'border' => 'border-sky-400'])

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div
        class="relative rmd:hidden rounded-l-lg w-[380px] h-[680px] bg-sky-400 p-8 shadow-lg shadow-black border-t-2 border-b-2 border-l-2 border-sky-700">
        <h1 class="text-2xl font-bold text-center mb-4 text-emerald-50">Edit Student Information</h1>
        <img src="{{ asset($student->image) }}" alt="user"
            class="absolute top-[80px] start-[114px] h-[140px] w-[140px] border-[4px] border-teal-400 object-cover justify-center rounded-full text-sm">
    </div>

    <div
        class="bg-sky-400 p-6 rounded-r-lg rmd:rounded-lg w-[380px] h-[680px] shadow-lg shadow-black rmd:border-2 border-t-2 border-b-2 border-r-2 border-sky-700">
        <h1 class="md:hidden text-2xl font-bold text-center mb-4 rmd:mb-2 text-emerald-50">Edit Student Information</h1>
        <form method="POST"
            action="{{route('updatestudent', ['student' => $student, 'page' => request()->input('page', 1)])}}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="{{$labelClass}}">Name</label>
                <input type="text" id="name" name="name" value="{{$student -> name}}" class="{{$inputClass}}">
            </div>

            <div class="mb-4">
                <label for="email" class="{{$labelClass}}">Email</label>
                <input type="email" id="email" name="email" value="{{$student -> email}}" class="{{$inputClass}}">
            </div>

            <div class="mb-4">
                <label for="phone_number" class="{{$labelClass}}">Phone Number</label>
                <input type="tel" id="phone_number" name="phone_number" pattern="\d{11}" maxlength="11"
                    value="{{$student -> phone_number}}" class="{{$inputClass}}">
            </div>

            <div class="mb-4">
                <label for="current_address" class="{{$labelClass}}">Current Address</label>
                <input type="text" id="current_address" name="current_address" value="{{$student -> current_address}}"
                    class="{{$inputClass}}">
            </div>

            <div class="mb-4">
                <label for="permanent_address" class="{{$labelClass}}">Permanent Address</label>
                <input type="text" id="permanent_address" name="permanent_address"
                    value="{{$student -> permanent_address}}" class="{{$inputClass}}">
            </div>

            <div class="mb-4 grid grid-cols-2 md:grid-cols-1">
                <div class="md:hidden">
                    <label for="" class="{{$labelClass}}">Current Image</label>
                    <img src="{{ asset($student->image) }}" alt="Student" class="{{$imageClass}}">
                </div>
                <div>
                    <label for="image" class="{{$labelClass}}">Update new Image</label>
                    <input type="file" id="image" name="image" class="{{$inputClassFile}} {{$fileClass}}">
                </div>
            </div>

            <div>
                <button type="submit"
                    class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">update</button>
            </div>
        </form>

    </div>


</div>



@endsection
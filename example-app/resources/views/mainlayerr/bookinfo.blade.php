@extends('layout')
@section('title', 'Book information')
@section('content')

@php
$labelClass ="block text-[14px] font-bold text-stone-950";
$inputClass = "mt-1 p-2 w-full h-[34px] rmd:h-[32px] bg-fuchsia-100 rounded-lg";
$inputClassFile = "mt-1 p-2 h-[90px] w-[85px] bg-fuchsia-100 rounded-lg";
$fileClass = "file:mr-0 file:py-1 file:px-0 file:rounded-lg file:border-1 file:border-violet-700 file:text-[12px]
file:font-semibold
file:bg-green-200 file:text-violet-700 hover:file:bg-green-400 file:w-full";
$imageClass ="mt-1 h-[90px] w-[85px] shadow-sm shadow-slate-800 rounded-lg text-sm object-cover";
@endphp

<div class="flex justify-center items-center min-h-screen w-screen bg-gray-400">
    @include('pagelayout.sidebarr', ['asideColor' => 'bg-green-400', 'border' => 'border-green-400'])

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div
        class="relative bg-green-400 p-4 my-6 rounded-l-lg w-[370px] h-[680px] shadow-md shadow-black border-green-700 border-l-2 border-t-2 border-b-2 border-bg-gray-800 rmd:hidden">
        <h1 class="text-2xl font-bold text-center mb-4 mt-2">Edit Book Information</h1>
        <img src="{{ asset($book->image) }}" alt="user"
            class="absolute top-[65px] start-[114px] h-[140px] w-[140px] border-[4px] border-teal-400 object-cover justify-center rounded-lg text-sm">

    </div>

    <div
        class="bg-green-400 p-8 rmd:pt-4 rmd:ps-8 rmd:pe-8 my-4 border-2 border-green-700 rounded-r-lg rmd:rounded-lg w-[370px] h-[680px] shadow-md shadow-black">

        <form method="POST" action="{{route('updatebook', ['book' => $book])}}" enctype="multipart/form-data">
            <h1 class="md:hidden text-2xl rmd:text-xl font-bold text-center mb-2 mt-2 rmd:mb-2 rmd:mt-1">Edit Book
                Information</h1>
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="book_title" class="{{$labelClass}}">Book Title</label>
                <input type="text" id="book_title" name="book_title" value="{{$book->book_title}}"
                    class="{{$inputClass}}">
            </div>
            <div class="mb-4">
                <label for="auther" class="{{$labelClass}}">Book Auther</label>
                <input type="text" id="auther" name="auther" value="{{$book->auther}}" class="{{$inputClass}}">
            </div>
            <div class="mb-4">
                <label for="edition" class="{{$labelClass}}">Book Edition</label>
                <input type="number" id="edition" name="edition" value="{{$book->edition}}" class="{{$inputClass}}">
            </div>
            <div class="mb-4">
                <label for="type" class="{{$labelClass}}">Book Type</label>
                <input type="text" id="type" name="type" value="{{$book->type}}" class="{{$inputClass}}">
            </div>
            <div class="mb-4">
                <label for="publisher" class="{{$labelClass}}">Published by</label>
                <input type="text" id="publisher" name="publisher" value="{{$book->publisher}}" class="{{$inputClass}}">
            </div>
            <div class="mb-4">
                <label for="isbn" class="{{$labelClass}}">ISBN Number</label>
                <input type="number" id="isbn" name="isbn" value="{{$book->isbn}}" class="{{$inputClass}}">
            </div>
            <div class="mb-4 grid rmd:grid-cols-2 grid-cols-1">
                <div class="md:hidden">
                    <label for="" class="{{$labelClass}}">Current Image</label>
                    <img src="{{ asset($book->image) }}" alt="Book_Cover" class="{{$imageClass}}">
                </div>
                <div>
                    <label for="image" class="{{$labelClass}}">Update new Image</label>
                    <input type="file" id="image" name="image" value="" class="{{$inputClassFile}} {{$fileClass}}">
                </div>
            </div>
            <div>
                <button type="submit" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium 
                    rounded-lg text-sm px-5 py-2.5 rmd:py-2 rmd:px-4.5 mb-2 rmd:h-[36px]">update</button>
            </div>
        </form>

    </div>


</div>



@endsection
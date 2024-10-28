@extends('layout')
@section('title', 'Add A Book')
@section('content')

@php
$labelClass ="block text-[16px] font-bold text-stone-950";
$inputClass = "mt-1 p-2 w-full h-[38px] bg-fuchsia-200 rounded-lg";
@endphp

<div class="bg-gray-100 bg-cover flex items-center justify-center h-full w-full">
    @include('pagelayout.sidebarr', ['asideColor' => 'bg-gray-400', 'border' => 'border-gray-400'])

    @if(session('error'))
    <div>{{ session('error') }}</div>
    @endif
    <div
        class="bg-gray-400 p-4 my-6 rounded-l-lg w-[380px] h-[680px] shadow-md shadow-black border-l-2 border-t-2 border-b-2 border-bg-gray-800 rmd:hidden">
        <h1 class="text-2xl font-bold text-center mb-4 mt-2">Add A Book</h1>

    </div>
    <div
        class="bg-gray-400 p-4 my-6 rounded-r-lg rmd:rounded-lg w-[380px] h-[680px] rmd:h-[720px] shadow-md shadow-black md:border-r-2 md:border-t-2 md:border-b-2 border-bg-gray-800">
        <div class="">
            <form class="" action="{{route('addbookp')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <h1 class="text-2xl font-bold text-center mb-4 mt-2 md:hidden">Add A Book</h1>
                <div class="mb-4">
                    <label for="book_title" class="{{$labelClass}}">Book Title</label>
                    <input type="text" id="book_title" name="book_title" value="" class="{{$inputClass}}">
                </div>
                <div class="mb-4">
                    <label for="auther" class="{{$labelClass}}">Book Auther</label>
                    <input type="text" id="auther" name="auther" value="" class="{{$inputClass}}">
                </div>

                <div class="mb-4">
                    <label for="edition" class="{{$labelClass}}">Book Edition</label>
                    <input type="number" id="edition" name="edition" value="" class="{{$inputClass}}">
                </div>
                <div class="mb-4">
                    <label for="type" class="{{$labelClass}}">Book Type</label>
                    <input type="text" id="type" name="type" value="" class="{{$inputClass}}">
                </div>
                <div class="mb-4">
                    <label for="publisher" class="{{$labelClass}}">Published by</label>
                    <input type="text" id="publisher" name="publisher" value="" class="{{$inputClass}}">
                </div>
                <div class="mb-4">
                    <label for="isbn" class="{{$labelClass}}">ISBN Number</label>
                    <input type="number" id="isbn" name="isbn" value="" class="{{$inputClass}}">
                </div>
                <div class="mb-4">
                    <label for="image" class="{{$labelClass}}">Cover Image</label>
                    <input type="file" id="image" name="image" value="" class="{{$inputClass}}">
                </div>
                <button type="submit"
                    class="bg-emerald-950 font-medium text-white p-3 w-full rounded-lg mt-3">Add</button>
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
@extends('layout')
@section('title', 'Books information')
@section('content')

<div class="bg-blue-300 min-h-screen w-full relative">

    <div class="sticky top-0 z-30">
        <header class="bg-blue-600 text-white p-4 sticky h-[100px] content-center">

            <div class="flex justify-between items-center">
                <div class="sm:w-40 md:w-80">
                    <a href="{{$is_student == 'false'? route('newhome'):route('newhome2')}}">
                        <h1 class="hidden sm:block sm:text-lg md:text-2xl font-bold">Library Management</h1>
                        <img src="/iconss/home_5.png" alt="" class="h-16 w-16 sm:hidden">
                    </a>
                </div>

                <div class="flex justify-end">
                    <div class="ms-4 bg-white rounded-full">
                        <form action="{{ route('logout') }}" method="POST" class="text-white hover:text-bold">
                            @csrf
                            <button type="submit" class=""><img src="/iconss/logoutt.png" alt=""
                                    class="ms-2 mt-1 h-[26px] w-[28px]"></button>
                        </form>
                    </div>
                </div>

            </div>
        </header>

    </div>


    @include('pagelayout.sidebar')


    <footer class="bg-blue-600 bg-opacity-30 text-white p-4 mt-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 My Website. All rights reserved.</p>
        </div>
    </footer>



    @endsection
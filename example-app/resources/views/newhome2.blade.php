@extends('layout')
@section('title', 'Student Home')
@section('content')

{{-- This is Student page. --}}

<div class="bg-sky-300 min-h-screen flex flex-col">

    @php
    $is_student = 'true';
    @endphp

    <header class="bg-neutral-700 text-white px-4 py-8 w-screen flex justify-between">
        <div class="flex w-80">
            <h1 class="text-2xl rmd:text-xl rsm:hidden font-bold">Welcome to the Library</h1>
            <button id="20" class="bg-white sm:hidden w-[40px] h-[40px] rounded-full"><img src="/iconss/menu.png"
                    alt=""></button>
            {{-- <a href="https://lordicon.com/">Icons by Lordicon.com</a> --}}
        </div>

        <div class="flex me-6"><a href="{{route('viewprofile')}}"><img src="{{asset(Auth::user()->image)}}" alt=""
                    class="w-10 h-10 rounded-full border-sky-200 border-[3px] hover:shadow-[0_0_2px_#fff,inset_0_0_2px_#fff,0_0_5px_#08f,0_0_15px_#08f,0_0_30px_#08f]"></a>
        </div>
    </header>

    <div class="flex flex-grow h-full max-w-screen">

        <!-- Sidebar -->
        {{-- change the padding later --}}
        @php
        $sideButton = "mt-1 me-1 p-2 hover:mt-0 hover:mb-1 bg-opacity-40 hover:bg-opacity-70 hover:bg-neutral-600 w-full
        bg-neutral-900 rounded-r-md";
        @endphp

        <aside id="10"
            class="rsm:hidden z-10 bg-neutral-700 lg:w-80 md:w-50 sm:w-40 rsm:absolute rsm:top-[104px] rsm:start-0 rsm:h-[810px] flex flex-grow-0 pe-2">
            {{-- <h2 class="text-xl font-bold text-white hover:bg-neutral-600 text-center mb-4">Sidebar</h2> --}}
            <ul class="w-full">
                <li class="mb-2"><a href="{{route('viewallbookadmn',['is_student' => $is_student])}}"
                        class="text-white hover:text-bold"><button class="{{$sideButton}}">View
                            Books</button></a></li>
                <li class="mb-2"><a
                        href="{{route('viewstudentrequest', ['student'=> Auth::user(), 'page' => request()->input('page', 1)])}}"
                        class="text-white hover:text-bold"><button class="{{$sideButton}}">Requested
                            Books</button></a></li>
                <li class="mb-2">
                    <form action="{{ route('logout') }}" method="POST" class="text-white hover:text-bold">
                        @csrf
                        <button type="submit" class="{{$sideButton}}">Logout</button>
                    </form>
                </li>
            </ul>
        </aside>
        @php
        $mainClass = "bg-white p-4 rounded shadow-md rmd:m-4 md:mt-6 md:mx-4 md:mb-4 shadow-black h-40 w-full relative";
        $mainPara ="text-[30px] font-[700] text-left text-emerald-900 w-3/5";
        $mainImg = "opacity-70 h-30 w-32 absolute end-4 top-8";
        @endphp

        <!-- Main Content -->
        {{-- class="w-screen min-h-screen max-h-full bg-red-200 flex flex-col lg:flex-row lg:flex-wrap lg:pr-8 md:pr-8"
        --}}
        <main class="w-screen h-full max-h-full grid md:grid-cols-2 grid-cols-1 gap-4 lg:pr-8 pr-8 pl-4">
            <div class="{{$mainClass}} bg-[url('/bg-img/yb-bg.avif')] bg-cover">
                <p class="{{$mainPara}}">Total Books : {{$totalBooks}}</p>
                <img src="/small-bg-img/total-books-removebg-preview.png" alt="" class="{{$mainImg}}">
            </div>

            <div class="{{$mainClass}} bg-[url('/bg-img/yb-bg.avif')] bg-cover">
                <p class="{{$mainPara}}">Available Books : {{$is_available}}</p>
                <img src="/small-bg-img/available-books-removebg-preview.png" alt="" class="{{$mainImg}}">
            </div>

            <div class="{{$mainClass}} bg-[url('/bg-img/yb-bg.avif')] bg-cover">
                <p class="{{$mainPara}}">Date : {{$currentDate}}</p>
                <img src="/small-bg-img/calendar-removebg-preview.png" alt="" class="{{$mainImg}}">
            </div>

            <div class="{{$mainClass}} bg-[url('/bg-img/yb-bg.avif')] bg-cover">
                <p class="{{$mainPara}}">Total Users : {{$total_user}}</p>
                <img src="/small-bg-img/total-users-removebg-preview.png" alt="" class="{{$mainImg}}">
            </div>
            <div class="{{$mainClass}} ">
                <p class="{{$mainPara}}">Pending Books : {{$pending_books}}</p>
            </div>
            <div class="{{$mainClass}} ">
                <p class="{{$mainPara}}">Book Requested : {{$book_requested}}</p>
            </div>
        </main>
        {{-- <div class="bg-red-200 h-screen w-screen"></div> --}}


    </div>

    <!-- Footer -->
    {{-- <footer
        class="md:absolute md:bottom-2 md:right-2 md:left-2 bg-blue-600 bg-opacity-30 text-white p-4 mt-6 mx-1"> --}}
        <footer class="bg-blue-500 text-white p-4 mt-6 mx-1">
            <div class="container mx-auto text-center">
                <p>&copy; 2024 My Website. All rights reserved.</p>
            </div>
        </footer>


</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the toggle button and the dropdown element
        const toggleButton = document.getElementById('20');
        const dropdown = document.getElementById('10');
        
        // Add a click event listener to the button
        toggleButton.addEventListener('click', function () {
            // Toggle the 'rsm:hidden' class on the dropdown element
            dropdown.classList.toggle('rsm:hidden');     

        });
    });
</script>



@endsection
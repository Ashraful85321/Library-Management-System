@extends('layout')
@section('title', 'Student information')
@section('content')

<div class="relative bg-blue-300 min-h-screen max-h-full w-screen">

    <header class="bg-blue-600 text-white p-4 sticky top-0 z-30 w-screen">

        <div class="flex justify-between items-center">
            <p class="text-lg"><a href="{{route('newhome')}}">Library Management</a></p>
            <div class="flex ">
                <form method="POST" action="{{route('viewsearchstudent')}}" class="flex items-center">
                    @csrf
                    @method('post')
                    <input type="hidden" name="page" value="{{ request()->input('page', 1) }}">
                    <input type="bigint"
                        class="rounded-l-full w-[150px] placeholder:text-black bg-white text-black ps-4 h-8 flex-grow focus:outline-none"
                        name="search" value="" placeholder="Search by id">
                    <button type="submit" class="rounded-r-full bg-white p-1 h-8"><img src="/iconss/search.svg"
                            alt=""></button>
                </form>
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

    <div class="bg-green-400 h-[6px] my-[20px] w-screen"></div>

    <div class="flex justify-end mt-4 pe-4">
        @include('pagelayout.sidebar', ['top' => 'top-[129px]'])
        <div class="flex flex-col me-[100px] rlg:me-[60px] my-4 ms-4 w-[70%] rmd:w-[75%]">
            @foreach($students as $student)
            <div class="bg-sky-300 shadow-lg rounded-lg flex flex-col mb-4">
                <div class="bg-sky-500 p-4 flex items-center rounded-t-lg">
                    <img class="w-16 h-16 rounded-full mr-4" src="{{asset($student->image)}}" alt="Student Image">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">{{$student->name}}</h2>
                        <p class="text-gray-600">ID: {{$student->id}}</p>
                    </div>
                    <div class="p-4 rmd:hidden">
                        <p class="p-2 font-medium text-[15px]">
                            <strong>Returnable Pending Books {{$borrow_count[$student->id]}}.</strong>
                            <a class="{{$borrow_count[$student->id] == 0 ? 'hidden' : ''}} underline hover:font-bold"
                                href="{{route('viewstudentborrow', ['student'=> $student, 'page' => request()->input('page', 1)])}}">View</a>
                        </p>
                        @php
                        $book_requested = 0;
                        if($student->req_1){
                        $book_requested++;
                        }
                        if($student->req_2){
                        $book_requested++;
                        }
                        if($student->req_3){
                        $book_requested++;
                        }
                        @endphp
                        <p class="p-2 font-medium text-[15px]">
                            <strong>Requested for Books {{$book_requested}}.</strong>
                            <a class="{{$book_requested == 0 ? 'hidden' : ''}} underline hover:font-bold"
                                href="{{route('viewstudentrequest', ['student'=> $student, 'page' => request()->input('page', 1)])}}">Requests</a>
                        </p>
                    </div>
                </div>
                <div class="p-4 flex bg-sky-300">
                    <div class="flex w-[80%] rmd:flex-col">
                        <div class="mb-4  w-[30%] rlg:w-[150px] rmd:w-full">
                            <p class="text-gray-700"><strong>Phone:</strong> {{$student->phone_number}}</p>
                            <p class="text-gray-700"><strong>Email:</strong> {{$student->email}}</p>
                        </div>

                        <div class="mb-4 ms-2 rmd:ms-0  w-[80%] rmd:w-full">
                            <p class="text-gray-700"><strong>Current Address:</strong> {{($student->current_address)?
                                $student->current_address : 'Not Provided'}}</p>
                            <p class="text-gray-700"><strong>Permanent Address:</strong>
                                {{($student->permanent_address)?$student->permanent_address:'Not Provided'}}
                            </p>
                        </div>
                    </div>


                    <div class=" flex flex-col ms-2 w-[100px] rmd:ps-2">
                        <a
                            href="{{route('viewstudent', ['student'=> $student, 'page' => request()->input('page', 1)])}}"><button
                                type="button" class="text-white bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br font-medium
                        text-sm p-auto w-[80px] h-[30px] block">Edit</button></a>
                        <form action="{{ route('deleteStudent', ['student'=> $student]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="page" value="{{ request()->input('page', 1) }}">
                            <button type="submit" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br font-medium
                            text-sm p-auto mt-2 w-[80px] h-[30px] block">Delete</button>
                        </form>
                        <a class="{{$borrow_count[$student->id] == 0 ? 'hidden' : ''}}"
                            href="{{route('viewstudentborrow', ['student'=> $student, 'page' => request()->input('page', 1)])}}"><button
                                type="button" class="md:hidden text-white bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br font-medium
                        text-sm p-auto mt-2 w-[80px] h-[30px] block">Pending
                                {{$borrow_count[$student->id]}}</button></a>
                        <a class="{{$book_requested == 0 ? 'hidden' : ''}}"
                            href="{{route('viewstudentrequest', ['student'=> $student, 'page' => request()->input('page', 1)])}}"><button
                                type="button" class="md:hidden text-white bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br font-medium
                        text-sm p-auto mt-2 w-[80px] h-[30px] block">Requests
                                {{$book_requested}}</button></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    {{-- <div class="flex justify-center mt-4 {{$students->count() < 5 ? 'hidden' : ''}} ">
        {{ $students->links() }}
    </div> --}}
    @if ($students instanceof \Illuminate\Pagination\LengthAwarePaginator && $students->isNotEmpty())
    <div class="flex justify-center mt-4">
        {{ $students->links() }}
    </div>
    @endif


    <footer class=" bg-blue-600 bg-opacity-30 text-white p-4 mt-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 My Website. All rights reserved.</p>
        </div>
    </footer>

    {{--
</div> --}}
</div>
@endsection
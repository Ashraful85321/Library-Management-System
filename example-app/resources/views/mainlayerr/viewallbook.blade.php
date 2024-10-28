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
                    <div class="relative text-left mx-2 content-center">
                        {{-- dropdown button 1 --}}
                        <button id="dropdownButton"
                            class=" border-2 focus:border-none border-green-300 w-full px-2 py-1 text-sm font-medium text-white bg-green-600 rounded-full hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Advanced Search
                        </button>
                        {{-- dropdown menu first --}}
                        @php
                        $fields = [
                        ['name' => 'auther', 'placeholder' => 'Author'],
                        ['name' => 'book_title', 'placeholder' => 'Title'],
                        ['name' => 'type', 'placeholder' => 'Subject'],
                        ['name' => 'edition', 'placeholder' => 'Edition', 'type' => 'int'],
                        ];
                        @endphp
                        <div id="dropdownMenu"
                            class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="p-4 space-y-4">
                                <form method="POST"
                                    action="{{route('viewsearchbookadv',['is_student' => $is_student])}}">
                                    @csrf
                                    @method('post')
                                    @foreach ($fields as $field)
                                    <input type="{{ $field['type'] ?? 'text' }}" name="{{ $field['name'] }}"
                                        placeholder="{{ $field['placeholder'] }}"
                                        class="w-full h-[32px] px-3 py-2 mb-1 border border-gray-500 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-black">
                                    @endforeach
                                    <button type="submit"
                                        class="w-full px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 border border-green-700">
                                        Search
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const dropdownButton = document.getElementById('dropdownButton');
                            const dropdownMenu = document.getElementById('dropdownMenu');
                    
                            dropdownButton.addEventListener('click', function () {
                                dropdownMenu.classList.toggle('hidden');
                            });
                    
                            // Optionally, close the dropdown if the user clicks outside of it
                            document.addEventListener('click', function (event) {
                                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                                    dropdownMenu.classList.add('hidden');
                                }
                            });
                        });
                    </script>


                    <form method="POST" action="{{route('viewsearchbook', ['is_student' => $is_student])}}"
                        class="flex items-center w-1/7">
                        @csrf
                        @method('post')
                        <input type="bigint"
                            class="placeholder:text-black ps-3 placeholder:text-[15px] rounded-l-full w-24 bg-white text-black h-8 flex-grow focus:outline-none"
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

    </div>

    @include('pagelayout.alerthome')



    @if($books->isEmpty())
    <div id="" class="content-center justify-center mt-[40px] mb-[40px]">
        <p class="text-bold font-medium text-[18px] text-center text-green-900">No book matched your query</p>
    </div>
    @endif
    @include('pagelayout.sidebar')
    <div class="flex flex-col items-end p-2 rmd:pt-2 rmd:pb-2 rmd:ps-10 min-h-[532px]">
        @foreach($books as $book)
        <div
            class="rmd:pb-1 mt-2 lg:mb-2 lg:ms-2 lgPlus:me-8 rounded-l-sm flex {{ $loop->iteration % 2 == 0 ? 'bg-emerald-100' : 'bg-emerald-200' }} md:w-4/5 w-full">
            <div class="lg:w-10 w-[20px]">
                <p class="text-bold font-bold ms-4 mt-4 text-xl">{{$book->id}}</p>
            </div>
            <div class="flex flex-col md:ms-[28px] ms-4 md:p-4 p-2 h-[117px] w-[92px]">
                <a href="{{route('bookdescription', ['book' => $book])}}"><img src="{{ asset($book->image) }}"
                        alt="Book_Cover" class="h- w-full shadow-sm shadow-slate-800 rounded-sm text-sm"></a>

                <div class="mdPlus:hidden relative mt-4 flex justify-center">
                    <div id="clock-{{ $book->id }}"
                        class="h-[26px] w-[26px] bg-green-700 flex justify-center items-center"
                        style="clip-path: polygon(0% 23%, 23% 0%, 77% 0%, 100% 23%, 100% 77%, 77% 100%, 23% 100%, 0% 77%)">
                        <img src="/iconss/clock.png" alt=""
                            class="h-[18px] w-[18px] {{$book->is_available == 'no' ? 'animate-spin' : ''}}">
                    </div>
                    <div id="countdown-{{ $book->id }}"
                        class="absolute top-[30px] hidden bg-blue-200 text-blue-900 px-1 border-blue-900 border rounded-sm">
                    </div>
                </div>
            </div>
            <div class="m-2 rmd:w-[200px] lg:w-[280px] rlg:w-[220px]">
                <p class="text-bold text-[18px] rmd:text-[16px] min-w-full">{{$book->book_title}}</p>
                <p class="text-bold text-[15px] rmd:[13px] font-medium w-full">By : {{$book->auther}}</p>
                <p class="text-bold text-[14px] rmd:text[12px] italic w-full text-green-950">
                    @if ($book->edition == 1)
                    {{$book->edition}}st
                    @elseif ($book->edition == 2)
                    {{$book->edition}}nd
                    @elseif ($book->edition == 3)
                    {{$book->edition}}rd
                    @else
                    {{$book->edition}}th
                    @endif edition
                </p>
                <p class="text-bold text-[18px] rmd:text-[16px] w-full">Book Type : {{$book->type}}</p>
                <p class="text-bold text-[18px] rmd:text-[16px] w-full">ISBN number : {{$book->isbn}}</p>
            </div>
            {{-- <div class="m-2 w-30">


                <p>{{$is_student}}</p>
            </div> --}}

            @php
            $buttonClass = "text-white bg-purple-700 hover:bg-purple-800 focus:ring-2 focus:ring-purple-300 font-medium
            rounded-lg text-sm mb-2 rmd:mb-1 h-[30px] w-full";
            $buttonDisabled = "disabled:bg-purple-500";
            @endphp

            <div
                class="{{$is_student == 'true' ? 'hidden' : ''}} grid rlg:grid-cols-1 lg:grid-cols-2 gap-4 rlg:gap-[10px] content-center lg:ms-4 ms-[8px] lg:w-[150px] rlg:w-[70px]">
                <div class="relative">
                    <form action="{{ route('deletebook', ['book'=> $book]) }}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="page" value="{{ request()->input('page', 1) }}">
                        <button type="submit" class="{{$buttonClass}} rlg:mt-2">Delete</button>
                    </form>
                </div>
                <div class="relative">
                    <a href="{{route('viewbook', ['book'=> $book])}}">
                        <button type="button" class="{{$buttonClass}}">Edit</button>
                    </a>
                </div>

                <!-- Lent Form -->
                <div class="relative">
                    <button type="button" class="dropdownButton {{$buttonClass}} {{$buttonDisabled}}"
                        data-menu-id="dropdownMenu{{ $loop->index }}" @if($book->is_available == 'no') disabled @endif>
                        Lent
                    </button>
                    <!-- Dropdown content -->
                    <div id="dropdownMenu{{ $loop->index }}"
                        class="hidden absolute z-10 top-10 left-0 rsm:-left-20 mt-2 w-[200px] ">
                        <form action="{{ route('lent', ['book' => $book])}}" method="POST"
                            class="p-4 bg-white shadow-lg rounded-lg lentForm" id="lentForm-{{ $book->id }}">
                            @csrf
                            <input type="hidden" name="page" value="{{ request()->input('page', 1) }}">
                            <input type="number" name="id" id="userIdInput-{{ $book->id }}" placeholder="Input user ID"
                                class="border rounded border-blue-700 p-2 w-full h-[20px] mb-3 userIdInput">
                            <span id="error-message-{{ $book->id }}"
                                class="text-red-500 text-sm hidden error-message">Please enter a positive
                                number.</span>
                            <button type="submit" class="{{$buttonClass}} mt-2 md:mt-0 lentButton"
                                data-book-id="{{ $book->id }}">Lent Book</button>
                        </form>
                    </div>
                </div>
                {{-- <div class="relative">
                    <form action="{{ route('return', ['book'=> $book]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="page" value="{{ request()->input('page', 1) }}">
                        <button type="submit" class="{{$buttonClass}}">Return</button>
                    </form>
                </div> --}}
                <div class="relative">
                    <button type="button" class="dropdownButton2 {{$buttonClass}} {{$buttonDisabled}}"
                        data-menu-id="dropdownMenu2{{ $loop->index }}" @if($book->is_available == 'yes') disabled
                        @endif>
                        Return
                    </button>
                    <!-- Dropdown content -->
                    <div id="dropdownMenu2{{ $loop->index }}"
                        class="hidden absolute z-10 top-10 left-0 rsm:-left-20 mt-2 w-[200px] ">
                        <form action="{{ route('return', ['book' => $book])}}" method="POST"
                            class="p-4 bg-white shadow-lg rounded-lg returnForm" id="returnForm-{{ $book->id }}">
                            @csrf
                            <input type="hidden" name="page" value="{{ request()->input('page', 1) }}">
                            <input type="text" name="book_condition" id="book_condition" maxlength="255"
                                placeholder="Book condition"
                                class="border border-blue-700 rounded p-2 w-full h-[20px] mb-3 userIdInput">
                            <textarea id="notes" name="notes" rows="4"
                                class="border rounded border-blue-700 p-2 w-full h-[80px] mb-3 userIdInput"
                                placeholder="Enter any additional notes"></textarea>

                            <button type="submit" class="{{$buttonClass}} mt-2 md:mt-0 returnButton"
                                data-book-id="{{ $book->id }}">Return Book</button>
                        </form>
                    </div>
                </div>

            </div>

            <div class="{{$is_student == 'false' ? 'hidden' : ''}}
                content-center lg:ms-4 ms-[8px] lg:w-[150px] rlg:w-[140px] flex flex-col bg-red-500">

                <div class="mt-2 mx-4">
                    <form action="{{route('requestbook', ['book' => $book])}}" method="POST" class="p-4 rmd:p-auto">
                        @csrf

                        <input type="hidden" name="page" value="{{ request()->input('page', 1) }}">
                        <button type="submit" class="{{$buttonClass}} {{$buttonDisabled}} mt-2 md:mt-0" @if($book->id ==
                            Auth::user()->req_1 || $book->id == Auth::user()->req_2 || $book->id == Auth::user()->req_3)
                            disabled
                            @endif>
                            Request
                        </button>
                    </form>
                </div>
                <div class="mt-2 mx-4">
                    <form action="{{route('removerequest', ['book' => $book])}}" method="POST" class="p-4">
                        @csrf

                        <input type="hidden" name="page" value="{{ request()->input('page', 1) }}">
                        <button type="submit" class="{{$buttonClass}} {{$buttonDisabled}} mt-2 md:mt-0">
                            Remove
                        </button>
                    </form>
                </div>


            </div>
            <div id="book-status-{{ $book->id }}"
                class="ms-4 rmd:me-2 my-2 p-2 min-h-full w-[90px] rsm:w-[70px] {{$book->is_available == 'yes' ? 'bg-green-400' : 'bg-red-400' }} content-center"
                style="clip-path: polygon(0% 0%, 50% 20%, 100% 0%, 100% 80%, 50% 100%, 0% 80%);">
                <p class="text-center rsm:text-[10px] rsm:font-[700]">{{$book->is_available == 'yes' ? 'Available' :
                    'Not Available'}}
                </p>
            </div>
            @php
            $timerClass = "bg-sky-400 h-[35px] w-[40px] rlg:h-[25px] rlg:w-[30px] border-black border-r-2 border-b-2
            text-center content-center";
            $timerIndicator = "bg-sky-500 h-[18px] w-[40px] rlg:w-[30px] text-[10px] font-bold text-black
            text-center
            content-center";
            @endphp
            <div class="flex content-center items-baseline">
                <div
                    class="flex flex-col justify-center my-1 me-2 lg:ms-4 rlg:ms-2 shadow-black shadow-lg rmdPlus:hidden">
                    <p class="bg-white text-black text-center text-[15px]">Due In</p>
                    <div class="grid grid-cols-4 rxl:grid-cols-2 gap-1">
                        <div class="flex flex-col">
                            <p id="dd-{{ $book->id }}" class="{{$timerClass}}">00</p>
                            <p id="54" class="{{$timerIndicator}} rlg:hidden">Days</p>
                            <p id="44" class="{{$timerIndicator}} lg:hidden">D</p>
                        </div>
                        <div class="flex flex-col">
                            <p id="hh-{{ $book->id }}" class="{{$timerClass}}">00</p>
                            <p id="55" class="{{$timerIndicator}} rlg:hidden">Hours</p>
                            <p id="45" class="{{$timerIndicator}} lg:hidden">H</p>
                        </div>
                        <div class="flex flex-col">
                            <p id="mm-{{ $book->id }}" class="{{$timerClass}}">00</p>
                            <p id="56" class="{{$timerIndicator}} rlg:hidden">minutes</p>
                            <p id="46" class="{{$timerIndicator}} lg:hidden">min</p>
                        </div>
                        <div class="flex flex-col">
                            <p id="ss-{{ $book->id }}" class="{{$timerClass}}">00</p>
                            <p id="57" class="{{$timerIndicator}} rlg:hidden">seconds</p>
                            <p id="47" class="{{$timerIndicator}} lg:hidden">sec</p>
                        </div>
                    </div>

                </div>
            </div>


        </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="flex justify-center mt-4">
        @if ($books instanceof \Illuminate\Pagination\LengthAwarePaginator || $books instanceof
        \Illuminate\Pagination\Paginator)
        {{ $books->links() }}
        @endif
    </div>

    <footer class="bg-blue-600 bg-opacity-30 text-white p-4 mt-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 My Website. All rights reserved.</p>
        </div>
    </footer>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
    
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('dropdownButton')) {
            const menuId = event.target.getAttribute('data-menu-id');
            const dropdownMenu = document.getElementById(menuId);
            dropdownMenu.classList.toggle('hidden');
        }
        if (event.target.classList.contains('dropdownButton2')) {
            const menuId = event.target.getAttribute('data-menu-id');
            const dropdownMenu = document.getElementById(menuId);
            dropdownMenu.classList.toggle('hidden');
        }
        
    });


    // Form validation for all lent forms
    document.querySelectorAll('.lentForm').forEach(function(form) {
        form.addEventListener('submit', function(event) {
            // Get the user ID input within the form being submitted
            const userIdInput = form.querySelector('.userIdInput');
            const errorMessage = form.querySelector('.error-message');
            const userId = userIdInput.value;

            console.log(`Form submitted for Book ID: ${form.getAttribute('data-book-id')}, User ID: ${userId}`);

            // Validation
            if (!userId || isNaN(userId) || parseInt(userId) <= 0) {
                event.preventDefault(); // Prevent form submission
                console.log('Validation failed: showing error message');
                errorMessage.classList.remove('hidden'); // Show the error message
            } else {
                console.log('Validation passed: hiding error message');
                errorMessage.classList.add('hidden'); // Hide the error message
            }
        });
    });
     
    let dueTimes = @json($timeInit);

            // Function to create a countdown for each book
            function createCountdown(bookId) {
                let countdownElement = document.getElementById(`countdown-${bookId}`);

                let d = document.getElementById(`dd-${bookId}`);
                let h = document.getElementById(`hh-${bookId}`);
                let m = document.getElementById(`mm-${bookId}`);
                let s = document.getElementById(`ss-${bookId}`);
                
                // Retrieve due time from the dueTimes object
                let dueTime = dueTimes[bookId];
                
                if (dueTime === 0) {
                    countdownElement.textContent = "No due time";
                    return;
                }

                // Convert dueTime to a timestamp
                dueTime = new Date(dueTime).getTime();

                // Update countdown every second
                let interval = setInterval(function() {
                    let now = new Date().getTime();
                    let timeRemaining = dueTime - now;

                    if (timeRemaining <= 0) {
                        clearInterval(interval);
                        countdownElement.textContent = "00:00:00:00";

                        d.textContent = "00";
                        h.textContent = "00";
                        m.textContent = "00";
                        s.textContent = "00";
                        return;
                    }

                    let days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                let hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                countdownElement.textContent = `${String(days).padStart(2, '0')}:${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

                d.textContent = `${String(days).padStart(2, '0')}`;
                h.textContent = `${String(hours).padStart(2, '0')}`;
                m.textContent = `${String(minutes).padStart(2, '0')}`;
                s.textContent = `${String(seconds).padStart(2, '0')}`;
                }, 1000);
            }

            // Loop through all books and create a countdown for each
            @foreach ($books as $book)
                createCountdown({{ $book->id }});
                document.getElementById('clock-{{ $book->id }}').addEventListener('click', function() {
            const countdownElement = document.getElementById('countdown-{{ $book->id }}');
            countdownElement.classList.toggle('hidden');
            @endforeach
    
});

        

    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

// Dropdown toggle functionality
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('dropdownButton')) {
        const menuId = event.target.getAttribute('data-menu-id');
        const dropdownMenu = document.getElementById(menuId);
        dropdownMenu.classList.toggle('hidden');
    }
    if (event.target.classList.contains('dropdownButton2')) {
        const menuId = event.target.getAttribute('data-menu-id');
        const dropdownMenu = document.getElementById(menuId);
        dropdownMenu.classList.toggle('hidden');
    }
    if (event.target.classList.contains('dropdownButton3')) {
        const menuId = event.target.getAttribute('data-menu-id');
        const dropdownMenu = document.getElementById(menuId);
        dropdownMenu.classList.toggle('hidden');
    }
});

// Form validation for all lent forms
document.querySelectorAll('.lentForm').forEach(function(form) {
    form.addEventListener('submit', function(event) {
        const userIdInput = form.querySelector('.userIdInput');
        const errorMessage = form.querySelector('.error-message');
        const userId = userIdInput.value;

        console.log(`Form submitted for Book ID: ${form.getAttribute('data-book-id')}, User ID: ${userId}`);

        // Validation
        if (!userId || isNaN(userId) || parseInt(userId) <= 0) {
            event.preventDefault(); // Prevent form submission
            console.log('Validation failed: showing error message');
            errorMessage.classList.remove('hidden'); // Show the error message
        } else {
            console.log('Validation passed: hiding error message');
            errorMessage.classList.add('hidden'); // Hide the error message
        }
    });
});

let dueTimes = @json($timeInit);

// Function to create a countdown for each book
function createCountdown(bookId) {
    let countdownElement = document.getElementById(`countdown-${bookId}`);
    let d = document.getElementById(`dd-${bookId}`);
    let h = document.getElementById(`hh-${bookId}`);
    let m = document.getElementById(`mm-${bookId}`);
    let s = document.getElementById(`ss-${bookId}`);

    let dueTime = dueTimes[bookId];

    if (dueTime === 0) {
        countdownElement.textContent = "No due time";
        return;
    }

    dueTime = new Date(dueTime).getTime();

    let interval = setInterval(function() {
        let now = new Date().getTime();
        let timeRemaining = dueTime - now;

        if (timeRemaining <= 0) {
            clearInterval(interval);
            countdownElement.textContent = "00:00:00:00";
            d.textContent = "00";
            h.textContent = "00";
            m.textContent = "00";
            s.textContent = "00";
            return;
        }

        let days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        let hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

        countdownElement.textContent = `${String(days).padStart(2, '0')}:${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        d.textContent = `${String(days).padStart(2, '0')}`;
        h.textContent = `${String(hours).padStart(2, '0')}`;
        m.textContent = `${String(minutes).padStart(2, '0')}`;
        s.textContent = `${String(seconds).padStart(2, '0')}`;
    }, 1000);
}

// Loop through all books and create a countdown for each
@foreach ($books as $book)
    createCountdown({{ $book->id }});

    // Add click event listener to toggle countdown visibility
    document.getElementById('clock-{{ $book->id }}').addEventListener('click', function() {
        const countdownElement = document.getElementById('countdown-{{ $book->id }}');
        if (countdownElement.classList.contains('hidden')) {
            countdownElement.classList.remove('hidden');
        } else {
            countdownElement.classList.add('hidden');
        }
    });
@endforeach

});

    </script>




</div>

@endsection
@extends('layout')
@section('title', 'User Profile')
@section('content')

<div class="bg-gray-200 min-h-screen p-4 flex flex-col">
    <div id="00" class="relative rounded-lg overflow-hidden">
        <div id="1" class="mx-auto p-4 bg-black h-[195px] flex justify-center rmd:justify-end">
            <p class="text-white text-[35px] text-center font-semibold flex-col content-end">
                {{$user->name}}
            </p>
        </div>
        <div id="2" class="absolute start-[60px] top-[95px] mx-auto p-2 bg-blue-700 h-40 w-40 rounded-full z-10">
            <img src="{{ asset($user->image) }}" alt="" class="w-full h-full rounded-full object-cover">
        </div>
        <div id="3" class="mx-auto p-4 bg-red-200 h-[110px] w-full">

        </div>
    </div>

    @php
    $asideClass = "bg-opacity-0 hover:bg-green-200 h-full w-full py-2 px-4";
    $asideList = "items-center odd:bg-red-400 even:bg-red-500";
    @endphp

    <div id="01" class="relative rounded-lg overflow-hidden flex h-full w-full">
        {{-- the aside part --}}
        <div id="001" class="mt-4 me-4 bg-gray-400 w-[160px]">
            <ul class="mt-4">

                <li class="{{$asideList}}">
                    <a href="{{route('getprofile', ['user' => $user])}}"><button type="button"
                            class="{{$asideClass}}">Edit Profile</button>
                    </a>
                </li>
                <li class="{{$asideList}}">
                    <a href="{{route($user->dbman == 'yes' ? 'newhome' : 'newhome2')}}"><button type="button"
                            class="{{$asideClass}}">Back Home</button>
                    </a>
                </li>
                <li class="{{$asideList}}">
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="{{$asideClass}}">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
        {{-- main part --}}
        @php
        $mainItem = ['Phone' => 'phone_number', 'E-mail' => 'email', 'Current Address' => 'current_address', 'Permanent
        Address'
        => 'permanent_address'];
        $mainClass = "text-center font-bold text-[18px] text-teal-900 px-4 py-2"
        @endphp
        <div id="002" class="mt-4 bg-blue-200 w-full h-full">
            <table class="w-full">
                @foreach($mainItem as $key => $value)
                <tr class="">
                    <td class="{{ $loop->even ? 'bg-teal-400' : 'bg-teal-300' }} {{$mainClass}} ">{{$key}}</td>
                    <td class="{{ $loop->even ? 'bg-teal-300' : 'bg-teal-400' }} {{$mainClass}} ">{{$user -> $value ?
                        $user -> $value : 'Not available'}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>





</div>


@endsection
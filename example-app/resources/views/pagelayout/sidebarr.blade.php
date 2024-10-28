@php
$sideButton = "mt-1 p-2 hover:mt-0 hover:mb-1 bg-opacity-40 hover:bg-opacity-70 border-r-2 border-b-2
hover:border-black
hover:bg-neutral-600 w-full
bg-neutral-900 rounded-md";
$asideClassColor = isset($asideColor) ? $asideColor : "bg-gray-400";
$borderColor = isset($border) ? $border : "border-gray-400";
$asidePosition = "absolute z-10 top-[25px] start-[10px] bottom-[25px] flex flex-col justify-between rounded-r-lg";
@endphp


<aside id="1"
    class="{{$asidePosition}} border-2 border-black rlgPlus:transition-width rlgPlus:duration-[250ms] rlgPlus:ease-in rxlPlus:w-[18%] rxl:w-[16%] rlgPlus:w-[30px] p-4 w-[21%] {{$asideClassColor}}">

    <div id="11" class="z-10 absolute top-[300px] right-[5px] h-[20px] w-[20px] lgPlus:hidden content-end">
        <img src="/iconss/arrow.png" alt="">
    </div>
    <ul id="2" class=" mt-4 rlgPlus:hidden">
        <li class="mb-2"><a href="{{route('back')}}" class="text-white hover:text-bold"><button
                    class="{{$sideButton}} {{$borderColor}} active:{{$borderColor}}">Back</button></a></li>
        <li class="mb-2"><a href="{{route(Auth::user()->dbman == 'yes' ? 'newhome' : 'newhome2')}}"
                class="text-white hover:text-bold"><button
                    class="{{$sideButton}} {{$borderColor}} active:{{$borderColor}}">Home</button></a></li>
    </ul>
    <ul id="3" class=" mt-4 rlgPlus:hidden">
        <li class="mb-2">
            <form action="{{ route('logout') }}" method="POST" class="text-white hover:text-bold">
                @csrf
                <button type="submit" class="{{$sideButton}} {{$borderColor}} active:{{$borderColor}}">Logout</button>
            </form>
        </li>
    </ul>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const aside = document.getElementById('1');
        const ul2 = document.getElementById('2');
        const ul3 = document.getElementById('3');
        const arrow = document.getElementById('11');
    
        aside.addEventListener('click', function () {
            if(aside.classList.contains('rlgPlus:w-[30px]')){
                arrow.classList.remove('lgPlus:hidden');
                arrow.classList.add('hidden');
                aside.classList.replace('rlgPlus:w-[30px]', 'rlgPlus:w-[200px]'); 
               setTimeout(() => {
                ul2.classList.remove('rlgPlus:hidden');
            ul3.classList.remove('rlgPlus:hidden');
               },250);
            
            }else if(aside.classList.contains('rlgPlus:w-[200px]')) {
                ul2.classList.add('rlgPlus:hidden');
            ul3.classList.add('rlgPlus:hidden');
            aside.classList.replace('rlgPlus:w-[200px]', 'rlgPlus:w-[30px]');
            setTimeout(() => {
                arrow.classList.add('lgPlus:hidden');
                arrow.classList.remove('hidden');
            },250);
            }
            

        });
    });
</script>
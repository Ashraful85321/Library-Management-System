@php
$sideButton = "mt-1 p-2 hover:mt-0 hover:mb-1 bg-opacity-40 hover:bg-opacity-70 border-r-2 border-b-2 border-green-400
hover:border-black active:border-green-400
hover:bg-neutral-600 w-full
bg-neutral-900 rounded-md";
$asideClassColor ="bg-blue-600";
$topPosition = isset($top) ? $top : "top-[100px]";
$asidePosition = "absolute z-20 $topPosition start-[0px] bottom-[56px] h-auto flex flex-col justify-between";
@endphp


<aside id="1"
    class="{{$asidePosition}} rmd:transition-width rmd:duration-[250ms] rmd:ease-in rmd:w-[30px] rmd:border-t-2 rmd:border-b-2 rmd:border-r-2 rmd:border-green-600 rmd:rounded-r-lg p-4 w-[17%] {{$asideClassColor}}">
    <div id="11" class="absolute top-[100px] right-[5px] h-[20px] w-[20px] md:hidden content-end">
        <img src="/iconss/arrow.png" alt="">
    </div>

    <ul id="2" class=" mt-4 rmd:hidden">
        <li class="mb-2"><a href="{{route('back')}}" class="text-white hover:text-bold"><button
                    class="{{$sideButton}}">Back</button></a></li>
        <li class="mb-2"><a href="{{route(Auth::user()->dbman == 'yes' ? 'newhome' : 'newhome2')}}"
                class="text-white hover:text-bold"><button class="{{$sideButton}}">Home</button></a></li>
    </ul>
    <ul id="3" class=" mt-4 rmd:hidden">
        <li class="mb-2">
            <form action="{{ route('logout') }}" method="POST" class="text-white hover:text-bold">
                @csrf
                <button type="submit" class="{{$sideButton}}">Logout</button>
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
            if(aside.classList.contains('rmd:w-[30px]')){
                arrow.classList.remove('md:hidden');
                arrow.classList.add('hidden');
                aside.classList.replace('rmd:w-[30px]', 'rmd:w-[200px]'); 
               setTimeout(() => {
                ul2.classList.remove('rmd:hidden');
            ul3.classList.remove('rmd:hidden');
               },250);
            
            }else if(aside.classList.contains('rmd:w-[200px]')) {
                ul2.classList.add('rmd:hidden');
            ul3.classList.add('rmd:hidden');
            aside.classList.replace('rmd:w-[200px]', 'rmd:w-[30px]');
            setTimeout(() => {
                arrow.classList.add('md:hidden');
                arrow.classList.remove('hidden');
            },250);
            }
            

        });
    });
</script>
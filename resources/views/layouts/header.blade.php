<nav x-data="{show:false}" class="w-full py-8 shadow-md">
    <div class="mx-12 flex justify-between items-center">
        <span class="uppercase font-bold text-md md:text-xl text-blue-500 ">{{config('app.name', 'Laravel')}}</span>
        <button x-on:click="show=!show" class="text-blue-500 hover:text-gray-400 md:hidden" >
            <i class="fas fa-bars fa-2x"></i>
        </button>
    </div>
    <div class="flex justify-end items-center rounded-lg shadow-lg m-4 bg-white md:shadow-none md:m-0 md:bg-opacity-0  mt-6 md:mt-0">
        <div x-bind:class="show?'mr-12 md:flex md:justify-around md:visible' : 'mr-12 md:flex md:justify-around hidden md:visible'">
            <span class="block my-2 uppercase font-bold text-blue-500 rounded-md hover:bg-gray-200 md:mx-4 md:hover:text-gray-400 md:hover:bg-opacity-0">
                <a href="/">Home</a>
            </span>
            <span class="block my-2 uppercase font-bold text-blue-500 rounded-md hover:bg-gray-200 md:mx-4 md:hover:text-gray-400 md:hover:bg-opacity-0">
                <a href="/">About us</a>
            </span>
            <span class="block my-2 uppercase font-bold text-blue-500 rounded-md hover:bg-gray-200 md:mx-4 md:hover:text-gray-400 md:hover:bg-opacity-0">
                <a href="/">Services</a>
            </span>
            <span class="block my-2 uppercase font-bold text-blue-500 rounded-md hover:bg-gray-200 md:mx-4 md:hover:text-gray-400 md:hover:bg-opacity-0">
                <a href="{{route('login')}}">
                    Log in
                </a>
            </span>
            <span class="block my-2 uppercase font-bold text-blue-500 rounded-md hover:bg-gray-200 md:mx-4 md:hover:text-gray-400 md:hover:bg-opacity-0">
                <a href="{{route('register.patient')}}">
                    Register
                </a>
            </span>
        </div>
    </div>
</nav>
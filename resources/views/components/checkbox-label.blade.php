@props(['id','data'])
<div x-data="{show:false,day:'{{$id}}',period_number:0}">
    <div class="block mt-1 w-full">
        <input x-on:click="show = !show" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="{{$id}}"type="checkbox" name="{{$id}}" value="{{$id}}">
        <label class="ml-2 font-medium text-sm text-gray-700" for="{{$id}}">
            {{$data}}
        </label>
    </div>
    <div x-show="show">
        <x-label for="{{$id.'period'}}" :value="__('How Many period')" />
        <x-input id="{{$id.'period'}}" class="ml-2"
                            type="text"/>
        <button type='button' x-on:click="period_number=parseInt(document.getElementById('{{$id.'period'}}',1).value)" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            show
        </button>
    </div>
    <div x-show="show" class="ml-6">

        <template x-for="idx in period_number" :key="idx">
            <div>
                <x-label for="time" :value="__('Day Time Period')" />
                <div id="time" class="block ml-1 w-full">
                    <x-input x-bind:id="day.concat(idx,'1')"  value="08:30" class="" type="time" x-bind:name="day.concat(idx,'1')" />
                    <x-input x-bind:id="day.concat(idx,'2')" value="12:30" class=" ml-1" type="time" x-bind:name="day.concat(idx,'2')" />
                </div>
            </div>
        </template>
    </div>
</div>

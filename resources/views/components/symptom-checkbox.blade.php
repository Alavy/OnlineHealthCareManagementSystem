@props(['id','value'])
<div class="mt-6">
    <input x-on:click="show = !show" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="{{$id}}"type="checkbox" name="{{$id}}" value="{{$value}}">
    <label class="ml-2 font-medium text-sm text-gray-700" for="{{$id}}">
        {{$value}}
    </label>
</div>

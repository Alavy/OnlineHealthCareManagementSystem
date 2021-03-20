@props(['option'=>[],'value'=>""])
<select {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}>
    @foreach ($option as $item)
    @if ($value == $item)
        <option value="{{$item}}" selected>{{$item}}</option>
    @else
    <option value="{{$item}}">{{$item}}</option>
    @endif
        
    @endforeach
</select>
<x-doctor-dashboard>
    @isset($diseases)

    <div class="mt-6 w-full">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg">
                <div class="min-w-full mt-6">
                    <div class="bg-white">
                        @foreach ($diseases as $item)
                        <h1 class="mt-20"><b> {{ $loop->index + 1 }}.Disease informations </b>  </h1>
                        <ul>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Disease's Name : {{$item->disease_name}}</td>
                            <li class="px-6 py-4  border-b text-blue-900 border-gray-500">Disease's Symtoms : {{$item->symptoms}}</td>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">
                                Suggested Doctor’s Information : 
                                <b>{{$item->doctor_name}}</b><br>
                                {{$item->designation}}<hr>
                                {{$item->specialist}}
                            </li>
                        </ul>    
                        @endforeach
                        </div>
                </div>   
            </div>
        </div>
    </div>
    @endisset
</x-doctor-dashboard>
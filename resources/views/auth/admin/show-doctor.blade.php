<x-admin-dashboard>
    <div class="mt-6 w-full">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg">
                <div class="flex-auto py-10">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="POST" action="{{ route('admin.show.doctor') }}">
                                @csrf
                    
                                <div class="mt-4">
                                    
                                    <x-label for="searchDoctor" :value="__('Search Doctor')" />
                    
                                    <div id="searchDoctor" class="w-full flex justify-between">
                                        <x-input class="block mt-1 flex-auto w-2/3"
                                                    type="text"
                                                    name="searchDoctor" :value="old('searchDoctor')" required />
                                        <button type="submit" class="flex-auto w-1/3">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </form> 
                </div>
                @isset($doctors)
                <div class="min-w-full mt-6">
                    <div class="bg-white">
                        @foreach ($doctors as $item)
                        <h1 class="mt-20"><b> {{ $loop->index + 1 }}.Doctor's informations </b>  </h1>
                        <ul>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="text-sm leading-5 text-blue-900">Fullname : {{$item->name}}</div>
                            </li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Email : {{$item->email}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Phone : {{$item->mobileNumber}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Specialist : {{$item->specialist}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Hospital : {{$item->hospital}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Degree : {{$item->degree}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Designation : {{$item->designation}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Fee : {{$item->fee}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Address : {{$item->address}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">
                                Shedules : 
                                <ul>
                                    @foreach (json_decode($item->weeklyInspec,true) as $key=>$data)
                                        <li>{{$key}} :
                                            <ol>
                                                @foreach ($data as $time)
                                                    <li> {{$time[0]}} To {{$time[1]}}</li>                                   
                                                @endforeach
                                            </ol>
                                        </li>
                                    @endforeach
                                    
                                </ul>
                            </li>
                            </ul>    
                        @endforeach
                        </div>
                    </div>   
                @endisset
            </div>
        </div>
    </div>
</x-admin-dashboard>
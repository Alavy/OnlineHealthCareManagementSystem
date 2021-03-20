<x-admin-dashboard>
    <div class="mt-6 w-full">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg">
                <div class="flex-auto py-10">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="POST" action="{{ route('admin.show.patient') }}">
                                @csrf
                    
                                <div class="mt-4">
                                    
                                    <x-label for="searchPatient" :value="__('Search Patient')" />
                    
                                    <div id="searchPatient" class="w-full flex justify-between">
                                        <x-input class="block mt-1 flex-auto w-2/3"
                                                    type="text"
                                                    name="searchPatient" :value="old('searchPatient')" required />
                                        <button type="submit" class="flex-auto w-1/3">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </form> 
                </div>
                @isset($patients)
                <div class="min-w-full mt-6">
                    <div class="bg-white">
                        @foreach ($patients as $item)
                        <h1 class="mt-20"><b> {{ $loop->index + 1 }}.Patient's informations</b>  </h1>

                        <ul>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="text-sm leading-5 text-blue-900">Fullname : {{$item->name}}</div>
                            </li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Email : {{$item->email}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Phone : {{$item->mobileNumber}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Date Of Birth : {{$item->dateOfBirth}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Sex : {{$item->sex}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Marital Status : {{$item->maritalStatus}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">BloodGroup : {{$item->bloodGroup}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Address : {{$item->address}}</li>
                        </ul>    
                        @endforeach
                    </div>
                </div>   
                @endisset
            </div>
        </div>
    </div>
</x-admin-dashboard>
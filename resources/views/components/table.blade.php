@props(['data'=>[]])
<div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
    <div class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg">
        <div>
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('patient.search.doctor') }}">
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
        @empty($data)
        <table class="min-w-full mt-6">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Fullname</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Email</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Phone</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Specialist</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Degree</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Designation</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Fee</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Address</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($data as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                        <div class="text-sm leading-5 text-blue-900">{{$item->name}}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">{{$item->email}}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">{{$item->mobileNumber}}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">{{$item->specialist}}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">{{$item->degree}}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">{{$item->designation}}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">{{$item->fee}}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">{{$item->address}}</td>

                    <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                        <button class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">Create Appointment</button>
                    </td>
                    </tr>    
                @endforeach
            </tbody>
        </table> 
        @endempty
    </div>
</div>
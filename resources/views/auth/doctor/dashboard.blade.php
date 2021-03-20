<x-doctor-dashboard>
    @isset($doctor)
                <div class="min-w-full">
                    <div class="bg-white p-12">
                        <h1 class="font-bold">Doctor's informations</h1>
                        <ul>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="text-sm leading-5 text-blue-900">Fullname : {{$doctor->name}}</div>
                            </li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Email : {{$doctor->email}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Phone : {{$doctor->mobileNumber}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Specialist : {{$doctor->specialist}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Hospital : {{$doctor->hospital}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Degree : {{$doctor->degree}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Designation : {{$doctor->designation}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Fee : {{$doctor->fee}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">Address : {{$doctor->address}}</li>
                            <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">
                                Shedules : 
                                <ul>
                                    @foreach (json_decode($doctor->weeklyInspec,true) as $key=>$data)
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
                        </div>
                    </div>   
                @endisset
</x-doctor-dashboard>
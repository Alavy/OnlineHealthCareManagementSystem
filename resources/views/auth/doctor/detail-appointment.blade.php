<x-doctor-dashboard>

    <h2 class="mt-10">Patient's Bio</h2>

    <div class="mt-6 w-full">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg">
                @isset($patient)
                    <ul>
                        <li>Name : {{$patient->name}}</li>
                        <li>Email : {{$patient->email}}</li>
                        <li>Phone Number : {{$patient->mobileNumber}}</li>
                        <li>Date Of Birth : {{$patient->dateOfBirth}}</li>
                        <li>Sex : {{$patient->sex}}</li>
                        <li>Marital Status : {{$patient->maritalStatus}}</li>
                        <li>Blood Group : {{$patient->bloodGroup}}</li>
                        <li>Address : {{$patient->address}}</li>
                    </ul>
                @endisset
            </div>
        </div>
    </div>
    

    <h2 class="mt-10">Patient's Appointment History</h2>
    <div class="mt-6 w-full">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg">
                @isset($appoinments)
                <table class="min-w-full mt-6">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Index</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Appointment Date</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Fee</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($appoinments as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">{{$loop->index + 1}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">{{$item->date}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">{{$item->fee}}</td>
                            </tr>    
                        @endforeach
                    </tbody>
                </table>   
                @endisset
            </div>
        </div>
    </div>

    <h2 class="mt-10">Patient's  Prescriptions </h2>
    <div class="mt-6 w-full">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg">
                @isset($prescriptions)
                <table class="min-w-full mt-6">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider"></th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Prescription</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($prescriptions as $it)
                        <tr>
                            <td class="px-6 py-4 flex flex-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Uploaded Date {{$it->date}}</td>
                            <td class="px-6 py-4 flex flex-wrap justify-center">
                                <img src="{{ asset('storage/prescription/'.$it->path)}}" alt="..." class="shadow rounded max-w-full h-auto align-middle border-none" />
                            </td>
                            </tr>    
                        @endforeach
                    </tbody>
                </table>   
                @endisset
            </div>
        </div>
    </div>
    
    
</x-doctor-dashboard>
<x-patient-dashboard>
    @isset($prescriptions)

    <div class="mt-6 w-full">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg">
                <table class="min-w-full mt-6">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider"></th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Prescription</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($prescriptions as $item)
                        <tr>
                            <td class="px-6 py-4 flex flex-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Uploaded Date {{$item->date}}</td>
                            <td class="px-6 py-4 flex flex-wrap justify-center">
                                <img src="{{ asset('storage/prescription/'.$item->path)}}" alt="..." class="shadow rounded max-w-full h-auto align-middle border-none" />
                            </td>
                            </tr>    
                        @endforeach
                    </tbody>
                </table>   
            </div>
        </div>
    </div>
    @endisset

</x-patient-dashboard>
<x-patient-dashboard>
    @isset($patient)
        <div class="min-w-full">
            <div class="bg-white p-12">
                <h2 class="font-bold">Patient's Bio</h2>
                <ul>
                    <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Name : {{ $patient->name }}</li>
                    <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Email : {{ $patient->email }}</li>
                    <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Phone Number : {{ $patient->mobileNumber }}</li>
                    <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Date Of Birth : {{ $patient->dateOfBirth }}</li>
                    <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Sex : {{ $patient->sex }}</li>
                    <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Marital Status : {{ $patient->maritalStatus }}</li>
                    <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Blood Group : {{ $patient->bloodGroup }}</li>
                    <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Address : {{ $patient->address }}</li>
                </ul>
            </div>
        </div>
    @endisset
</x-patient-dashboard>

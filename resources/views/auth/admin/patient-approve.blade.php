<x-admin-dashboard>
    @isset($patients)
    <div class="mt-6 w-full">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg">
                <div class="min-w-full mt-6">
                    <div class="bg-white" 
                            x-data="{{ json_encode(['patients' => $patients]) }}"
                            x-init="
                            Echo.private('patient-register')
                                .listen('PatientRegisterEvent', (patient) => {
                                    patients.push(patient);
                                });
                            ">
                            <template x-if="patients.length > 0">
                                <template x-for="patient in patients" :key="patient.id">
                                    
                                    <ul>
                                        <li x-text="'Name : '+patient.name" class="px-6 py-4 flex flex-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"></li>
                                        <li x-text="'Email : '+patient.email" class="px-6 py-4 flex flex-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"></li>
                                        <li x-text="'Date Of Birth : '+patient.dateOfBirth" class="px-6 py-4 flex flex-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"></li>
                                        <li x-text="'Sex : '+patient.sex" class="px-6 py-4 flex flex-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"></li>
                                        <li x-text="'Marital Status : '+patient.maritalStatus" class="px-6 py-4 flex flex-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"></li>
                                        <li x-text="'Blood Group : '+patient.bloodGroup" class="px-6 py-4 flex flex-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"></li>
                                        <li x-text="'Address : '+patient.address" class="px-6 py-4 flex flex-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"></li>
                                        <li x-text="'Mobile Number : '+patient.mobileNumber" class="px-6 py-4 flex flex-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"></li>

                                        <li class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                            <form action="{{ route('admin.patient.approve') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="user_id" x-bind:value="patient.id">
                                                <button type="submit" class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                                    accept
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </template>
                            </template>    
                    </div>
                </div>   
            </div>
        </div>
    </div>
    @endisset
</x-admin-dashboard>
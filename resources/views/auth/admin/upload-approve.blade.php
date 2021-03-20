<x-admin-dashboard>
    @isset($prescriptions)
    <div class="mt-6 w-full">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow shadow-dashboard overflow-hidden bg-white  px-8 pt-3 rounded-bl-lg rounded-br-lg">
                <div class="min-w-full mt-6">
                    <div class="bg-white" 
                            x-data="{{ json_encode(['prescriptions' => $prescriptions]) }}"
                            x-init="
                            Echo.private('prescription-upload')
                                .listen('PrescriptionUploadEvent', (prescription) => {
                                    prescriptions.push(prescription);
                                });
                            ">
                            <template x-if="prescriptions.length > 0">
                                <template x-for="prescription in prescriptions" :key="prescription.id">
                                    <ul>
                                        <li x-text="prescription.upload_date" class="px-6 py-4 flex flex-wrap border-b text-blue-900 border-gray-500 text-sm leading-5"></li>
                                        <li class="px-6 py-4 flex flex-wrap justify-center">
                                            Prescription or Report image
                                            <img x-bind:src="'{{ asset('storage/prescription/')}}/'+prescription.path" alt="..." class="shadow rounded max-w-full h-auto align-middle border-none" />
                                        </li>
                                        <li class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                            <form action="{{ route('admin.upload.approve') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="prescription_id" x-bind:value="prescription.id">
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
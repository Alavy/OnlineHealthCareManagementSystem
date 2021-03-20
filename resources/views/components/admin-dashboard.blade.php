<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="md:grid md:grid-cols-4 justify-center py-12">

        <div class="flex md:col-span-2 lg:col-span-1 h-auto sm:px-6 lg:px-8">
            <div class="bg-white w-full h-full overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col justify-center items-start p-6 bg-white">
                    <div class="flex justify-center">
                        <span class="text-blue-600 inline-block"><i class="fa fa-bars fa-3x" aria-hidden="true"></i>
                        </span>
                        <x-nav-link class="ml-6" :href="route('admin.edit')" :active="request()->routeIs('admin.edit')">
                            {{ __('Update Profile') }}
                        </x-nav-link>
                    </div>
                    
                    <div class="flex justify-center mt-6">
                        <span class="text-blue-600 inline-block"><i class="fa fa-user fa-3x" aria-hidden="true"></i>
                        </span>
                        <x-nav-link class="ml-6" :href="route('register.admin')" :active="request()->routeIs('register.admin')">
                            {{ __('Register Admin') }}
                        </x-nav-link>
                    </div>
                    
                    <div class="flex justify-center mt-6">
                        <span class="text-blue-600 inline-block"><i class="fa fa-user-md fa-3x" aria-hidden="true"></i>
                        </span>
                        <x-nav-link class="ml-6" :href="route('register.doctor')" :active="request()->routeIs('register.doctor')">
                            {{ __('Register Doctor') }}
                        </x-nav-link>
                    </div>
                    
                    <div class="flex justify-center mt-6">
                        <span class="text-blue-600 inline-block"><i class="fa fa-search fa-3x" aria-hidden="true"></i>
                        </span>
                        <x-nav-link class="ml-6" :href="route('admin.show.patient')" :active="request()->routeIs('admin.show.patient')">
                            {{ __('Search Patient') }}
                        </x-nav-link>
                    </div>
                    
                    <div class="flex justify-center mt-6">
                        <span class="text-blue-600 inline-block"><i class="fa fa-search fa-3x" aria-hidden="true"></i></span>
                        <x-nav-link class="ml-6" :href="route('admin.show.doctor')" :active="request()->routeIs('admin.show.doctor')">
                            {{ __('Search Doctor') }}
                        </x-nav-link>
                    </div>

                    <div class="flex justify-center mt-6"
                    x-data="{noti_count:0}"
                    x-init="
                            axios.get('{{route('admin.patient.data')}}')
                                .then((response) => {
                                    noti_count=response.data;
                            });
                            Echo.private('patient-register')
                                .listen('PatientRegisterEvent', (patient) => {
                                    noti_count++;
                                });
                            "
                    >
                        <span class="text-blue-600 inline-block relative">
                            <i class="fas fa-bell fa-3x"></i>
                            <div class="rounded-full h-8 w-8 bg-red-600 absolute top-0 left-5">
                                <span class="text-gray-200 pl-2 p-1" x-text="noti_count"></span>
                            </div>
                        </span>
                        <x-nav-link class="ml-6" :href="route('admin.patient.approve')" :active="request()->routeIs('admin.patient.approve')">
                            {{ __('Approve Patient Request') }}
                        </x-nav-link>
                    </div>
                    
                    <div class="flex justify-center mt-6"
                    x-data="{noti_count:0}"
                    x-init="
                            axios.get('{{route('admin.upload.data')}}')
                                .then((response) => {
                                    noti_count=response.data;
                            });
                            Echo.private('prescription-upload')
                                .listen('PrescriptionUploadEvent', (prescription) => {
                                    noti_count++;
                                });
                            "
                    >
                        <span class="text-blue-600 inline-block relative">
                            <i class="fas fa-bell fa-3x"></i>
                            <div class="rounded-full h-8 w-8 bg-red-600 absolute top-0 left-5">
                                <span class="text-gray-200 pl-2 p-1" x-text="noti_count"></span>
                            </div>
                        </span>
                        <x-nav-link class="ml-6" :href="route('admin.upload.approve')" :active="request()->routeIs('admin.upload.approve')">
                            {{ __('Approve Upload  Request') }}
                        </x-nav-link>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="flex-auto md:col-span-2 lg:col-span-3 sm:px-6 lg:px-8">
            {{$slot}}
        </div>
    </div>
</x-app-layout>

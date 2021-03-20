<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patient Dashboard') }}
        </h2>
    </x-slot>

    <div class="md:grid md:grid-cols-4 justify-center py-12">

        <div class="flex md:col-span-2 lg:col-span-1 h-auto sm:px-6 lg:px-8">
            <div class="bg-white w-full h-full overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col justify-center items-start p-6 bg-white">
                    <div class="flex justify-center">
                        <span class="text-blue-600 inline-block"><i class="fa fa-stethoscope fa-3x" aria-hidden="true"></i>
                        </span>
                        <x-nav-link class="ml-6" :href="route('patient.check.disease')" :active="request()->routeIs('patient.check.disease')">
                            {{ __('Identify Disease') }}
                        </x-nav-link>
                    </div>
                    
                    <div class="flex justify-center  mt-6">
                        <span class="text-blue-600 inline-block"><i class="fa fa-search fa-3x" aria-hidden="true"></i></span>
                        <x-nav-link class="ml-6" :href="route('patient.search.doctor')" :active="request()->routeIs('patient.search.doctor')">
                            {{ __('Search Doctor') }}
                        </x-nav-link>
                    </div>
                    
                    <div class="flex justify-center  mt-6">
                        <span class="text-blue-600 inline-block"><i class="fa fa-address-book fa-3x"></i></span>
                        <x-nav-link class="ml-6" :href="route('patient.show.appointment')" :active="request()->routeIs('patient.show.appointment')">
                            {{ __('Show My Appointments') }}
                        </x-nav-link>
                    </div>
                    
                    <div class="flex justify-center  mt-6">
                        <span class="text-blue-600 inline-block"><i class="fa fa-bars fa-3x" aria-hidden="true"></i></span>
                        <x-nav-link class="ml-6" :href="route('patient.edit')" :active="request()->routeIs('patient.edit')">
                            {{ __('Update My Profile') }}
                        </x-nav-link>
                    </div>
                    
                    <div class="flex justify-center  mt-6">
                        <span class="text-blue-600 inline-block"><i class="fa fa-upload fa-3x" aria-hidden="true"></i>
                        </span>
                        <x-nav-link class="ml-6" :href="route('patient.upload.prescription')" :active="request()->routeIs('patient.upload.prescription')">
                            {{ __('Upload Prescription And Report') }}
                        </x-nav-link>
                    </div>
                    
                    <div class="flex justify-center  mt-6">
                        <span class="text-blue-600 inline-block"><i class="fa fa-print fa-3x" aria-hidden="true"></i>
                        </i>
                        </span>
                        <x-nav-link class="ml-6" :href="route('patient.show.prescription')" :active="request()->routeIs('patient.show.prescription')">
                            {{ __('Show My Prescription And Report') }}
                        </x-nav-link>
                    </div>
                    
                    <div class="flex justify-center  mt-6">
                        <span class="text-blue-600 inline-block"><i class="fa fa-eye fa-3x" aria-hidden="true"></i>
                        </span>
                        <x-nav-link class="ml-6" :href="route('patient.search.disease')" :active="request()->routeIs('patient.search.disease')">
                            {{ __('Search Disease') }}
                        </x-nav-link>
                    </div>
                    
                    <div class="flex justify-center  mt-6">
                        <span class="text-blue-600 inline-block"><i class="fa fa-comments fa-3x" aria-hidden="true"></i></span>
                        <x-nav-link class="ml-6" :href="route('patient.chat.list')" :active="request()->routeIs('patient.chat.list')">
                            {{ __('Chat list') }}
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

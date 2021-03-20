<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Doctor Dashboard') }}
        </h2>
    </x-slot>

    <div class="md:grid md:grid-cols-4 justify-center py-12">

        <div class="flex md:col-span-2 lg:col-span-1 h-auto sm:px-6 lg:px-8">
            <div class="bg-white w-full h-full overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col justify-center items-start p-6 bg-white">
                    <div class="flex justify-center">
                        <span class="text-blue-600 inline-block"><i class="fa fa-address-book fa-3x"></i></span>
                        <x-nav-link class="ml-6" :href="route('doctor.show.appointment')" :active="request()->routeIs('doctor.show.appointment')">
                            {{ __('Show My Appointment') }}
                        </x-nav-link>
                    </div>
                    <div class="flex justify-center mt-6">
                        <span class="text-blue-600 inline-block"><i class="fa fa-bars fa-3x" aria-hidden="true"></i>
                        </span>
                        <x-nav-link class="ml-6" :href="route('doctor.edit')" :active="request()->routeIs('doctor.edit')">
                            {{ __('Update Profile') }}
                        </x-nav-link>
                    </div>
                    <div class="flex justify-center mt-6">
                        <span class="text-blue-600"><i class="fa fa-user-md fa-3x" aria-hidden="true"></i></span>
                        <x-nav-link class="ml-6" :href="route('doctor.create.disease')" :active="request()->routeIs('doctor.create.disease')">
                            {{ __('Create Disease') }}
                        </x-nav-link>
                    </div>
                   <div class="flex justify-center mt-6">
                       <span class="text-blue-600"><i class="fa fa-book fa-3x" aria-hidden="true"></i>
                       </span>
                       <x-nav-link class="ml-6" :href="route('doctor.show.disease')" :active="request()->routeIs('doctor.show.disease')">
                        {{ __('Show Disease') }}
                    </x-nav-link>
                   </div>
                    <div class="flex justify-center mt-6">
                        <span class="text-blue-600"><i class="fa fa-comments fa-3x" aria-hidden="true"></i>
                        </span>
                        <x-nav-link class="ml-6" :href="route('doctor.chat.list')" :active="request()->routeIs('doctor.chat.list')">
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

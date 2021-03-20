<x-patient-dashboard>
    @isset($patient)

    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('patient.edit') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$patient->name" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$patient->email" required />
            </div>

            <div class="mt-4">
                <x-label for="dateOfBirth" :value="__('Date Of Birth')" />

                <x-input id="dateOfBirth" class="block mt-1 w-full"
                                type="date"
                                name="dateOfBirth" value="{{$patient->dateOfBirth}}" required />
            </div>

            <div class="mt-4">
                <x-label for="sex" :value="__('Sex')" />

                <x-select id="sex" class="block mt-1 w-full"
                                name="sex" :value="$patient->sex" :option="['Male','Female']" required />
            </div>

            <div class="mt-4">
                <x-label for="maritalStatus" :value="__('Marital Status')" />

                <x-select id="maritalStatus" class="block mt-1 w-full"
                                name="maritalStatus" :value="$patient->maritalStatus" :option="['Married','UnMarried']" required />
            </div>

            <div class="mt-4">
                <x-label for="bloodGroup" :value="__('Blood Group')" />

                <x-select id="bloodGroup" class="block mt-1 w-full"
                                name="bloodGroup" :value="$patient->bloodGroup" :option="['A+','B+','AB+','A+','O+','O-','AB-','A-','B-']" required />
            </div>

            <div class="mt-4">
                <x-label for="address" :value="__('Address')" />
                <x-textarea id="address" class="block mt-1 w-full"
                                rows="3" cols="4"
                                name="address" :value="$patient->address" required />
            </div>

            <div class="mt-4">
                <x-label for="mobileNumber" :value="__('Mobile Number')" />

                <x-input id="mobileNumber" class="block mt-1 w-full"
                                type="tel" placeholder="+8801761572186"
                                name="mobileNumber" value="{{$patient->mobileNumber}}" required />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    {{ __('Update Profile') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
        
    @endisset
</x-patient-dashboard>

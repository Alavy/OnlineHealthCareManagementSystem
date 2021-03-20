<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register.patient') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="mt-4">
                <x-label for="dateOfBirth" :value="__('Date Of Birth')" />

                <x-input id="dateOfBirth" class="block mt-1 w-full"
                                type="date"
                                name="dateOfBirth" required />
            </div>

            <div class="mt-4">
                <x-label for="sex" :value="__('Sex')" />

                <x-select id="sex" class="block mt-1 w-full"
                                name="sex" :option="['Male','Female']" required />
            </div>

            <div class="mt-4">
                <x-label for="maritalStatus" :value="__('Marital Status')" />

                <x-select id="maritalStatus" class="block mt-1 w-full"
                                name="maritalStatus" :option="['Married','UnMarried']" required />
            </div>

            <div class="mt-4">
                <x-label for="bloodGroup" :value="__('Blood Group')" />

                <x-select id="bloodGroup" class="block mt-1 w-full"
                                name="bloodGroup" :option="['A+','B+','AB+','A+','O+','O-','AB-','A-','B-']" required />
            </div>

            <div class="mt-4">
                <x-label for="address" :value="__('Address')" />
                <x-textarea id="address" class="block mt-1 w-full"
                                rows="3" cols="4"
                                name="address" required />
            </div>

            <div class="mt-4">
                <x-label for="mobileNumber" :value="__('Mobile Number')" />

                <x-input id="mobileNumber" class="block mt-1 w-full"
                                type="tel" placeholder="+8801761572186"
                                name="mobileNumber" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

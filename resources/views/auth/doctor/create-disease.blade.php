<x-doctor-dashboard>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('doctor.create.disease') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="symptoms" :value="__('Symptoms')" />
                <x-textarea :value="'1.Severe fever from 2 or more weeks 2.Severe  headache'" id="symptoms"
                                 class="block mt-1 w-full"
                                rows="3" cols="4"
                                name="symptoms" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('dashboard') }}">
                    {{ __('Cancel') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Create Disease') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-doctor-dashboard>
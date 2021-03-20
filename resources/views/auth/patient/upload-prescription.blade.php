<x-patient-dashboard>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('patient.upload.prescription') }}" enctype="multipart/form-data">
            @csrf

            <div class="mt-4">
                <x-label for="prescription_file" :value="__('Choose Prescription Photo')" />
                <x-input type="file" name="prescription_file"  required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('dashboard') }}">
                    {{ __('Cancel') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Upload Prescription') }}
                </x-button>
            </div>
        </form>

    </x-auth-card>
</x-patient-dashboard>
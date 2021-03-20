<x-doctor-dashboard>
    @isset($doctor)
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('doctor.edit') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$doctor->name" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$doctor->email" required />
            </div>

            <div>
                <x-label for="averageConsultancyFee" :value="__('Average Consultancy Fee')" />

                <x-input id="averageConsultancyFee" class="block mt-1 w-full" 
                        type="number" name="averageConsultancyFee"
                         :value="$doctor->fee" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="academicDegree" :value="__('Academic Degree')" />
                <x-textarea id="academicDegree" class="block mt-1 w-full"
                                rows="3" cols="4" :value="$doctor->degree"
                                name="academicDegree" required />
            </div>

            <div>
                <x-label for="designation" :value="__('Designation')" />

                <x-input id="designation" class="block mt-1 w-full" 
                        type="text" name="designation"
                         :value="$doctor->designation" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="diseaseSpecialist" :value="__('Disease Specialist')" />
                <x-textarea id="diseaseSpecialist" class="block mt-1 w-full"
                                rows="3" cols="4" :value="$doctor->specialist"
                                name="diseaseSpecialist" required />
            </div>
            <div class="mt-4">
                <x-label for="hospital" :value="__('Associated Hospital')" />
                <x-textarea id="hospital" class="block mt-1 w-full"
                                rows="3" cols="4" :value="$doctor->hospital"
                                name="hospital" required />
            </div>

            <div class="mt-4">
                <x-label for="address" :value="__('Address')" />
                <x-textarea id="address" class="block mt-1 w-full"
                                rows="3" cols="4"
                                name="address" :value="$doctor->address" required />
            </div>

            <div class="mt-4">
                <x-label for="mobileNumber" :value="__('Mobile Number')" />

                <x-input id="mobileNumber" class="block mt-1 w-full"
                                type="tel" :value="$doctor->mobileNumber"
                                name="mobileNumber" required />
            </div>

            <div class="mt-4">
                <x-label for="workday" :value="__('Working Days')" />
                <div class="mt-4" id="workday">
                    <x-checkbox-label :id="'sat'" :data="__('Saturday')"/>
                    <x-checkbox-label :id="'sun'" :data="__('Sunday')"/>
                    <x-checkbox-label :id="'mon'" :data="__('Monday')"/>
                    <x-checkbox-label :id="'tue'" :data="__('Tuesday')"/>
                    <x-checkbox-label :id="'wed'" :data="__('Wednesday')"/>
                    <x-checkbox-label :id="'thr'" :data="__('Thursday')"/>
                    <x-checkbox-label :id="'fri'" :data="__('Friday')"/>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Update Doctor Profile') }}
                </x-button>
            </div>
        </form>
    </x-auth-card> 
    @endisset
</x-doctor-dashboard>
<x-patient-dashboard>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form x-data="{week:{{$week}},numToweek:{0:'sun',1:'mon',2:'tue',3:'wed',4:'thr',5:'fri',6:'sat'},current:'',show:false}" method="POST" action="{{ route('patient.create.appointment') }}">
            @csrf

            <script>
                function dateToDay(date) {
                    temp = new Date(date).getDay();
                    return temp;
                }
            </script>

            <div class="mt-4">
                <x-label for="appointmentDate" :value="__('Pick Appointment Date')" />

                <x-input x-on:input="current=numToweek[dateToDay(String(document.getElementById('appointmentDate').value))];show=week.hasOwnProperty(current);" id="appointmentDate" class="block mt-1 w-full"
                                type="date"
                                name="appointmentDate" value="{{ date('Y-m-d') }}" required />
            </div>
            
            <template class="m-8" x-if="show">
                <x-label for="appointmentTime" :value="__('Pick Time Period')" />
                <select name="appointmentTime" id="appointmentTime" class='rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50' required>
                    <template x-for="idx in week[current]" :key="idx">
                        <option x-bind:value="idx[0]" x-text="String(idx[0]).concat(' To ',String(idx[1]))"></option>
                    </template>
                </select>
            </template>
            <input type="hidden" name="doctor_id" value="{{$doctor_id}}">
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('dashboard') }}">
                    {{ __('Cancel') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Create Appoinment') }}
                </x-button>
            </div>
        </form>

    </x-auth-card>
</x-patient-dashboard>
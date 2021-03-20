<x-patient-dashboard>
    @if (!isset($diseases))
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        @isset($arr)
        <form method="POST" action="{{ route('patient.check.disease') }}">
            @csrf

            <div class="mt-4">
                <h2> select symptoms</h2>
                @foreach ($arr as $it)
                <div class="mt-4" id="symptoms">
                    <x-symptom-checkbox :id="'sym_'.$loop->index" :value="$it" >
                    </x-symptom-checkbox>
                </div>
                @endforeach
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Go') }}
                </x-button>
            </div>
        </form>
        @endisset

    </x-auth-card>
    @else

    <div class="min-w-full mt-6">
        <div class="bg-white">
            @foreach ($diseases as $item)
            <h1 class="mt-20"><b> {{ $loop->index + 1 }}.Disease informations </b>  </h1>
            <ul>
                <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Disease's Name : {{$item->disease_name}}</td>
                <li class="px-6 py-4  border-b text-blue-900 border-gray-500">Disease's Symtoms : {{$item->symptoms}}</td>
                <li class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">
                    Suggested Doctor’s Information : <br>
                    <b class="mt-4">{{$item->doctor_name}}</b><br>
                    {{$item->designation}}<hr>
                    {{$item->specialist}}
                </li>
                <div class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                    <button class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                        <a href="{{route('patient.create.appointment').'/'.$item->id}}">Create Appointment</a>
                    </button>
                </div>
            </ul>    
            @endforeach
            </div>
        </div>    
        
    @endif
    
</x-patient-dashboard>
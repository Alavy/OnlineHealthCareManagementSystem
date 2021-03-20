<x-patient-dashboard>
    @isset($messages)
        <div class="mt-4 bg-white rounded-lg shadow-md p-6"
            x-data="{{ json_encode(['messages' => $messages, 'messageBody' => '','doctor_id'=> $doctor_id,'own_user_id' => $own_user_id ]) }}"
            x-init="
            Echo.private('message.{{ $roomIdentity }}')
                .listen('MessageEvent', (message) => {
                    messages.push(message);
                });
            ">
            <h2 class="flex justify-center items-center">
                Doctor's Name : {{$name}}
            </h2>
            <template x-if="messages.length > 0">
                <template x-for="message in messages" :key="message.id">
                    <div class="overflow-auto px-1 py-1">
                        <template x-if="message.owner_user_id == own_user_id">
                            <div class="flex items-center pr-10">
                                <span x-text="message.body"
                                    class="flex ml-1 h-auto bg-gray-900 text-gray-200 text-xs font-normal rounded-sm px-1 p-1 items-end"
                                    style="font-size: 10px;">
                                    
                                </span>
                                <span x-text="message.sendTime" class="text-gray-400 pl-1"
                                        style="font-size: 8px;">
                                </span>
                            </div>
                        </template>
                        <template x-if="message.owner_user_id != own_user_id">
                            <div class="flex justify-end pt-2 pl-10">
                                <span x-text="message.body"
                                    class="bg-green-900 h-auto text-gray-200 text-xs font-normal rounded-sm px-1 p-1 items-end flex justify-end "
                                    style="font-size: 10px;">
                                    
                                </span><br>
                                <span x-text="message.sendTime" class="text-gray-400 pl-1"
                                        style="font-size: 8px;">
                                </span>
                            </div>
                        </template>
                    </div>
                </template>
            </template>
            <div class="flex justify-start items-center p-1 ">
                <div class="relative">
                    <input
                        x-on:keydown.enter="sendMessage('{{ route('patient.chat.post') }}','{{ csrf_token() }}',messages, messageBody,doctor_id);messageBody = '';  "
                        x-model="messageBody"
                        class="rounded-full pl-6 pr-12 py-2 focus:outline-none h-auto placeholder-gray-100 bg-gray-900 text-white"
                        style="font-size: 11px;width: 250px;" type="text" placeholder="Type a message..."
                        id="typemsg">
                </div>
                <div class="w-7 h-7 ml-2 rounded-full bg-blue-300 text-center items-center flex justify-center">
                    <button
                        class="w-7 h-7 rounded-full text-center items-center flex justify-center focus:outline-none hover:bg-gray-900 hover:text-white"
                        x-on:click="sendMessage('{{ route('patient.chat.post') }}','{{ csrf_token() }}',messages,messageBody,doctor_id);messageBody = '';">
                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    </button>
                </div>
            </div>  
        </div>
    @endisset
</x-patient-dashboard>

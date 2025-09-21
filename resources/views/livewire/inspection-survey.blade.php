<div x-data="{
    hasFlutterChannel: false,
    uploadImages(recordId, recordItemId) {
        const message = { record_id: recordId, action: 'upload' };
        if (window.FlutterChannel && FlutterChannel.postMessage) {
            FlutterChannel.postMessage(JSON.stringify(message));
        }
    }
}" x-init="hasFlutterChannel = !!(window.FlutterChannel && FlutterChannel.postMessage)">

    {{-- Starting  --}}
    <div class="md:p-4 max-w-3xl mx-auto relative">
        <div class="absolute cursor-text top-0 right-2 text-xs mt-1">{{ $this->draftMessage }}</div>
        <div class="mt-2 space-y-2 md:space-y-6">
            @foreach (collect($questions)->groupBy(fn($q) => $q['task']['name']) as $taskName => $taskQuestions)
                <x-ts-card minimize>
                    <x-slot:header>
                        <div class="flex items-center justify-between p-4 text-secondary-700 dark:text-dark-300 dark:border-b-dark-600 border-b border-gray-100"
                            x-bind:class="{ 'dark:border-b-dark-600 border-b border-gray-100': !minimize }">
                            <div class="text-xl font-semibold text-amber-600">
                                {{ $loop->iteration }}. {{ $taskName }}
                            </div>
                            <div>
                                <button type="button" class="cursor-pointer" x-on:click="minimize = !minimize"
                                    dusk="tallstackui_card_minimize">

                                    <svg class="w-6 h-6" x-show="!minimize" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M4.25 12a.75.75 0 0 1 .75-.75h14a.75.75 0 0 1 0 1.5H5a.75.75 0 0 1-.75-.75Z"
                                            clip-rule="evenodd"></path>
                                    </svg>

                                    <svg class="w-6 h-6" x-show="minimize" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon"
                                        style="display: none;">
                                        <path fill-rule="evenodd"
                                            d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                                            clip-rule="evenodd"></path>
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </x-slot:header>
                    <div class="space-y-3 px-3">
                        @foreach ($taskQuestions as $q)
                            <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                                <h3 class="text-lg font-medium text-gray-700 mb-3">
                                    {{ $loop->iteration }}. {{ $q['name'] }}
                                </h3>

                                <div class="space-y-3">
                                    <div class="flex items-center space-x-6">
                                        @foreach ($answerOptions as $ao)
                                            <x-ts-radio
                                                wire:model.live.debounce.450ms="items.{{ $q['id'] }}.answer_id"
                                                name="q{{ $q['id'] }}"
                                                id="q{{ $q['id'] }}_{{ $ao['id'] }}" color="amber"
                                                label="{{ $ao['name'] }}" value="{{ $ao['id'] }}" />
                                        @endforeach
                                    </div>

                                    <div class="flex gap-2" x-show="hasFlutterChannel" x-cloak>
                                        @if (!empty($items[$q['id']]['images']))
                                            @foreach ($items[$q['id']]['images'] as $img)
                                                <div class="relative">
                                                    <img src="{{ $img['url'] }}"
                                                        class="w-16 h-16 object-cover rounded border" alt="Image">
                                                    <button wire:click="deleteImage({{ $img['id'] }})"
                                                        class="absolute top-0 right-0 bg-red-600 text-white text-xs px-1 rounded">x</button>
                                                </div>
                                            @endforeach
                                        @endif

                                        <div @click.stop="uploadImages({{ $q['id'] }})"
                                            class="flex items-center justify-center w-12 h-12 bg-gray-200 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-700">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 7.5h2.25L7.5 4.5h9l2.25 3H21a1.5 1.5 0 011.5 1.5v9A1.5 1.5 0 0121 19.5H3A1.5 1.5 0 011.5 18v-9A1.5 1.5 0 013 7.5zm9 9.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" />
                                            </svg>
                                        </div>
                                    </div>

                                    <details class="group" wire:ignore>
                                        <summary class="cursor-pointer text-sm text-gray-500 hover:text-gray-700">
                                            + Add Remark
                                        </summary>
                                        <textarea wire:model.blur="items.{{ $q['id'] }}.remarks" rows="3"
                                            class="mt-2 w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200"
                                            placeholder="Enter your remark here..."></textarea>
                                    </details>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-ts-card>
            @endforeach
            {{-- <div class="my-5 px-3">
                <x-ts-card minimize>
                    <x-slot:header>
                        <div class="flex items-center justify-between p-4 text-secondary-700 dark:text-dark-300 dark:border-b-dark-600 border-b border-gray-100"
                            x-bind:class="{ 'dark:border-b-dark-600 border-b border-gray-100': !minimize }">
                            <div class="text-xl font-semibold text-amber-600">
                                Compilances
                            </div>
                            <div>
                                <button type="button" class="cursor-pointer" x-on:click="minimize = !minimize"
                                    dusk="tallstackui_card_minimize">

                                    <svg class="w-6 h-6" x-show="!minimize" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M4.25 12a.75.75 0 0 1 .75-.75h14a.75.75 0 0 1 0 1.5H5a.75.75 0 0 1-.75-.75Z"
                                            clip-rule="evenodd"></path>
                                    </svg>

                                    <svg class="w-6 h-6" x-show="minimize" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon"
                                        style="display: none;">
                                        <path fill-rule="evenodd"
                                            d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                                            clip-rule="evenodd"></path>
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </x-slot:header>
                    <div class="space-y-3 px-3">
                        gfg
                    </div>
                </x-ts-card>
            </div> --}}
            <div class="mt-6">
                <x-ts-signature wire:model="signature" label="Signature of Candidate *" clearable />
            </div>
            <div class="my-3 md:my-1">
                <button type="button" wire:click="save"
                    class="w-full cursor-pointer py-3 px-4 rounded-md bg-amber-600 text-white font-medium shadow-sm hover:bg-amber-800 
               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-600 flex justify-center items-center space-x-2"
                    wire:loading.attr="disabled">

                    <svg wire:loading class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>

                    <span wire:loading.remove wire:target="save">Submit Inspection</span>
                    <span wire:loading wire:target="save">Submitting...</span>
                </button>
            </div>
        </div>
    </div>



    {{-- first design  --}}


    {{-- <div class="bg-white md:shadow-md rounded-lg p-2 md:p-4 border border-gray-200">
                <h2 class="text-xl font-semibold text-amber-600 mb-2">
                    {{ $task }}. Task Name
                </h2>

                <div class="space-y-3 px-3">
                    @for ($q = 1; $q < 6; $q++)
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                            <h3 class="text-lg font-medium text-gray-700 mb-3">
                                {{ $q }}. Inspection Question
                            </h3>

                            <div class="space-y-3">
                                <div class="flex items-center space-x-6">
                                    <x-ts-radio name="q{{ $task }}_{{ $q }}"
                                        id="q{{ $task }}_{{ $q }}_yes" color="amber"
                                        label="Yes" value="yes" />
                                    <x-ts-radio name="q{{ $task }}_{{ $q }}"
                                        id="q{{ $task }}_{{ $q }}_no" color="amber" label="No"
                                        value="no" />
                                    <x-ts-radio name="q{{ $task }}_{{ $q }}"
                                        id="q{{ $task }}_{{ $q }}_n/a" color="amber"
                                        label="N/A" value="n/a" />
                                </div>

                                <div class="flex gap-2" x-show="hasFlutterChannel" x-cloak>
                                    @if ($q == 1)
                                        @foreach ($tempImages as $image)
                                            <img src="data:image/jpeg;base64,{{ $image }}"
                                                class="w-12 h-12 object-cover" />
                                        @endforeach
                                    @endif
                                    <div @click.stop="uploadImages(5)"
                                        class="flex items-center justify-center w-12 h-12 bg-gray-200 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-700">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 7.5h2.25L7.5 4.5h9l2.25 3H21a1.5 1.5 0 011.5 1.5v9A1.5 1.5 0 0121 19.5H3A1.5 1.5 0 011.5 18v-9A1.5 1.5 0 013 7.5zm9 9.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" />
                                        </svg>
                                    </div>
                                </div>

                                <details class="group">
                                    <summary class="cursor-pointer text-sm text-gray-500 hover:text-gray-700">
                                        + Add Remark
                                    </summary>
                                    <textarea rows="3" class="mt-2 w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200"
                                        placeholder="Enter your remark here..."></textarea>
                                </details>
                            </div>
                        </div>
                    @endfor
                </div>
            </div> --}}



    {{-- Reference for Me  --}}
    {{-- <div id="message">Original Text</div>
    {{ auth()->user()->full_name }}
    @foreach ($tempImages as $image)
        <div> <img src="data:image/jpeg;base64,{{ $image }}" style="max-width: 200px; margin: 5px;" /></div>
    @endforeach
    <button x-show="hasFlutterChannel" x-cloak @click.stop="uploadImages(5)">
        Upload Photo
    </button> --}}



    {{-- Ending --}}
</div>
<script>
    document.addEventListener('livewire:init', () => {
        window.onFlutterMessage = function(data) {
            if (data.action === 'upload_completed') {
                Livewire.dispatchTo('inspection-survey', 'image-uploaded', data)
            }
        }
    })
</script>

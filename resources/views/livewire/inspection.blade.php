<div class="p-4 max-w-xl mx-auto">
    <form wire:submit.prevent="start" class="space-y-6" novalidate>
        <div>
            <label for="title" class="block text-sm font-semibold text-slate-700 mb-1">
                Title <span class="text-red-500">*</span>
            </label>
            <input id="title" wire:model="title" type="text"
                class="mt-1 block w-full rounded-lg px-4 py-2 text-sm shadow-sm
                       border @error('title') border-red-500 @else border-slate-300 @enderror
                       focus:border-amber-600 focus:ring-2 focus:ring-amber-500 focus:bg-white 
                       outline-none ring-0 transition"
                placeholder="Enter Title For Inspection">
            @error('title')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <x-ts-select.styled label="Site *" searchable wire:model="site" :options="$sites"
                select="label:name|value:id" required />
        </div>
        <div>
            <x-ts-select.styled label="Frequency *" wire:model="frequency" :options="$frequencies" required />
        </div>
        <div class="space-y-2">
            <p class="text-xs text-slate-500">
                After starting inspection it is saved as <span class="font-semibold text-amber-600">Draft</span>.
                If closed, it will be saved.
            </p>
            <button type="submit"
                class="w-full py-3 px-4 rounded-md bg-amber-600 text-white font-medium shadow-sm hover:bg-amber-800 
               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-600 flex justify-center items-center space-x-2"
                wire:loading.attr="disabled">

                <svg wire:loading class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>

                <span wire:loading.remove>Start Inspection</span>
                <span wire:loading>Starting...</span>
            </button>
        </div>
    </form>
</div>

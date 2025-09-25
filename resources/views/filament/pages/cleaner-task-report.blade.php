<x-filament-panels::page>

    @forelse ($record->items as $item)
        <x-filament::section collapsible>
            <x-slot name="heading">
                {{ $item->task->name }}
            </x-slot>

            <x-slot name="description">
                Site: {{ $record->site->name }} <br />
                Cleaner: {{ $record->cleaner->full_name }}
            </x-slot>

            @livewire('cleaner-report-info-list', ['data' => $item])

        </x-filament::section>
    @empty
        <div class="flex justify-center items-center">No Any Reports Data Found</div>
    @endforelse

    <x-filament::modal id="report-missing">
        <x-slot name="heading">
            Report PDF not ready
        </x-slot>

        <x-slot name="description">
            <div class="text-center">The report is still being prepared. Please wait a moment and try again later, or
                contact the
                administrator.</div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-center items-center">
                <x-filament::button color="primary" x-on:click="$dispatch('close-modal', {id: 'report-missing' })">
                    OK
                </x-filament::button>
            </div>
        </x-slot>
    </x-filament::modal>


</x-filament-panels::page>

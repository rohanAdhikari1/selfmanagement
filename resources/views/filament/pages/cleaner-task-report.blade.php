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

    <x-filament::modal id="report-missing" alignment="center" footer-actions-alignment="center" display-classes="flex">
        <x-slot name="heading">
            Report PDF not ready
        </x-slot>

        <x-slot name="description">
            The report is still being prepared. Please wait a moment and try again later, or
            contact the
            administrator.
        </x-slot>

        <x-slot name="footer">
            <x-filament::button color="primary" x-on:click="$dispatch('close-modal', {id: 'report-missing' })">
                OK
            </x-filament::button>
        </x-slot>
    </x-filament::modal>


</x-filament-panels::page>

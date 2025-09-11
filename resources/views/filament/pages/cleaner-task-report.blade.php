<x-filament-panels::page>

    @forelse ($records as $record)
        <x-filament::section collapsible>
            <x-slot name="heading">
                {{ $record->task->name }}
            </x-slot>

            <x-slot name="description">
                Site: {{ $record->site->name }} <br />
                Cleaner: {{ $record->cleaner->full_name }}
            </x-slot>

            @livewire('cleaner-report-info-list', ['data' => $record])

        </x-filament::section>
    @empty
        <div class="flex justify-center items-center">No Any Reports Data Found</div>
    @endforelse

</x-filament-panels::page>

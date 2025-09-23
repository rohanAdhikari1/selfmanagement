<x-filament-panels::page>
    <x-filament::section collapsible>
        <x-slot name="heading">
            Inspection
        </x-slot>

        <x-slot name="afterHeader">
            {{ $this->getHeaderPoints() }}
        </x-slot>

        @forelse ($tasks as $task)
            <div class="my-2">
                <x-filament::section collapsible>
                    <x-slot name="heading">
                        Task: {{ $task->name }}
                    </x-slot>

                    @php
                        $items = $reportItems->filter(function ($item) use ($task) {
                            return $item->question && $item->question->task_id == $task->id;
                        });
                        $total = $items->sum('question.total_point');
                        $obtained_points = $items->sum('obtained_point');
                        $percentage = $total > 0 ? number_format(($obtained_points / $total) * 100, 2) : 0;
                        $point_head = "$obtained_points/$total ($percentage%)";
                    @endphp

                    <x-slot name="afterHeader">
                        {{ $point_head }}
                    </x-slot>

                    <div class="flex flex-col gap-3">
                        @foreach ($items as $item)
                            <div
                                class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 p-4 bg-white dark:bg-gray-800 rounded-lg border-b-2 border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                                <div class="flex-1">
                                    <p class="text-sm sm:text-base font-medium text-gray-800 dark:text-gray-100">
                                        {{ $item->question?->name }}
                                    </p>

                                    @if ($item->remarks)
                                        <p class="text-gray-500 dark:text-gray-400 text-xs mt-1">
                                            Remark: {{ $item->remarks }}
                                        </p>
                                    @endif
                                    <div>
                                        <div class="flex gap-2 mt-1 flex-wrap gallery">
                                            @foreach ($item->images as $image)
                                                @php
                                                    $url = Storage::temporaryUrl($image->file_path, now()->addHour(1));
                                                    $groupName = $item->question?->name ?? 'default';
                                                    $safeGroupId = preg_replace('/[^a-zA-Z0-9\-_:.]/', '_', $groupName);
                                                @endphp
                                                <a href="#" x-lightbox="@js($url)"
                                                    x-lightbox:group="{{ $safeGroupId }}"
                                                    class="aspect-square flex rounded-md overflow-hidden hover:opacity-80 transition-opacity">
                                                    <img loading="lazy" src="{{ $url }}"
                                                        alt="{{ $image->title }}"
                                                        class="w-20 h-20 object-cover rounded-md">
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="inline-block px-3 text-white py-1 rounded-full text-xs font-semibold"
                                        style="background-color: {{ $item->answer?->color_code ?? '#D97706' }};">
                                        {{ $item->answer?->name }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-filament::section>
            </div>
        @empty
        @endforelse
    </x-filament::section>

    <div>
        <h3>Assessors Signatures</h3>
        <div class="bg-white p-2 h-12 w-20">
            <a href="#" x-lightbox="@js($report->inspector_signature)">
                <img src="{{ $report->inspector_signature }}" loading="lazy" alt="Inspector Signature" />
            </a>
        </div>
    </div>


</x-filament-panels::page>
@assets
    <script defer src="https://cdn.jsdelivr.net/npm/alpine-tailwind-lightbox@1.x.x/dist/alpine-tailwind-lightbox.min.js">
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
@endassets

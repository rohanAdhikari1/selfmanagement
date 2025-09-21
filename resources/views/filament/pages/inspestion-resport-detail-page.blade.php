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
                <x-filament::section>
                    <x-slot name="heading">
                        Task: {{ $task->name }}
                    </x-slot>

                    @php
                        $items = $reportItems->filter(function ($item) use ($task) {
                            return $item->question && $item->question->task_id == $task->id;
                        });
                        $total = $items->sum('question.total_point');
                        $obtained_points = $items->sum('obtained_point');
                        $percentage = number_format(($obtained_points / $total) * 100, 2);
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

                                    @if ($item->remark)
                                        <p class="text-gray-500 dark:text-gray-400 text-xs mt-1">
                                            Remark: {{ $item->remark }}
                                        </p>
                                    @endif
                                </div>
                                <div>
                                    <span
                                        class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-200">Yes</span>
                                </div>
                            </div>
                        @endforeach

                        <!-- Inspection Item with photos -->
                        <div
                            class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-2 p-2 bg-white dark:bg-gray-800 rounded-lg">
                            <div class="flex-1">
                                <p class="text-sm sm:text-base font-medium text-gray-800 dark:text-gray-100">Are
                                    switches
                                    working?</p>
                                <p class="text-gray-500 dark:text-gray-400 text-xs mt-1">Remark: One switch stuck, needs
                                    adjustment.</p>
                                <div class="flex gap-2 mt-1 flex-wrap">
                                    <img src="photo1.jpg" alt="Switch photo" class="w-20 h-20 object-cover rounded-md">
                                    <img src="photo2.jpg" alt="Switch photo" class="w-20 h-20 object-cover rounded-md">
                                </div>
                            </div>
                            <div>
                                <span
                                    class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-200">No</span>
                            </div>
                        </div>

                        <!-- Inspection Item without remark/photo -->
                        <div class="flex justify-between items-center p-2 bg-white dark:bg-gray-800 rounded-lg">
                            <p class="text-sm sm:text-base font-medium text-gray-800 dark:text-gray-100">Any exposed
                                live
                                wires?
                            </p>
                            <span
                                class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">None</span>
                        </div>
                    </div>
                </x-filament::section>
            </div>
        @empty
        @endforelse


    </x-filament::section>


</x-filament-panels::page>

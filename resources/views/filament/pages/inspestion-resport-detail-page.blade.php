<x-filament-panels::page>
    <x-filament::section collapsible>
        <x-slot name="heading">
            Inspection
        </x-slot>

        <x-slot name="afterHeader">
            345/360 (95.83%)
        </x-slot>

        {{-- Nested inspections --}}
        <x-filament::section>
            <x-slot name="heading">
                Task: Electrical Check
            </x-slot>

            <x-slot name="afterHeader">
                50/50 (100%)
            </x-slot>

            <div class="flex flex-col gap-3">
                <!-- Inspection Item -->
                <div
                    class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 p-2 bg-white dark:bg-gray-800 rounded-lg">
                    <div class="flex-1">
                        <p class="text-sm sm:text-base font-medium text-gray-800 dark:text-gray-100">Are all wires
                            insulated?</p>
                        <p class="text-gray-500 dark:text-gray-400 text-xs mt-1">Remark: Minor wear on wire insulation
                            near panel.</p>
                    </div>
                    <div>
                        <span
                            class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-200">Yes</span>
                    </div>
                </div>

                <!-- Inspection Item with photos -->
                <div
                    class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-2 p-2 bg-white dark:bg-gray-800 rounded-lg">
                    <div class="flex-1">
                        <p class="text-sm sm:text-base font-medium text-gray-800 dark:text-gray-100">Are switches
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
                    <p class="text-sm sm:text-base font-medium text-gray-800 dark:text-gray-100">Any exposed live wires?
                    </p>
                    <span
                        class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">None</span>
                </div>
            </div>
        </x-filament::section>
    </x-filament::section>


</x-filament-panels::page>

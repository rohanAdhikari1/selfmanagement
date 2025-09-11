<x-filament-panels::page>
    <div class="relative ">
        @php
            $faqs = [
                [
                    'question' => 'Entrance',
                    'answer' =>
                        'This is notes for entrance',
                    'images' => [
                        'https://getcomposer.org/img/logo-composer-transparent.png',
                        'https://laravel.com/img/logomark.min.svg',
                    ],
                ],
                [
                    'question' => 'Can I use Livewire inside Filament?',
                    'answer' =>
                        'Yes, Filament itself is built on Livewire, so you can create custom widgets, forms, and components easily.',
                    'images' => [
                        'https://laravel.com/img/logomark.min.svg',
                        'https://cdn.worldvectorlogo.com/logos/livewire-1.svg',
                    ],
                ],
                [
                    'question' => 'How do I install Filament?',
                    'answer' => 'Run <code>composer require filament/filament</code> inside your Laravel project.',
                    'images' => ['https://getcomposer.org/img/logo-composer-transparent.png'],
                ],
            ];
        @endphp

        <div x-data="{ openImage: null, zoom: 1 }" class="space-y-4">
            @foreach ($faqs as $index => $faq)
                <div x-data="{ open: {{ $index === 0 ? 'true' : 'true' }} }"
                    class="relative bg-white dark:bg-gray-800 rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700">
                    <!-- Question -->
                    <div class="flex items-center cursor-pointer font-semibold text-lg text-gray-900 dark:text-gray-100"
                        @click="open = !open">
                        {{-- <span class="w-3 h-3 bg-primary-500 rounded-full mr-3"></span> --}}
                        {{ $faq['question'] }}
                        <span class="ml-auto text-xl" x-text="open ? '−' : '+'"></span>
                    </div>
                    <div class="flex gap-6 text-gray-700 dark:text-gray-200 text-sm">
                        <span><b>Start:</b> 10:00 AM</span>
                        <span><b>End:</b> 11:00 PM</span>
                        <span><b>Files:</b> 6</span>
                        <span><b class="text-success-600">Notes *</b></span>
                    </div>

                    <!-- Answer -->
                    <div x-show="open" x-collapse class="mt-4 text-gray-600 dark:text-gray-300 space-y-3">
                        <p>{!! $faq['answer'] !!}</p>
                        <div class="flex justify-between gap-4">
                            <div class="flex-1">
                                <h5 class="font-semibold text-gray-700 dark:text-gray-200">Before</h5>
                                <div class="flex flex-wrap gap-4 mt-3">
                                    @foreach ($faq['images'] as $image)
                                        <img src="{{ $image }}" alt="{{ $faq['question'] }}"
                                            class="rounded-md shadow w-32 h-32 object-contain bg-white p-2 cursor-pointer hover:scale-105 transition"
                                            @click="openImage = '{{ $image }}'; zoom = 1">
                                    @endforeach
                                </div>
                            </div>

                            <div class="flex-1">
                                <h5 class="font-semibold text-gray-700 dark:text-gray-200">After</h5>
                                <div class="flex flex-wrap gap-4 mt-3">
                                    @foreach ($faq['images'] as $image)
                                        <img src="{{ $image }}" alt="{{ $faq['question'] }}"
                                            class="rounded-md shadow w-32 h-32 object-contain bg-white p-2 cursor-pointer hover:scale-105 transition"
                                            @click="openImage = '{{ $image }}'; zoom = 1">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Popup Modal with Zoom + Drag -->
            <div x-show="openImage" x-transition class="fixed inset-0 flex items-center justify-center bg-black/70 z-50"
                @click.self="openImage = null" x-data="{
                    zoom: 1,
                    posX: 0,
                    posY: 0,
                    dragging: false,
                    startX: 0,
                    startY: 0
                }">
                <div class="relative max-w-5xl w-full p-4 flex flex-col items-center">
                    <!-- Close button -->
                    <button class="absolute top-2 right-2 text-white text-2xl" @click="openImage = null">
                        ✕
                    </button>

                    <!-- Image Container -->
                    <div class="overflow-hidden max-h-[90vh] w-full flex justify-center items-center relative">
                        <img :src="openImage"
                            class="rounded-lg shadow-lg cursor-grab transition-transform duration-300"
                            :style="`transform: scale(${zoom}) translate(${posX}px, ${posY}px);`"
                            @mousedown.prevent="dragging = true; startX = $event.clientX - posX; startY = $event.clientY - posY"
                            @mouseup="dragging = false" @mouseleave="dragging = false"
                            @mousemove="if(dragging){ posX = $event.clientX - startX; posY = $event.clientY - startY }">
                    </div>

                    <!-- Zoom controls -->
                    <div class="flex gap-4 mt-4">
                        <button class="bg-white px-3 py-1 rounded shadow text-black font-bold"
                            @click="zoom = Math.max(0.5, zoom - 0.2); posX = 0; posY = 0">− Zoom Out</button>

                        <button class="bg-white px-3 py-1 rounded shadow text-black font-bold"
                            @click="zoom = zoom + 0.2; posX = 0; posY = 0">+ Zoom In</button>

                        <button class="bg-white px-3 py-1 rounded shadow text-black font-bold"
                            @click="zoom = 1; posX = 0; posY = 0">Reset</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-filament-panels::page>

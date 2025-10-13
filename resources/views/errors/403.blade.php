<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>{{ __('403 Forbidden') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="robots" content="noindex, nofollow">
</head>

<body
    class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-300">

    <main class="max-w-lg w-full mx-auto px-6">
        <section
            class="relative bg-white/70 dark:bg-gray-800/80 backdrop-blur-xl shadow-2xl rounded-3xl border border-gray-200/60 dark:border-gray-700 overflow-hidden transition-all hover:shadow-indigo-200 dark:hover:shadow-indigo-900/30">

            <div class="p-10 text-center">
                <!-- Animated lock icon -->
                <div
                    class="mx-auto w-24 h-24 mb-6 flex items-center justify-center bg-gradient-to-tr from-red-500 to-rose-400 rounded-full shadow-lg text-white animate-bounce-slow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M12 15a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M7 10V8a5 5 0 1110 0v2" />
                        <rect x="4" y="10" width="16" height="10" rx="2" stroke-width="1.5" />
                    </svg>
                </div>

                <h1 class="text-5xl font-black text-gray-900 dark:text-white tracking-tight">403</h1>
                <p class="mt-3 text-lg text-gray-600 dark:text-gray-300">
                    {{ __("You don't have permission to access this page.") }}
                </p>

                <!-- Button Group -->
                <div class="mt-8 flex flex-wrap justify-center gap-3 sm:gap-4">
                    <a href="{{ url()->previous() ?? url('/') }}"
                        class="flex-1 min-w-[140px] text-center whitespace-nowrap px-5 py-2.5 rounded-xl text-sm font-medium border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 transition">
                        {{ __('Go Back') }}
                    </a>

                    <a href="{{ url('/') }}"
                        class="flex-1 min-w-[140px] text-center whitespace-nowrap px-5 py-2.5 rounded-xl text-sm font-medium bg-indigo-600 text-white hover:bg-indigo-700 dark:hover:bg-indigo-500 transition">
                        {{ __('Go Home') }}
                    </a>

                    {{-- @auth
                        <form method="POST" action="/logout" class="flex-1 min-w-[140px] flex">
                            @csrf
                            <button type="submit"
                                class="w-full text-center whitespace-nowrap px-5 py-2.5 rounded-xl text-sm font-medium bg-rose-500 text-white hover:bg-rose-600 dark:hover:bg-rose-400 transition">
                                {{ __('Logout') }}
                            </button>
                        </form>
                    @endauth --}}

                    @if (config('app.debug'))
                        <button id="show-details"
                            class="flex-1 min-w-[140px] text-center whitespace-nowrap px-5 py-2.5 rounded-xl text-sm font-medium bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                            {{ __('Show Details') }}
                        </button>
                    @endif
                </div>


                @if (config('app.debug'))
                    <div id="details"
                        class="mt-6 hidden text-left p-4 border border-gray-200 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-gray-900/40 text-sm text-gray-700 dark:text-gray-300">
                        <strong>{{ __('Exception message:') }}</strong>
                        <pre class="whitespace-pre-wrap break-words mt-2 text-rose-600 dark:text-rose-400">{{ optional($exception)->getMessage() }}</pre>
                        <strong class="mt-3 block">{{ __('Trace:') }}</strong>
                        <pre class="whitespace-pre-wrap break-words mt-2 text-xs text-gray-500 dark:text-gray-400">{{ optional($exception)->getTraceAsString() }}</pre>
                    </div>
                    <script>
                        document.getElementById('show-details').addEventListener('click', function() {
                            const d = document.getElementById('details');
                            d.classList.toggle('hidden');
                            d.scrollIntoView({
                                behavior: 'smooth',
                                block: 'nearest'
                            });
                        });
                    </script>
                @endif

                <p class="mt-8 text-xs text-gray-400 dark:text-gray-500">
                    {{ __('If you think this is a mistake, contact support or try signing in with another account.') }}
                </p>
            </div>
        </section>
    </main>

    <style>
        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-6px);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 3s ease-in-out infinite;
        }
    </style>
</body>

</html>

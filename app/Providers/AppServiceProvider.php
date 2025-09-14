<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TallStackUi\Facades\TallStackUi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->personalize();
    }

    public function personalize()
    {
        TallStackUi::personalize()
            ->select('styled')
            ->block('box.list.item.selected', 'font-semibold bg-amber-100 hover:bg-amber-500 hover:text-white dark:hover:bg-amber-500')
            ->block('box.list.item.wrapper', 'dark:text-dark-300 dark:hover:bg-dark-500 dark:focus:bg-dark-500 relative cursor-pointer select-none px-2 py-2 text-gray-700 hover:bg-amber-100 focus:bg-amber-100 focus:outline-hidden');
    }
}

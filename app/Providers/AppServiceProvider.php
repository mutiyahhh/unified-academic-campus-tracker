<?php

namespace App\Providers;

use App\Models\Akreditas;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('partials.header', function ($view) {
            if (auth()->check()) {
                // dd(auth()->user()->toArray());
                if (auth()->user()->roles[0]->name == 'admin' || auth()->user()->roles[0]->name == 'manajemen') {
                    $akreditas = Akreditas::where('expired', '<=', now()->addYears(2))->get();
                } else {
                    $akreditas = Akreditas::where('name', auth()->user()->prodi)
                        ->where('expired', '<=', now()->addYears(2))
                        ->get();
                }

                $view->with('akreditas', $akreditas);
            }
        });
    }
}

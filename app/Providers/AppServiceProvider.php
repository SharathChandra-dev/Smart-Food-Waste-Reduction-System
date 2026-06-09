<?php

namespace App\Providers;

use App\Models\HeaderSfwr;
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
        View::composer('admin.layout', function ($view) {
            $header = HeaderSfwr::where('page_type_sfwr', 'admin')
                ->latest('created_at')
                ->first();

            $view->with('adminHeaderTitle', $header?->heading_sfwr ?? 'SFWR Admin');
        });

        View::composer('layouts.header', function ($view) {
            $header = HeaderSfwr::where('page_type_sfwr', 'user')
                ->latest('created_at')
                ->first();

            $view->with('userHeaderTitle', $header?->heading_sfwr ?? 'Smart Food Waste Reducer(SFWR)');
        });
    }
}

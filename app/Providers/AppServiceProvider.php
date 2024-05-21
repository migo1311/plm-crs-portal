<?php

namespace App\Providers;

use App\Filament\Faculty\Pages\FacultyInformation;
use App\Observers\ClassStudentObserver;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Page;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\Pivot;
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
        Pivot::observe(ClassStudentObserver::class);
        Filament::serving(function () {
            Filament::registerUserMenuItems([
                FacultyInformation::getNavigationSort(),
                // ...
            ]);
        });
    }
}

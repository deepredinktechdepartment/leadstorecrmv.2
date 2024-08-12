<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Themeoptions;

class ThemeOptionsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Share theme options globally
        view()->composer('*', function ($view) {
            $theme_options = Themeoptions::first(); // Fetch the first record

            // Share these values with all views
            $view->with([
                'header_logo' => $theme_options->header_logo ?? 'default_header_logo.png',
                'favicon' => $theme_options->favicon ?? 'default_favicon.png',
                'footer_logo' => $theme_options->footer_logo ?? 'default_footer_logo.png',
                'copyright' => $theme_options->copyright ?? 'Default Copyright'
            ]);
        });
    }
}

<?php

namespace App\Providers;

use App\Helpers\MarkdownHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Model::unguard();
        
        // Register markdown Blade directive
        Blade::directive('markdown', function ($expression) {
            return "<?php echo App\Helpers\MarkdownHelper::render($expression); ?>";
        });
    }
}

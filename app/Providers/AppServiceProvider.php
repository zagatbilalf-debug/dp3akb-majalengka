<?php

namespace App\Providers;

use App\Models\Program;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('layouts.partials.footer', function ($view) {
            $view->with('footerPrograms', Program::latest()->take(4)->get());
        });

        View::composer('layouts.partials.nav', function ($view) {
            $view->with('navPrograms', Program::latest()->take(5)->get());

            // Captcha matematika sederhana untuk modal Admin Login
            $num1 = rand(1, 9);
            $num2 = rand(1, 9);
            session(['admin_captcha_answer' => $num1 + $num2]);

            $view->with('captchaNum1', $num1);
            $view->with('captchaNum2', $num2);
        });
    }
}
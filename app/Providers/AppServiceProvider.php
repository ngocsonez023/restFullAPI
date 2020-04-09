<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $smtpdata = DB::table('setting_email')->first();
        Config::set('mail.host', $smtpdata->MAIL_HOST);
        Config::set('mail.port', $smtpdata->MAIL_PORT);
        Config::set('mail.username', $smtpdata->MAIL_USERNAME);
        Config::set('mail.password', $smtpdata->MAIL_PASSWORD);
        Config::set('mail.driver', $smtpdata->MAIL_DRIVER);
        Config::set('mail.encryption', $smtpdata->MAIL_ENCRYPTION);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

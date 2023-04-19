<?php

namespace App\Providers;
use App\Services\PHPMailService;
use Illuminate\Mail\MailServiceProvider;

class PHPMailServiceProvider extends MailServiceProvider
{
    public function registerSwiftTransport()
    {
//        $this->app['swift.transport'] = $this->app->share(function ($app) {
//            return new PHPMailService(new PHPMailTransport());
//        });


        $this->app->singleton('mail.manager', function($app) {
            return new PHPMailService($app);
        });

        // Copied from Illuminate\Mail\MailServiceProvider
        $this->app->bind('mailer', function ($app) {
            return $app->make('mail.manager')->mailer();
        });
    }

}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use EasyWeChat\Factory;
use EasyWeChat\OfficialAccount\Application;

class AppServiceProvider extends ServiceProvider
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
        $this->app->bind(EasyWeChat\OfficialAccount\Application::class, function($app){
            $config = [
                'app_id' => '',
                'secret' => '',
                'token' => '',
                'aes_key' => '',
                'response_type' => 'array',

                'log' => [
                    'default' => 'dev',
                    'channels' => [
                        'dev' => [
                            'driver' => 'single',
                            'path' => storage_path('logs/easywechat.log'),
                            'level' => 'debug',
                        ],
                        'prod' => [
                            'driver' =>'daily',
                            'path' => storage_path('logs/easywechat.log'),
                            'level' => 'info',
                        ],
                    ],
                ],
            ];
            return Factory::officialAccount($config);
        });
    }
}

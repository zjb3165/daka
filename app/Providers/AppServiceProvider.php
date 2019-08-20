<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use EasyWeChat\Factory;

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
        $this->app->singleton(\EasyWeChat\OfficialAccount\Application::class, function($app){
            $setting = $app->make(\App\Repo\SettingRepo::class);
            $params = $setting->get('wechat');
            $config = [
                'app_id' => $params['appid'] ?? '',
                'secret' => $params['appsecret'] ?? '',
                'token' => $params['token'] ?? '',
                'aes_key' => $params['aeskey'] ?? '',
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

        $this->app->singleton(\App\Services\utils\RemoteCatch::class, function($app){
            return new \App\Services\utils\RemoteCatch();
        });

        $this->app->bind(\App\Services\image\ShareImageBuilderInterface::class, \App\Services\image\ShareImageBuilder::class);
    }
}

<?php

namespace App\Providers;

use App\Services\MailService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\OtpRepository;
use App\Repositories\OtpRepositoryInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MailService::class, function ($app) {
            return new MailService();
        });
        // Khi bạn sử dụng singleton để đăng ký một dịch vụ, Laravel sẽ chỉ tạo một phiên bản duy nhất của 
        // dịch vụ đó và sử dụng phiên bản đó cho tất cả các lần yêu cầu dịch vụ trong cùng một vòng đời của 
        // ứng dụng. Điều này giúp tiết kiệm tài nguyên và đảm bảo rằng bạn luôn nhận được cùng một phiên bản 
        // khi yêu cầu dịch vụ.
        
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(OtpRepositoryInterface::class, OtpRepository::class);

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

<?php
/**
 * Binds the CourierInterface to a specific courier class
 * based on configuration, allowing switching between different courier services.
 */
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\CourierInterface;

class CourierServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CourierInterface::class, function () {
            $courier = config('services.default_courier');
            $courierClass = config("services.courier_classes.{$courier}");

            if (!class_exists($courierClass)) {
                throw new \Exception("Courier class for {$courier} does not exist.");
            }

            return new $courierClass();
        });
    }
}

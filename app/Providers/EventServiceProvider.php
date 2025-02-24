<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [ 
        \App\Events\StudentCreated::class => [ 
            \App\Listeners\CreateDonationForNewStudent::class, 
            \App\Listeners\CreateFrequencyList::class,
        ], 
        \App\Events\StudentUpdated::class => [
            \App\Listeners\UpdateStudentFrequency::class,
        ],
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

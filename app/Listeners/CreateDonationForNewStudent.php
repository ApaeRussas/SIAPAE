<?php

namespace App\Listeners;

use App\Events\StudentCreated;
use App\Models\Donation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateDonationForNewStudent
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StudentCreated $event) { 
        Donation::create([ 
            'student_id' => $event->student->id, 
            'year_of_donation' => \Carbon\Carbon::now()->year
        // Outros campos da tabela de doações, que serão vazios por padrão 
        ]); 
    }
}

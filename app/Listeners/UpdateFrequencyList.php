<?php

namespace App\Listeners;

use App\Events\StudentUpdated;
use App\Models\Frequency;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateFrequencyList
{
    /**
     * Create the event listener.
     */

    /**
     * Handle the event.
     */
    public function handle(StudentUpdated $event)
    {
        $currentMonthYear = Carbon::now()->format('m/Y');
        $frequency = Frequency::where('student_id', $event->student->id)
            ->where('month_year', $currentMonthYear)
            ->first();

        if ($frequency) {
            $frequency->class_apae = $event->student->class_apae;
            $frequency->turn_apae = $event->student->turn_apae;
            $frequency->save();
        } else {
            Frequency::create([
                'student_id' => $event->student->id,
                'class_apae' => $event->student->class_apae,
                'turn_apae' => $event->student->turn_apae,
                'month_year' => $currentMonthYear
            ]);
        }
    }
}

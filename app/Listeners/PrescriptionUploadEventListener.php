<?php

namespace App\Listeners;

use App\Events\PrescriptionUploadEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PrescriptionUploadEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PrescriptionUploadEvent  $event
     * @return void
     */
    public function handle(PrescriptionUploadEvent $event)
    {
        //
    }
}

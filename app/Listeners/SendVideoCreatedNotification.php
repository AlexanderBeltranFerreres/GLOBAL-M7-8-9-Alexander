<?php

namespace App\Listeners;

use App\Events\VideoCreated;
use App\Models\User;
use App\Notifications\VideoCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class SendVideoCreatedNotification
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
    public function handle(VideoCreated $event)
    {
        // comprovem les dades passades des del event
        Log::info('Event de VideoCreated entrant', ['video' => $event->video]);

        // busquyem els usuaris admins
        $admins = User::where('super_admin', true)->get();

        if ($admins->isEmpty()) {
            Log::info('No s\'han trobat usuaris super admin ');
        }

        // Enviar la notificacio
        Notification::send($admins, new VideoCreatedNotification($event->video));

        Log::info('Notificació enviada correctament');
    }
}

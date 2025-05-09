<?php

namespace App\Notifications;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
class VideoCreatedNotification extends Notification
{
    use Queueable;

    public $video;

    /**
     * Creem una nova instància de la notifiació.
     *
     * @param Video $video
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Canals on s'envia la noficació.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'broadcast'];
    }

    /**
     * Enviar noti per correu
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('NOU VIDEO CREAT')
            ->line('S\'ha creat un nou video.')
            ->line('Titol: ' . $this->video->title)
            ->line('URL: ' . $this->video->url)
            ->action('Veure Video', url($this->video->url));
    }

    /**
     * Guardar la notificació a la BD.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'video_id' => $this->video->id,
            'title' => $this->video->title,
            'description' => $this->video->description,
        ];
    }

    /**
     * Enviar la notificació per broadcast (Pusher).
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'video_id' => $this->video->id,
            'title' => $this->video->title,
            'description' => $this->video->description,
        ]);
    }
}

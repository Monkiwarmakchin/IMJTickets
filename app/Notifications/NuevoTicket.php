<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class NuevoTicketPush extends Notification
{
    use Queueable;

    public $ticketInfo;

    public function __construct($ticketInfo)
    {
        $this->ticketInfo = $ticketInfo;
    }

    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('¡Nuevo Ticket Recibido!')
            ->icon('/images/IMJCabezaT.png')
            ->body("Ticket #{$this->ticketInfo['id']} creado por: {$this->ticketInfo['nombre']}")
            ->action('Ver Ticket', 'ver_ticket') // Botón de acción
            ->data(['url' => route('tickets.index')]); //Ruta a abrir al hacer clic en la notificación
    }
}
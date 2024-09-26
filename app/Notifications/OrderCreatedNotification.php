<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $channels = ['database','mail','broadcast'];
        if($notifiable->notification_preferinces['order_created']['sms'] ?? false)
            $channels[] = 'vonage';
        if($notifiable->notification_preferinces['order_created']['mail'] ?? false)
            $channels[] = 'mail';
        if($notifiable->notification_preferinces['order_created']['broadcast'] ?? false)
            $channels[] = 'broadcast';
        return  $channels;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject("Order Created # {$this->order->number}")
//                    ->from()
                    ->greeting("Hello {$notifiable->name},")
                    ->line("A new order created ({$this->order->number}) created by {$this->order->name}")
                    ->action('View Order', url('/dashboard'))
                    ->line('Thank you for using our application!')
                    ->salutation('best regard')
                    ->line('multi-vendor');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'body' => "A new order created ({$this->order->number}}) created by {$this->order->name}",
            'icon' => 'fas fa-file',
            'url'  => url('/dashboard'),
            'order_id' => $this->order->id
        ];
    }

    public function toBroadcast(object $notifiable )
    {
        return new BroadcastMessage([
            'body' => "A new order created ({$this->order->number}}) created by {$this->order->name}",
            'icon' => 'fas fa-file',
            'url'  => url('/dashboard'),
            'order_id' => $this->order->id
        ]);
    }
}

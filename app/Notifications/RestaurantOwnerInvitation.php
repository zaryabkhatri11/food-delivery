<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Password as FacadesPassword;
use Password;

class RestaurantOwnerInvitation extends Notification
{
    use Queueable;

    public function __construct(public string $restaurantName)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = route('password.reset', [
            'token' => FacadesPassword::createToken($notifiable),
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);

        return (new MailMessage)
            ->subject(__("we invited you to join :app to manage restaurent", [
                'restaurant' => $this->restaurantName,
                'app' => config('app.name')
            ]))
            ->markdown('mail.restaurant.owner-invitation', [
                'setUrl' => $url,
                'requestNewUrl' => route('password.request'),
                'restaurant' => $this->restaurantName,
            ]);
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
}

<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    protected $token;
    protected $baseUrl;

    /**
     * Create a new notification instance.
     *
     * @param string $token
     * @param string $baseUrl
     */
    public function __construct($token, $baseUrl)
    {
        $this->token = $token;
        $this->baseUrl = $baseUrl;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $frontendUrl = $this->baseUrl . '/reset-password?token=' . $this->token . '&email=' . urlencode($notifiable->email);

        return (new MailMessage)
        ->subject('Opsh Password Reset Notification')
        ->line('<img src="https://opportunitiessharing.com/opcn/images/opportunity/paterner/place-10.png" alt="Opsh Logo" style="max-width: 200px;">')
        ->line('You are receiving this email because we received a password reset request for your account.')
        ->action('Reset Password', $frontendUrl)
        ->line('If you did not request a password reset, no further action is required.')
        ->line('Regards,')
        ->line('Opsh');
}

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

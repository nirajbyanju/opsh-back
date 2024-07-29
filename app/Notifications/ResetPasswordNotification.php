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
                ->view('password_reset', [
                    'frontendUrl' => $frontendUrl,
                    'logoUrl' => 'https://yourdomain.com/path/to/logo.png',
                    'appName' => 'Opsh',
                ]);
}

}

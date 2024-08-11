<?php
/**
 * Defines sending notifications in case of a delivery failure via email and SMS.
 */

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Twilio\TwilioMessage;

class DeliveryFailureNotification extends Notification
{
    use Queueable;

    protected $payload;
    protected $errorMessage;

    public function __construct(array $payload, $errorMessage)
    {
        $this->payload = $payload;
        $this->errorMessage = $errorMessage;
    }

    public function via($notifiable)
    {
    $channels = ['mail'];

    // Check if the notifiable entity has a phone number for SMS notifications
    if (!empty($notifiable->phone_number)) {
        $channels[] = 'nexmo'; // Added 'nexmo' for SMS notifications
    }

    return $channels;
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Delivery Failure Notification')
                    ->greeting('Hello ' . $notifiable->name)
                    ->line('There was a problem with a delivery attempt.')
                    ->line('Payload: ' . json_encode($this->payload))
                    ->line('Error: ' . $this->errorMessage)
                    ->line('Please check the logs for more details.')
                    ->salutation('Regards, Your Application Team');
    }

    public function toNexmo($notifiable)
    {
        return (new TwilioMessage)
                    ->content("Hello " . $notifiable->name . ", Delivery Failure Notification: There was a problem with a delivery attempt. Payload: " . json_encode($this->payload) . ". Error: " . $this->errorMessage);
    }

    public function toArray($notifiable)
    {
        return [
            'notifiable_id' => $notifiable->id,
            'payload' => $this->payload,
            'error' => $this->errorMessage,
        ];
    }
}

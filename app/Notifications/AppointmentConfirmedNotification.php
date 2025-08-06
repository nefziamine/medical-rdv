<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentConfirmedNotification extends Notification
{
    use Queueable;

    protected $appointment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Rendez-vous confirmé')
            ->greeting('Bonjour ' . $notifiable->first_name)
            ->line('Votre rendez-vous a été confirmé par le médecin.')
            ->line('Détails du rendez-vous :')
            ->line('Date : ' . Carbon::parse($this->appointment->appointment_date)->format('d/m/Y'))
            ->line('Heure : ' . $this->appointment->appointment_time)
            ->line('Médecin : Dr. ' . $this->appointment->doctor->user->first_name . ' ' . $this->appointment->doctor->user->last_name)
            ->line('Spécialité : ' . $this->appointment->doctor->specialty->name)
            ->action('Voir les détails', url('/appointments/' . $this->appointment->id))
            ->line('Merci de votre confiance !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'appointment_id' => $this->appointment->id,
            'message' => 'Votre rendez-vous du ' . Carbon::parse($this->appointment->appointment_date)->format('d/m/Y') . ' à ' . $this->appointment->appointment_time . ' a été confirmé.',
            'date' => $this->appointment->appointment_date,
            'time' => $this->appointment->appointment_time,
            'doctor_name' => $this->appointment->doctor->user->first_name . ' ' . $this->appointment->doctor->user->last_name,
            'specialty' => $this->appointment->doctor->specialty->name,
        ];
    }
} 
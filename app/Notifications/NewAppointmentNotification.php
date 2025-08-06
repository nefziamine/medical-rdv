<?php

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewAppointmentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        $role = $notifiable->isDoctor() ? 'Docteur' : 'Patient';
        return (new MailMessage)
            ->subject('Nouveau rendez-vous')
            ->greeting('Bonjour ' . $notifiable->first_name . ',')
            ->line('Vous avez un nouveau rendez-vous le ' . $this->appointment->appointment_date . ' à ' . $this->appointment->appointment_time . '.')
            ->action('Voir le rendez-vous', url('/appointments'))
            ->line('Merci d\'utiliser notre application!');
    }

    public function toArray($notifiable)
    {
        return [
            'appointment_id' => $this->appointment->id,
            'date' => $this->appointment->appointment_date,
            'time' => $this->appointment->appointment_time,
            'patient' => $this->appointment->patient->full_name ?? null,
            'doctor' => $this->appointment->doctor->full_name ?? null,
            'status' => $this->appointment->status,
        ];
    }
}

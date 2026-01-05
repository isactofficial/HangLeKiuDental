<?php

namespace App\Jobs;

use App\Models\Appointment;
use App\Services\WhatsAppService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWhatsAppAppointmentReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $appointmentId)
    {
    }

    public function handle(WhatsAppService $whatsApp): void
    {
        $appointment = Appointment::with('doctor')->find($this->appointmentId);
        if (!$appointment) {
            return;
        }

        $to = (string) ($appointment->patient_phone ?? '');
        if (trim($to) === '') {
            return;
        }

        $doctorName = $appointment->doctor->name ?? 'dokter';
        $procedure = $appointment->procedure ?? 'tindakan';
        $start = $appointment->start_at?->format('d/m/Y H:i');
        $end = $appointment->end_at?->format('H:i');

        $message = "Halo {$appointment->patient_name}, tindakan {$procedure} bersama {$doctorName} (mulai {$start}) akan selesai sekitar {$end}.";

        $whatsApp->send($to, $message);
    }
}

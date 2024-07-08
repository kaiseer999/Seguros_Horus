<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Pago_Empleado;

class Nomina extends Mailable
{
    use Queueable, SerializesModels;

    public $pagoEmpleado;
    public $deducciones;
    public $pdfOutput; // Variable para almacenar la ruta del archivo PDF

    public $name;

    /**
     * Create a new message instance.
     *
     * @param Pago_Empleado $pagoEmpleado
     * @param array $deducciones
     * @param string $pdfPath
     * @return void
     */
    public function __construct(Pago_Empleado $pagoEmpleado, $deducciones, $pdfOutput, $name)
    {
        $this->pagoEmpleado = $pagoEmpleado;
        $this->deducciones = $deducciones;
        $this->pdfOutput = $pdfOutput; // Almacena la ruta del archivo PDF
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Detalle de Nómina')
                    ->view('Nomina.Pago.Email')
                    ->with([
                        'pagoEmpleado' => $this->pagoEmpleado,
                        'deducciones' => $this->deducciones,
                        'name' => $this->name,
                    ])
                    ->attachData($this->pdfOutput, 'Nomina.pdf', [
                        'mime' => 'application/pdf', // Tipo MIME del archivo adjunto
                    ]);
    }
    
}

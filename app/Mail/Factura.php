<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Factura extends Mailable
{
    use Queueable, SerializesModels;

    public $factura;

    /**
     * Create a new message instance.
     */
    public function __construct($factura)
    {
        $this->factura = $factura;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Aviso de Vencimiento de Factura')
                    ->html("
                        <p>Estimado cliente,</p>
                        <p>Le informamos que la factura N.º {$this->factura->idFactura} está próxima a vencer el {$this->factura->fecha_Vencimiento}.</p>
                        <p>Por favor, realice el pago antes de la fecha indicada para evitar inconvenientes.</p>
                        <p>Gracias por su atención.</p>
                    ");
    }
}

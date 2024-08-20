<?php


namespace App\Console\Commands;

use App\Mail\Factura as MailFactura;
use Illuminate\Console\Command;
use App\Models\vencimientosPolizas;
use App\Models\Factura;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class VencimientoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:vencimiento-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualizar vencimientos de pólizas y registrar avisos.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $fechaLimite = \Illuminate\Support\Carbon::now()->addMonths(12);
            $facturas = Factura::where('fecha_Vencimiento', '<=', $fechaLimite)
                ->whereDoesntHave('vencimientos', function ($query) {
                    $query->where('Avisos', 'like', '%Aviso%');
                })
                ->get();

            foreach ($facturas as $factura) {
                $vencimiento = new vencimientosPolizas();
    
                if ($vencimiento->Estado != 'Notificado') { // Asegúrate de verificar el estado correctamente
                    $vencimiento->idFactura = $factura->idFactura;
                    $vencimiento->Avisos = "Aviso: La factura N.º {$factura->idFactura} está próxima a vencer el {$factura->fecha_Vencimiento}.";
                    $vencimiento->Estado = "Notificado";
                    $vencimiento->save();

                    // Obtener el email del cliente usando la relación
                    $email = $factura->clientes_facturas->email;

                    // Enviar el correo de aviso
                    Mail::to($email)
                        ->send(new MailFactura($factura));
                }

                $this->info("Vencimiento creado y correo enviado para la factura N.º {$factura->idFactura}.");
            }

            $this->info('No hay vencimientos sin notificar');
        } catch (\Exception $e) {
            $this->error('Ocurrió un error: ' . $e->getMessage());
        }
    }
    
}

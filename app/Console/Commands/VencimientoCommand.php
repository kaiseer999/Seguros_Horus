<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\vencimientosPolizas;
use App\Models\Factura;
use Illuminate\Support\Carbon;

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
        // Obtener la fecha límite para vencimientos (3 meses a partir de ahora)
        $fechaLimite = Carbon::now()->addMonths(12);

        // Obtener las facturas que están próximas a vencer
        $facturas = Factura::where('fecha_vencimiento', '<=', $fechaLimite)
            ->whereDoesntHave('Vencimiento', function ($query) {
                $query->where('Avisos', 'like', '%Aviso%');
            })
            ->get();

        foreach ($facturas as $factura) {
            $vencimiento = new vencimientosPolizas();
            // if($vencimiento->Estado != "Notificado")
            // {

            $vencimiento->idFactura = $factura->idFactura;
            $vencimiento->Avisos = "Aviso: La factura N.º {$factura->idFactura} está próxima a vencer el {$factura->fecha_Vencimiento}.";
            $vencimiento->Estado = "Notificado";
            $vencimiento->save();

            // Mensaje para confirmar la creación del vencimiento
            $this->info("Vencimiento creado para la factura N.º {$factura->idFactura}.");

            }
        // }

        $this->info('No hay vencimientos sin notificar');
    }
}

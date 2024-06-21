<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento Soporte de Pago Nómina Electrónica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 10px;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header, .section, .footer {
            border: 1px solid #333;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 20px;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .header-text {
            text-align: left;
            padding-left: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 14px;
        }
        .header h2 {
            margin: 0;
            font-size: 12px;
            color: #007bff;
        }
        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .col-half {
            width: 48%;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .table th, .table td {
            border: 1px solid #333;
            padding: 5px;
            text-align: left;
            font-size: 10px;
        }
        .table th {
            background-color: #007bff;
            color: #fff;
            text-align: center;
        }
        .table tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
        .footer-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer-col {
            width: 48%;
        }
        .total {
            font-weight: bold;
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .highlight {
            background-color: #ffeb3b;
            padding: 10px;
            border-radius: 5px;
            font-size: 12px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <div class="header-text">
            <h1>EMPRESA CAPACITACION S.A.</h1>
            <h2>Nit 100313819</h2>
            <p>Documento soporte de pago nómina electrónica</p>
        </div>
    </div>

    <div class="section">
        <div class="row">
            <div class="col-half">
                <strong>Período de Pago:</strong> 10/12/2022 - 30/01/2022<br>
                <strong>Comprobante Número:</strong> 1
            </div>
            <div class="col-half text-right">
                <strong>Fecha Generación:</strong> 30/01/2022<br>
                <strong>Fecha Emisión:</strong> 30/01/2022
            </div>
        </div>
        <div class="row">
            <div class="col-half">
                <strong>Nombre:</strong> SUSANA NES SHOPENHAWEN<br>
                <strong>Cargo:</strong> AUXILIAR DE EDICIÓN<br>
                <strong>Salario básico:</strong> 1,550,000
            </div>
            <div class="col-half text-right">
                <strong>Identificación:</strong> 32,582,545
            </div>
        </div>
    </div>

    <div class="section">
        <table class="table">
            <thead>
                <tr>
                    <th colspan="3">INGRESOS</th>
                    <th colspan="3">DEDUCCIONES</th>
                </tr>
                <tr>
                    <th>Concepto</th>
                    <th>Cantidad</th>
                    <th>Valor</th>
                    <th>Concepto</th>
                    <th>Cantidad</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sueldo</td>
                    <td>28.00</td>
                    <td>$1,446,666.00</td>
                    <td>Fondo de Salud</td>
                    <td>1.00</td>
                    <td>$62,000.00</td>
                </tr>
                <tr>
                    <td>Auxilio de Transporte</td>
                    <td>28.00</td>
                    <td>$1,509,351.00</td>
                    <td>Fondo de Pensión</td>
                    <td>1.00</td>
                    <td>$62,000.00</td>
                </tr>
                <tr>
                    <td>Incapacidad Empleada</td>
                    <td>28.00</td>
                    <td>$103,333.00</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" class="total">Total Ingresos</td>
                    <td>$1,859,350.00</td>
                    <td colspan="2" class="total">Total Deducciones</td>
                    <td>$124,000.00</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="section highlight">
        <div class="text-center">
            <strong>NETO A PAGAR</strong>
            <h1>$1,535,360.00</h1>
        </div>
    </div>

    <div class="footer">
        <div class="footer-row">
            <div class="footer-col">
                <strong>Medio de pago:</strong> Transferencia Bancaria<br>
                <strong>Fecha de pago:</strong> 31/01/2022
            </div>
            <div class="footer-col text-right">
                <div class="qr-code">
                    <!-- Placeholder for QR code -->
                    <img src="qr_code_placeholder.png" alt="QR Code">
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

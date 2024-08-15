<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #000;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .invoice-container {
            width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #0B6FAE;
            padding-bottom: 20px;
        }

        header .company-info {
            width: 70%;
        }

        header .company-info h1 {
            margin: 0;
            color: #0B6FAE;
        }

        header .company-info p {
            margin: 5px 0;
        }

        header .logo {
            width: 30%;
            text-align: right;
            background-color: #0B6FAE;
            color: white;
            padding: 10px;
            font-weight: bold;
        }

        .invoice-details {
            margin: 20px 0;
        }

        .invoice-number {
            margin-bottom: 20px;
        }

        .billing-shipping-container {
            display: flex;
            justify-content: space-between;
        }

        .billing-info, .shipping-info {
            width: 48%;
        }

        .billing-info strong, .shipping-info strong {
            color: #0B6FAE;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th, .items-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        .items-table th {
            background-color: #0B6FAE;
            color: white;
        }

        .summary {
            text-align: right;
            margin-bottom: 20px;
        }

        .summary p {
            margin: 5px 0;
        }

        .summary p strong {
            font-size: 1.2em;
            color: #0B6FAE;
        }

        footer {
            text-align: center;
            font-size: 0.9em;
            color: #555;
            border-top: 3px solid #0B6FAE;
            padding-top: 20px;
        }

        footer strong {
            display: block;
            margin-top: 10px;
            color: #0B6FAE;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <header>
            <div class="company-info">
                <h1>PYMES HORUS OUTSOURCING</h1>
                <p>Carrera 52 {{'#'}} 42 -60, Medellin, Antioquia</p>
                <p>4487575 | 3208264325</p>
            </div>
            <div class="logo">
                <p>EL LOGOTIPO VA AQUÍ</p>
            </div>
        </header>

        <section class="invoice-details">
            <div class="invoice-number">
                <strong>FACTURA N.º 100</strong>
                <p>Fecha: 14/08/2024</p>
            </div>
        </section>

        <div class="billing-shipping-container">
            <div class="billing-info">
                <strong>FACTURAR A</strong>
                <p>Pepito perez</p>
                <p>Asesor : beta</p>
                <p>451315</p>
            </div>
            <div class="shipping-info">
                <strong>PARA</strong>
                <p>Descripción del producto</p>
            </div>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>DESCRIPCIÓN DEL ARTÍCULO</th>
                    <th>IMPORTE</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis, sunt repudiandae a asperiores ab tenetur numquam earum esse sapiente soluta, corporis iusto in reprehenderit nesciunt, ratione mollitia possimus consequatur laudantium!</td>
                    <td>15451588</td>
                </tr>
                <!-- Repite estas filas según necesites -->
            </tbody>
        </table>

        <div class="summary">
            <p>Subtotal: 0,00 €</p>
            <p>Tasa impositiva: 0,00 €</p>
            <p>Costes adicionales: 0,00 €</p>
            <p><strong>COSTO TOTAL: 0,00 €</strong></p>
        </div>

        <footer>
            <p>Todos los cheques se extenderán al nombre de Nombre de la compañía</p>
            <p>Si tiene preguntas sobre esta factura, póngase en contacto con:</p>
            <p>Nombre del contacto, número de teléfono, dirección de correo electrónico</p>
            <p><strong>GRACIAS POR SU CONFIANZA.</strong></p>
        </footer>
    </div>
</body>
</html>

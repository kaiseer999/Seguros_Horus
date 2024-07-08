
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Pago del Empleado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 5px;
            overflow: hidden;
        }
        .header {
            background-color: #ff8800;
            padding: 20px;
            text-align: center;
            color: #ffffff;
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            padding: 20px;
        }
        .content h1 {
            font-size: 22px;
            color: #333333;
        }
        .content p {
            font-size: 16px;
            color: #666666;
            line-height: 1.5;
        }
        .content h2 {
            font-size: 18px;
            color: #333333;
            margin-top: 20px;
        }
        .content ul {
            list-style-type: none;
            padding: 0;
        }
        .content ul li {
            font-size: 16px;
            color: #666666;
            line-height: 1.5;
            margin-bottom: 10px;
        }
        .button-container {
            text-align: center;
            margin: 20px 0;
        }
        .button-container a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #ff8800;
            color: #ffffff;
            border-radius: 5px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            HORUS
        </div>
        <div class="content">
            <h1>Detalles del Pago del Empleado</h1>
            <p>Estimado/a {{$name}},</p>
            <p>Espero que este mensaje te encuentre bien. Te escribo para informarte sobre los detalles de tu pago quincenal correspondiente a esta quincena. A continuación, encontrarás un desglose completo de tu pago y las deducciones aplicadas.</p>

            <p><strong>Fecha de Pago:</strong> {{ $pagoEmpleado->fechaDePagoNom }}</p>
            <p><strong>Sueldo Bruto:</strong> {{ $pagoEmpleado->SueldoBruto }}</p>
            <p><strong>Sueldo Neto:</strong> {{ $pagoEmpleado->SueldoNeto }}</p>

            <h2>Deducciones</h2>
            <ul>
                @foreach($deducciones as $deduccion)
                    <li><strong>Tipo de Deducción:</strong> {{ $deduccion['nombre'] }}</li>
                    <li><strong>Valor de la Deducción:</strong> {{ $deduccion['ValorDescuento'] }}</li>
                @endforeach
            </ul>

            <p>Es importante para nosotros asegurarnos de que comprendas cada componente de tu pago. Si tienes alguna pregunta o necesitas alguna aclaración adicional sobre estos detalles, no dudes en contactarnos. Estamos aquí para ayudarte.</p>

            <p>Agradecemos tu continuo esfuerzo y dedicación. Tu trabajo es fundamental para el éxito de nuestro equipo y queremos asegurarnos de que te sientas valorado/a y bien informado/a sobre todos los aspectos de tu pago.</p>

            <p>¡Gracias por tu trabajo y compromiso!</p>

            <p>Saludos cordiales,</p>
            <p>[Nombre del Remitente]<br>
               [Posición]<br>
               [Nombre de la Empresa]<br>
               [Contacto]</p>
        </div>
    </div>
</body>
</html>

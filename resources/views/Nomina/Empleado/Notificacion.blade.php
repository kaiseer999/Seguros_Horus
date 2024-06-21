<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correo de Bienvenida de Minty</title>
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
            <h1>¡Bienvenido, {{$name}}!</h1>
            <p>Nos complace darte la bienvenida al equipo de HORUS. Nuestra misión es ofrecer servicios excepcionales en el ámbito de la seguridad social, afiliaciones a riesgos laborales, salud, pensión y caja de compensación en Colombia. Estamos seguros de que tu incorporación será clave para alcanzar nuestros objetivos.</p>
            <p>Tu viaje con nosotros comienza ahora, y estamos comprometidos a apoyarte en cada paso del camino. Si tienes alguna pregunta o necesitas asistencia, no dudes en comunicarte con nosotros atraves de admonhorus2006@gmail.com.</p>
            <h2>Tu cuenta</h2>
            <p>Para comenzar, por favor inicia sesión en tu cuenta utilizando el botón a continuación. Esto te dará acceso a todos los recursos y herramientas que necesitas para desempeñar tu nuevo rol con éxito.</p>
            <div class="button-container">
                <a href="#">Iniciar sesión</a>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <style>
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
            }

            .button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #4CAF50;
                color: white;
                text-decoration: none;
                border-radius: 30px;
                text-align: center;
                width: fit-content;
                font-size: 24px;
                margin-bottom: 10px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                transition: background-color 0.3s ease;
            }

            .button:hover {
                background-color: #45a049;
            }

            .container-button {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class = "container">
            <p>Estimado/a,</p>
            <p>Nos dirigimos a usted para informarle que el dia de la fecha el mantenimientro porgramado con id nro: {{ $mantenimiento->id }} debe llevarse a cabo.</p>
            <h1>Detalles del mantenimiento programado</h1>
            <p>Titulo: {{ $mantenimiento->nombre }}</p>
            <p>Equipo: {{ $mantenimiento->equipo }}</p>
            <p>Frecuencia: {{ $mantenimiento->frecuencia }}</p>
            <p>Descripción: {{ $mantenimiento->descripcion }}</p>

            <div class="container-button">
                <br>
                <a href="http://intranet.lafedar/mantenimientoProgramado" class="button">Mantenimientos programados</a>
                <br>
            </div>

            <p>Saludos,</p>
            <p>Área de Mantenimiento</p>

        </div>
    </body>
</html>

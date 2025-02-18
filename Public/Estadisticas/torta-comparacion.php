<style>
h2{
    text-align: center;
    border-bottom: solid 1px white;
    padding-bottom: 10px;
    width: 100%;
}
</style>


<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include './Public/Consultas/recursos/conexion-bd.php';
if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}


$consulta = "SELECT 'Muebles_y_Enseres' AS tabla, COUNT(*) AS total FROM Muebles_y_Enseres UNION ALL SELECT 'equipos' AS tabla, COUNT(*) AS total FROM equipos UNION ALL SELECT 'otros' AS tabla, COUNT(*) AS total FROM otros ORDER BY total DESC;";
$respuesta = $con->query($consulta);

$data = [];

if ($respuesta) {
    while($row = $respuesta->fetch_assoc()){
        $data[] = $row;
    }
} else {
    die("Error en la consulta: " . $con->error);
}


$jsonData = json_encode($data);

?>

<head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

    <h2>Inventario</h2>
    <div class="content" style="width: 300px;">
            <canvas id="myChart3"></canvas>
    </div>

    
    <script>
    console.log(<?php $jsonData?>)
    var datos = <?php echo $jsonData; ?>;

    if (!Array.isArray(datos) || datos.length === 0) {
        console.error("No se recibieron datos válidos.");
    } else {
        var nombre = []; 
        var cantidad = []; 

        datos.forEach(item => {
            nombre.push(item.tabla);
            cantidad.push(item.total);
        });

        const ctx = document.getElementById('myChart3').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: nombre,
                datasets: [{
                    label: 'Cantidad',
                    data: cantidad,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(255, 205, 86, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    }
    </script>

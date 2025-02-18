<style>
  .es{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }

  .item{
    display: flex;
    justify-content: center;
    align-items: center;
    border-bottom: solid 1px black;
    width: 70%;
    gap: 20px;
  }

  img{
    width: 15%;
  }

  h5{
    font-size: 30px;
  }
</style>
<?php
include './Public/Consultas/recursos/conexion-bd.php';
if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}


$sql = "SELECT COUNT(DISTINCT oficina) AS total FROM (SELECT oficina FROM equipos UNION SELECT oficina FROM Muebles_y_Enseres UNION SELECT oficina FROM otros) AS ciudades;";
$result = $con->query($sql);

if ($result) {
    $row = $result->fetch_assoc();

    echo "
    
    <div class=\"es\">
        <div class=\"item\">
            <img src=\"/styles/source/mano.png\">
            <h5>Empleados</h5>
        </div> 
        <h4>{$row['total']}</h4>
    </div>";

} else {
    echo "Error en la consulta: " . $con->error;
}


$con->close();
?>

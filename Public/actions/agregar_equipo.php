
<?php

$nombre_equipo = $_POST['nombre_equipo'];
$serial = $_POST['serial'];
$oficina = $_POST['oficina'];
$asignado = $_POST['asignado'];
$no_de_acta = $_POST['no_de_acta'];

try{
    include './Public/Consultas/recursos/conexion-bd.php';
    $cons = "INSERT INTO equipos (serial, oficina, asignado, no_acta, nombre_equipo) VALUES ('$serial', '$oficina', '$asignado', '$no_de_acta', '$nombre_equipo')";
    $res = $con->query($cons);

    if(!$res){
        throw new Exception("error". $con->error);
    }else{
        header("Location: /descargar.php");
    }


}catch(Exception $e){
    $error = urldecode($e->getMessage()); 
    header("Location: ../error.php?msg=$error");
}

mysqli_close($con);
?>

<?php 
include './Public/Consultas/recursos/conexion-bd.php';
$cons = "INSERT INTO usuarios (cedula, nombre, correo, cargo) VALUES ('$cedula', '$nombre', '$correo', '$cargo')";
$res = $con->query($cons);

?>



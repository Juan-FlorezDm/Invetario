
<?php
if(isset($_POST['query'])) {
    $busqueda = $_POST['query'];
    
    include './recursos/conexion-bd.php';
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM usuarios WHERE cedula LIKE '%$busqueda%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<p>".$row['nombre']."</p>";
        }
    } else {
        echo "<p>No se encontraron resultados</p>";
    }

    $conn->close();
}
?>


<link rel="stylesheet" href="/styles/index.css">
<link rel="stylesheet" href="/styles/Editar.css">
<body>
<style>
    h1{
        text-align: center;
        color: white;
        border-bottom: solid 1px gray;
        }
    </style> 
    <div class="content_body">
        
        <?php
            include('nav.php');
        ?>
        
        <h1>Buscar Registro para eliminar</h1>
        <div class="con">
            <div class="contentframe">
             <form method="post" autocomplete="off">
                <label for="tabla">Tabla</label>
                <select name="tabla" id="tabla">
                    <option>equipos</option>
                    <option>usuarios</option>
                    <option value="Muebles_y_Enseres">mubles y enseres</option>
                    <option>otros</option>
                    <option style="display: none;" selected></option>
                </select>
                
                <label for="column">Selcciona porque lo quieres buscar</label>
                <select name="column" id="column">
                    <option>serial</option>
                    <option>cedula</option>
                    <option>oficina</option>
                    <option>asignado</option>
                    <option style="display: none;" selected></option>
                </select>
                <input type="text" name="entrada">
        
                <button type="submit" name="submit" class="buscar" value="submit">Buscar</button>
             </form>    
        
             <?php
include './Public/Consultas/recursos/conexion-bd.php';
if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $tabla = mysqli_real_escape_string($con, trim($_POST['tabla']));
    $column = mysqli_real_escape_string($con, trim($_POST['column']));
    $entrada = mysqli_real_escape_string($con, trim($_POST['entrada']));

    // Validar que los valores no estén vacíos
    if (empty($tabla) || empty($column) || empty($entrada)) {
        echo "Por favor, selecciona una tabla, columna e ingresa un valor";
    } else {
        $consulta = "SELECT * FROM $tabla WHERE $column='$entrada'";
        $respuesta = $con->query($consulta);

        if (!$respuesta) {
            echo "Esa no es una consulta válida.";
        } elseif ($respuesta->num_rows > 0) {
            echo "<h3>Resultados:</h3>";
            echo "<div class='res'>";
            echo "<div class='table-container'>";
            echo "<table>";
            echo "<thead>";
            echo "<tr>";

            // Obtener nombres de los campos
            $campos = [];
            while ($campo = $respuesta->fetch_field()) {
                $campos[] = $campo->name;
                echo "<th>{$campo->name}</th>";
            }
            echo "<th>Acción</th>"; // Columna para eliminar
            echo "</tr>";
            echo "<thead>";

            // Obtener clave primaria de la tabla
            $pk_query = $con->query("SHOW KEYS FROM $tabla WHERE Key_name = 'PRIMARY'");
            $pk_row = $pk_query->fetch_assoc();
            $primaryKey = $pk_row['Column_name'] ?? null; 

            echo "<tbody>";
            while ($fila = $respuesta->fetch_assoc()) {
                echo "<tr>";
                foreach ($fila as $valor) {
                    echo "<td>$valor</td>";
                }

                // Formulario para eliminar
                echo "<td>
                        <form method='POST' style='margin: 0; padding: 0; border:0; background-color: transparent;'>
                            <input style='background-color: transparent;' type='hidden' name='tabla' value='{$tabla}'>
                            <input style='background-color: transparent;' type='hidden' name='primaryKey' value='{$primaryKey}'>
                            <input style='background-color: transparent;' type='hidden' name='entrada' value='{$fila[$primaryKey]}'>
                            <button type='submit' name='Eliminar' class='btnedit'>Eliminar</button>
                        </form>
                    </td>";

                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "<p>No hay resultados para '$entrada' en la tabla '$tabla'</p>";
        }
    }
}
            if (isset($_POST['Eliminar'])) {
                $tabla = isset($_POST['tabla']) ? mysqli_real_escape_string($con, $_POST['tabla']) : null;
                $primaryKey = isset($_POST['primaryKey']) ? mysqli_real_escape_string($con, $_POST['primaryKey']) : null;
                $entrada = isset($_POST['entrada']) ? mysqli_real_escape_string($con, $_POST['entrada']) : null;

                if (!empty($tabla) && !empty($primaryKey) && !empty($entrada)) {
                    $consultaeli = "DELETE FROM $tabla WHERE $primaryKey='$entrada'";
                    $respuestaeli = $con->query($consultaeli);

                    if ($respuestaeli) {
                        echo "<p>Registro eliminado correctamente</p>";
                    } else {
                        echo "<p>Error al eliminar el registro.</p>";
                    }
                } else {
                    echo "<p>Error: Datos inválidos para eliminar</p>";
                }   
            }
?>
            </div>
        </div>
        
    </div>
</body>

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
    <div class="content_body" >
        <?php
                include 'nav.php';
            ?>  
        <h1>Buscar Registro</h1>
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
                
                        <button type="submit" name="submit" value="submit" class="buscar">Buscar</button>
                    </form>    
                
                    <?php
                    include './Public/Consultas/recursos/conexion-bd.php';
                    if (!$con) {
                        die("Error de conexión: " . mysqli_connect_error());
                    }
                    
                    
                    if (isset($_POST['editar'])) {
                        $tabla = $_POST['tabla'];
                        $primaryKey = $_POST['primaryKey']; 
                        $primaryValue = $_POST['primaryValue']; 
                    
                        $valores_actualizados = $_POST['campo'];
                    
                        
                        $consulta_campos = "SHOW COLUMNS FROM $tabla";
                        $resultado_campos = $con->query($consulta_campos);
    
                        $campos = [];
                        $i = 0;
                    
                        while ($fila = $resultado_campos->fetch_assoc()) {
                            $columna = $fila['Field'];
                            $valor = $valores_actualizados[$i];
                            $campos[] = "$columna = '$valor'";
                            $i++;
                        }
                    
                        $set_update = implode(", ", $campos);
                        $consulta_update = "UPDATE $tabla SET $set_update WHERE $primaryKey = '$primaryValue'";
                    
                        if ($con->query($consulta_update) === TRUE) {
                            echo "Registro actualizado correctamente";
                        } else {
                            echo "Error al actualizar: " . $con->error;
                        }
                    }
                    
                    
                    if (isset($_POST['submit'])) {
                        $tabla = trim($_POST['tabla']);
                        $column = trim($_POST['column']);
                        $entrada = trim($_POST['entrada']);
                    
                        $consulta = "SELECT * FROM $tabla WHERE $column='$entrada'";
                        $respuesta = $con->query($consulta);
                    
                        if (!$respuesta) {
                            echo "Esa no es una consulta válida";
                        } elseif ($respuesta->num_rows > 0) {
                            echo "<h3>Resultados:</h3>";
                            
                            echo "<div class='res'>";
                            echo "<div class='table-container'>";
                            echo "<table>";
                            echo "<thead>";
                            echo "<tr>";
                    
                    
                            $campos = [];
                            while ($campo = $respuesta->fetch_field()) {
                                $campos[] = $campo->name;
                                echo "<th>{$campo->name}</th>";
                            }
                            echo "<th>      </th>";
                            echo "</tr>";
                            echo "<thead>";
                    
                            $pk_query = $con->query("SHOW KEYS FROM $tabla WHERE Key_name = 'PRIMARY'");
                            $pk_row = $pk_query->fetch_assoc();
                            $primaryKey = $pk_row['Column_name'];
                            echo "<tbody>";
                            while ($fila = $respuesta->fetch_assoc()) {
                                echo "<tr><form method='post'>";
                                foreach ($fila as $key => $valor) {
                                    echo "<td><input type='text' name='campo[]' value='$valor'></td>";
                                }
                    
                                
                                echo "<input type='hidden' name='tabla' value='$tabla'>";
                                echo "<input type='hidden' name='primaryKey' value='$primaryKey'>";
                                echo "<input type='hidden' name='primaryValue' value='{$fila[$primaryKey]}'>";
                    
                                echo "<td>
                                        <button type='submit' name='editar' class='btnedit'>Editar</button>
                                    </td>";
                                echo "</form></tr>";
                            }

                            echo "</tbody>";
                            echo "</table>";
                            echo "</div>";
                        } else {
                            echo "<p>No hay resultados para '$entrada' en la tabla '$tabla'</p>";
                        }
                    }
                    ?>
                </div>
            </div>
    </div>
</body>



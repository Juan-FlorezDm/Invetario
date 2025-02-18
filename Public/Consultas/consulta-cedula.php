<link rel="stylesheet" href="./recursos/tablas.css">

  <div class="contentframe">
        <h1>Busqueda en base de datos</h1>
            <form action="" method="POST" autocomplete="off">
                <div class="ingresar">
                    <input type="text" name="entrada" placeholder="Cedula , Nombre , Correo">
                    <button type="submit">Enviar</button>
                </div>
            
                <?php
                    $entrada = $_POST['entrada'];
                    $cedula = trim(rtrim($entrada));
                    try {
                        
                        include './recursos/conexion-bd.php';

                        if (!is_int($cedula)) {
                            $consultaPK = "SELECT * FROM usuarios WHERE cedula='$cedula' OR nombre='$cedula' OR correo='$cedula'";
                            $resp = $con->query($consultaPK);
                        
                            if ($resp->num_rows > 0) {
                                while ($rowPK = $resp->fetch_assoc()) {
                                    $resPK = $rowPK['cedula'];
                                    $cedula = $resPK;
                                }
                            }
                        }
                            
        
                        $consulta = "select * from equipos where asignado='$cedula'";
                        $consulta2 = "select * from Muebles_y_Enseres where asignado='$cedula'";
                        $consulta3 = "select * from otros where asignado='$cedula'";
                        $res = $con->query($consulta);
                        $res2 = $con->query($consulta2);
                        $res3 = $con->query($consulta3);

            
                        if (!$res) {
                            throw new Exception("Error en la consulta: " . $con->error);
                        } elseif ($res->num_rows > 0) {
                            echo "
                            <h3>Equipos</h3>
                            <div class='table-container'>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Oficina</th>
                                            <th>Asignado</th>
                                            <th>No de Acta</th>
                                            <th>Nombre equipo</th>
                                        </tr>
                                    </thead>";
                    
                            echo"<tbody> ";
                            while ($row = $res->fetch_assoc()) {
                                echo "
                                       
                                        <tr>
                                            <td>{$row['serial']}</td>
                                            <td>{$row['oficina']}</td>
                                            <td>{$row['asignado']}</td>
                                            <td>{$row['no_acta']}</td>
                                            <td>{$row['nombre_equipo']}</td>
                                        </tr>
                                    
                                    ";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            echo "</div>";
                        } else {
                            
                        }
                        


                        if (!$res2) {
                            throw new Exception("Error en la consulta: " . $con->error);
                        } elseif ($res2->num_rows > 0) {
                            // Imprimir tabla
                            echo "
                                    <h3>Mubles y Enseres</h3>
                                    <div class='table-container'>
                                        <table>
                                        <thead>
                                            <tr>
                                                <th>Serial</th>
                                                <th>Oficina</th>
                                                <th>Asignado</th>
                                                <th>No de Acta</th>
                                                <th>Descripcion</th>
                                            </tr>
                                        </thead>";
                            
                        
                            echo"<tbody>";
                            while ($row2 = $res2->fetch_assoc()) {
                                echo "
                                        <tr>
                                            <td>{$row2['serial']}</td>
                                            <td>{$row2['oficina']}</td>
                                            <td>{$row2['asignado']}</td>
                                            <td>{$row2['no_acta']}</td>
                                            <td>{$row2['descripcion']}</td>
                                        </tr>
                                    ";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            echo "</div>";
                        }
                
                        if (!$res3) {
                            throw new Exception("Error en la consulta: " . $con->error);
                        } elseif ($res3->num_rows > 0) {
                            // Imprimir tabla
                            echo "
                            <h3>otros</h3>
                            <div class='table-container'>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Oficina</th>
                                            <th>Asignado</th>
                                            <th>No de Acta</th>
                                            <th>detalle</th>
                                        </tr>
                                    </thead>
                                    ";
                    
                            echo "<tbody>";
                            while ($row3 = $res3->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row3['serial']}</td>
                                        <td>{$row3['oficina']}</td>
                                        <td>{$row3['asignado']}</td>
                                        <td>{$row3['no_acta']}</td>
                                        <td>{$row3['detalle']}</td>
                                    </tr>";
                            }
                            echo "</tbody";
                            echo "</table>";
                        } else {
                        
                        }
                        

                    } catch (Exception $e) {
                        $error = urlencode($e->getMessage());
                        header("Location: ../error.php?msg=$error");
                        exit();
                    }
                    
                    mysqli_close($con);
                ?>

            </form>
        </div>



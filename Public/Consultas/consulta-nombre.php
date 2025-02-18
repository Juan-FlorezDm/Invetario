<link rel="stylesheet" href="./recursos/tablas.css">
        <div class="contentframe">
            <h1>Ingrese Nombre Equipo</h1>
                <form action="" method="POST" autocomplete="off">
                    <div class="ingresar">
                        <input type="text" name="cedula" placeholder="MacBook">
                        <button type="submit">Enviar</button>
                    </div>
                <?php
                    $ent = $_POST['cedula'];
                    $entrada = trim(rtrim($ent));
                    try {
                        include './recursos/conexion-bd.php';
                        $consultaPK = "select * from equipos where nombre_equipo='$entrada'";
                        $res = $con->query($consultaPK);
        
        
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
                                    </thead>"
                                    ;
                                    echo"<tbody>";
                            while ($row = $res->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['serial']}</td>
                                        <td>{$row['oficina']}</td>
                                        <td>{$row['asignado']}</td>
                                        <td>{$row['no_acta']}</td>
                                        <td>{$row['nombre_equipo']}</td>
                                      </tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            echo "</div>";
                        } else {
                            
                        }
        
                    } catch (Exception $e) {
                        $error = urlencode($e->getMessage());
                        header("Location: ../error.php?msg=$error");
                        exit();
                    } catch (Exception $e) {
                        $error = urlencode($e->getMessage());
                        header("Location: ../error.php?msg=$error");
                        exit();
                    }
                    
                    mysqli_close($con);
                ?>
        
            </form>
        </div>

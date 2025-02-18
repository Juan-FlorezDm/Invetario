
<link rel="stylesheet" href="http://34.227.14.144/inventario-landing/styles/index.css">
<link rel="stylesheet" href="/styles/Editar.css">

<style>
    .centrar{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column; 
    }

    .login-container{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        height: 90%;
    }

    button{
        margin-top: 20px;
    }
    
    .form {
    width: 100%;
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    background: rgba(255, 255, 255, 0.473);
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    gap: 15px;
}
</style>

<div class="content_body">
    <div class="login-container">
        <div class="centrar">
            <form method="POST" class="form" >
                <div>
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" autocomplete="off">
                </div>
    
                <div>
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" autocomplete="off" >

                <div class="centrar">
                    <button class="submit" type="submit">Iniciar sesión</button>
                </div>
            </from>
        </div>  
    </div>


    <?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
    
    if (isset($_POST['submit'])){
include './Public/Consultas/recursos/conexion-bd.php';
        if (!$con) {
            die("Error de conexión: " . mysqli_connect_error()); // Muestra el error específico
        }


        $correo = trim(htmlspecialchars($_POST['correo']));
        $contraseña = trim($_POST['contraseña']);

        $stmt = $con->prepare("SELECT contraseña FROM login WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();

        echo $correo . $contraseña;
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hash = $row['contraseña'];

            if (password_verify($contraseña, $hash)) {
                header("Location: /index.php");
                exit();
            } else {
                echo "<h1>Su contraseña no es correcta</h1>";
            }
        } else {
            echo "<h1>No se encontró su usuario</h1>";
        }

        $stmt->close();
        $con->close();
    }
?>


</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing</title>
    <link rel="stylesheet" href="./Public/styles/index.css">
    <link rel="stylesheet" href="./Public/styles/Editar.css"">

<style>
    h1{
        text-align: center;
        color: white;
        border-bottom: solid 1px gray;
    }
</style>
</head>
<body>
    <div class="content_body">
        <?php
            include 'nav.php';
        ?>
        <h1>Datos</h1>
                <div class="contenido">
                    <div class="contentframe">
                        <div class="center">
                        <?php
                            include ('./Estadisticas/Iniciales/equipos.php');
                        ?>
                        </div>
                    </div>
            
                    <div class="contentframe">
                        <div class="center">

                        <?php
                            include ('./Estadisticas/Iniciales/cuidades.php');
                        ?>
                        </div>
                    </div>
                    <div class="contentframe">
                        <div class="center">

                        <?php
                            include ('./Estadisticas/Iniciales/empleados.php');
                        ?>
                        </div>
                    </div>
                </div>
            </div>
    

</body>
</html>
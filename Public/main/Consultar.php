<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta</title>
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/Agregar.css">
    
</head>
<style>
    h1{
        text-align: center;
        color: white;
        border-bottom: solid 1px gray;
    }
</style>
<body>
    <div class="content_body">
        <?php
            include('nav.php');
        ?>
        
        <h1>Hacer una consulta</h1>

        <div class="ubi">
                <section class="men-po">
                    <button class="change-content" data-url="./consultas/consulta-cedula.php">Cedula</button>
                    <button class="change-content" data-url="./consultas/consulta-serial.php">Serial</button>
                    <button class="change-content" data-url="./consultas/consulta-nombre.php">Nombre equipo</button>
                    <button class="change-content" data-url="./consultas/consulta-ubicacion.php">Ubicacion</button>
                </section>  

                <div class="content"><iframe id="contentFrame" src="" frameborder="0" width="100%" height="500px"></iframe></div>
        </div>

        <script>
            document.querySelectorAll(".change-content").forEach(button => {
            button.addEventListener("click", function () {
                let url = this.getAttribute("data-url");
                document.getElementById("contentFrame").src = url;
                });
            });
            
        </script>
        </div>
    </div>
</body>
</html>
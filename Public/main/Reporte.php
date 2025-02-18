
<link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/Editar.css">

<style>
    h1{
        text-align: center;
        color: white;
        border-bottom: solid 1px gray;
    }
</style>

<style>

</style>

<body>
    <div class="content_body">
        <?php 
            include 'nav.php';
        ?>
            <h1>Estadisticas</h1>
            <div class="contenido">
                <div class="contentframe">
                    <div class="center">
                    <?php
                        include ('./Estadisticas/torta-equipos.php');
                    ?>
                    </div>
                </div>
        
                <div class="contentframe">
                    <div class="center">

                    <?php
                        include ('./Estadisticas/torta-equipos-ubi.php');
                    ?>
                    </div>
                </div>
                <div class="contentframe">
                    <div class="center">

                    <?php
                        include ('./Estadisticas/torta-comparacion.php');
                    ?>
                    </div>
                </div>
            </div>
    </div>
</body>



</html>



<link rel="stylesheet" href="/styles/index.css">

<style>

    .co{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    button{
    width: 200px;
    background-color:  rgba(197, 162, 162, 0.479);
    height: 40px;
    border: solid 1px rgba(255, 255, 255, 0.616);
    outline: none;
    box-shadow: none;
    border-radius: 18px;
    }

    .content_body{
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>


<body>
    <div class="content_body">
        <div class="co">
            <h1>ocurrio un error porfavor vuelve a relaizar la accion</h1>
            <?php
                if(isset($_GET['msg'])){
                    echo "<p>el error es: ". htmlspecialchars($_GET['msg'])."</p>";
                }
            ?>
        
            <button onclick="window.location.href='index.php'">Volver</button>
        </div>

    </div>
</body>
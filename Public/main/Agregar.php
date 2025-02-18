<link rel="stylesheet" href="/styles/Agregar.css">
<link rel="stylesheet" href="/styles/index.css">
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
                include 'nav.php';
            ?>
        <h1>Ingresar</h1>
        <div class="ubi">
                <section class="men-po">
                    <button class="change-content" data-url="./html-registro/usuario.html">Usuario</button>
                    <button class="change-content" data-url="./html-registro/equipo.html">Equipos IT</button>
                    <button class="change-content" data-url="./html-registro/muebles.html">Muebles</button>
                    <button class="change-content" data-url="./html-registro/otro.html">Otro</button>
                </section>

                <div class="content"></div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const buttons = document.querySelectorAll(".change-content")
                const contentDiv = document.querySelector(".content")

                buttons.forEach(button => {
                    button.addEventListener("click", function () {
                        let url = this.getAttribute("data-url")

                        fetch(url)
                            .then(response => response.text())
                            .then(data => {
                                contentDiv.innerHTML = data
                            })
                            .catch(error => console.error("Error al cargar contenido:", error))
                    })
                })
            })

        </script>
    </div> 
</body>

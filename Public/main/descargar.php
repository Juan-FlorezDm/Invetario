
<link rel="stylesheet" href="/styles/index.css">
<link rel="stylesheet" href="/styles/Editar.css">

<style>
        button {
            padding: 10px 15px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            width: 10%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        button:hover {
            background-color: #0056b3;
        }

        .contenido{
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    </style>
</head>

<div class="content_body">
        <?php
            include 'nav.php';
        ?>
        <div class="contenido">
            <h2>Descargar acta</h2>
            <button onclick="">Descargar CSV</button>
        </div>
</div>





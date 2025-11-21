<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>CEC - Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Federo&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap');

        * {
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
        }

        body {
            background-image: linear-gradient(to right, #fd4463 10%, #0b76a8, #12bdeb);
            font-family: Poppins, Arial, Helvetica, sans-serif;
        }

        main {
            background-color: #e5e5e5;
            border-radius: 20px;
            padding: 10px;
            box-shadow: 2px 2px 5px #0000003e;
        }

        h3 {
            text-align: center;
            font-weight: bold;
        }

        .form-control {
            border-radius: 6px;
            margin-bottom: 20px;
            width: 300px;
        }

        label {
            margin-left: 5%;
        }

        #trocar-senha-enviar, #link_voltar {
            background-color: white;
        }

        #trocar-senha-enviar:hover, #link_voltar:hover {
            background-color: #c9c9c9ff;

        }

     
    </style>
</head>

<body class="d-flex py-4 bg-body-tertiary justify-content-center align-items-center">
    <?php
    include 'alert/alert.php'
    ?>
    <main class="h-auto">
        <!-- Formulário -->
        <form action="" class="py-3 px-2">
            <h3 class="mt-3 mb-3">Esqueceu a senha?</h3>

            <!--Input do email-->
            <div class="form-floating d-flex justify-content-center mx-3">
                <input type="email" class="form-control" name="email" id="floatingEmail" placeholder="seu-email@gmail.com" required>
                <label for="floatingEmail">E-mail</label>
            </div>

            <!--Input da senha TEM QUE VER SE TEM QUE MUDAR O NAME-->
            <div class="form-floating d-flex justify-content-center mx-3">
                <input type="password" class="form-control mb-4" name="senha" id="floatingSenha" placeholder="senha" required>
                <label for="floatingSenha">Nova senha</label>
            </div>

            <!--Confirmação da nova senha-->
            <div class="form-floating d-flex justify-content-center mx-3">
                <input type="password" class="form-control mb-4" name="senha" id="floatingSenha" placeholder="senha" required>
                <label for="floatingSenha">Confirmar senha</label>
            </div>


            <div class="div col-12 d-flex justify-content-end">
                <!--Botão de voltar-->
                <a href="index.php" class="btn text-black p-2 me-3" id="link_voltar">Voltar</a>

                <!--Botão de enviar-->
                <button type="submit" class="btn p-2 me-3" id="trocar-senha-enviar">Enviar</button>
            </div>

        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="script.js"></script>

</html>
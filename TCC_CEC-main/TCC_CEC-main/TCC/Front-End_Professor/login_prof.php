<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <title>CEC - Login</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Federo&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            margin: 0px;
            padding: 0px;
        }

        html, body {
            height: 100%; /*deixa o conteúdo no centro vertical e horizontal*/
        }


        body {
            background-image: linear-gradient(to right, #fd4463 10%, #0b76a8, #12bdeb);
            font-family: Poppins, Arial, Helvetica, sans-serif;
        }


        main {
            background-color: #e5e5e5;
            border-radius: 20px;
            padding: 10px; 
        }


        h3 {
            text-align: center;
        }

        
        .form-control { /*Inputs de login e senha*/
            border-radius: 6px;
            margin-bottom: 20px;
            width: 300px;
        }

        label {
            margin-left: 5%;
        }


        #login-acessar { /*Botão de avançar*/
            color: black;
        }


        #link_voltar {
            color: black;
            text-decoration: none;
        }


        #esqueci-senha {
            display: block;
            color: rgb(147, 147, 147);
        }
    </style>
</head>

<body class="d-flex py-4 bg-body-tertiary justify-content-center align-items-center">
    <main class="h-auto">
        <form action="" class="py-4 px-3">
            <h3 class="fw-bold a-center mb-3">Professor</h3>

            <!--Input do email-->
            <div class="form-floating d-flex justify-content-center">
                <input type="email" class="form-control" id="floatingInput" placeholder="seu-email@gmail.com">
                <label for="floatingInput">E-mail</label>
            </div>

            <!--Input da senha-->
            <div class="form-floating d-flex justify-content-center">
                <input type="password" class="form-control mb-1" id="floatingInput" placeholder="senha">
                <label for="floatingInput">Senha</label>
            </div>

            <!--Esqueci a senha-->
            <a href="" class="mb-3 d-flex justify-content-end small" id="esqueci-senha">Esqueci a senha</a>             

            <div class="div col-12 d-flex justify-content-end">
                <!--Botão de voltar-->
                <button class="btn p-2 bg-white me-3" id="voltar">
                    <a href="../index.php" id="link_voltar">Voltar</a>
                </button>

                <!--Botão de logar-->
                <button class="btn p-2 bg-white" id="login-acessar">
                    Acessar
                </button>
            </div>



        </form>
    </main>

    <?php 


    ?>
    
</body>
</html>
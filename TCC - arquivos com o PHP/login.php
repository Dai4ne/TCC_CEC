<?php
session_start();
include "Front-End_Admin/conect.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if (empty($email) || empty($senha)) {
        echo "<script>alert('Preencha todos os campos!'); window.location.href='login.php';</script>";
        exit;
    }

    $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha=SHA1('$senha')";
    $result = $con->query($sql);

    if ($result && $result->num_rows === 1) {
        $usuario = $result->fetch_assoc();

        $_SESSION['id_usuario']   = $usuario['id_usuario'];
        $_SESSION['nome_usuario'] = $usuario['nome'];
        $_SESSION['perfil']       = $usuario['tipo_usuario'];

        switch ($usuario['tipo_usuario']) {
            case '1':
                header("Location: Front-End_Admin/home_admin.php");
                break;
            case '2':
                header("Location: Front-End_Professor/home_prof.php");
                break;
            case '3':
                header("Location: Front-End_Inspetor/home_insp.php");
                break;
            default:
                header("Location: index.php");
        }
        exit;
    } else {
        echo "<script>alert('E-mail ou senha inválidos!'); window.location.href='login.php';</script>";
        exit;
    }
}
?>


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


        #esqueci-senha {
            display: block;
            color: rgb(147, 147, 147);
        }
    </style>
</head>

<body class="d-flex py-4 bg-body-tertiary justify-content-center align-items-center">
    <main class="h-auto">
        <!-- Formulário aponta para login.php -->
        <form action="login.php" method="post" class="py-4 px-3">
            <h3 class="fw-bold text-center mb-3">Inspetor</h3>
            <!--Input do email-->
            <div class="form-floating d-flex justify-content-center">
                <input type="email" class="form-control" name="email" id="floatingEmail" placeholder="seu-email@gmail.com" required>
                <label for="floatingEmail">E-mail</label>
            </div>

            <!--Input da senha-->
            <div class="form-floating d-flex justify-content-center">
                <input type="password" class="form-control mb-1" name="senha" id="floatingSenha" placeholder="senha" required>
                <label for="floatingSenha">Senha</label>
            </div>

            <!--Esqueci a senha-->
            <a href="" class="mb-3 d-flex justify-content-end small" id="esqueci-senha">Esqueci a senha</a>             

            <div class="div col-12 d-flex justify-content-end">
                <!--Botão de voltar-->
                <a href="index.php" class="btn text-black p-2 bg-white me-3" id="link_voltar">Voltar</a>

                <!--Botão de logar-->
                <button type="submit" class="btn p-2 bg-white" id="login-acessar">Acessar</button>
            </div>
        </form>
    </main>
</body>
</html>

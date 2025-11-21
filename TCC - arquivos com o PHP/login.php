<?php
session_start();
include "Front-End_Admin/conect.php";
include "functions.php";

// Pega o tipo passado na URL e valida
$tipoUsuario = $_GET['tipo'] ?? '';
$tiposValidos = ['administrador', 'professor', 'inspetor'];

if (!in_array(strtolower($tipoUsuario), $tiposValidos)) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if (empty($email) || empty($senha)) {
        echo "<script>
                alert('Preencha todos os campos!');
                window.location.href='login.php?tipo=" . urlencode($tipoUsuario) . "';
              </script>";
        exit;
    }

    // Proteção contra SQL Injection usando prepared statements
    $stmt = $con->prepare("SELECT * FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $usuario = $result->fetch_assoc();
        
        // Verifica se a senha está correta usando a função de verificação
        if (verifyPassword($senha, $usuario['senha'])) {
            // Cria as sessões corretas
            $_SESSION['id_usuario']   = $usuario['id_usuario'];
            $_SESSION['nome_usuario'] = $usuario['nome'];
            $_SESSION['perfil']       = $usuario['tipo'];

            // Redireciona baseado no tipo
            switch ($usuario['tipo']) {
                case '1':
                    $_SESSION['msg_alert'] = ['success', 'Login realizado com sucesso!'];
                    header("Location: Front-End_Admin/home_admin.php");
                    break;
                case '2':
                    $_SESSION['msg_alert'] = ['success', 'Login realizado com sucesso!'];
                    header("Location: Front-End_Professor/home_prof.php");
                    break;
                case '3':
                    $_SESSION['msg_alert'] = ['success', 'Login realizado com sucesso!'];
                    header("Location: Front-End_Inspetor/home_insp.php");
                    break;
                default:
                    header("Location: index.php");
            }
            exit;
        }
    }
    
    // Se chegou aqui, é porque o login falhou
    $_SESSION['msg_alert'] = ['danger', 'Email ou Senha Incorreto!'];
    header("Location: login.php?tipo=" . urlencode($tipoUsuario));
    exit;
}
?>

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

        html, body {
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
        }

        .form-control {
            border-radius: 6px;
            margin-bottom: 20px;
            width: 300px;
        }

        label {
            margin-left: 5%;
        }

        #login-acessar {
            background-color: white;
            color: black;
        }

        #link_voltar {
            background-color: white;
        }

        #login-acessar:hover, #link_voltar:hover{
            background-color: #c9c9c9ff ;
        }

        #esqueci-senha {
            display: block;
            color: #767676ff;
        }
    </style>
</head>

<body class="d-flex py-4 bg-body-tertiary justify-content-center align-items-center">
    <?php
    include 'alert/alert.php'
    ?>
    <main class="h-auto">
        <!-- Formulário -->
        <form action="login.php?tipo=<?= htmlspecialchars($tipoUsuario); ?>" method="post" class="py-3 px-3">
            <h3 class="fw-bold a-center mb-3 text-capitalize">
                <?= htmlspecialchars($tipoUsuario); ?>
            </h3>

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
            <a href="esqueceu_senha.php" class="mt-2 mb-3 d-flex justify-content-end small" id="esqueci-senha">Esqueci a senha</a>

            <div class="div col-12 d-flex justify-content-end">
                <!--Botão de voltar-->
                <a href="index.php" class="btn text-black p-2 me-3" id="link_voltar">Voltar</a>

                <!--Botão de logar-->
                <button type="submit" class="btn p-2" id="login-acessar">Acessar</button>
            </div>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="script.js"></script>

</html>
<?php
session_start();

/*
 * esqueceu_senha.php
 * - Propósito: permitir que um usuário altere a própria senha informando o e-mail e a nova senha.
 * - Observação importante: o fluxo atual verifica apenas se o e-mail existe e atualiza a senha
 *   imediatamente. Em produção é recomendado implementar um fluxo com token enviado por e-mail
 *   (link temporário) para evitar que terceiros alterem senhas apenas conhecendo o e-mail.
 * - Fluxo principal:
 *   1) Verifica método POST e inclui `conect.php` e `functions.php` para usar a conexão e helpers.
 *   2) Valida campos (email, senha, confirmação) e força de senha com `isPasswordStrong`.
 *   3) Busca usuário pelo e-mail usando prepared statement e, se existir, atualiza a senha
 *      armazenando um hash gerado por `createPasswordHash`.
 * - Segurança: usando hashing ao salvar a senha; recomenda-se também limitar tentativas e
 *   registrar auditoria para alterações de credenciais.
 */

// Processamento do formulário de troca de senha
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "Front-End_Admin/conect.php";
    include "functions.php";

    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
    $senha_confirm = trim($_POST['senha_confirm'] ?? '');

    if (empty($email) || empty($senha) || empty($senha_confirm)) {
        $_SESSION['msg_alert'] = ['danger', 'Preencha todos os campos!'];
        header('Location: esqueceu_senha.php');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['msg_alert'] = ['danger', 'E-mail inválido!'];
        header('Location: esqueceu_senha.php');
        exit;
    }

    if ($senha !== $senha_confirm) {
        $_SESSION['msg_alert'] = ['danger', 'As senhas não coincidem!'];
        header('Location: esqueceu_senha.php');
        exit;
    }

    // Verifica força da senha
    if (!isPasswordStrong($senha)) {
        $_SESSION['msg_alert'] = ['danger', 'A senha deve ter pelo menos 8 caracteres, incluindo maiúsculas, minúsculas, números e caracteres especiais.'];
        header('Location: esqueceu_senha.php');
        exit;
    }

    // Verificar se o email existe
    $stmt = $con->prepare("SELECT id_usuario FROM usuario WHERE email = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res && $res->num_rows === 1) {
            $row = $res->fetch_assoc();
            $id_usuario = intval($row['id_usuario']);

            // Atualizar a senha com hash seguro
            $senhaHash = createPasswordHash($senha);
            $upd = $con->prepare("UPDATE usuario SET senha = ? WHERE id_usuario = ?");
            if ($upd) {
                $upd->bind_param('si', $senhaHash, $id_usuario);
                if ($upd->execute()) {
                    $_SESSION['msg_alert'] = ['success', 'Senha alterada com sucesso. Faça login com a nova senha.'];
                    header('Location: login.php');
                    exit;
                }
            }
            $_SESSION['msg_alert'] = ['danger', 'Erro ao atualizar a senha. Tente novamente.'];
            header('Location: esqueceu_senha.php');
            exit;
        } else {
            $_SESSION['msg_alert'] = ['danger', 'E-mail não encontrado no sistema.'];
            header('Location: esqueceu_senha.php');
            exit;
        }
    } else {
        $_SESSION['msg_alert'] = ['danger', 'Erro na operação. Contate o administrador.'];
        header('Location: esqueceu_senha.php');
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
        <form action="esqueceu_senha.php" method="post" class="py-3 px-2">
            <h3 class="mt-3 mb-3">Esqueceu a senha?</h3>

            <!--Input do email-->
            <div class="form-floating d-flex justify-content-center mx-3">
                <input type="email" class="form-control" name="email" id="floatingEmail" placeholder="seu-email@gmail.com" required>
                <label for="floatingEmail">E-mail</label>
            </div>

            <!--Input da nova senha -->
            <div class="form-floating d-flex justify-content-center mx-3">
                <input type="password" class="form-control mb-4" name="senha" id="floatingSenha" placeholder="Nova senha" required oninput="validatePassword(this.value)">
                <label for="floatingSenha">Nova senha</label>
            </div>

            <!--Confirmação da nova senha-->
            <div class="form-floating d-flex justify-content-center mx-3">
                <input type="password" class="form-control mb-4" name="senha_confirm" id="floatingSenhaConfirm" placeholder="Confirmar senha" required>
                <label for="floatingSenhaConfirm">Confirmar senha</label>
            </div>

            <div class="mt-2 small text-center mx-3">
                <div id="password-length" class="text-danger">Mínimo de 8 caracteres</div>
                <div id="password-uppercase" class="text-danger">Pelo menos uma letra maiúscula</div>
                <div id="password-lowercase" class="text-danger">Pelo menos uma letra minúscula</div>
                <div id="password-number" class="text-danger">Pelo menos um número</div>
                <div id="password-special" class="text-danger">Pelo menos um caractere especial</div>
            </div>

            <div class="div col-12 d-flex justify-content-end mt-3">
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
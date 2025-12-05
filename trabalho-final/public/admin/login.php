<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../src/db.php';

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
    if ($login === '' || $senha === '') {
        $erro = 'Informe usuário e senha';
    } else {
        $conn = conectarBanco();
        if ($conn) {
            $loginEsc = pg_escape_string($conn, $login);
            // Buscar usuário por login
            $query_usuario = "SELECT id, nome, senha FROM usuarios_admin WHERE login='$loginEsc' LIMIT 1";
            $resultado_busca = pg_query($conn, $query_usuario);
            if ($resultado_busca) {
                $user = pg_fetch_assoc($resultado_busca);
                $hash = $user['senha'];
                $ok = password_verify($senha, $hash);
                if ($ok) {
                    $_SESSION['admin_id'] = $user['id'];
                    $_SESSION['admin_nome'] = $user['nome'];
                    header('Location: dashboard.php');
                    exit;
                } else {
                    $erro = 'Credenciais inválidas';
                }
            } else {
                $erro = 'Credenciais inválidas';
            }
            pg_close($conn);
        } else {
            $erro = 'Falha na conexão';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh
        }

        .form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            width: 300px
        }

        .form h1 {
            margin: 0 0 15px;
            font-size: 20px;
            text-align: center
        }

        .form input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px
        }

        .form button {
            width: 100%;
            padding: 10px;
            border: none;
            background: #4a148c;
            color: #fff;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer
        }

        .erro {
            color: #b00020;
            font-size: 14px;
            margin: 5px 0;
            text-align: center
        }

        .link {
            margin-top: 10px;
            text-align: center
        }
    </style>
</head>

<body>
    <div class="form">
        <h1>Painel</h1>
        <?php if ($erro) {
            echo '<div class="erro">' . $erro . '</div>';
        } ?>
        <form method="post">
            <input type="text" name="login" placeholder="Usuário" autocomplete="off">
            <input type="password" name="senha" placeholder="Senha">
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>

</html>
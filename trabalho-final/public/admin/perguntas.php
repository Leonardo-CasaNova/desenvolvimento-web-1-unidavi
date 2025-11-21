<?php
require_once __DIR__ . '/inc/auth.php';
require_once __DIR__ . '/../../src/perguntas.php';

$acao = $_GET['acao'] ?? '';
$msg = '';

if ($acao === 'nova' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $texto = $_POST['texto'] ?? '';
    $ordem = $_POST['ordem'] ?? 0;
    if (trim($texto) !== '') {
        if (criarPergunta($texto, $ordem)) {
            $msg = 'Pergunta criada';
        } else {
            $msg = 'Erro ao criar';
        }
    } else {
        $msg = 'Texto obrigatório';
    }
}
if ($acao === 'editar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_GET['id'] ?? 0);
    $texto = $_POST['texto'] ?? '';
    $ordem = $_POST['ordem'] ?? 0;
    $status = $_POST['status'] ?? 'ativa';
    if ($id > 0 && trim($texto) !== '') {
        if (atualizarPergunta($id, $texto, $ordem, $status)) {
            $msg = 'Atualizada';
        } else {
            $msg = 'Erro';
        }
    } else {
        $msg = 'Dados inválidos';
    }
}
if ($acao === 'excluir') {
    $id = (int)($_GET['id'] ?? 0);
    if ($id > 0) {
        excluirPergunta($id);
        $msg = 'Excluída';
    }
}

$lista = listarPerguntas();
$editarId = ($acao === 'editar') ? (int)($_GET['id'] ?? 0) : 0;
$editarDados = $editarId ? obterPergunta($editarId) : null;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Perguntas</title>
    <style>
        body {
            font-family: Arial;
            margin: 0;
            background: #fafafa;
            color: #333
        }

        header {
            background: #4a148c;
            color: #fff;
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center
        }

        nav a {
            color: #fff;
            margin-right: 12px;
            text-decoration: none;
            font-size: 14px
        }

        .container {
            padding: 15px;
            max-width: 900px;
            margin: 0 auto
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 6px;
            font-size: 14px;
            text-align: left
        }

        .table th {
            background: #eee
        }

        form.box {
            background: #fff;
            padding: 12px;
            margin: 15px 0;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, .1)
        }

        input[type=text],
        input[type=number],
        select {
            width: 100%;
            padding: 8px;
            margin: 6px 0;
            border: 1px solid #ccc;
            border-radius: 4px
        }

        button {
            padding: 8px 14px;
            border: none;
            background: #4a148c;
            color: #fff;
            border-radius: 4px;
            cursor: pointer
        }

        .msg {
            color: #00695c;
            margin: 10px 0;
            font-size: 14px
        }

        .actions a {
            margin-right: 8px;
            font-size: 12px
        }
    </style>
</head>

<body>
    <header>
        <div><strong>Perguntas</strong></div>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="perguntas.php">Perguntas</a>
            <a href="logout.php">Sair</a>
        </nav>
    </header>
    <div class="container">
        <?php if ($msg) echo '<div class="msg">' . $msg . '</div>'; ?>
        <h2>Lista</h2>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Texto</th>
                <th>Ordem</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($lista as $p) {
                echo '<tr><td>' . $p['id'] . '</td><td>' . htmlspecialchars($p['texto']) . '</td><td>' . $p['ordem'] . '</td><td>' . $p['status'] . '</td><td class="actions">';
                echo '<a href="?acao=editar&id=' . $p['id'] . '">Editar</a>';
                echo '<a href="?acao=excluir&id=' . $p['id'] . '" onclick="return confirm(\'Excluir?\')">Excluir</a>';
                echo '</td></tr>';
            }
            ?>
        </table>
        <h2><?php echo $editarDados ? 'Editar' : 'Nova'; ?> Pergunta</h2>
        <form method="post" class="box" action="?acao=<?php echo $editarDados ? 'editar&id=' . $editarId : 'nova'; ?>">
            <label>Texto</label>
            <input type="text" name="texto" value="<?php echo $editarDados ? htmlspecialchars($editarDados['texto']) : ''; ?>">
            <label>Ordem</label>
            <input type="number" name="ordem" value="<?php echo $editarDados ? (int)$editarDados['ordem'] : 0; ?>">
            <?php if ($editarDados) { ?>
                <label>Status</label>
                <select name="status">
                    <option value="ativa" <?php echo $editarDados['status'] === 'ativa' ? 'selected' : ''; ?>>ativa</option>
                    <option value="inativa" <?php echo $editarDados['status'] === 'inativa' ? 'selected' : ''; ?>>inativa</option>
                </select>
            <?php } ?>
            <button type="submit">Salvar</button>
        </form>
    </div>
</body>

</html>
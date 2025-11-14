<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../src/respostas.php';
require_once __DIR__ . '/../src/funcoes.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirecionar('index.php');
}

$respostas = isset($_POST['resposta']) ? $_POST['resposta'] : array();
$feedback = isset($_POST['feedback']) ? $_POST['feedback'] : null;

if (empty($respostas)) {
    redirecionar('index.php?erro=1');
}

$sucessoTotal = true;
$feedbackSalvo = false;

foreach ($respostas as $id_pergunta => $resposta) {
    if (!$feedbackSalvo && $feedback && trim($feedback) !== '') {
        $sucesso = salvarAvaliacao($id_pergunta, $resposta, $feedback);
        $feedbackSalvo = true;
    } else {
        $sucesso = salvarAvaliacao($id_pergunta, $resposta);
    }
    
    if (!$sucesso) {
        $sucessoTotal = false;
    }
}

if ($sucessoTotal) {
    redirecionar('obrigado.php');
} else {
    redirecionar('index.php?erro=2');
}
?>

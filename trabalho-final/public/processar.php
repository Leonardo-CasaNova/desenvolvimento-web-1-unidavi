<?php
/**
 * Processamento das respostas do formulário
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../src/respostas.php';
require_once __DIR__ . '/../src/funcoes.php';

// Verificar se é POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirecionar('index.php');
}

// Processar respostas
$respostas = isset($_POST['resposta']) ? $_POST['resposta'] : array();
$feedback = isset($_POST['feedback']) ? $_POST['feedback'] : null;

// Validar se há respostas
if (empty($respostas)) {
    redirecionar('index.php?erro=1');
}

$sucessoTotal = true;
$feedbackSalvo = false;

// Salvar cada resposta no banco de dados
foreach ($respostas as $id_pergunta => $resposta) {
    // Para a primeira resposta, incluir o feedback se houver
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

// Redirecionar para página de agradecimento
if ($sucessoTotal) {
    redirecionar('obrigado.php');
} else {
    redirecionar('index.php?erro=2');
}
?>

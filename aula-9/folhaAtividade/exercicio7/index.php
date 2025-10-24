<?php
function calcularJuros($valorVista, $parcelas, $valorParcela) {
    $valorTotal = $parcelas * $valorParcela;
    return $valorTotal - $valorVista;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valorVista = floatval($_POST['valor_vista']);
    $parcelas = intval($_POST['parcelas']);
    $valorParcela = floatval($_POST['valor_parcela']);
    
    $valorTotal = $parcelas * $valorParcela;
    $juros = calcularJuros($valorVista, $parcelas, $valorParcela);
    
    echo "<h1>Resultado</h1>";
    echo "<div style='margin-top: 20px;'>";
    echo "<p><strong>Valor à vista:</strong> R$ " . number_format($valorVista, 2, ',', '.') . "</p>";
    echo "<p><strong>Valor total financiado:</strong> R$ " . number_format($valorTotal, 2, ',', '.') . "</p>";
    echo "<p><strong>Total de juros pagos:</strong> R$ " . number_format($juros, 2, ',', '.') . "</p>";
    echo "</div>";
    echo "<br><a href='index.html'>Voltar</a>";
} else {
    header('Location: index.html');
    exit;
}
?>

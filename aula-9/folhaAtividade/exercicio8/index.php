<?php
function calcularJurosSimples($capital, $taxa, $tempo) {
    $montante = $capital * (1 + ($taxa / 100) * $tempo);
    return $montante;
}

function calcularParcela($montante, $numeroParcelas) {
    return $montante / $numeroParcelas;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valorVista = floatval($_POST['valor_vista']);
    
    $opcoes = [
        ['parcelas' => 24, 'taxa' => 1.5],
        ['parcelas' => 36, 'taxa' => 2.0],
        ['parcelas' => 48, 'taxa' => 2.5],
        ['parcelas' => 60, 'taxa' => 3.0]
    ];
    
    echo "<h1>Resultado - Juros Simples</h1>";
    echo "<div style='margin-top: 20px;'>";
    echo "<p><strong>Valor à vista:</strong> R$ " . number_format($valorVista, 2, ',', '.') . "</p>";
    echo "<table border='1' style='width: 100%; border-collapse: collapse; margin-top: 15px;'>";
    echo "<tr><th style='padding: 10px; background-color: #4CAF50; color: white;'>Parcelas</th><th style='padding: 10px; background-color: #4CAF50; color: white;'>Taxa (%)</th><th style='padding: 10px; background-color: #4CAF50; color: white;'>Montante Total</th><th style='padding: 10px; background-color: #4CAF50; color: white;'>Valor da Parcela</th></tr>";
    
    foreach ($opcoes as $opcao) {
        $montante = calcularJurosSimples($valorVista, $opcao['taxa'], $opcao['parcelas']);
        $valorParcela = calcularParcela($montante, $opcao['parcelas']);
        
        echo "<tr>";
        echo "<td style='padding: 10px; text-align: center;'>" . $opcao['parcelas'] . "x</td>";
        echo "<td style='padding: 10px; text-align: center;'>" . number_format($opcao['taxa'], 1, ',', '.') . "%</td>";
        echo "<td style='padding: 10px; text-align: center;'>R$ " . number_format($montante, 2, ',', '.') . "</td>";
        echo "<td style='padding: 10px; text-align: center;'>R$ " . number_format($valorParcela, 2, ',', '.') . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    echo "</div>";
    echo "<br><a href='index.html'>Voltar</a>";
} else {
    header('Location: index.html');
    exit;
}
?>

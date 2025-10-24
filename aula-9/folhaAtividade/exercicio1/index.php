<?php
function calcularSoma($v1, $v2, $v3) {
    return $v1 + $v2 + $v3;
}

function determinarCor($v1, $v2, $v3) {
    if ($v1 > 10) {
        return 'blue';
    }
    if ($v2 < $v3) {
        return 'green';
    }
    if ($v3 < $v1 && $v3 < $v2) {
        return 'red';
    }
    return 'black';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valor1 = floatval($_POST['valor1']);
    $valor2 = floatval($_POST['valor2']);
    $valor3 = floatval($_POST['valor3']);
    
    $soma = calcularSoma($valor1, $valor2, $valor3);
    $cor = determinarCor($valor1, $valor2, $valor3);
    
    echo "<h1>Resultado da Soma</h1>";
    echo "<div style='color: $cor; font-size: 20px; font-weight: bold; margin-top: 20px;'>";
    echo "Resultado: $soma";
    echo "</div>";
    echo "<br><a href='index.html'>Voltar</a>";
} else {
    header('Location: index.html');
    exit;
}
?>

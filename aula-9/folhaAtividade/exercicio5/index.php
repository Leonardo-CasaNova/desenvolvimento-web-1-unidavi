<?php
function calcularAreaTriangulo($base, $altura) {
    return ($base * $altura) / 2;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $base = floatval($_POST['base']);
    $altura = floatval($_POST['altura']);
    $area = calcularAreaTriangulo($base, $altura);
    
    echo "<h1>Resultado</h1>";
    echo "<div style='font-size: 18px; margin-top: 20px;'>";
    echo "A área do triângulo retângulo com base $base metros e altura $altura metros é $area metros quadrados";
    echo "</div>";
    echo "<br><a href='index.html'>Voltar</a>";
} else {
    header('Location: index.html');
    exit;
}
?>

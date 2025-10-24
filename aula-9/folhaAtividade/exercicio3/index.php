<?php
function calcularAreaQuadrado($lado) {
    return $lado * $lado;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lado = floatval($_POST['lado']);
    $area = calcularAreaQuadrado($lado);
    
    echo "<h1>Resultado</h1>";
    echo "<div style='font-size: 18px; margin-top: 20px;'>";
    echo "A área do quadrado de lado $lado metros é $area metros quadrados";
    echo "</div>";
    echo "<br><a href='index.html'>Voltar</a>";
} else {
    header('Location: index.html');
    exit;
}
?>

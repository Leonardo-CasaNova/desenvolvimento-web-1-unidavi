<?php
function calcularAreaRetangulo($ladoA, $ladoB) {
    return $ladoA * $ladoB;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ladoA = floatval($_POST['lado_a']);
    $ladoB = floatval($_POST['lado_b']);
    $area = calcularAreaRetangulo($ladoA, $ladoB);
    
    $frase = "A área do retângulo de lados $ladoA e $ladoB metros é $area metros quadrados.";
    
    if ($area > 10) {
        echo "<h1>$frase</h1>";
    } else {
        echo "<h3>$frase</h3>";
    }
    echo "<br><a href='index.html'>Voltar</a>";
} else {
    header('Location: index.html');
    exit;
}
?>

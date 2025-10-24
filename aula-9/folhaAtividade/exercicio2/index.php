<?php
function verificarDivisivel($numero) {
    if ($numero % 2 == 0) {
        return "Valor divisível por 2";
    } else {
        return "O valor não é divisível por 2";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero = intval($_POST['numero']);
    $resultado = verificarDivisivel($numero);
    
    echo "<h1>Resultado</h1>";
    echo "<div style='font-size: 18px; margin-top: 20px;'>";
    echo $resultado;
    echo "</div>";
    echo "<br><a href='index.html'>Voltar</a>";
} else {
    header('Location: index.html');
    exit;
}
?>

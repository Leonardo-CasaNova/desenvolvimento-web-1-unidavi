<?php
function exibirArvore($array, $nivel = 0) {
    $resultado = "";
    foreach ($array as $chave => $valor) {
        $prefixo = str_repeat("- ", $nivel);
        
        if (is_array($valor)) {
            $resultado .= $prefixo . "- " . $chave . "<br>";
            $resultado .= exibirArvore($valor, $nivel + 1);
        } else {
            $resultado .= $prefixo . "- " . $valor . "<br>";
        }
    }
    return $resultado;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' || true) {
    $pastas = array(
        "bsn" => array(
            "3a Fase" => array(
                "desenvWeb",
                "bancoDados 1",
                "engSoft 1"
            ),
            "4a Fase" => array(
                "Intro Web",
                "bancoDados 2",
                "engSoft 2"
            )
        )
    );
    
    echo "<h1>Estrutura de Pastas</h1>";
    echo "<div style='margin-top: 20px;'>";
    echo exibirArvore($pastas);
    echo "</div>";
    echo "<br><a href='index.html'>Voltar</a>";
} else {
    header('Location: index.html');
    exit;
}
?>

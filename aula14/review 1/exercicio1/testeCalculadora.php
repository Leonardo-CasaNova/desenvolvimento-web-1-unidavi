<?php

require_once 'Calculadora.php';

$calc = new Calculadora();

echo "<h2>Teste da Classe Calculadora</h2>";

$num1 = 10;
$num2 = 5;

echo "<p>Números utilizados: $num1 e $num2</p>";

echo "<p>Soma: " . $calc->somar($num1, $num2) . "</p>";

echo "<p>Subtração: " . $calc->subtrair($num1, $num2) . "</p>";

echo "<p>Multiplicação: " . $calc->multiplicar($num1, $num2) . "</p>";

try {
    echo "<p>Divisão: " . $calc->dividir($num1, $num2) . "</p>";
} catch (Exception $e) {
    echo "<p>Erro: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<p>Testando divisão por zero:</p>";
echo "<p>Divisão de $num1 por 0: " . $calc->dividir($num1, 0) . "</p>";

?>

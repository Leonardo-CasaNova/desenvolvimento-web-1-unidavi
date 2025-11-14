<?php

require_once 'Computador.php';

$pc = new Computador();

echo "<h2>Teste da Classe Computador</h2>";

echo "<p>Status inicial: " . $pc->status() . "</p>";

echo "<hr>";

echo "<p>Executando ligar(): ";
$pc->ligar();
echo "</p>";

// Verificando status após ligar
echo "<p>Status atual: " . $pc->status() . "</p>";
echo "<hr>";

// Desligando o computador
echo "<p>Executando desligar(): ";
$pc->desligar();
echo "</p>";

// Verificando status após desligar
echo "<p>Status atual: " . $pc->status() . "</p>";

echo "<hr>";

// Testando múltiplas operações
echo "<h3>Testando múltiplas operações:</h3>";

echo "<p>Ligando novamente: ";
$pc->ligar();
echo "Status: " . $pc->status() . "</p>";

echo "<p>Desligando: ";
$pc->desligar();
echo "Status: " . $pc->status() . "</p>";

?>

<?php

require_once 'Campeonato.php';
require_once 'Jogador.php';

$time = new Campeonato("Flamengo", 1895);

echo "<h3>Informações do Time</h3>";
echo "<p>Nome: " . $time->getNome() . "</p>";
echo "<p>Ano de Fundação: " . $time->getAnoFundacao() . "</p>";

echo "<hr>";

$jogador1 = new Jogador("Gabriel Barbosa", "Atacante", "1996-08-30");
$jogador2 = new Jogador("Arrascaeta", "Meia", "1994-06-01");
$jogador3 = new Jogador("Everton Ribeiro", "Meia", "1989-04-10");


$time->adicionarJogador($jogador1);
$time->adicionarJogador($jogador2);
$time->adicionarJogador($jogador3);

echo "<h3>Elenco do Time</h3>";

foreach ($time->getJogadores() as $jogador) {
    echo "<p>";
    echo "Nome: " . $jogador->getNome() . "<br>";
    echo "Posição: " . $jogador->getPosicao() . "<br>";
    echo "Data de Nascimento: " . date('d/m/Y', strtotime($jogador->getDataNascimento()));
    echo "</p>";
}

echo "<hr>";
?>

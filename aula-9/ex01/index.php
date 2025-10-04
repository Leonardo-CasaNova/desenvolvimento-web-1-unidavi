<?php 
require_once 'funcoes.php';

$aNotas = [10,8,4.5];
$aFrequencia = [1,1,1,1,0,0,1,1,0,1,1,1,1,1,0,0,1,1,0,1];

$bAprovadoReprovado = verificaAluno($aNotas, $aFrequencia);
echo $bAprovadoReprovado;
?>
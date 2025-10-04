<?php
function calcularMediaNotas(array $aNotas){
    $soma = array_sum($aNotas);
    return $soma / count($aNotas);
}

function calcularFrequencia(array $aFrequencia){
    $somaFrequencia = array_sum($aFrequencia);
    $frequencia = ($somaFrequencia * 100) / count($aFrequencia);
    return $frequencia ;
}

function verificaAluno($aNotas, $aFrequencia){
    $mediaNotas = calcularMediaNotas($aNotas);
    if ($mediaNotas < 7) return 'Reprovado por Nota'; 

    $frequencia = calcularFrequencia($aFrequencia);
    if ($frequencia < 70 ) return 'Reprovado por frequencia';

    return 'Aprovado';
}
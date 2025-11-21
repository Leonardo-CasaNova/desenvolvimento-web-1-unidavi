<?php

function redirecionar($url)
{
    header("Location: $url");
    exit();
}

function gerarEscala($escalaMaxima = 10)
{
    $escala = array();
    for ($i = 0; $i <= $escalaMaxima; $i++) {
        $escala[] = $i;
    }
    return $escala;
}

function getDescricaoNota($valor)
{
    if ($valor >= 0 && $valor <= 3) {
        return "Muito Insatisfeito";
    } elseif ($valor >= 4 && $valor <= 6) {
        return "Neutro";
    } elseif ($valor >= 7 && $valor <= 8) {
        return "Satisfeito";
    } else {
        return "Completamente Satisfeito";
    }
}

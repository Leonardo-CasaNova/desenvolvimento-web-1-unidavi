<?php

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/../config.php';

function sanitizarString($str)
{
    return trim(htmlspecialchars(strip_tags($str), ENT_QUOTES, 'UTF-8'));
}

function validarResposta($resposta)
{
    return is_numeric($resposta) && $resposta >= 0 && $resposta <= ESCALA_MAXIMA;
}

function salvarAvaliacao($id_pergunta, $resposta, $feedback = null)
{
    $conn = conectarBanco();

    if (!$conn) {
        return false;
    }

    if (!validarResposta($resposta)) {
        fecharBanco($conn);
        return false;
    }

    $id_pergunta = (int)$id_pergunta;
    $resposta = (int)$resposta;
    $id_dispositivo = (int)ID_DISPOSITIVO;

    if ($feedback && trim($feedback) !== '') {
        $feedback_sanitizado = sanitizarString($feedback);
        $feedback_sql = "'" . pg_escape_string($conn, $feedback_sanitizado) . "'";
    } else {
        $feedback_sql = "NULL";
    }
    // id_setor usa o mesmo valor de id_dispositivo (setores representados pelos dispositivos)
    $query = "INSERT INTO avaliacoes (id_setor, id_dispositivo, id_pergunta, resposta, feedback_textual, data_hora) 
              VALUES ($id_dispositivo, $id_dispositivo, $id_pergunta, $resposta, $feedback_sql, CURRENT_TIMESTAMP)";

    $result = pg_query($conn, $query);

    fecharBanco($conn);

    return $result !== false;
}

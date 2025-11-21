<?php

require_once __DIR__ . '/db.php';

function buscarPerguntasAtivas()
{
    $conn = conectarBanco();

    if (!$conn) {
        return array();
    }

    $query = "SELECT id, texto, ordem 
              FROM perguntas 
              WHERE status = 'ativa' 
              ORDER BY ordem ASC, id ASC";

    $result = pg_query($conn, $query);

    if (!$result) {
        fecharBanco($conn);
        return array();
    }

    $perguntas = array();
    while ($row = pg_fetch_assoc($result)) {
        $perguntas[] = $row;
    }

    fecharBanco($conn);
    return $perguntas;
}

function listarPerguntas()
{
    $conn = conectarBanco();
    if (!$conn) {
        return array();
    }
    $result = pg_query($conn, "SELECT id, texto, ordem, status FROM perguntas ORDER BY ordem ASC, id ASC");
    $dados = array();
    if ($result) {
        while ($row = pg_fetch_assoc($result)) {
            $dados[] = $row;
        }
    }
    fecharBanco($conn);
    return $dados;
}

function criarPergunta($texto, $ordem = 0)
{
    $conn = conectarBanco();
    if (!$conn) {
        return false;
    }
    $texto = pg_escape_string($conn, trim($texto));
    $ordem = (int)$ordem;
    $q = "INSERT INTO perguntas (texto, ordem, status) VALUES ('$texto', $ordem, 'ativa')";
    $ok = pg_query($conn, $q) !== false;
    fecharBanco($conn);
    return $ok;
}

function atualizarPergunta($id, $texto, $ordem, $status)
{
    $conn = conectarBanco();
    if (!$conn) {
        return false;
    }
    $id = (int)$id;
    $ordem = (int)$ordem;
    $status = ($status === 'inativa') ? 'inativa' : 'ativa';
    $texto = pg_escape_string($conn, trim($texto));
    $q = "UPDATE perguntas SET texto='$texto', ordem=$ordem, status='$status' WHERE id=$id";
    $ok = pg_query($conn, $q) !== false;
    fecharBanco($conn);
    return $ok;
}

function excluirPergunta($id)
{
    $conn = conectarBanco();
    if (!$conn) {
        return false;
    }
    $id = (int)$id;
    $q = "DELETE FROM perguntas WHERE id=$id";
    $ok = pg_query($conn, $q) !== false;
    fecharBanco($conn);
    return $ok;
}

function obterPergunta($id)
{
    $conn = conectarBanco();
    if (!$conn) {
        return null;
    }
    $id = (int)$id;
    $result = pg_query($conn, "SELECT id, texto, ordem, status FROM perguntas WHERE id=$id");
    $row = $result ? pg_fetch_assoc($result) : null;
    fecharBanco($conn);
    return $row;
}

function mediaPorPergunta()
{
    $conn = conectarBanco();
    if (!$conn) {
        return array();
    }
    $sql = "SELECT p.id, p.texto, AVG(a.resposta) AS media, COUNT(a.id) AS total
            FROM perguntas p
            LEFT JOIN avaliacoes a ON a.id_pergunta = p.id
            GROUP BY p.id, p.texto
            ORDER BY media DESC NULLS LAST";
    $result = pg_query($conn, $sql);
    $dados = array();
    if ($result) {
        while ($r = pg_fetch_assoc($result)) {
            $dados[] = $r;
        }
    }
    fecharBanco($conn);
    return $dados;
}

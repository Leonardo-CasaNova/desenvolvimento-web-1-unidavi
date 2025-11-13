<?php

require_once __DIR__ . '/db.php';

function buscarPerguntasAtivas() {
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
?>

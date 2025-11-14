<?php

require_once __DIR__ . '/../config.php';

function conectarBanco() {
    $conn_string = "host=" . DB_HOST . 
                   " port=" . DB_PORT . 
                   " dbname=" . DB_NAME . 
                   " user=" . DB_USER . 
                   " password=" . DB_PASS;
    
    $conn = pg_connect($conn_string);
    
    if (!$conn) {
        error_log("Erro ao conectar ao banco de dados PostgreSQL");
        return false;
    }
    
    return $conn;
}

function fecharBanco($conn) {
    if ($conn) {
        pg_close($conn);
    }
}
?>

<?php
    session_start();
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'local');
    define('DB_USER', 'postgres');
    define('DB_PASS', 'postgres');
    define('DB_PORT', '5432');      

    $connectString = "host=".DB_HOST." port=".DB_PORT." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASS;

    $condb = pg_connect($connectString);

    if(!$condb){
        echo "Erro ao conectar com o banco de dados.";
    } else {
        echo "Conexão com o banco de dados realizada com sucesso.";

        $aDados = array($_POST['nome'], $_POST['sobrenome'], $_POST['email'], $_POST['senha'], $_POST['cidade'], $_POST['estado']);
        $result = pg_query_params($condb, "INSERT INTO TBPESSOA (PESNOME, PESSOBRENOME, PESEMAIL, PESPASSWORD, PESCIDADE, PESESTADO) VALUES ($1, $2, $3, $4, $5, $6);", $aDados);

        if($result){
            echo "<br>Dados inseridos com sucesso na tabela pessoa.";
        }
    }
?>
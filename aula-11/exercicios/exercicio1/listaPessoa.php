<?php
session_start();
define('DB_HOST', 'localhost');
define('DB_NAME', 'local');
define('DB_USER', 'postgres');
define('DB_PASS', 'postgres');
define('DB_PORT', '5432');

$connectString = "host=" . DB_HOST . " port=" . DB_PORT . " dbname=" . DB_NAME . " user=" . DB_USER . " password=" . DB_PASS;

$condb = pg_connect($connectString);

if (!$condb) {
    echo "Erro ao conectar com o banco de dados.";
} else {
    echo "Conexão com o banco de dados realizada com sucesso.";

    $result = pg_query($condb, "SELECT * FROM TBPESSOA;");

    echo "                <table border='1'>
        <tr>
          <th>Código</th>
          <th>Nome</th>
          <th>Sobrenome</th>
          <th>Email</th>
          <th>Cidade</th>
          <th>Estado</th>
        </tr>";
    while ($row = pg_fetch_assoc($result)) {
        echo "
                 <tr>
                    <td>" . $row['pescodigo'] . "</td>
                    <td>" . $row['pesnome'] . "</td>
                    <td>" . $row['pessobrenome'] . "</td>
                    <td>" . $row['pesemail'] . "</td>
                    <td>" . $row['pescidade'] . "</td>
                    <td>" . $row['pesestado'] . "</td> 
                  </tr>";
    }
    echo "</table>";
}

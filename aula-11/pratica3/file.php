<?php
define('arquivo', 'dados.txt');

if(file_exists(arquivo)){
    $conteudo = file_get_contents(arquivo);
    echo nl2br($conteudo);
}

?>
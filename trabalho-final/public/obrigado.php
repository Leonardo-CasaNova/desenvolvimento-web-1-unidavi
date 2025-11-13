<?php

require_once __DIR__ . '/../config.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obrigado - Avaliação de Qualidade</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="agradecimento-container">
            <div class="icone-sucesso">✓</div>

            <h1>Obrigado pela sua avaliação!</h1>

            <p>
                O Estabelecimento agradece sua resposta e ela é muito importante para nós,
                pois nos ajuda a melhorar continuamente nossos serviços.
            </p>

            <a href="index.php" class="botao-nova-avaliacao">
                Nova Avaliação
            </a>
        </div>

        <div class="rodape">
            <p>
                Sua avaliação espontânea é anônima, nenhuma informação pessoal é solicitada ou armazenada.
            </p>
        </div>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 10000);
    </script>
</body>

</html>
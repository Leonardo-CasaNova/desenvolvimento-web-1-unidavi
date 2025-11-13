<?php
/**
 * Página principal - Formulário de Avaliação
 * Sistema de Avaliação de Qualidade de Serviços Prestados
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../src/perguntas.php';
require_once __DIR__ . '/../src/funcoes.php';

// Buscar perguntas ativas do banco de dados
$perguntas = buscarPerguntasAtivas();

// Se não houver perguntas, mostrar mensagem
if (empty($perguntas)) {
    die("Nenhuma pergunta cadastrada no sistema.");
}

$escalaMaxima = ESCALA_MAXIMA;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação de Qualidade</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Avaliação de Qualidade</h1>
            <p>Sua opinião é muito importante para nós!</p>
        </div>

        <form id="formularioAvaliacao" action="processar.php" method="POST">
            <div class="formulario-avaliacao">
                <?php foreach ($perguntas as $index => $pergunta): ?>
                    <div class="pergunta-container">
                        <div class="pergunta-texto">
                            <?php echo ($index + 1) . '. ' . htmlspecialchars($pergunta['texto']); ?>
                        </div>
                        
                        <div class="escala-container">
                            <?php 
                            $escala = gerarEscala($escalaMaxima);
                            foreach ($escala as $valor): 
                            ?>
                                <div class="escala-item">
                                    <input 
                                        type="radio" 
                                        id="pergunta_<?php echo $pergunta['id']; ?>_valor_<?php echo $valor; ?>" 
                                        name="resposta[<?php echo $pergunta['id']; ?>]" 
                                        value="<?php echo $valor; ?>"
                                    >
                                    <label 
                                        class="escala-label" 
                                        for="pergunta_<?php echo $pergunta['id']; ?>_valor_<?php echo $valor; ?>"
                                    >
                                        <?php echo $valor; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="escala-legenda">
                            <div class="legenda-item">Muito Insatisfeito</div>
                            <div class="legenda-item">Completamente Satisfeito</div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Pergunta aberta para feedback adicional -->
                <div class="feedback-container">
                    <label for="feedback">
                        Tem algum comentário ou sugestão adicional? (Opcional)
                    </label>
                    <textarea 
                        id="feedback" 
                        name="feedback" 
                        placeholder="Compartilhe sua experiência conosco..."
                        maxlength="500"
                    ></textarea>
                </div>
            </div>

            <button type="submit" class="botao-enviar">
                Enviar Avaliação
            </button>
        </form>

        <div class="rodape">
            <p>
                Sua avaliação espontânea é anônima, nenhuma informação pessoal é solicitada ou armazenada.
            </p>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>


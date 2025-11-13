/**
 * JavaScript para validação e interatividade do formulário
 */

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formularioAvaliacao');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            if (!validarFormulario()) {
                e.preventDefault();
            }
        });
    }
});

/**
 * Valida se todas as perguntas obrigatórias foram respondidas
 */
function validarFormulario() {
    const perguntas = document.querySelectorAll('.pergunta-container');
    let todasRespondidas = true;
    
    // Remove mensagens de erro anteriores
    removerMensagensErro();
    
    perguntas.forEach(function(pergunta) {
        const radios = pergunta.querySelectorAll('input[type="radio"]');
        let respondida = false;
        
        radios.forEach(function(radio) {
            if (radio.checked) {
                respondida = true;
            }
        });
        
        if (!respondida) {
            todasRespondidas = false;
            mostrarErro(pergunta, 'Por favor, selecione uma resposta para esta pergunta.');
        }
    });
    
    if (!todasRespondidas) {
        // Scroll para a primeira pergunta não respondida
        const primeiroErro = document.querySelector('.erro-validacao');
        if (primeiroErro) {
            primeiroErro.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        
        alert('Por favor, responda todas as perguntas antes de enviar.');
    }
    
    return todasRespondidas;
}

/**
 * Mostra mensagem de erro em uma pergunta
 */
function mostrarErro(elemento, mensagem) {
    const erroDiv = document.createElement('div');
    erroDiv.className = 'erro-validacao';
    erroDiv.style.color = '#dc3545';
    erroDiv.style.fontSize = '0.9em';
    erroDiv.style.marginTop = '10px';
    erroDiv.textContent = mensagem;
    elemento.appendChild(erroDiv);
    elemento.style.borderLeftColor = '#dc3545';
}

/**
 * Remove todas as mensagens de erro
 */
function removerMensagensErro() {
    const erros = document.querySelectorAll('.erro-validacao');
    erros.forEach(function(erro) {
        erro.remove();
    });
    
    const perguntas = document.querySelectorAll('.pergunta-container');
    perguntas.forEach(function(pergunta) {
        pergunta.style.borderLeftColor = '#667eea';
    });
}

/**
 * Adiciona feedback visual ao selecionar uma resposta
 */
document.querySelectorAll('.escala-label').forEach(function(label) {
    label.addEventListener('click', function() {
        const container = this.closest('.pergunta-container');
        container.style.borderLeftColor = '#28a745';
        
        // Remove mensagem de erro se existir
        const erro = container.querySelector('.erro-validacao');
        if (erro) {
            erro.remove();
        }
    });
});

function adicionarLinhaTotalizadora() {
    var tabela = document.getElementById('tabela-notas');
    var tbody = tabela.getElementsByTagName('tbody')[0];
    
    var linhaExistente = document.getElementById('linha-totalizadora');
    if (linhaExistente) {
        tbody.removeChild(linhaExistente);
    }
    
    var novaLinha = tbody.insertRow();
    novaLinha.id = 'linha-totalizadora';
    novaLinha.className = 'media-linha';
    
    var celulaNome = novaLinha.insertCell();
    celulaNome.innerHTML = 'Media das Notas';
    
    var linhas = tbody.rows;
    var numColunas = 9;
    
    for (var col = 1; col <= numColunas; col++) {
        var soma = 0;
        var contador = 0;
        
        for (var linha = 0; linha < linhas.length - 1; linha++) {
            var valor = parseFloat(linhas[linha].cells[col].textContent);
            if (!isNaN(valor)) {
                soma += valor;
                contador++;
            }
        }
        
        var media = contador > 0 ? (soma / contador).toFixed(2) : '0.00';
        var celula = novaLinha.insertCell();
        celula.innerHTML = media;
    }
}

function adicionarColunaTotalizadora() {
    var tabela = document.getElementById('tabela-notas');
    var thead = tabela.getElementsByTagName('thead')[0];
    var tbody = tabela.getElementsByTagName('tbody')[0];
    
    var colunaExistente = document.querySelector('.coluna-totalizadora');
    if (colunaExistente) {
        var linhas = tabela.rows;
        for (var i = 0; i < linhas.length; i++) {
            var ultimaCelula = linhas[i].lastElementChild;
            if (ultimaCelula && ultimaCelula.classList.contains('media-coluna')) {
                linhas[i].removeChild(ultimaCelula);
            }
        }
    }
    
    var primeiraLinha = thead.rows[0];
    var novaCelulaCabecalho = document.createElement('th');
    novaCelulaCabecalho.innerHTML = 'Media Aluno';
    novaCelulaCabecalho.rowSpan = 2;
    novaCelulaCabecalho.className = 'media-coluna coluna-totalizadora';
    primeiraLinha.appendChild(novaCelulaCabecalho);
    
    var linhasCorpo = tbody.rows;
    for (var i = 0; i < linhasCorpo.length; i++) {
        if (linhasCorpo[i].id === 'linha-totalizadora') continue;
        
        var linha = linhasCorpo[i];
        var soma = 0;
        var contador = 0;
        
        for (var j = 1; j <= 9; j++) {
            var valor = parseFloat(linha.cells[j].textContent);
            if (!isNaN(valor)) {
                soma += valor;
                contador++;
            }
        }
        
        var media = contador > 0 ? (soma / contador).toFixed(2) : '0.00';
        var novaCelula = linha.insertCell();
        novaCelula.innerHTML = media;
        novaCelula.className = 'media-coluna coluna-totalizadora';
    }
    
    var linhaTotalizadora = document.getElementById('linha-totalizadora');
    if (linhaTotalizadora) {
        var celulaTotalGeral = linhaTotalizadora.insertCell();
        celulaTotalGeral.innerHTML = '-';
        celulaTotalGeral.className = 'media-coluna coluna-totalizadora';
    }
}

function removerTotalizadores() {
    var linhaTotalizadora = document.getElementById('linha-totalizadora');
    if (linhaTotalizadora) {
        linhaTotalizadora.parentNode.removeChild(linhaTotalizadora);
    }
    
    var tabela = document.getElementById('tabela-notas');
    var linhas = tabela.rows;
    for (var i = 0; i < linhas.length; i++) {
        var ultimaCelula = linhas[i].lastElementChild;
        if (ultimaCelula && ultimaCelula.classList.contains('media-coluna')) {
            linhas[i].removeChild(ultimaCelula);
        }
    }
}

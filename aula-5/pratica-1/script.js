function calcular(operacao) {
    var num1 = parseFloat(document.getElementById('numero1').value);
    var num2 = parseFloat(document.getElementById('numero2').value);
    var resultadoDiv = document.getElementById('resultado');
    
    if (isNaN(num1) || isNaN(num2)) {
        resultadoDiv.innerHTML = 'Digite números válidos';
        resultadoDiv.className = '';
        return;
    }
    
    var resultado;
    
    if (operacao === '+') {
        resultado = num1 + num2;
    } else if (operacao === '-') {
        resultado = num1 - num2;
    } else if (operacao === '*') {
        resultado = num1 * num2;
    } else if (operacao === '/') {
        if (num2 === 0) {
            resultadoDiv.innerHTML = 'Erro: divisão por zero';
            resultadoDiv.className = '';
            return;
        }
        resultado = num1 / num2;
    }
    
    resultadoDiv.innerHTML = resultado;
    
    resultadoDiv.className = '';
    if (resultado < 0) {
        resultadoDiv.className = 'negativo';
    } else if (resultado > 0) {
        resultadoDiv.className = 'positivo';
    } else {
        resultadoDiv.className = 'zero';
    }
}

function limpar() {
    document.getElementById('numero1').value = '';
    document.getElementById('numero2').value = '';
    document.getElementById('resultado').innerHTML = 'Resultado';
    document.getElementById('resultado').className = '';
}

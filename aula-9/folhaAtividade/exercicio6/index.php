<?php
function calcularValorProduto($preco, $quantidade) {
    return $preco * $quantidade;
}

function verificarSaldo($total, $disponivel) {
    if ($total > $disponivel) {
        $falta = $total - $disponivel;
        return "<div style='color: red; font-weight: bold; margin-top: 10px;'>Falta dinheiro! O valor ficou R$ " . number_format($falta, 2, ',', '.') . " acima do disponível.</div>";
    } elseif ($total == $disponivel) {
        return "<div style='color: green; font-weight: bold; margin-top: 10px;'>O saldo para compras foi esgotado.</div>";
    } else {
        $sobra = $disponivel - $total;
        return "<div style='color: blue; font-weight: bold; margin-top: 10px;'>Joãozinho ainda poderia gastar R$ " . number_format($sobra, 2, ',', '.') . "</div>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $disponivel = 50.00;
    
    $valorMaca = calcularValorProduto($_POST['preco_maca'], $_POST['qtd_maca']);
    $valorMelancia = calcularValorProduto($_POST['preco_melancia'], $_POST['qtd_melancia']);
    $valorLaranja = calcularValorProduto($_POST['preco_laranja'], $_POST['qtd_laranja']);
    $valorRepolho = calcularValorProduto($_POST['preco_repolho'], $_POST['qtd_repolho']);
    $valorCenoura = calcularValorProduto($_POST['preco_cenoura'], $_POST['qtd_cenoura']);
    $valorBatatinha = calcularValorProduto($_POST['preco_batatinha'], $_POST['qtd_batatinha']);
    
    $total = $valorMaca + $valorMelancia + $valorLaranja + $valorRepolho + $valorCenoura + $valorBatatinha;
    
    echo "<h1>Resultado das Compras</h1>";
    echo "<div style='margin-top: 20px;'>";
    echo "<p><strong>Valores por produto:</strong></p>";
    echo "<p>Maçã: R$ " . number_format($valorMaca, 2, ',', '.') . "</p>";
    echo "<p>Melancia: R$ " . number_format($valorMelancia, 2, ',', '.') . "</p>";
    echo "<p>Laranja: R$ " . number_format($valorLaranja, 2, ',', '.') . "</p>";
    echo "<p>Repolho: R$ " . number_format($valorRepolho, 2, ',', '.') . "</p>";
    echo "<p>Cenoura: R$ " . number_format($valorCenoura, 2, ',', '.') . "</p>";
    echo "<p>Batatinha: R$ " . number_format($valorBatatinha, 2, ',', '.') . "</p>";
    echo "<hr>";
    echo "<p><strong>Total da compra: R$ " . number_format($total, 2, ',', '.') . "</strong></p>";
    echo verificarSaldo($total, $disponivel);
    echo "</div>";
    echo "<br><a href='index.html'>Voltar</a>";
} else {
    header('Location: index.html');
    exit;
}
?>

<?php

class Calculadora {
    
    public function somar($a, $b) {
        return $a + $b;
    }
    
    public function subtrair($a, $b) {
        return $a - $b;
    }
    
    public function multiplicar($a, $b) {
        return $a * $b;
    }
    
    public function dividir($a, $b) {
        if ($b == 0) {
            throw new Exception("Erro: Divisão por zero não é permitida!");
        }
        return $a / $b;
    }
}

?>

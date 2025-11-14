<?php

class Computador {

    private $estado;
    
    public function __construct() {
        $this->estado = "Desligado";
    }

    public function ligar() {
        $this->estado = "Ligado";
        echo "Ligado<br>";
    }
    
    public function desligar() {
        $this->estado = "Desligado";
        echo "Desligado<br>";
    }
    
    public function status() {
        return $this->estado;
    }
}

?>

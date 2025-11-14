<?php


class Campeonato {
    private $nome;
    private $anoFundacao;
    private $jogadores;
    
    public function __construct($nome, $anoFundacao) {
        $this->nome = $nome;
        $this->anoFundacao = $anoFundacao;
        $this->jogadores = array();
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function getAnoFundacao() {
        return $this->anoFundacao;
    }
    
    public function setAnoFundacao($anoFundacao) {
        $this->anoFundacao = $anoFundacao;
    }
    
    public function adicionarJogador($jogador) {
        $this->jogadores[] = $jogador;
    }
    
    public function getJogadores() {
        return $this->jogadores;
    }
}

?>

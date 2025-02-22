<?php

    function getDesconto(){
        try{
            if(isset($_REQUEST["desconto"])){

                if(is_numeric($_REQUEST["desconto"])){
    
                    return $_REQUEST["desconto"];
                }
        }
        }
        catch(\Throwable $e) {
            exibeMensagem("Erro ao obter desconto" .$e->getMessage());
            return 0;
        }; 
    };

    function getValor(){
        try{
            if(isset($_REQUEST["valor"])){

                if(is_numeric($_REQUEST["valor"])){
    
                    return $_REQUEST["valor"];
                }
        }
        }
        catch(\Throwable $e) {
            exibeMensagem("Erro ao obter valor" . $e->getMessage());
            return 0;
        };  
    }    

    function calculaValorFinal() {
        try {
            return getValor() - getDesconto();
        } catch (\Throwable $th) {
            exibeMensagem("Erro ao calcular valor" . $th->getMessage());
            return 0;
        }
        
    };

    function exibirMensagem($mensagem) {
        echo $mensagem;
    };

    exibirMensagem("valor final " . calculaValorFinal() . "<br>");

    exibirMensagem(var_dump($_REQUEST));
?>
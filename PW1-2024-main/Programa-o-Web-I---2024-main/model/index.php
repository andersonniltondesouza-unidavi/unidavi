<?php
    require_once "pessoa.php";
    require_once "contato.php";
    require_once "endereco.php";    

    /*Instanciar um objeto da classe pessoa*/
    $objetoPessoa = new \app\model\Pessoa();
    $objetoPessoa->setNome("Anderson");
    $objetoPessoa->setSobreNome("Nilton de Souza");
    $objetoPessoa->setDataNascimento(new DateTime("2005-03-24"));
    $objetoPessoa->setTipo(1);
    $objetoPessoa->setCpfCnpj("000.000.000-00");

    $objetoPessoa->getTelefone()->setTipo(1);
    $objetoPessoa->getTelefone()->setNome("Telefone Pessoal");
    $objetoPessoa->getTelefone()->setValor("00 00000-0000");
    echo "Nome Completo: " . $objetoPessoa->getNomeCompleto() . "<br>"; 
    echo "Idade: " . $objetoPessoa->getIdade();
?>
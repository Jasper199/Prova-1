<?php

require_once("classes/PessoaFisica.class.php");

function retornaListar() {
    $texto = isset($_POST['texto'])?$_POST['texto']:'';
    $filtro = isset($_POST['filtro'])?$_POST['filtro']:1;
    return PessoaFisica::listar(array($filtro, $texto));
}

if (!empty($_POST['acao'])) {
    if ($_POST["acao"] == "salvar"){
        $cpf = isset($_POST['cpf'])?$_POST['cpf']:0;
        $nome = isset($_POST['nome'])?$_POST['nome']:0;
        $dt_nascimento = isset($_POST['dt_nascimento'])?$_POST['dt_nascimento']:0;
        $dt_nascimento = date('Y-m-d', strtotime($dt_nascimento));
        // criar pessoa fisica
        $pessoa = new PessoaFisica($cpf,$nome,$dt_nascimento);
        // chamar função inserir
        if($pessoa->insere())
            header('location: listar-pessoa-fisica.php');
        else
            echo "Erro ao efetuar cadastro";
    } else if ($_POST['acao'] == 'filtrar') {
        $_REQUEST['pessoa_fisica'] = retornaListar();
        // header('location: listar.php');
    } else if ($_POST['acao'] == 'alterar') {
        PessoaFisica::alterar($_POST['id']);
        header('location: listar-pessoa-fisica.php');
    }

    require_once 'listar-pessoa-fisica.php';
}

if (!empty($_GET['acao'])) {
    if ($_GET['acao'] == 'excluir') {
        PessoaFisica::excluir($_GET['id']);
        header('location: listar-pessoa-fisica.php');
    } else if ($_GET['acao'] == 'alterar') {
        $buscaPessoa = PessoaFisica::buscar($_GET['id']);
        $_REQUEST['pessoa-form'] = $buscaPessoa[0];
        require_once 'alterar-pessoa-fisica.php';
    }
}

?>
<?php

require_once("classes/PessoaFisica.class.php");
require_once("classes/Contato.class.php");

function retornaListarContato() {
    $texto = isset($_POST['texto'])?$_POST['texto']:'';
    $filtro = isset($_POST['filtro'])?$_POST['filtro']:1;
    return Contato::listar(array($filtro, $texto));
}

if (!empty($_POST['acao'])) {
    if ($_POST["acao"] == "salvar"){
        $tipo = isset($_POST['tipo'])?$_POST['tipo']:0;
        $descricao = isset($_POST['descricao'])?$_POST['descricao']:0;
        $pf = isset($_POST['pf'])?$_POST['pf']:0;
        // criar contato
        $contato = new Contato($tipo,$descricao,$pf);
        // chamar função inserir
        if($contato->insere())
            header('location: listar-contato.php');
        else
            echo "Erro ao efetuar cadastro";
    } else if ($_POST['acao'] == 'filtrar') {
        $_REQUEST['contato'] = retornaListarContato();
        // header('location: listar.php');
    } else if ($_POST['acao'] == 'alterar') {
        Contato::alterar($_POST['id']);
        header('location: listar-contato.php');
    }

    require_once 'listar-contato.php';
}

if (!empty($_GET['acao'])) {
    if ($_GET['acao'] == 'excluir') {
        Contato::excluir($_GET['id']);
        header('location: listar-contato.php');
    } else if ($_GET['acao'] == 'alterar') {
        $_REQUEST['contato-form'] = Contato::buscar($_GET['id']);
        require_once 'alterar-contato.php';
    }
}

?>
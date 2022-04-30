<?php

require_once("classes/ContaCorrente.class.php");


if (!empty($_POST['acao'])) {
    if ($_POST["acao"] == "salvar"){
        $pf = isset($_POST['pf'])?$_POST['pf']:0;
        $cc = isset($_POST['cc'])?$_POST['cc']:0;
        $valor = isset($_POST['valor'])?$_POST['valor']:0;
        $tipo = isset($_POST['tipo'])?$_POST['tipo']:0;
        if($tipo == 1) {
            ContaCorrente::saque($cc, $pf, $valor);
            header('location: listar-conta-corrente.php');
        } else if($tipo == 2) {
            ContaCorrente::deposito($cc, $pf, $valor);
            header('location: listar-conta-corrente.php');
        }
    }

    if ($_POST['acao'] == 'filtrar') {
        $_REQUEST['pessoa_fisica'] = retornaListar();
        // header('location: listar.php');
    }

    require_once 'listar-pessoa-fisica.php';
}

if (!empty($_GET['acao'])) {
    if ($_GET['acao'] == 'excluir') {
        PessoaFisica::excluir($_GET['id']);
        header('location: listar-pessoa-fisica.php');
    }
}

?>
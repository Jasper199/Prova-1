<?php

require_once("classes/PessoaFisica.class.php");
require_once("classes/ContaCorrente.class.php");

function exibir_como_select($chave,$dados){
    $html = "<option value=0>Selecione</option>";
    foreach($dados as $linha){
        if (isset($_REQUEST['contato-form']) && $linha[$chave[0]] == $_REQUEST['contato-form']->pessoa_fisica_id) {
            $html .= "<option selected value='".$linha[$chave[0]]."'>".$linha[$chave[1]]."</option>";
        } else {
            $html .= "<option value='".$linha[$chave[0]]."'>".$linha[$chave[1]]."</option>";
        }
    }
    return $html;
}

function lista_pessoa($id){
    $lista = PessoaFisica::buscar($id);
    return exibir_como_select(array('id','nome'),$lista);
}

function retornaListar() {
    $texto = isset($_POST['texto'])?$_POST['texto']:'';
    $filtro = isset($_POST['filtro'])?$_POST['filtro']:1;
    return ContaCorrente::listar(array($filtro, $texto));
}

if (!empty($_POST['acao'])) {

    if ($_POST["acao"] == "salvar"){
        $numero = isset($_POST['numero'])?$_POST['numero']:0;
        $saldo = isset($_POST['saldo'])?$_POST['saldo']:0;
        $dt = isset($_POST['dt-ultima-alteracao'])?$_POST['dt-ultima-alteracao']:0;
        $pf = isset($_POST['pf'])?$_POST['pf']:0;
        // criar conta corrente

        $conta = new ContaCorrente($numero,$saldo,$pf,$dt);
        // chamar função inserir
        if($conta->insere())
            header('location: listar-conta-corrente.php');
        else
            echo "Erro ao efetuar cadastro";
    } else if ($_POST['acao'] == 'filtrar') {
        $_REQUEST['conta_corrente'] = retornaListar();
        // header('location: listar.php');
    }


    require_once 'listar-conta-corrente.php';
}

if (!empty($_GET['acao'])) {
    if ($_GET['acao'] == 'excluir') {
        ContaCorrente::excluir($_GET['id']);
        header('location: listar-conta-corrente.php');
    }
}

?>
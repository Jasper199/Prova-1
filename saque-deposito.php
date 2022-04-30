<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Contatos</title>
</head>
<body>
    <?php 
        include_once('nav.php');
        require_once("classes/PessoaFisica.class.php");
        require_once("classes/ContaCorrente.class.php");
    ?>
    <form action="controle-saque-deposito.php" method="POST">

        <label for="pf">Pessoa Física:</label>
        <select name="pf">
            <?php
                require_once("controle-conta-corrente.php");
                echo lista_pessoa(0);
            ?>
        </select>

        <br>

        <label for="cc">Conta corrente:</label>
        <input name="cc" type="text">

        <br>

        <label for="valor">Valor:</label>
        <input name="valor" type="text">

        <br>

        <input type="radio" name="tipo" value="1" checked required> Saque
        <br>
        <input type="radio" name="tipo" value="2" required> Deposito

        <br>

        <button type="submit" name="acao" value="salvar">Salvar</button>

    </form>
    
</body>
</html>
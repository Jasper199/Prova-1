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
    ?>
    <form action="controle-contato.php" method="POST">

        <label for="tipo">Tipo:</label>
        <input type="text" name="tipo" required>

        <br>
    
        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" required>

        <br>

        <label for="pf">Pessoa Física:</label>
        <select name="pf">
            <?php
                require_once("controle-conta-corrente.php");
                echo lista_pessoa(0);
            ?>
        </select>

        <br>

        <button type="submit" name="acao" value="salvar">Salvar</button>

    </form>
    
</body>
</html>
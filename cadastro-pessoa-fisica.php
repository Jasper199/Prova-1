<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoa Fisica</title>
</head>
<body>
    <?php 
        include_once('nav.php');
    ?>
    <form action="controle-pessoa-fisica.php" method="POST">

        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" required>

        <br>
    
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>

        <br>

        <label for="dt_nascimento">Data de nascimento:</label>
        <input type="date" name="dt_nascimento" required>

        <br>

        <button type="submit" name="acao" value="salvar">Salvar</button>

    </form>
    
</body>
</html>
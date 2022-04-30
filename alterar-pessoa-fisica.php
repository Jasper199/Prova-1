<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Pessoa Fisica</title>
</head>
<body>
    <?php 
        include_once('nav.php');
    ?>
    <form action="controle-pessoa-fisica.php" method="POST">

        <input name="id" <?= isset($_GET['id'])?'value="'.$_GET['id'].'"':0 ?> type="hidden">
    
        <label for="cpf">CPF:</label>
        <input <?= isset($_REQUEST['pessoa-form']['cpf'])?'value="'.$_REQUEST['pessoa-form']['cpf'].'"':'' ?> type="text" name="cpf" required>

        <br>
    
        <label for="nome">Nome:</label>
        <input <?= isset($_REQUEST['pessoa-form']['nome'])?'value="'.$_REQUEST['pessoa-form']['nome'].'"':'' ?> type="text" name="nome" required>

        <br>

        <label for="dt_nascimento">Data de nascimento:</label>
        <input <?= isset($_REQUEST['pessoa-form']['dt_nascimento'])?'value="'.date('Y-m-d', strtotime($_REQUEST['pessoa-form']['dt_nascimento'])).'"':'' ?> type="date" name="dt_nascimento" required>

        <br>

        <button type="submit" name="acao" value="alterar">Salvar</button>

    </form>
    
</body>
</html>
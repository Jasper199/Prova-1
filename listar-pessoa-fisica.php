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
    ?>
    <form action="controle-pessoa-fisica.php" method="POST">

        <label for="texto">Filtro:</label>
        <input type="text" name="texto">

        <br>

        <input type="radio" name="filtro" value="1" checked required> CPF
        <br>
        <input type="radio" name="filtro" value="2" required> Nome

        <br>

        <button type="submit" name="acao" value="filtrar">Salvar</button>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>CPF</th>
                <th>Nome</th>
                <th>Data de nascimento</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </tr>
            <?php 
                require_once("controle-pessoa-fisica.php");
                $pessoasFisicas = isset($_REQUEST['pessoa_fisica'])?$_REQUEST['pessoa_fisica']:retornaListar();

                foreach ($pessoasFisicas as $pessoaFisica) {
                    echo '<tr> <td>'.$pessoaFisica['id'].'</td>';
                    echo '<td>'.$pessoaFisica['cpf'].'</td>';
                    echo '<td>'.$pessoaFisica['nome'].'</td>';
                    echo '<td>'.date('d/m/Y', strtotime($pessoaFisica['dt_nascimento'])).'</td>';
                    echo '<td><a href="controle-pessoa-fisica.php?acao=alterar&id='.$pessoaFisica['id'].'">Alterar</a></td>';
                    echo '<td><a href="controle-pessoa-fisica.php?acao=excluir&id='.$pessoaFisica['id'].'">Excluir</a></td></tr>';
                }
            ?>
        </table>

    </form>
    
</body>
</html>
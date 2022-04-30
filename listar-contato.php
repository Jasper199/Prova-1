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
        require_once("classes/Contato.class.php");
    ?>
    <form action="controle-contato.php" method="POST">

        <label for="texto">Filtro:</label>
        <input type="text" name="texto">

        <br>

        <input type="radio" name="filtro" value="1" checked required> Tipo
        <br>
        <input type="radio" name="filtro" value="2" required> Descrição

        <br>

        <button type="submit" name="acao" value="filtrar">Salvar</button>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Pessoa Fisica</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </tr>
            <?php 
                require_once("controle-contato.php");
                $contatos = isset($_REQUEST['contato'])?$_REQUEST['contato']:retornaListarContato();

                foreach ($contatos as $contato) {
                    echo '<tr> <td>'.$contato['id'].'</td>';
                    echo '<td>'.$contato['tipo'].'</td>';
                    echo '<td>'.$contato['descricao'].'</td>';
                    echo '<td>'.$contato['nome'].'</td>';
                    echo '<td><a href="controle-contato.php?acao=alterar&id='.$contato['id'].'">Alterar</a></td>';
                    echo '<td><a href="controle-contato.php?acao=excluir&id='.$contato['id'].'">Excluir</a></td></tr>';
                }
            ?>
        </table>

    </form>
    
</body>
</html>
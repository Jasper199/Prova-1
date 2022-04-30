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
        require_once("classes/ContaCorrente.class.php");
    ?>
    <form action="controle-conta-corrente.php" method="POST">

        <label for="texto">Filtro:</label>
        <input type="text" name="texto">

        <br>

        <input type="radio" name="filtro" value="1" checked required> Número da conta
        <br>
        <input type="radio" name="filtro" value="2" required> Saldo

        <br>

        <button type="submit" name="acao" value="filtrar">Salvar</button>

        <table border="1">
            <tr>
                <th>Número da conta</th>
                <th>Saldo</th>
                <th>Data última alteração</th>
                <th>Dono</th>
                <!-- <th>Alterar</th> -->
                <th>Excluir</th>
            </tr>
            <?php 
                require_once("controle-conta-corrente.php");
                $contasCorrentes = isset($_REQUEST['conta_corrente'])?$_REQUEST['conta_corrente']:retornaListar();

                foreach ($contasCorrentes as $contaCorrente) {
                    echo '<tr> <td>'.$contaCorrente['id'].'</td>';
                    echo '<td>'.$contaCorrente['saldo'].'</td>';
                    echo '<td>'.date('d/m/Y', strtotime($contaCorrente['dt_ultima_alteracao'])).'</td>';
                    echo '<td>'.$contaCorrente['nome'].'</td>';
                    // echo '<td>Alterar|'.$contaCorrente['id'].'</td>';
                    echo '<td><a href="controle-conta-corrente.php?acao=excluir&id='.$contaCorrente['id'].'">Excluir</a></td></tr>';
                }
            ?>
        </table>

    </form>
    
</body>
</html>
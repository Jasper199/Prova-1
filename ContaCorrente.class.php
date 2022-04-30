<?php
class ContaCorrente{
    private $numero;
    private $saldo;
    private $id;
    private $dt_ultima_alteracao;

    public function __construct($numero,$saldo,$id){
        $this->setNumero($numero);
        $this->setSaldo($saldo);
        $this->setPf($id);
        $this->setDtUltimaAlteracao(date('Y-m-d'));
    }

    public function getNumero(){ return $this->numero;}
    public function setNumero($numero){ $this->numero = $numero; }

    public function getSaldo(){ return $this->saldo;}
    public function setSaldo($saldo){ $this->saldo = $saldo; }

    public function getPf(){ return $this->id;}
    public function setPf($pf){ $this->id = $pf;}

    public function getDtUltimaAlteracao(){ return $this->dt_ultima_alteracao;}
    public function setDtUltimaAlteracao($dt){ $this->dt_ultima_alteracao = $dt;}

    public function insere(){
        require_once("conexao.php");
        global $conexao;
        $query = 'INSERT IGNORE INTO conta_corrente (id, saldo, pessoa_fisica_id, dt_ultima_alteracao)
                   VALUES(:numero,:saldo,:id,:dt)';
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':numero',$this->getNumero());
        $stmt->bindParam(':saldo',$this->getSaldo());
        $stmt->bindParam(':id',$this->getPf());
        $stmt->bindParam(':dt',$this->getDtUltimaAlteracao());
        return $stmt->execute();
    }

    public static function buscar($id){
        require_once("conexao.php");
        $query = 'SELECT * FROM conta_corrente';

        if($id > 0){
            $query .= ' WHERE id = :id';
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(':id',$id);
        } else
            $stmt = $conexao->prepare($query);

        if ($stmt->execute()) {
            $teste = $stmt->fetchObject();
            return $teste;
        }
        return false;
    }

    public static function preparaUpdate($id, $pessoa, $valor, $operacao) {
        $contaCorrenteBd = self::buscar($id);
        if ($contaCorrenteBd->pessoa_fisica_id == $pessoa) {
            if ($operacao == 'saque') {
                $contaCorrenteBd->saldo -= $valor;
            } else {
                $contaCorrenteBd->saldo += $valor;
            }
            return $contaCorrenteBd;
        }
        return false;
    }

    public static function atualizaSaldo($contaCorrente, $id) {
        require("conexao.php");
        $query = 'UPDATE conta_corrente SET saldo = :saldo, dt_ultima_alteracao = :dt_ultima_alteracao WHERE id = :id';
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':saldo', $contaCorrente->saldo);
        $stmt->bindParam(':dt_ultima_alteracao',date('Y-m-d'));
        $stmt->execute();
        echo 'ok';
    }

    public static function saque($id, $pessoa, $valor) {
        $cc = self::preparaUpdate($id, $pessoa, $valor, 'saque');
        if ($cc) {
            self::atualizaSaldo($cc, $id);
        } else {
            echo 'erro';
        }
    }

    public static function deposito($id, $pessoa, $valor) {
        $cc = self::preparaUpdate($id, $pessoa, $valor, 'deposito');
        if ($cc) {
            self::atualizaSaldo($cc, $id);
        } else {
            echo 'erro';
        }
    }

    public static function listar($filtro) { //Filtro[0]: Select / Filtro[1]: Input
        require_once("conexao.php");
        $filtroTexto = '"'.$filtro[1].'%"';
        $query = 'SELECT conta_corrente.id, conta_corrente.saldo, conta_corrente.dt_ultima_alteracao, pessoa_fisica.nome FROM conta_corrente';
        $query .= ' JOIN pessoa_fisica ON conta_corrente.pessoa_fisica_id = pessoa_fisica.id';
        if ($filtro[0] == 1) { //Select option tipo
            $query  .= ' WHERE conta_corrente.id LIKE '.$filtroTexto;
            // die($query);
        } else {
            $query .= ' WHERE conta_corrente.saldo LIKE '.$filtroTexto;
        }
        $stmt = $conexao->prepare($query);
        if ($stmt->execute())
            return $stmt->fetchAll();
    }

    public static function excluir($id) {
        require_once("conexao.php");
        $query = 'DELETE FROM conta_corrente WHERE id = :id';
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
     }
    
}

?>
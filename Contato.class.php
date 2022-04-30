<?php
class Contato{
    private $tipo;
    private $descricao;
    private $id;

    public function __construct($tipo,$descricao,$id){
        $this->setTipo($tipo);
        $this->setDescricao($descricao);
        $this->setPf($id);
    }

    public function getTipo(){ return $this->tipo;}
    public function setTipo($tipo){ $this->tipo = $tipo; }

    public function getDescricao(){ return $this->descricao;}
    public function setDescricao($descricao){ $this->descricao = $descricao; }

    public function getPf(){ return $this->id;}
    public function setPf($pf){ $this->id = $pf;}

    public static function buscar($id){
        require("conexao.php");
        $query = 'SELECT * FROM contatos';

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
    
    public function insere(){
        require_once("conexao.php");
        // criar variável conexão
        $query = 'INSERT INTO contatos (tipo, descricao, pessoa_fisica_id)
                   VALUES(:tipo,:descricao,:id)';
       
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':tipo',$this->tipo);
        $stmt->bindParam(':descricao',$this->descricao);
        $stmt->bindParam(':id',$this->id);

        return $stmt->execute();
    }

    public static function listar($filtro) { //Filtro[0]: Select / Filtro[1]: Input
        require_once("conexao.php");
        $filtroTexto = '"'.$filtro[1].'%"';
        $query = 'SELECT contatos.id, contatos.tipo, contatos.descricao, pessoa_fisica.nome FROM contatos';
        $query .= ' JOIN pessoa_fisica ON contatos.pessoa_fisica_id = pessoa_fisica.id';
        if ($filtro[0] == 1) { //Select option tipo
            $query  .= ' WHERE contatos.tipo LIKE '.$filtroTexto;
            // die($query);
        } else {
            $query .= ' WHERE contatos.descricao LIKE '.$filtroTexto;
        }
        $stmt = $conexao->prepare($query);
        if ($stmt->execute())
            return $stmt->fetchAll();
    }

    public static function excluir($id) {
        require_once("conexao.php");
        $query = 'DELETE FROM contatos WHERE id = :id';
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
     }

     public static function alterar($id) {
        require_once("conexao.php");
        $query = 'UPDATE contatos SET tipo = :tipo, descricao = :descricao, pessoa_fisica_id = :pessoa_fisica_id WHERE id = :id';
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':tipo', $_POST['tipo'], PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $_POST['descricao'], PDO::PARAM_STR);
        $stmt->bindParam(':pessoa_fisica_id', $_POST['pf'], PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
     }
    
}

?>
<?php
class PessoaFisica{
    private $id;
    private $cpf;
    private $nome;
    private $dt_nascimento;

    public function __construct($cpf,$nome,$dt_nascimento){
        $this->setCpf($cpf);
        $this->setNome($nome);
        $this->setDtNascimento($dt_nascimento);
    }

    public function getId(){  return $this->id; }
    public function getCpf(){  return $this->cpf; }
    public function getNome(){  return $this->nome; }
    public function getDtNascimento(){  return $this->dt_nascimento; }

    public function setId($id) { $this->id = $id; }
    public function setCpf($cpf) { $this->cpf = $cpf; }
    public function setNome($nome) { $this->nome = $nome; }
    public function setDtNascimento($dt_nascimento) { 
        $this->dt_nascimento = $dt_nascimento; 
    }

    public static function buscar($id){
        require("conexao.php");
        $query = 'SELECT * FROM pessoa_fisica';

        if($id > 0){
            $query .= ' WHERE id = :id';
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(':id',$id);
        } else
            $stmt = $conexao->prepare($query);

        if ($stmt->execute())
            return $stmt->fetchAll();
        
        return false; 
    }

    public function insere(){
        require_once("conexao.php");
        $query = 'INSERT INTO pessoa_fisica (cpf, nome, dt_nascimento)
                   VALUES(:cpf,:nome,:dt_nascimento)';
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':cpf',$this->getCpf());
        $stmt->bindParam(':nome',$this->getNome());
        $stmt->bindParam(':dt_nascimento',$this->getDtNascimento());
        return $stmt->execute();
    }

    public static function listar($filtro) { //Filtro[0]: Select / Filtro[1]: Input
        require_once("conexao.php");
        $filtroTexto = '"'.$filtro[1].'%"';
        $query = 'SELECT * FROM pessoa_fisica';
        if ($filtro[0] == 1) { //Select option tipo
            $query  .= ' WHERE cpf LIKE '.$filtroTexto;
            // die($query);
        } else {
            $query .= ' WHERE nome LIKE '.$filtroTexto;
        }
        $stmt = $conexao->prepare($query);
        if ($stmt->execute())
            return $stmt->fetchAll();
    }

    public static function excluir($id) {
        require_once("conexao.php");
        $query = 'DELETE FROM pessoa_fisica WHERE id = :id';
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
     }

     public static function alterar($id) {
        $data = date('Y-m-d', strtotime($_POST['dt_nascimento']));
        require_once("conexao.php");
        $query = 'UPDATE pessoa_fisica SET cpf = :cpf, nome = :nome, dt_nascimento = :dt_nascimento WHERE id = :id';
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':cpf', $_POST['cpf'], PDO::PARAM_STR);
        $stmt->bindParam(':nome', $_POST['nome'], PDO::PARAM_STR);
        $stmt->bindParam(':dt_nascimento', $data, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
     }

}

?>
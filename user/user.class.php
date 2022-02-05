<?php
require_once("../conexao.class.php");
class user{
	private $conexao;
	private $id;
	private $name;
	private $senha;
	
	public function __construct(){
		$this->conexao = new conexao;
	}
	function setId($id){
		$this->id = $id;
	}
	function setName($name){
		$this->name = $name;
	}
	function setSenha($senha){
		$this->senha = $senha;
	}
	function getId(){
		return $this->id;
	}
	function getName(){
		return $this->name;
	}
	function getSenha(){
		return $this->senha;
	}
	public function cadastrar_user(){
		$query = "INSERT INTO users VALUES(0, '".$this->name."', '".$this->senha."')";
		$sql = $this->conexao->query($query);
		
		return $sql;
	}
	public function consulta($name){
		$query = "SELECT * FROM users WHERE name="."'$name'";
		$sql = $this->conexao->query($query);
		$result = $this->conexao->fetch($sql);
		return $result;
	}
}
?>
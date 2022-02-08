<?php
require_once("../../lib/conexao.php");
class cliente{
	private $conexao;
	private $id;
	private $name;
	private $email;
	private $telephone;
	
	public function __construct(){
		$this->conexao = new conexao;
	}
	function setId($id){
		$this->id = $id;
	}
	function setName($name){
		$this->name = $name;
	}
	function setEmail($email){
		$this->email = $email;
	}
	function setTelephone($telephone){
		$this->telephone = $telephone;
	}
	function getId(){
		return $this->id;
	}
	function getName(){
		return $this->name;
	}
	function getEmail(){
		return $this->email;
	}
	function getTelephone(){
		return $this->telephone;
	}
	public function cadastrar_cliente(){
		$query = "INSERT INTO clientes VALUES(0, '".$this->name."', '".$this->email."', '".$this->telephone."')";
		$sql = $this->conexao->query($query);
		
		return $sql;
	}
	public function consulta($email){
		$query = "SELECT * FROM clientes WHERE email="."'$email'";
		$sql = $this->conexao->query($query);
		$result = $this->conexao->fetch($sql);
		return $result;
	}
}
?>
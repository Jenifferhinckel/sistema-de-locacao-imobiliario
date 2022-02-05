<?php
require_once("../conexao.class.php");
class proprietario{
	private $conexao;
	private $id;
	private $name;
	private $email;
	private $telephone;
	private $repasse_day;
	
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
	function setRepasseDay($repasse_day){
		$this->repasse_day = $repasse_day;
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
	function getRepasseDay(){
		return $this->repasse_day;
	}
	public function cadastrar_proprietario(){
		$query = "INSERT INTO proprietarios VALUES(0, '".$this->name."', '".$this->email."', '".$this->telephone."', '".$this->repasse_day."')";
		$sql = $this->conexao->query($query);
		
		return $sql;
	}
	public function consulta($email){
		$query = "SELECT * FROM proprietarios WHERE email="."'$email'";
		$sql = $this->conexao->query($query);
		$result = $this->conexao->fetch($sql);
		return $result;
	}
}
?>
<?php
require_once("../conexao.class.php");
class imovel{
	private $conexao;
	private $address_id;
	private $address;
	private $proprietario_id;
	
	public function __construct(){
		$this->conexao = new conexao;
	}
	function setAddressId($address_id){
		$this->address_id = $address_id;
	}
	function setAddress($address){
		$this->address = $address;
	}
	function setProprietarioId($proprietario_id){
		$this->proprietario_id = $proprietario_id;
	}
	function getAddressId(){
		return $this->address_id;
	}
	function getAddress(){
		return $this->address;
	}
	function getProprietarioId(){
		return $this->proprietario_id;
	}
	public function cadastrar_imovel(){
		$query = "INSERT INTO imoveis VALUES(0, '".$this->address_id."', '".$this->address."',  '".$this->proprietario_id."')";
		$sql = $this->conexao->query($query);
		
		return $sql;
	}
	public function consulta($address_id){
		$query = "SELECT * FROM imoveis WHERE address_id = ".$address_id;
		$sql = $this->conexao->query($query);
		$result = $this->conexao->fetch($sql);
		return $result;
	}
}
?>
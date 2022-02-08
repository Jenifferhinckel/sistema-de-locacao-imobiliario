<?php
require_once("../../lib/conexao.php");
class contrato{
	private $conexao;
	private $imovel_id;
	private $proprietario_id;
	private $cliente_id;
	private $start_date;
	private $end_date;
	private $taxa_admin;
	private $valor_aluguel;
	private $valor_condominio;
	private $valor_iptu;
	
	public function __construct(){
		$this->conexao = new conexao;
	}
	function setImovelId($imovel_id){
		$this->imovel_id = $imovel_id;
	}
	function setProprietarioId($proprietario_id){
		$this->proprietario_id = $proprietario_id;
	}
	function setClienteId($cliente_id){
		$this->cliente_id = $cliente_id;
	}
	function setStartDate($start_date){
		$this->start_date = $start_date;
	}
	function setEndDate($end_date){
		$this->end_date = $end_date;
	}
	function setTaxaAdmin($taxa_admin){
		$this->taxa_admin = $taxa_admin;
	}
	function setValorAluguel($valor_aluguel){
		$this->valor_aluguel = $valor_aluguel;
	}
	function setValorCondominio($valor_condominio){
		$this->valor_condominio = $valor_condominio;
	}
	function setValorIptu($valor_iptu){
		$this->valor_iptu = $valor_iptu;
	}
	function getImovelId(){
		return $this->imovel_id;
	}
	function getProprietarioId(){
		return $this->proprietario_id;
	}
	function getClienteId(){
		return $this->cliente_id;
	}
	function getStartDate(){
		return $this->start_date;
	}
	function getEndDate(){
		return $this->end_date;
	}
	function getTaxaAdmin(){
		return $this->taxa_admin;
	}
	function getValorAluguel(){
		return $this->valor_aluguel;
	}
	function getValorCondominio(){
		return $this->valor_condominio;
	}
	function getValorIptu(){
		return $this->valor_iptu;
	}
	public function cadastrar_contrato(){
		$query = "INSERT INTO contratos VALUES(0, '".$this->imovel_id."', '".$this->proprietario_id."',  '".$this->cliente_id."',
		'".$this->start_date."','".$this->end_date."' ,'".$this->taxa_admin."','".$this->valor_aluguel."', '".$this->valor_condominio."',
		'".$this->valor_iptu."')";
		$sql = $this->conexao->query($query);
		if($sql){
			$query_consulta = "SELECT * FROM contratos WHERE imovel_id="."'$this->imovel_id'";
			$sql_consulta = $this->conexao->query($query_consulta);
			$result = $this->conexao->fetch($sql_consulta);
			return $result->id;
		}
		return $sql;
	}
	public function consulta($imovel_id){
		$query = "SELECT * FROM contratos WHERE imovel_id="."'$imovel_id'";
		$sql = $this->conexao->query($query);
		$result = $this->conexao->fetch($sql);
		return $result;
	}
}
?>
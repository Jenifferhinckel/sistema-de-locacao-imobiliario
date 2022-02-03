<?php
require_once("../conexao.class.php");
class cliente{
	private $conexao;
	private $id;
	private $nome;
	private $email;
	private $telefone;
	
	public function __construct(){
		$this->conexao = new conexao;
	}
	function setId($id){
		$this->id = $id;
	}
	function setNome($nome){
		$this->nome = $nome;
	}
	function setEmail($email){
		$this->email = $email;
	}
	function setTelefone($telefone){
		$this->telefone = $telefone;
	}
	function getId(){
		return $this->id;
	}
	function getNome(){
		return $this->nome;
	}
	function getEmail(){
		return $this->email;
	}
	function getTelefone(){
		return $this->telefone;
	}
	public function cadastrar_cliente(){
		$query = "INSERT INTO clientes VALUES(0, '".$this->nome."', '".$this->email."', '".$this->telefone."')";
		$sql = $this->conexao->query($query);
		
		return $sql;
	}
	public function consulta(){
		$query = "SELECT * FROM clientes";
		$sql = $this->conexao->query($query);
		// $tabela = '';
		// while($result = $this->conexao->fetch($sql)){
		// 	$this->setId($result->id_produto);
		// 	$this->setNome($result->nome);
		// 	$this->setValor($result->valor);
			
		// 	$tabela .= '<tr align="center">
		// 					<td>'.$this->nome.'</td>
		// 					<td>'.$this->valor.'</td>
		// 					<td><a href="edita.php?id='.$this->id.'">Editar</a></td>
		// 					<td><a href="exclui.php?id='.$this->id.'">Excluir</a></td>
		// 				</tr>';
		// }
		$result = $this->conexao->fetch($sql);
		return $result;
	}
	// public function edita(){
	// 	$query = "SELECT * FROM produtos WHERE id_produto = ".$this->id;
	// 	$sql = $this->conexao->query($query);
	// 	$result = $this->conexao->fetch($sql);

	// 	$this->setNome($result->nome);
	// 	$this->setValor($result->valor);	
	// }
	// public function altera(){
	// 	$query = "UPDATE produtos SET nome = '".$this->nome."', valor = '".$this->valor."' WHERE id_produto = ".$this->id;
	// 	$sql = $this->conexao->query($query);
		
	// 	return $sql;
	// }
	// public function exclui(){
	// 	$query = "DELETE FROM produtos WHERE id_produto = ".$this->id;
	// 	$sql = $this->conexao->query($query);
		
	// 	return $sql;
	// }
}
?>
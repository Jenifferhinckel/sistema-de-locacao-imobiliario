<?php
class conexao{
	private $host = "localhost";
	private $user = "root";
	private $pass = "";
	private $banco = "imobiliaria";
	
	function __construct(){
		$con = mysqli_connect($this->host, $this->user, $this->pass) or die("Erro ao conectar o servidor do banco de dados. Favor contactar o administrador.");
		$db = mysqli_select_db($con ,$this->banco) or die("Erro ao selecionar o banco de dados. Favor contactar o administrador.");
	}
	public function query($query){
		$con = mysqli_connect($this->host, $this->user, $this->pass, $this->banco);
		$sql = mysqli_query($con, $query) or die("<b>Erro ao executar a query:</b> ".$query." -> ".mysqli_error());
		return $sql;
	}
	public function fetch($sql){
		$result = mysqli_fetch_object($sql);
		return $result;
	}
	public function num($sql){
		$num = mysqli_num_rows($sql);
		return $num;
	}
    
	function __destruct(){}
}
?>
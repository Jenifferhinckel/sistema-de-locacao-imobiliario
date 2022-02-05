<?php
require_once("user.class.php");

$name = $_POST['name'];
$senha = $_POST['senha'];

$user = new user;

if(empty($name) || empty($senha)){
	$texto = "O(s) Campo(s) obrigatório(s) não foi (foram) preenchido(s)";
}else{
	$consulta = $user->consulta($name);
	if(empty($consulta)){
		$user->setName($name);
		$user->setSenha($senha);
		$sql = $user->cadastrar_user();
		if($sql){
			$texto = "Usuário cadastrado com sucesso.";
		}else{
			$texto = "Erro ao tentar cadastrar o usuário";
		}
	}else{
		$texto = "Usuário(a) logado(a)!";
	}
}
?>
<html>
<head>
	<title>Sistema de Gestão de imobiliária</title>
</head>
<body>
	<h3 align="center">Sistema de Gestão de imobiliária</h3>
	<hr />
	<p align="center">
	<a href="../cliente/cadastrar.php">Cadastrar Clientes</a>
	<a href="cadastrar.php">Cadastrar Proprietários</a>
	<a href="cadastrar.php">Cadastrar Imovéis</a>
	<a href="cadastrar.php">Cadastrar Contratos</a>
	</p>
	<hr />
	<p align="center"><?=$texto?></p>
</body>
</html>
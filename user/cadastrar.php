<?php
require_once("user.class.php");

$nome = $_POST['nome'];
$senha = $_POST['senha'];

$user = new user;

if(empty($nome) || empty($senha)){
	$texto = "O(s) Campo(s) obrigatório(s) não foi (foram) preenchido(s)";
}else{
	$consulta = $user->consulta();
	if($consulta->name != $nome){
		$user->setNome($nome);
		$user->setSenha($senha);
		$sql = $user->cadastrar_user();
		if($sql){
			$texto = "Usuário cadastrado com sucesso.";
		}else{
			$texto = "Erro ao tentar cadastrar o usuário";
		}
	}
	$texto = "Usuário logado";
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
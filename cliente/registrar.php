<?php
require_once("cliente.class.php");

$name = $_POST['name'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];

$cliente = new cliente;

if(empty($name) || empty($email) || empty($telephone)){
	$texto = "O(s) Campo(s) obrigatório(s) não foi (foram) preenchido(s)";
}else{
	$consulta = $cliente->consulta($email);
    if(empty($consulta)){
        $cliente->setName($name);
        $cliente->setEmail($email);
        $cliente->setTelephone($telephone);
        $sql = $cliente->cadastrar_cliente();
        if($sql){
            $texto = "Cliente cadastrado com sucesso.";
        }else{
            $texto = "Erro ao tentar cadastrar o cliente";
        }
    }else{
        $texto = "Cliente já cadastrado(a)!";   
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
	<a href="cadastrar.php">Cadastrar Clientes</a>
	<a href="../proprietario/cadastrar.php">Cadastrar Proprietários</a>
	<a href="../imovel/cadastrar.php">Cadastrar Imovéis</a>
	<a href="../contrato/cadastrar.php">Cadastrar Contratos</a>
	</p>
	<hr />
	<p align="center"><?=$texto?></p>
</body>
</html>
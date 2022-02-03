<?php
require_once("cliente.class.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

$cliente = new cliente;

if(empty($nome) || empty($email) || empty($telefone)){
	$texto = "O(s) Campo(s) obrigatório(s) não foi (foram) preenchido(s)";
}else{
	$consulta = $cliente->consulta();
    if(empty($consulta)){
        $cliente->setNome($nome);
        $cliente->setEmail($email);
        $cliente->setTelefone($telefone);
        $sql = $cliente->cadastrar_cliente();
        if($sql){
            $texto = "Cliente cadastrado com sucesso.";
        }else{
            $texto = "Erro ao tentar cadastrar o cliente";
        }
    }else{
        if($consulta->name != $nome){
            $cliente->setNome($nome);
            $cliente->setEmail($email);
            $cliente->setTelefone($telefone);
            $sql = $cliente->cadastrar_cliente();
            if($sql){
                $texto = "Cliente cadastrado com sucesso.";
            }else{
                $texto = "Erro ao tentar cadastrar o cliente";
            }
        }
    }
	
    $consulta;
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
	<p align="center"><?=$consulta?></p>
</body>
</html>
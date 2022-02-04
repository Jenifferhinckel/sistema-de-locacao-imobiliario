<?php
require_once("proprietario.class.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$repasse_day = $_POST['repasse_day'];

$proprietario = new proprietario;
$consulta="";
if(empty($nome) || empty($email) || empty($telephone) || empty($repasse_day)){
	$texto = "O(s) Campo(s) obrigatório(s) não foi (foram) preenchido(s)";
}else{
	$consulta = $proprietario->consulta();
    if(empty($consulta)){
        $proprietario->setNome($nome);
        $proprietario->setEmail($email);
        $proprietario->setTelephone($telephone);
        $proprietario->setRepasseDay($repasse_day);
        $sql = $proprietario->cadastrar_proprietario();
        if($sql){
            $texto = "Proprietário cadastrado com sucesso.";
        }else{
            $texto = "Erro ao tentar cadastrar o proprietário";
        }
    }else{
        if($consulta->email != $email){
            $proprietario->setNome($nome);
            $proprietario->setEmail($email);
            $proprietario->setTelephone($telephone);
            $proprietario->setRepasseDay($repasse_day);
            $sql = $proprietario->cadastrar_proprietario();
            if($sql){
                $texto = "Proprietário cadastrado com sucesso.";
            }else{
                $texto = "Erro ao tentar cadastrar o proprietário";
            }
        }
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
	<a href="../imovel/cadastrar.php">Cadastrar Imovéis</a>
	<a href="../contrato/cadastrar.php">Cadastrar Contratos</a>
	</p>
	<hr />
	<p align="center"><?=$texto?></p>
</body>
</html>
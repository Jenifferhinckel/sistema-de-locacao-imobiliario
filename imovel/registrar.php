<?php
require_once("imovel.class.php");

$imovel = $_POST['imoveis'];
$imovelDetails = explode("-",$imovel);
$address_id = $imovelDetails[0];
$address = $imovelDetails[1];
$proprietario_id = $_POST['proprietarios'];

$imovel = new imovel;

if(empty($imovel) || empty($proprietario_id)){
	$texto = "O(s) Campo(s) obrigatório(s) não foi (foram) preenchido(s)";
}else{
	$consulta = $imovel->consulta($address_id);
    if(empty($consulta)){
        $imovel->setAddressId($address_id);
        $imovel->setAddress($address);
        $imovel->setProprietarioId($proprietario_id);
        $sql = $imovel->cadastrar_imovel();
        if($sql){
            $texto = "Imovel cadastrado com sucesso.";
        }else{
            $texto = "Erro ao tentar cadastrar o imovel";
        }
    }else{
        $texto = "Cliente já cadastrado!";
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
	<a href="../proprietario/cadastrar.php">Cadastrar Proprietários</a>
	<a href="cadastrar.php">Cadastrar Imovéis</a>
	<a href="../contrato/cadastrar.php">Cadastrar Contratos</a>
	</p>
	<hr />
	<p align="center"><?=$texto?></p>
</body>
</html>
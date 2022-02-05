<?php
require_once("contrato.class.php");

$imovel_id = $_POST['imovel_id'];
$proprietario_id = $_POST['proprietario_id'];
$cliente_id = $_POST['cliente_id'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$taxa_admin = $_POST['taxa_admin'];
$valor_aluguel = $_POST['valor_aluguel'];
$valor_condominio = $_POST['valor_condominio'];
$valor_iptu = $_POST['valor_iptu'];

$contrato = new contrato;

if(empty($imovel_id) || empty($cliente_id) || empty($start_date) || empty($end_date)){
	$texto = "O(s) Campo(s) obrigatório(s) não foi (foram) preenchido(s)";
}else{
	$consulta = $contrato->consulta($imovel_id);
    if(empty($consulta)){
        $contrato->setImovelId($imovel_id);
        $contrato->setProprietarioId($proprietario_id);
        $contrato->setClienteId($cliente_id);
        $contrato->setStartDate($start_date);
        $contrato->setEndDate($end_date);
        $contrato->setTaxaAdmin($taxa_admin);
        $contrato->setValorAluguel($valor_aluguel);
        $contrato->setValorCondominio($valor_condominio);
        $contrato->setValorIptu($valor_iptu);
        $sql = $contrato->cadastrar_contrato();
        if($sql){
            $texto = "Contrato cadastrado com sucesso.";
        }else{
            $texto = "Erro ao tentar cadastrar contrato";
        }
    }else{
        $texto = "Imovel já cadastrado!";
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
	<a href="../imovel/cadastrar.php">Cadastrar Imovéis</a>
	<a href="cadastrar.php">Cadastrar Contratos</a>
	</p>
	<hr />
	<p align="center"><?=$texto?></p>
</body>
</html>
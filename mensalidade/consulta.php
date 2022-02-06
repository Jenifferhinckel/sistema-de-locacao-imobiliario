<?php
require_once("../conexao.class.php");
require_once("mensalidade.class.php");

$conexao = new Conexao();
$mensalidade = new mensalidade;
$contrato_id = $_GET['id'];

$query = "SELECT * FROM contratos WHERE id="."'$contrato_id'";
$sql = $conexao->query($query);
$contrato = mysqli_fetch_array($sql, MYSQLI_ASSOC);

if(!empty($contrato_id)){
    $consulta = $mensalidade->consultar($contrato_id);
    if(empty($consulta)){
        $iptu = $contrato['valor_iptu']/12;
        $valor = $contrato['valor_aluguel'] + $contrato['valor_condominio'] + $iptu;
        $taxa = ($contrato['valor_aluguel'] * 10)/100;
        $repasse = ($contrato['valor_aluguel'] + $iptu) - $taxa;
        $start = new DateTime($contrato['start_date']);
        $end = new DateTime($contrato['end_date']);
        $estadia = $start->diff($end);
        $mensalidade->setContratoId($contrato['id']);
        $mensalidade->setMensalidade($valor);
        $mensalidade->setRepasse($repasse);
        $mensalidade->setMensalidadeStatus(0);
        $mensalidade->setRepasseStatus(0);
        $mensalidade->setEstadia($estadia->m);
        $mensalidade->setStartDate($contrato['start_date']);
        $sql = $mensalidade->cadastrar_mensalidades();
        if($sql){
            $consulta = $mensalidade->consultar($contrato['id']);
        }else{
            $consulta = '';
            $texto = "Error";
        }    
    }else{
        $consulta;
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
	<a href="../contrato/cadastrar.php">Cadastrar Contratos</a>
	</p>
	<hr />
    <?php
        if(!empty($consulta)){
    ?>
        <table border="1" align="center">
            <tr>
                <th>Mensalidade</th>
                <th>Repasse</th>
                <th>Mensalidade Status</th>
                <th>Repasse Status</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
            <?php
                foreach($consulta as $key => $value){
            ?>
                <tr>
                    <td><?=$value['mensalidade']?></td>
                    <td><?=$value['repasse']?></td>
                    <td><?=$value['mensalidade_status'] ? 'Pago' : 'Não Pago'?></td>
                    <td><?=$value['repasse_status'] ? 'Realizado' : 'Não Realizado'?></td>
                    <td><?=date('d/m/Y', strtotime($value['date']))?></td>
                    <td>
                        <a href="atualizar.php?contract_id=<?=$contrato_id?>&id=<?=$value['id']?>&name=m">Pagar mensalidade</a><br>
                        <a href="atualizar.php?contract_id=<?=$contrato_id?>&id=<?=$value['id']?>&name=r">Pagar repasse</a>
                    </td>
                </tr>
            <?php   
            }
            ?>
        </table>
    <?php   
    }else{
    ?>
        <p align="center"><?=$texto?></p>
    <?php   
    }
    ?>
</body>
</html>
<?php
require_once("../../models/contrato/contrato.php");

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
        $contrato_id_criado = $contrato->cadastrar_contrato();
        if(!empty($contrato_id_criado)){
            $texto = "Contrato cadastrado com sucesso.";
            $link = 'success';
        }else{
            $texto = "Erro ao tentar cadastrar contrato";
            $link = 'error';
        }
    }else{
        $contrato_id_criado = $consulta->id;
        $texto = "Imovel já cadastrado!";
        $link = 'have';
    }
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        link = document.getElementById("link").value;
        if(link == 'success'){
            alert("Contrato cadastrado com sucesso");
            window.location.href = "../mensalidade/consulta.php?id=<?=$contrato_id_criado?>";
        }
    });
</script>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de gestão de locação para imobiliárias</title>
    <link href="../../public/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../public/css/index.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <div class="cover-container d-flex h-100 w-100 p-3 mx-auto flex-column">
      <header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand">Vista</h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link" href="../../index.php">Home</a>
            <a class="nav-link active" href="../../views/cliente/cadastrar.php">Cadastrar cliente</a>
            <a class="nav-link" href="../../views/proprietario/cadastrar.php">Cadastrar proprietario</a>
            <a class="nav-link" href="../../views/imovel/cadastrar.php">Cadastrar imóvel</a>
          </nav>
        </div>
      </header>
      <main role="main" class="inner cover" style="margin-left:20%">
            <h5 style="margin-right:25%"><?=$texto?></h5>
            <p style="margin-right:25%"><?=$texto?>
                <input type="hidden" id="link" value=<?=$link?>>
                <?php if ($link=='have'): ?>
                    <a href="../mensalidade/consulta.php?id=<?=$contrato_id_criado?>">Ver mensalidade</a>
                <?php endif ?>
            </p>
      </main>
      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>Vista @2022</p>
        </div>
      </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  </body>
</html>
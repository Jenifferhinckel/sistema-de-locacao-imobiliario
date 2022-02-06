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
        $texto = "Imovel já cadastrado!";
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de gestão de locação para imobiliárias</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/index.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <div class="cover-container d-flex h-100 w-100 p-3 mx-auto flex-column">
      <header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand">Vista</h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link" href="../index.php">Home</a>
            <a class="nav-link active" href="../imovel/cadastrar.php">Cadastrar imóvel</a>
            <a class="nav-link" href="../contrato/cadastrar.php">Cadastrar contrato</a>
            <a class="nav-link" href="../cliente/cadastrar.php">Cadastrar cliente</a>
          </nav>
        </div>
      </header>
      <main role="main" class="inner cover" style="margin-left:20%">
            <h5 style="margin-right:25%"><?=$texto?></h5>
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
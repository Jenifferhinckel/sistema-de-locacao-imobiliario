<?php
require_once("../../models/cliente/cliente.php");

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
<?php
    require_once("../../lib/conexao.php");
    
    $conexao = new conexao;
    $query = "SELECT c.id, p.name FROM clientes as p JOIN contratos as c on p.id = c.cliente_id";
    $clientes = $conexao->query($query);
    $clientes = mysqli_fetch_all($clientes, MYSQLI_ASSOC);
?>
<script>
    var ajax = new XMLHttpRequest;
    function buscar(){
        var contract_id = document.getElementById("contract_id").value;
        window.location.href = "../../controllers/mensalidade/consulta.php?id="+contract_id;
    }
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
      <header class="masthead mb-auto" style="margin-right:10%">
        <div class="inner">
          <h3 class="masthead-brand">Vista</h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link" href="../../index.php">Home</a>
            <a class="nav-link active" href="#">Mensalidade</a>
          </nav>
        </div>
      </header>

      <main role="main" class="inner cover" >
        <div class="row">    
            <fieldset class="form-group col-md-7" style="margin-bottom:16%; margin-left:8%">
                <h1 class="h3 mb-3 font-weight-normal">Mensalidade</h1>
                <label for="cliente" class="float-left">Selecionar Mensalidade do Cliente:</label>
                <select class="custom-select d-block w-100" id="contract_id" name="contract_id" required>
                    <option value="">Selecionar</option>
                    <?php
                        foreach($clientes as $key => $value){
                    ?>
                        <option value="<?=$value['id']?>"><?=$value['name']?></option>
                    <?php   
                    }
                    ?>
                </select>
            </fieldset>
            <fieldset class="form-group col-md-3" style="margin-top:11%">
                <button class="btn btn-lg btn-primary float-right" style="background-color:#55b5a6; border-color:#55b5a6;" type="button" onclick="buscar()">Pesquisar</button>
            </fieldset>
        </div>
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
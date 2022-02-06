<?php
    require_once("../conexao.class.php");
   
    $conexao = new conexao;
    $query = "SELECT * FROM imoveis";
    $imoveis = $conexao->query($query);
    $imoveis = mysqli_fetch_all($imoveis, MYSQLI_ASSOC);
    
    $query_clientes = "SELECT * FROM clientes";
    $clientes = $conexao->query($query_clientes);
    $clientes = mysqli_fetch_all($clientes, MYSQLI_ASSOC);
?>
<script>
    var ajax = new XMLHttpRequest;
    function find(address_id){
        ajax.open("GET", "consulta.php?address_id="+address_id);
        ajax.onreadystatechange = function(){
            if(ajax.readyState == 4 && ajax.status == 200){
                var result = JSON.parse(ajax.responseText);
                document.getElementById("proprietario_id").value = result.id;
                document.getElementById("proprietario_name").value = result.name;
            }
        }
        ajax.send(null);
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
            <a class="nav-link active" href="cadastrar.php">Cadastrar contrato</a>
            <a class="nav-link" href="../imovel/cadastrar.php">Cadastrar Imóvel</a>
            <a class="nav-link" href="../mensalidade/buscar.php">Mensalidade</a>
          </nav>
        </div>
      </header>

      <main role="main" class="inner cover" style="margin-left:10%; margin-right:10%">
        <form class="form-signin" method="POST" action="registrar.php" style="max-width:100%">
            <h5 class="mb-3 font-weight-normal pt-3">Cadastrar Contrato</h5>
            <div class="row">
              <div class="col-md-6 mb-1">
                    <label for="imoveis" class="float-left">Selecionar Endereço:</label>
                    <select class="custom-select d-block w-100" id="imovel_id" name="imovel_id" onchange="find(this.value)" required>
                        <option value="">Selecionar</option>
                        <?php
                            foreach($imoveis as $key => $value){
                        ?>
                            <option value="<?=$value['id']?>"><?=$value['address']?></option>
                        <?php   
                        }
                        ?>
                    </select>
                    </div>
                <div class="col-md-6 mb-1">
                    <label for="proprietario" class="float-left">Proprietário:</label>
                    <input type="hidden" id="proprietario_id" name="proprietario_id">
                    <input type="text" id="proprietario_name" name="proprietario_name" class="form-control my-2" disabled>
                </div>
            </div>
            
            <label for="locatario" class="float-left">Selecionar Locatário:</label>
            <select class="custom-select d-block w-100 mb-1" id="cliente_id" name="cliente_id" required>
                <option value="">Selecionar</option>
                <?php
                    foreach($clientes as $key => $value){
                ?>
                    <option value="<?=$value['id']?>"><?=$value['name']?> - <?=$value['email']?></option>
                <?php   
                }
                ?>
            </select>

            <div class="row">
              <div class="col-md-6 mb-2">
                <label for="date_start" class="float-left">Data Ínicio:</label>
                <input type="date" name="start_date" class="form-control" required>
              </div>
              <div class="col-md-6 mb-2">
                <label for="data_end" class="float-left">Data Fim:</label>
                <input type="date" name="end_date" class="form-control" required>
              </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-2">
                  <label for="taca" class="float-left">Taxa de Administração(%):</label>
                  <input type="text" name="taxa_admin" class="form-control" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="aluguel" class="float-left">Valor do Aluguel:</label>
                    <input type="text" name="valor_aluguel" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-2">
                  <label for="condominio" class="float-left">Valor do Condomínio:</label>
                  <input type="text" name="valor_condominio" class="form-control my-2" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="iptu" class="float-left">Valor do IPTU:</label>
                    <input type="text" name="valor_iptu" class="form-control my-2" required>
                </div>
            </div>
            
            <button class="btn btn-lg btn-primary btn-block" style="background-color:#55b5a6; border-color:#55b5a6;" type="submit">Cadastrar</button>
        </form>
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
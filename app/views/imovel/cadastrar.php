<?php
    require_once("../../lib/conexao.php");
    $dados = array(
        'fields' => array( 'Endereco' )
    );
    
    $dados = json_encode($dados);
    $key='c9fdd79584fb8d369a6a579af1a8f681';
    $url="http://sandbox-rest.vistahost.com.br/imoveis/listar?key=$key&pesquisa=$dados";
    $ch="";
    $ch = curl_init($url);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_HTTPHEADER , array( 'Accept: application/json' ) );
    $result = curl_exec( $ch );
    $resultAddress = json_decode( $result, true );
    
    $conexao = new conexao;
    $query = "SELECT * FROM proprietarios";
    $proprietarios = $conexao->query($query);
    $proprietarios = mysqli_fetch_all($proprietarios, MYSQLI_ASSOC);
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
            <a class="nav-link active" href="cadastrar.php">Cadastrar Imóvel</a>
            <a class="nav-link" href="../../views/cliente/cadastrar.php">Cadastrar cliente</a>
            <a class="nav-link" href="../../views/proprietario/cadastrar.php">Cadastrar proprietário</a>
          </nav>
        </div>
      </header>

      <main role="main" class="inner cover" style="margin-left:20%">
        <form class="form-signin" method="POST" action="../../controllers/imovel/imovelController.php" style="max-width:330px">
            <h1 class="h3 mb-3 font-weight-normal">Cadastrar Imóvel</h1>
            <label for="imoveis" class="float-left">Selecionar Endereço:</label>
            <select class="custom-select d-block w-100" id="imoveis" name="imoveis" required>
                <option value="">Selecionar</option>
                <?php
                    foreach($resultAddress as $key => $value){
                ?>
                    <option value="<?=$value['Codigo']?>-<?=$value['Endereco']?>"><?=$value['Endereco']?></option>
                <?php   
                }
                ?>
            </select>
            <label for="proprietarios" class="float-left">Selecionar Proprietários:</label>
            <select class="custom-select d-block w-100 my-2" id="proprietarios" name="proprietarios" required>
                <option value="">Selecionar</option>
                <?php
                    foreach($proprietarios as $key => $value){
                ?>
                    <option value="<?=$value['id']?>"><?=$value['name']?></option>
                <?php   
                }
                ?>
            </select>
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
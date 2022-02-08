<?php
require_once("../../lib/conexao.php");
require_once("../../models/mensalidade/mensalidade.php");

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
        $estadia_days = $start->diff($end);
        $estadia_months = ($estadia_days->days /30);
        $mensalidade->setContratoId($contrato['id']);
        $mensalidade->setMensalidade($valor);
        $mensalidade->setRepasse($repasse);
        $mensalidade->setMensalidadeStatus(0);
        $mensalidade->setRepasseStatus(0);
        $mensalidade->setEstadia(round($estadia_months));
        $mensalidade->setStartDate($contrato['start_date']);
        $mensalidade->setEndDate($contrato['end_date']);
        $mensalidade->setAluguel($contrato['valor_aluguel']);
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
            <a class="nav-link active" href="../../views/mensalidade/buscar.php">Mensalidade</a>
            <a class="nav-link" href="../../views/contrato/cadastrar.php">Cadastrar contrato</a>
            <a class="nav-link" href="../../views/imovel/cadastrar.php">Cadastrar imóvel</a>
          </nav>
        </div>
      </header>
      <main role="main" class="inner cover" style="width:120%; margin-left:-9%">
      <h1 class="h3 mb-3 font-weight-normal">Mensalidade</h1>
        <?php
            if(!empty($consulta)){
        ?>
            <div class="table-responsive">
                <table class="table table-striped table-sm" style="background-color:#AAB7B8">
                    <thead style="background-color:#55b5a6;">
                        <tr>
                            <th>Mensalidade</th>
                            <th>Repasse</th>
                            <th>Mensalidade Status</th>
                            <th>Repasse Status</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
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
                                <a style="background-color:#55b5a6; border-color:#55b5a6;" class="btn btn-primary mb-1" href="atualizar.php?contract_id=<?=$contrato_id?>&id=<?=$value['id']?>&name=m">Pagar mensalidade</a><br>
                                <a style="background-color:#55b5a6; border-color:#55b5a6;" class="btn btn-primary" href="atualizar.php?contract_id=<?=$contrato_id?>&id=<?=$value['id']?>&name=r">Pagar repasse</a>
                            </td>
                        </tr>
                    <?php   
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        <?php   
        }else{
        ?>
            <p align="center"><?=$texto?></p>
        <?php   
        }
        ?>
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
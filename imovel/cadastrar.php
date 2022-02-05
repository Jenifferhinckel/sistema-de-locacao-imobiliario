<?php
    require_once("../conexao.class.php");
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
    $proprietarios = $proprietarios->fetch_all();
?>
<html>
    <head>
        <title>Cadastrar Imovel</title>
    </head>
    <body>
        <h3>Cadastrar Imovel</h3>
        <hr />
        <a href="../index.php">Sair</a>
        <h4>Cadastrar Imovel</h4>
        <form method="POST" action="registrar.php">
            Selecionar Endereço:
            <select name="imoveis" id="imoveis">
                <option value="">Selecionar</option>
                <?php
                    foreach($resultAddress as $key => $value){
                ?>
                    <option value="<?=$value['Codigo']?>-<?=$value['Endereco']?>"><?=$value['Endereco']?></option>
                <?php   
                }
                ?>
            </select>
            Selecionar Proprietários:
            <select name="proprietarios" id="proprietarios">
                <option value="">Selecionar</option>
                <?php
                    foreach($proprietarios as $key => $value){
                ?>
                    <option value="<?=$value[0]?>"><?=$value[1]?></option>
                <?php   
                }
                ?>
            </select>
            <input type="submit" value="Salvar">
        </form>
    </body>
</html>
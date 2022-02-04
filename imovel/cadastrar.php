<?php
    require_once("../conexao.class.php");
    $dados = array(
        'fields' => array( 'Endereco' )
    );
    
    $dados = json_encode($dados);
    $key='c9fdd79584fb8d369a6a579af1a8f681';
    $url="http://sandbox-rest.vistahost.com.br/imoveis/listar?key=c9fdd79584fb8d369a6a579af1a8f681&pesquisa=$dados";
    $ch="";
    $ch = curl_init($url);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_HTTPHEADER , array( 'Accept: application/json' ) );
    $result = curl_exec( $ch );
    $resultAddress = json_decode( $result, true );
    
    $conexao = new conexao;
    $query = "SELECT * FROM proprietarios";
    $teste = $conexao->query($query);
    $teste = $teste->fetch_all();
    // echo '<pre>';
    // var_dump($teste);
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
                    foreach($teste as $key => $value){
                ?>
                    <option value="<?=$value[0]?>"><?=$value[1]?></option>
                <?php   
                }
                ?>
            </select>
            <input type="submit" value="Salvar">
        </form>
            <!-- <button type="submit" onclick="findAddress()">Pesquisar</button> -->
        <!-- <table align="center" border="1" cellspacing="0">
            <tr>
                <th>Codigo</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>ValorVenda</th>
                <th>ValorLocacao</th>
                <th>Selecionar</th>
            </tr>
        <?php
        foreach($result as $key => $value){
        ?> 
            <tr>
                <td><?=isset($value['Codigo']) ? $value['Codigo'] : 'indefinido' ?></td>
                <td><?=isset($value['Bairro']) ? $value['Bairro'] : 'indefinido' ?></td>
                <td><?=isset($value['Cidade']) ? $value['Cidade'] : 'indefinido' ?></td>
                <td><?=isset($value['ValorVenda']) ? $value['ValorVenda'] : 'indefinido' ?></td>
                <td><?=isset($value['ValorLocacao']) ? $value['ValorLocacao'] : 'indefinido' ?></td>
                <td><a href="#">Selecionar</a></td>
            </tr>
        <?php   
        }
        ?>
		</table>
        <h4>Proprietários</h4>
        <table align="center" border="1" cellspacing="0">
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Selecionar</th>
            </tr>
            <tr>
                <td><?=isset($proprietarios['name']) ? $proprietarios['name'] : 'indefinido' ?></td>
                <td><?=isset($proprietarios['email']) ? $proprietarios['email'] : 'indefinido' ?></td>                
                <td><a href="#">Selecionar</a></td>
            </tr>
		</table>
        <form method="POST" action="registrar.php">
            <table>
                <tr>
                    <td colspan="2" align="right" >* campo(s) obrigatórios</td>
                </tr>
                <tr>
                    <td align="right">*Endereço:</td>
                    <td><input type="text" name="address" /></td>
                </tr>
                <tr>
                    <td align="right">*Proprietário cadastrado:</td>
                    <td><input type="text" name="proprietario" /></td>
                </tr>
                <tr>
                    <td colspan="2" align="right">
                        <input type="submit" value="Cadastrar" />
                    </td>
                </tr>
            </table>
        </form> -->
    </body>
</html>
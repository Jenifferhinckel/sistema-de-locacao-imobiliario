<?php
    require_once("../conexao.class.php");
   
    $conexao = new conexao;
    $query = "SELECT * FROM imoveis";
    $imoveis = $conexao->query($query);
    $imoveis = $imoveis->fetch_all();
    $query_clientes = "SELECT * FROM clientes";
    $clientes = $conexao->query($query_clientes);
    $clientes = $clientes->fetch_all();
?>
<script>
    var ajax = new XMLHttpRequest;
        function find(address_id){
            ajax.open("GET", "consulta.php?address_id="+address_id);
            ajax.onreadystatechange = function(){
                if(ajax.readyState == 4 && ajax.status == 200){
                    var result = ajax.responseText;
                    console.log(result);
                    document.getElementById("id_proprietario").value = result;
                }
            }
            ajax.send(null);
        }
</script>
<html>
    <head>
        <title>Cadastrar Contrato</title>
    </head>
    <body>
        <h3>Cadastrar Contrato</h3>
        <hr />
        <a href="../index.php">Sair</a>
        <h4>Cadastrar Contrato</h4>
        <form method="POST" action="registrar.php">
            Selecionar Endereço:
            <select name="imovel_id" id="imovel_id" onchange="find(this.value)" required>
                <option value="">Selecionar</option>
                <?php
                    foreach($imoveis as $key => $value){
                ?>
                    <option value="<?=$value[0]?>"><?=$value[2]?></option>
                <?php   
                }
                ?>
            </select>
            Proprietário:
            <input type="text" id="proprietario_id" disabled>
            Selecionar Locatário:
            <select name="cliente_id" id="cliente_id" onchange="find(this.value)" required>
                <option value="">Selecionar</option>
                <?php
                    foreach($clientes as $key => $value){
                ?>
                    <option value="<?=$value[0]?>"><?=$value[2]?></option>
                <?php   
                }
                ?>
            </select>
            Data Ínicio:
                <input type="date" id="start_date" required>
            Data Fim:
                <input type="date" id="end_date" required>
            Taxa de Administração:
                <input type="text" id="taxa_admin" required>
            Valor do Aluguel:
                <input type="text" id="valor_aluguel" required>
            Valor do Condomínio:
                <input type="text" id="valor_condominio" required>
            Valor do IPTU:
                <input type="text" id="valor_iptu" required>
            <input type="submit" value="Salvar">
        </form>
    </body>
</html>
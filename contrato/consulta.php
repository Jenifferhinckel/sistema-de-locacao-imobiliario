<?php
    require_once("../conexao.class.php");
    $conexao = new conexao;

    $address_id = $_GET['address_id'];
    $query = "SELECT proprietarios.id, proprietarios.name FROM imoveis 
    LEFT JOIN proprietarios ON imoveis.proprietario_id = proprietarios.id 
    WHERE imoveis.id ="."'$address_id'";
    $proprietario = $conexao->query($query);
    $proprietario = $proprietario->fetch_row();
    if(!empty($proprietario)){
        $array = [
            'id' => $proprietario[0],
            'name' => $proprietario[1]
        ];
    }
    echo json_encode($array);
?>
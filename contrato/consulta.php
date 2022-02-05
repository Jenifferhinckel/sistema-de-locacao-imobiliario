<?php
    require_once("../conexao.class.php");
    $conexao = new conexao;

    $address_id = $_GET['address_id'];
    $query = "SELECT proprietarios.name FROM imoveis 
    LEFT JOIN proprietarios ON imoveis.proprietario_id = proprietarios.id 
    WHERE imoveis.id ="."'$address_id'";
    $proprietario_name = $conexao->query($query);
    $proprietario_name = $proprietario_name->fetch_row();
    // var_dump($proprietario_name);
    return $proprietario_name[0];
?>
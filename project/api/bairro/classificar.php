<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");


$req  = json_decode(file_get_contents("php://input"), true);

try {
	$bd = include "../pdo.php";
	$md = $bd->prepare("SELECT (select count(bairro_idbairro) from classificacao where bairro_idbairro = :bairro_idbairro 
and `data` BETWEEN  CURRENT_DATE()-5 AND CURRENT_DATE() and valor = 1) as perigo, (select count(bairro_idbairro) from classificacao where bairro_idbairro = :bairro_idbairro 
and `data` BETWEEN  CURRENT_DATE()-5 AND CURRENT_DATE() and valor = 0) as seguro, (select count(email) from usuario 
where bairro_idbairro = :bairro_idbairro) as quantidadeU");
	$md->execute($req);
    $dados = $md->fetch(PDO::FETCH_ASSOC);

    echo json_encode($dados);

} catch(Exception $e) {
    die("erro com o servidor: " . $e->getMessage());
}
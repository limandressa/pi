<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

session_start();
if (!$_SESSION['login']) die("não está logado");


try {
	$bd = include "../pdo.php";
	$md = $bd->prepare("SELECT  b.idbairro, b.nome, b.latitude, b.longitude, (SELECT COUNT(bairro_idbairro) FROM classificacao WHERE 
`data` BETWEEN  CURRENT_DATE()-5 AND NOW() AND valor = 1 AND bairro_idbairro = b.idbairro) AS perigo,
(SELECT COUNT(bairro_idbairro) FROM classificacao WHERE 
`data` BETWEEN  CURRENT_DATE()-5 AND NOW() AND valor = 0 AND bairro_idbairro = b.idbairro) AS seguro, 
(SELECT COUNT(u.email) FROM usuario u 
WHERE u.bairro_idbairro = b.idbairro AND `data` NOT BETWEEN CURRENT_DATE()-5 AND NOW()) AS quantidadeU
FROM bairro b
LEFT JOIN classificacao c 
ON c.bairro_idbairro = b.idbairro 
GROUP BY b.nome
ORDER BY b.idbairro ASC");
	$md->execute();
    $dados = $md->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($dados);
    

} catch(Exception $e) {
    die("erro com o servidor: " . $e->getMessage());
}
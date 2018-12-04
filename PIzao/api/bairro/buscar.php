<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

session_start();
if (!$_SESSION['login']) die("não está logado");


try {
	$bd = include "../pdo.php";
	$md = $bd->prepare("SELECT COUNT(u.email) AS quantidadeU, b.idbairro, b.nome, b.latitude, b.longitude, (SELECT COUNT(bairro_idbairro) FROM classificacao WHERE 
`data` BETWEEN  CURRENT_DATE()-5 AND NOW() AND valor = 1 AND bairro_idbairro = b.idbairro) AS perigo,
(SELECT COUNT(bairro_idbairro) FROM classificacao WHERE 
`data` BETWEEN  CURRENT_DATE()-5 AND NOW() AND valor = 0 AND bairro_idbairro = b.idbairro) AS seguro FROM usuario u 
RIGHT JOIN classificacao c
ON u.email = c.usuario_email
RIGHT JOIN bairro b
ON c.bairro_idbairro = b.idbairro
OR u.data NOT BETWEEN CURRENT_DATE()-5 AND NOW()
GROUP BY b.idbairro
ORDER BY b.idbairro ASC");
	$md->execute();
    $dados = $md->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($dados);
    

} catch(Exception $e) {
    die("erro com o servidor: " . $e->getMessage());
}
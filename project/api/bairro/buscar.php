<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

session_start();
if (!$_SESSION['login']) die("não está logado");


try {
	$bd = include "../pdo.php";
	$md = $bd->prepare("SELECT  b.idbairro, b.nome, b.latitude, b.longitude, (select count(bairro_idbairro) from classificacao where 
`data` BETWEEN  CURRENT_DATE()-5 AND NOW() and valor = 1 and bairro_idbairro = b.idbairro) as perigo,
(select count(bairro_idbairro) from classificacao where 
`data` BETWEEN  CURRENT_DATE()-5 AND NOW() and valor = 0 and bairro_idbairro = b.idbairro) as seguro, 
(select count(u.email) from usuario u 
where u.bairro_idbairro = b.idbairro) as quantidadeU
from bairro b
left join classificacao c 
on c.bairro_idbairro = b.idbairro 
group by b.nome
order by b.idbairro asc");
	$md->execute();
    $dados = $md->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($dados);
    

} catch(Exception $e) {
    die("erro com o servidor: " . $e->getMessage());
}
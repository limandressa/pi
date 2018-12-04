<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

session_start();
if (!$_SESSION['login']) die("não está logado");


try {
	$bd = include "../pdo.php";
	$md = $bd->prepare("
SELECT c.data, b.nome, c.valor FROM classificacao c
INNER JOIN bairro b ON b.idbairro = c.bairro_idbairro
 WHERE usuario_email = :email
 ORDER BY c.data DESC");
	$md->execute([
		'email'=> $_SESSION['login']
	]);
    $dados = $md->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($dados);
    

} catch(Exception $e) {
    die("erro com o servidor: " . $e->getMessage());
}
<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

session_start();
if (!$_SESSION['login']) die("não está logado");

$obj = json_decode( file_get_contents('php://input'), true );

try {
	$bd = include "../pdo.php";

	$md = $bd -> prepare("SELECT u.email, u.nome, u.bairro_idbairro, u.senha, b.latitude, b.longitude, b.nome AS nomeBairro, b.idbairro,
(SELECT COUNT(u.email) FROM usuario u WHERE u.bairro_idbairro = :bairro_idbairro) AS qtd
FROM usuario u, bairro b WHERE email=:email AND u.bairro_idbairro = b.idbairro");
	$md->execute([
		'email'=> $_SESSION['login'],
		'bairro_idbairro' => $obj['bairro_idbairro']
	]);

    $dados = $md->fetch(PDO::FETCH_ASSOC);


    echo json_encode($dados);


} catch (Exception $e) {
     echo "Houve algum erro " . $e->getMessage();
}
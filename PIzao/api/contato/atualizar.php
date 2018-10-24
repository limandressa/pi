<?php

session_start();
if (!$_SESSION['login']) die("não está logado");

$strRecebido = file_get_contents('php://input');
$objRecebido = json_decode($strRecebido);

try {
	
	$bd = include "../pdo.php";
	$md = $bd->prepare("UPDATE usuario SET nome=:nome, senha=:senha, bairro_idbairro=:idbairro WHERE email=:email LIMIT 1");
	$md->execute([
		'email' => $_SESSION['login'],
		'nome' => $objRecebido->nome,
		'senha' => $objRecebido->senha,
		'idbairro' => $objRecebido->idbairro
	]);
    echo "inserido";

} catch(Exception $e) {
    die("erro com o servidor: " . $e->getMessage());
}
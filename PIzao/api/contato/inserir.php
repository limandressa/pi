<?php

$strRecebido = file_get_contents('php://input');
$objRecebido = json_decode($strRecebido);

try {
	
	$bd = include "../pdo.php";
	$md = $bd->prepare("INSERT INTO usuario(email, nome, senha, bairro_idbairro, data) VALUES (:email, :nome, :senha, :idbairro, NOW())");
	$md->execute([
		'email' => $objRecebido->email,
		'nome' => $objRecebido->nome,
		'senha' => $objRecebido->senha,
		'idbairro' => $objRecebido->idbairro
	]);

    echo "inserido";

} catch(Exception $e) {
    die("erro com o servidor: " . $e->getMessage());
}
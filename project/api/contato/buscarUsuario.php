<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

session_start();
if (!$_SESSION['login']) die("não está logado");

$obj = json_decode( file_get_contents('php://input'), true );

try {
	$bd = include "../pdo.php";
	$md = $bd -> prepare("
SELECT u.email, u.nome, u.bairro_idbairro, u.senha, b.nome as nomeBairro FROM usuario u, bairro b WHERE email=:email and u.bairro_idbairro = b.idbairro");
	$md->execute([
		'email'=> $_SESSION['login']
		//'email' => $obj['email'],
	]);

    $dados = $md->fetch(PDO::FETCH_ASSOC);


    echo json_encode($dados);
	
	$count = $md->rowCount();
    
    print("$count rows.\n");

    if ($count > 0) {
    	print("a nao");
    }


} catch (Exception $e) {
     echo "Houve algum erro " . $e->getMessage();
}
<?php

session_start();
if (!$_SESSION['login']) die("não está logado");

$strRecebido = file_get_contents('php://input');
$objRecebido = json_decode($strRecebido);

try {
	
	$bd = include "../pdo.php";

	$mdTeste = $bd->prepare("SELECT COUNT(email) as qtd FROM usuario WHERE email = :email AND senha = :senhaAntiga");
	$mdTeste->execute([
		'email' => $_SESSION['login'],
		'senhaAntiga' => $objRecebido->senhaAntiga
	]); 

	$count = $mdTeste->rowCount();
	$res = $mdTeste->fetch(PDO::FETCH_ASSOC);


	if ($res['qtd'] == 1) {

		if (is_object($objRecebido) && empty($objRecebido->idbairro)) {

			$md = $bd->prepare("UPDATE usuario SET nome=:nome, senha=:senha WHERE email=:email LIMIT 1");
			$md->execute([
				'email' => $_SESSION['login'],
				'nome' => $objRecebido->nome,
				'senha' => $objRecebido->senha
			]);
		    echo "inserido";
		} else {

				$md = $bd->prepare("UPDATE usuario SET nome=:nome, senha=:senha, bairro_idbairro=:idbairro WHERE email=:email LIMIT 1");
				$md->execute([
					'email' => $_SESSION['login'],
					'nome' => $objRecebido->nome,
					'senha' => $objRecebido->senha,
					'idbairro' => $objRecebido->idbairro
				]);
			    echo "CU";
		}
	} else {
		echo "erro";
	}

} catch(Exception $e) {
    die("erro com o servidor: " . $e->getMessage());
}
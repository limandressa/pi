<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

session_start();

if (!$_SESSION['login']) die("não está logado");
 
 $obj = json_decode( file_get_contents('php://input'), true );
 try {
 
 	$bd = include "../pdo.php";

 	/**/

 	$mdTeste2 = $bd->prepare("SELECT count(nome) as qtd from usuario where bairro_idbairro = :bairro_idbairro and email = :email");
	$mdTeste2->execute([
		'email' => $_SESSION['login'],
		'bairro_idbairro' => $obj['bairro_idbairro'],
		//'email' => $obj['email']
	]);

	$count2 = $mdTeste2->rowCount();
	$res = $mdTeste2->fetch(PDO::FETCH_ASSOC);

	
	$mdTeste1 = $bd->prepare("SELECT count(usuario_email) as qtd from classificacao where usuario_email = :email AND `data` BETWEEN CURRENT_DATE()-1 AND NOW() AND valor = :valor");
	$mdTeste1->execute([
		'email' => $_SESSION['login'],
		'valor' => $obj['valor']
		//'bairro_idbairro' => $obj['bairro_idbairro'],
		//'email' => $obj['email']
	]);

	$count1 = $mdTeste1->rowCount();
	$res1 = $mdTeste1->fetch(PDO::FETCH_ASSOC);

	echo json_encode([
		"testBairro" => (int)$res['qtd'],
		"testClick" => (int)$res1['qtd']
	]);
	
	if ($res['qtd'] > 0 && $res1['qtd'] == 0) {

 		$md = $bd->prepare("INSERT INTO classificacao(bairro_idbairro, valor, data, usuario_email) VALUES (:bairro_idbairro, :valor, NOW(), :email)");	
 			$md->execute([	
 			'bairro_idbairro' => $obj['bairro_idbairro'],	
 			'valor' => $obj['valor'],	
 			'email' => $_SESSION['login'] 	
 			//'email' => $obj['email']
 		]);
 	}
 

 
 } catch(Exception $e) {
     die("erro com o servidor: " . $e->getMessage());
 }


/*
try {

	$bd = include "../pdo.php";

	$mdTeste = $bd->prepare("SELECT * from classificacao where usuario_email = :email and `data` BETWEEN CURRENT_DATE()-1 AND NOW()");
	$mdTeste->execute([
		//'email' => $obj['email']
	]); 

	$count = $mdTeste->rowCount();

	//testa se o bairro que o cara quer alertar é mesmo o bairro dele senão não deixa
	$mdTeste2 = $bd->prepare("SELECT nome from usuario where bairro_idbairro = :bairro_idbairro and email = :email");
	$mdTeste2->execute([
		'email' => $_SESSION['login'],
		'bairro_idbairro' => $obj['bairro_idbairro'],
		'email' => $obj['email']
	]);

	$count2 = $mdTeste2->rowCount();



	if ($count > 0 && $count2 > 0) {
		$md = $bd->prepare("INSERT INTO classificacao(bairro_idbairro, valor, data, usuario_email) VALUES (:bairro_idbairro, :valor, NOW(), :email)");
		$md->execute([
			'bairro_idbairro' => $obj['bairro_idbairro'],
			'valor' => $obj['valor'],
			//'email' => $obj['email']
			'email' => $_SESSION['login'] 
		]);

		echo "usul deu certo";

	} else {
		echo "o count e menor que zero e esse n e seu bairro!!!";
	}

	var_dump($count2);
	var_dump($count);

} catch(Exception $e) {
    die("erro com o servidor: " . $e->getMessage());
}
*/



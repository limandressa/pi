<?php 

session_start();
if (!$_SESSION['login']) die("não está logado");

try {

	$bd = include "../pdo.php";
	$md = $bd->prepare("DELETE FROM classificacao WHERE usuario_email = :email");
	$md->execute([
		'email' => $_SESSION['login'] 
	]);

	$md2 = $bd->prepare("DELETE FROM usuario WHERE email = :email LIMIT 1");
	$md2->execute([
		'email' => $_SESSION['login'] 
	]);

	echo "foi";
	
} catch(Exception $e) {
    die("erro com o servidor: " . $e->getMessage());
}




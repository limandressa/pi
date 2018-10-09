<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

session_start();
if (!$_SESSION['login']) die("não está logado");

$strRecebido = file_get_contents('php://input');
$objRecebido = json_decode($strRecebido);

try {
	$bd = include "../pdo.php";
	$md = $bd->prepare("SELECT idcidade, nome FROM cidade");
	$md->execute();
    $dados = $md->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($dados);

} catch(Exception $e) {
    die("erro com o servidor: " . $e->getMessage());
}
<?php

// $bd é conexão com o banco de dados
// decla $md é manipulador declaraçãohttp://127.0.0.1/rodinhas/api/contato/inserir.php

session_start();
if (!$_SESSION['login']) die("não está logado");

$strRecebido = file_get_contents('php://input');
$objRecebido = json_decode($strRecebido);


$mensagensDeErro = [];

if ( !is_object($objRecebido)) 
	$mensagensDeErro[] = "Os dados enviados para o servidor não são um objeto válido";

if ( is_object($objRecebido) && !property_exists($objRecebido, 'nome')) 
	$mensagensDeErro[] = "Faltou o atributo nome no json enviado";

if ( is_object($objRecebido) && !property_exists($objRecebido, 'email')) 
	$mensagensDeErro[] = "Faltou o atributo email no json enviado";

if ( is_object($objRecebido) && property_exists($objRecebido, 'nome') && empty($objRecebido->nome))
	$mensagensDeErro[] = "O atributo nome não pode ser vazio";

if ( is_object($objRecebido) && property_exists($objRecebido, 'email') && empty($objRecebido->email))
	$mensagensDeErro[] = "O atributo email não pode ser vazio";

if ( is_object($objRecebido) && !property_exists($objRecebido, 'senha')) 
	$mensagensDeErro[] = "Faltou o atributo senha no json enviado";

if ( is_object($objRecebido) && !property_exists($objRecebido, 'idbairro')) 
	$mensagensDeErro[] = "Faltou o atributo idbairro no json enviado";

if ( is_object($objRecebido) && property_exists($objRecebido, 'senha') && empty($objRecebido->senha))
	$mensagensDeErro[] = "O atributo senha não pode ser vazio";

if ( is_object($objRecebido) && property_exists($objRecebido, 'idbairro') && empty($objRecebido->idbairro))
	$mensagensDeErro[] = "O atributo idbairro não pode ser vazio";

if ( !empty($mensagensDeErro) )
	die( implode("\n", $mensagensDeErro));


try {
	
	$bd = include "../pdo.php";
	$md = $bd->prepare("INSERT INTO usuario(email, nome, senha, bairro_idbairro) VALUES (:email, :nome, :senha, :idbairro)");
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

//$mensagensDeErro = [];
//
//if ( !is_object($objRecebido)) 
//	$mensagensDeErro[] = "Os dados enviados para o servidor não é um objeto válido";
//
//if ( is_object($objRecebido) && !property_exists($objRecebido, 'nome')) 
//	$mensagensDeErro[] = "Faltou o atributo nome no json enviado";
//
//if ( is_object($objRecebido) && !property_exists($objRecebido, 'telefone')) 
//	$mensagensDeErro[] = "Faltou o atributo telefone no json enviado";
//
//if ( is_object($objRecebido) && property_exists($objRecebido, 'nome') && empty($objRecebido->nome))
//	$mensagensDeErro[] = "O atributo nome não pode ser vazio";
//
//if ( is_object($objRecebido) && property_exists($objRecebido, 'telefone') && empty($objRecebido->telefone))
//	$mensagensDeErro[] = "O atributo telefone não pode ser vazio";
//
//if ( !empty($mensagensDeErro) )
//	die( implode("\n", $mensagensDeErro));

<?php 

  session_start();

  $bd = include "pdo.php";
  $md = $bd->prepare("SELECT email FROM usuario WHERE email=:user AND senha =:password");
  $md->execute($_GET);
  $dados = $md->fetch(PDO::FETCH_ASSOC);

  if (!empty($dados)) {
    $_SESSION['login'] = $dados['email'];
    echo json_encode(true);
  } else {
    $_SESSION['login'] = null;
    echo json_encode(false);
  }
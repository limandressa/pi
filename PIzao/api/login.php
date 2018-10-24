<?php 

  $email = $_POST['email'];
  $entrar = $_POST['entrar'];
  $senha = $_POST['senha'];
  $connect = mysql_connect('localhost','root','');
  $db = mysql_select_db('bdpi');
  

    if (isset($entrar)) 
    {
        $verifica = mysql_query("SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'") or die("erro ao selecionar");
        
        if (mysql_num_rows($verifica) <= 0)
        {
            echo"<script language='javascript' type='text/javascript'>alert('email e/ou senha incorretos');window.location.href='PIzao/Telas/Login.html';</script>";
            die();
        } else {
          session_start();
          $_SESSION["login"] = $email;
          header("Location:../Telas/index.php");
        }
    }



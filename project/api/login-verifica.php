<?php 
    session_start();
    echo json_encode( isset($_SESSION['login']) && !empty($_SESSION['login']) );
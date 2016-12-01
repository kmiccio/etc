<?php
  // SESSION START
  session_start();

  // VARAIBLES DE SESSION 
  $id = "";
  $token = "";

  // DEFINE VARIABLES DE SESSION => SI ES QUE EXISTEN VARIABLES $_SESSION => SI NO TE DEVUELVE AL LOGIN
  if (!isset($_SESSION['userSession'])) {
        header("Location: login.php");
        exit;
  }else{
        $id = strip_tags($_SESSION['userSession']);
  }

  if (!isset($_SESSION['token'])) {
        header("Location: login.php");
        exit;
  }else{
        $token = strip_tags($_SESSION['token']);
  }

  // ACCESO BASE DATOS
  $servername = "localhost";
  $username = "username";
  $password = "password";
  $dbname = "db";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 

  // CONEXION A BD PARA VERIFICACION DE TOKEN
  $query = $conn->query("SELECT user_token FROM user WHERE user_id='$id'");
  $row=$query->fetch_array();
  // VERIFICA QUE EL USUARIO EXISTA Y RETORNA 1 SI EXISTE USUARIO
  $count = $query->num_rows; 
  // SI EL USUARIO EXISTE
  if( $count == 1 ){
  // VERIFICA QUE LA VARIABLE TOKEN DE LA SESSION CONCUERDE CON EL TOKEN DEL USUARIO DE LA BASE DE DATOS 
    if( $token == $row['user_token']){
        //echo "TOKEN OK";
    }else{
  // DE LO CONTRARIO TE ENVIA AL LOGIN Y DESTRUYE LAS VARIABLES DE SESSION
        // echo "BAD TOKEN";
        session_destroy();
        header("Location: login.php");
        exit;
    }
  }else{
  // EN CASO DE QUE EL USUARIO NO EXISTA
        session_destroy();
        header("Location: login.php");
        exit;
  }
 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  </head>
  <body>
      OK
  </body>
</html>

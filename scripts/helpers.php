<?php

function hashear($password) {
  $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
  return $hash; 
}

function chequearSesion() {
  
  if (!isset($_SESSION['username'])) {
    header('location: index.php');
    exit();
  }
}

?>
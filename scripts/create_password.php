<?php
  include 'funciones.inc.php';

  //$algos = password_algos();
  //var_dump($algos);
 /*  foreach($algos as $algo) {
    echo $algo . '<br>';
  } */

  $password = $_GET['pass'];

  $hash = hashear($password);
  
  echo $hash;
  // echo password_verify($password, $hash) ? 'ok' : 'error';

?>
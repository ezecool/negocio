<?php

function hashear($password) {
  $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
  return $hash; 
}

?>
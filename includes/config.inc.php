<?php

	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
  define('DB_NAME', 'fansenlock');
  
  $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  
  if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
  }

?>
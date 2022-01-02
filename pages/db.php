<?php

$username = "sql11453113";
$password = "mwI8ip452n";
$dbh = new PDO('mysql:host=sql11.freemysqlhosting.net;dbname=sql11453113', $username, $password);

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

return $dbh;

 ?>

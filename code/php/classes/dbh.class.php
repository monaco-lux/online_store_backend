<?php

class DbH
{
  // this is to connect to the database succesfully

  protected function connect()
  {
    try
    {
      $username = "sql11453113";
      $password = "mwI8ip452n";
      $dbh = new PDO('mysql:host=sql11.freemysqlhosting.net;dbname=sql11453113', $username, $password);
      return $dbh;
    }
    catch (PDOException $e)
    {
      print "Error!: ".$e->getMessage()."<br>";
      die();
    }

  }

}


?>

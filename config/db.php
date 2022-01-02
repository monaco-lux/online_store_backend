<?php

  class DB
  {
    private $host = 'sql11.freemysqlhosting.net';
    private $user = 'sql11453113';
    private $pass = 'mwI8ip452n';
    private $dbname = 'sql11453113';

    public function connect()
    {
      $conn_string = "mysql:host=$this->host;dbname=$this->dbname";
      $conn = new PDO($conn_str,$this->user, $this->pass);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return $conn;
    }


  }


 ?>

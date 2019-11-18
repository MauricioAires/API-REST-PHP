<?php

namespace App\Source;


use App\Source\Main;


class Connection  extends Main
{
    private $host = "localhost";
    private $user = "root";
    private $password = "asdqwe123";
    private $dbname = "usuarios";

    public $connection;

    public function __construct()
    {
        try {

            $this->connection = new \PDO('mysql:host=' . $this->host . ";dbname=" . $this->dbname, $this->user, $this->password);
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_ASSOC);
        } catch (\PDOException $ex) {
            $this->throwError(404, ["message" => $ex->getMessage()]);
        }
    }
}

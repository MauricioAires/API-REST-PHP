<?php

namespace App\Classes;

use App\Source\Connection;
use App\Source\Main;


class ClassUsuario
{
    # Atributos
    private $id;
    private $name;
    private $email;
    private $password;
    private $active;
    private $createdAt;


    # Atributos Principais
    public $getConnection;
    public $getFunctions;

    #Atibutos de controle
    private $indice;
    private $limit;


    public function __construct()
    {
        $this->getFunctions = new Main();
        $this->getConnection = new Connection();
    }

    # METODOS GET E SET
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }

    public function setemail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }
    public function getActive()
    {
        return $this->active;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;
    }
    public function getLimit()
    {
        return $this->limit;
    }

    public function setIndice($indice)
    {
        $this->indice = $indice;
    }
    public function getIndice()
    {
        return $this->indice;
    }




    /**
     *  Cadastrar Usuario
     */
    public function cadastrarUsuario()
    {
        try {

            $query = "INSERT INTO usuarios (name,email,password,active,createdAt) VALUES (:name,:email,:password,:active,:createdAt)";

            $stmt = $this->getConnection->connection->prepare($query);



            $stmt->bindValue(':name', $this->name);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':password', $this->password);
            $stmt->bindValue(':active', $this->active);
            $stmt->bindValue(':createdAt', date('Y-m-d H:m:s'));


            if ($stmt->execute()) {
                return true;
            } else {
                $this->getFunctions->throwError(DATABASE_ERROR, ["message" =>  $stmt->errorInfo()[2]]);
            }
        } catch (\PDOException $ex) {
            $this->getFunctions->throwError(DATABASE_ERROR, ["message" => $ex->getMessage()]);
        }
    }

    /**
     *  Deletar Usuario
     */

    public function deletarUsuario()
    {
        try {

            $query = "DELETE FROM usuarios WHERE id = :id";
            $stmt = $this->getConnection->connection->prepare($query);

            $stmt->bindValue(':id', $this->id);


            if ($stmt->execute()) {
                #Verifica se algum usuario foi realmente deletado
                if ($stmt->rowCount()) {
                    return true;
                } else {

                    $this->getFunctions->throwError(DATABASE_ERROR, ['message' => "O id do usuario não foi encontrado."]);
                }
            } else {
                $this->getFunctions->throwError(DATABASE_ERROR, ["message" => $stmt->errorInfo()[2]]);
            }
        } catch (PDOException $ex) {
            $this->getFunctions->throwError(DATABASE_ERROR, ['message' => $ex->getMessage()]);
        }
    }


    public function buscarUsuario()
    {
        try {

            $query = "SELECT * FROM usuarios";


            if (!empty($this->limit) && !empty($this->indice)) {
                $query .= " LIMIT   :indice , :limite";
            }

            $stmt = $this->getConnection->connection->prepare($query);

            $stmt->bindValue(':indice', $this->indice, \PDO::PARAM_INT);


            $stmt->bindValue(':limite', $this->limit, \PDO::PARAM_INT);


            $stmt->execute();

         

            if ($stmt->rowCount()) {
                $this->getFunctions->returnResponse(SUCCESS_RESPONSE, $stmt->fetchAll());
            } else {
                $this->getFunctions->throwError(DATABASE_ERROR, ["message" => $stmt->errorInfo()[2]]);
            }
        } catch (PDOException $ex) {
            $this->getFunctions->throwError(DATABASE_ERROR, ['message' => $ex->getMessage()]);
        }
    }
}

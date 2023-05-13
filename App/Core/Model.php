<?php

namespace App\Core;

use App\Classes\Message;
use App\Core\DataBase;

// Class MODEL
class Model
{


    //=====================================================
    // CRUD CREATE - DELETE - READ* - UPDATE
    //=====================================================

    /**
     * Exe "cliente", "id = :id",  $params | [":id" => <id>"]
     * @param string $table
     * @param string $terms
     * @param null $params
     * @param string $columns
     * 
     */

    //vQjX0EC-Tt=}
    public static function read(string $table, string $terms = "", $params = null, string $columns = "*")
    {
        $sql = "SELECT {$columns} FROM {$table}" . ($terms != '' ? " WHERE {$terms}" : "");

        if (!preg_match("/^SELECT/i", $sql)) {
            Message::danger("Somente Select");
            return;
        }

        try {
            if (!empty($params)) {
                $stmt = DataBase::getInstance()->prepare($sql);
                $stmt->execute($params);
                $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
            } else {

                $stmt = DataBase::getInstance()->prepare($sql);

                if ($stmt->execute()) {
                    $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
                }
            }

            return $result;
        } catch (\PDOException $e) {
            Message::danger("Somente Select" . $e->getMessage());
            return null;
        }
    }

    /**
     * @param mixed $table
     * @param int $id
     * 
     * @return [type]
     */
    public static function findId($table, int $id)
    {
        return self::read($table, "id = :id", [":id" => $id]);
    }

    /**
     * @param mixed $table
     * @param int $id
     * 
     * @return [type]
     */
    public static function findAll($table)
    {
        return self::read($table);
    }



    /**
     * @param string $table
     * @param array $dados
     * 
     * @return int|null
     */
    public static function create(string $table, array $dados): ?int
    {

        // Filtranto os dados vindo como array
        $filter = [];
        foreach ($dados as $key => $value) {
            $filter[$key] = is_null($value) ? null : filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        try {
            // Trabalhando nas colunas e valores
            $columns = implode(", ", array_keys($filter));
            $values = ":" . implode(', :', array_keys($filter));

            $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$values}) ";


            $stmt = DataBase::getInstance()->prepare($sql);
            $stmt->execute($dados);

            return DataBase::getInstance()->lastInsertId();
        } catch (\PDOException $e) {
            echo Message::danger("create Select" . $e->getMessage());
        }
    }

    //=====================================================
    // CRUD CREATE - READ - UPDATE*- DELETE 
    //=====================================================



    /**
     * Necessário indomar Tabela, dados, termos junto como id e parametros
     * Exe = Model::update("<TABLE>", array(PARAMS), "id = :id", "id=3");
     * 
     * @param string $table <TABLE>
     * @param array $dados array(PARAMS)
     * @param string $terms id = :id
     * @param mixed $params id= <VALOR> 
     * 
     */
    public static function update(string $table, array $dados, string $terms, $params)
    {

        // Filtranto os dados vindo como array
        $filter = [];
        foreach ($dados as $key => $value) {
            $filter[$key] = is_null($value) ? null : filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        $dataSet = [];
        foreach ($filter as $key => $value) {
            $dataSet[$key] = "{$key} = :{$key}";
        }

        // Trabalhando nas colunas e valores
        $dataSet = implode(", ", $dataSet);

        // transforma o id que vem como string em um array
        parse_str($params, $params);
        
        $sql = "UPDATE {$table} SET {$dataSet} WHERE {$terms}";
        // var_dump($sql, array_merge($dados, $params));

        try {

            $stmt = DataBase::getInstance()->prepare($sql);
            $stmt->execute(array_merge($dados, $params));

            return ($stmt->rowCount() ?? 1);
        } catch (\PDOException $e) {
            Message::danger("Erro ao Atualizar" . $e->getMessage());
            return null;
        }
    }

    //=====================================================
    // CRUD CREATE - READ - UPDATE- DELETE* 
    //=====================================================
    public static function delete(string $table, $id): int
    {
        // Filtranto os dados vindo como int
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);



        $sql = "DELETE FROM {$table} where id = {$id}";
        try {

            $stmt = DataBase::getInstance()->prepare($sql);
            $stmt->execute();

            return ($stmt->rowCount() ?? 1);
        } catch (\PDOException $e) {
            Message::danger("Erro ao Excluir" . $e->getMessage());
            return null;
        }
    }


    /**
     * Validação dos campos
     * @return bool
     */
    protected function require(): bool
    {
        if (
            empty($this->first_name) ||
            empty($this->last_name) ||
            empty($this->email) ||
            empty($this->phone) ||
            empty($this->ddd) ||
            empty($this->password)
        ) {
            Message::danger("Por favor, preencha os campos");
            return false;
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            Message::danger("e-mail não confere");
            return false;
        }
        return true;
    }
}

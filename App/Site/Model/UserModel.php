<?php

namespace App\Site\Model;

use App\Classes\Message;
use App\Core\Model;
use App\Core\DataBase;
use LDAP\Result;

// Class MODEL
class UserModel extends Model
{
    protected static $table = "cliente";


    //===============================================
    // BUSCAR E-MAIL
    //===============================================
    public function findByEmail($email)
    {

        if (!empty($email)) {
            return Model::read(self::$table, "email = :email", [':email' => $email]);
        }
    }

    //===============================================
    // CADASTRANDO UM NUMERO DE TELEFONE
    //===============================================
    public function validaPhone($ddd, $phone)
    {
        if (!empty($phone)) {
            return Model::read(self::$table, "ddd = :ddd and phone = :phone", [':phone' => $phone, ':ddd' => $ddd]);
        }
    }

    //===============================================
    // CADASTRANDO UM USUÁRIO
    //===============================================
    public function insertUser($dados, $createdHash)
    {

        //Criando uma hash
        $pass = password_hash($dados["password"], PASSWORD_DEFAULT);

        // armazenando em parametros os dados
        $params = [
            "first_name" => $dados["first_name"],
            "last_name" => $dados["last_name"],
            "email" => $dados["email"],
            "ddd" => $dados["ddd"],
            "phone" => $dados["phone"],
            "password" => $pass,
            "status" => "inative",
            "cod_ativacao" => $createdHash
        ];

        // Cadastrando no banco
        $returnUser =  Model::create(self::$table, $params);

        //Recebendo o ultimo ID
        $id = DataBase::getInstance()->lastInsertId();

        // armazenando em parametros o ultimo id cadastrado
        $paramId = [
            "id_cliente" => $id
        ];

        // se retornar  um valor insere o id o cliente na tabela de endereço
        if ($id != 0) {
            Model::create("address", $paramId);
        }

        //return os dados de cadastro
        return $returnUser;
    }

    //===============================================
    // BUSCAR CÓDIGO DO E-MAIL
    //===============================================
    public function findByCodEmail($cod)
    {

        if (!empty($cod)) {
            return Model::read(self::$table, "cod_ativacao = :cod_ativacao", [':cod_ativacao' => $cod]);
        }
    }

    //===============================================
    // CONFIRMANDO CODIGO E ALTERANDO BANCO
    //===============================================
    /**
     * Aqui ja com os dados retornados, alterando o
     * Status e Retirando o coódigo
     */
    public function confirmCodEmail($dados)
    {

        $id = $dados['dados'];
        //recebendo os dados
        $params = [
            "id" => $id,
            "status" => "ativo",
            "cod_ativacao" => null
        ];


        //-------------------------------
        // Atualizando o banco de dados
        return UserModel::update(self::$table, $params, "id = :id", "id=$id");
    }

    //===============================================
    // Fazendo login
    //===============================================
    public function logando($loginUser, $password)
    {
        //================================================
        // Login user

        if (!empty($loginUser) && is_numeric($loginUser)) {

            $result = Model::read(self::$table, "phone = :phone AND status = 'ativo' AND cod_ativacao IS NULL", [":phone" => $loginUser]);
            if (!$result) {

                Message::warning("Verifique os Dados e acesse.");
                redirect('user/login');
                return;
            }
        } else {
            $result = Model::read(self::$table, "email = :email AND status = 'ativo' AND cod_ativacao IS NULL", [":email" => $loginUser]);
            if (!$result) {
                Message::warning("Verifique os Dados.");
                redirect('user/login');
                return;
            }
        }

        $pass = $result[0]->password;
        $id = $result[0]->id;

        // Verificando o password
        if (password_verify($password, $pass)) {

            // atualizando a hash
            if (password_needs_rehash($pass, PASSWORD_DEFAULT, ['cost' => 12])) {

                $param = [
                    "password" => password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]),
                    "id" => $id
                ];

                Model::update(self::$table, $param, "id = :id", "id=$id");
            }

            if ($result) {


                $access = [
                    "id_cliente" =>  $id,
                    "adress_ip" => $_SERVER['SERVER_ADDR'],
                    "plataforma" => $_SERVER["HTTP_SEC_CH_UA_PLATFORM"] ?? "",
                    "mobile_or_computer" => accessInUrl()
                ];


                Model::create("acessos", $access);

                $params =  [
                    "id" => $result[0]->id,
                    "first_nome" => $result[0]->first_name,
                    "last_name" => $result[0]->last_name,
                    "email" => $result[0]->email,
                    "ddd" => $result[0]->ddd,
                    "phone" => $result[0]->phone
                ];

                return $params;
            }
        } else {
            Message::warning("E-mail ou senha não confere");
            redirect('user/login');
            return;
        }
    }

    //===============================================
    // Atualizando o endereço
    //===============================================
    public function atualizandoEndereco($dados, $id_cad = null)
    {

        $id = $id_cad  ?? $_SESSION['cliente']['id'];
        // var_dump($id, $dados);
        // die();
        $param = [
            'pais' => $dados['pais'],
            'cep' => $dados['cep'],
            'estado' => $dados['estado'],
            'bairro' => $dados['bairro'],
            'cidade' => $dados['cidade'],
            'rua' => $dados['rua'],
            'numero' => $dados['numero'],
            'complemento' => $dados['complemento'],
            'informacoes_adicionais' => $dados['informacoes_adicionais']
        ];


        return Model::update("address", $param, "id_cliente = :id_cliente", "id_cliente=$id");
    }

    //===============================================
    // Buscando cliente pelo id
    //===============================================
    public function findCliente($id)
    {

        return Model::read(self::$table . " ", "id = :id", [":id" => $id]);
    }

    //===============================================
    // Buscando cliente pelo id
    //===============================================
    public function findAddressCliente($id)
    {
        $result = Model::read(self::$table . " ", "id = :id", [":id" => $id])[0];
        $cliente = $result->id;
        $endereco = Model::read("address" . " ", "id = :id", [":id" => $cliente])[0];
        return [
            "usuario" => $result,
            "address" => $endereco
        ];
    }


    // //===============================================
    // // Alterando Dados
    // //===============================================
    public function atualizarDados($dados)
    {
        $id = $_SESSION['cliente']['id'];
        $param = [
            "firt_name" => $dados['firt_name'],
            "last_name" => $dados['last_name'],
            "email" => $dados['email'],
            "ddd" => $dados['ddd'],
            "phone" => $dados['phone'],

        ];

        return Model::update(self::$table, $param, "id = :id", "id=$id");
    }

    //====================================
    // BUSCANDO ENDEREÇO
    //====================================
    public function buscarEndereco()
    {
        return Model::read("address", " id_cliente = :id_cliente", ["id_cliente" => $_SESSION['cliente']['id']]);
    }

    //====================================
    // CONFIRMAR SENHA
    //====================================
    public function verificar_senha_Atual($pass, $id)
    {
        $param = [
            ":id" => $id
        ];

        $result = Model::read(self::$table, "id = :id", $param, ' password ')[0]->password;

        return password_verify($pass, $result);
    }

    //====================================
    // ALTERANDO A SENHA
    //====================================
    public function newpassword($pass, $id)
    {

        $param = [
            "password" => password_hash($pass, PASSWORD_DEFAULT)
        ];

        return Model::update(self::$table, $param, "id = :id", "id=$id");
    }

    //===========================================
    // ENDEREÇO
    //===========================================
    public function endereco($id)
    {

        if (!is_numeric($id)) {
            Message::alert("Error, Cliente não tem endereço cadastrado");
            return;
        }

        return Model::read('encomendas', "id = :id", ['id' => $id])[0];
    }
}

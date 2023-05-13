<?php

namespace App\Site\Model;

use App\Classes\Message;
use App\Core\Model;
use DateTime;

// Class MODEL
class LojaModel extends Model
{

    private static $table = "funcionario";

    //========================================
    // LOGIN
    //========================================
    public function login($login, $senha)
    {
        if ($login == null || $login == "") {
            Message::alert("Erro, Informe os dados");
            redirect("loja/login");
            return;
        }

        $ResultLogin = Model::read(self::$table, "login = :login AND status = 'ativo' AND cargo = 'vendedor'", [":login" => $login]);

        $passAdmin = $ResultLogin[0]->password;
        $id = $ResultLogin[0]->id;
        if (password_verify($senha, $passAdmin)) {

            $param = [
                "id_funcionario" => $id,
                "acesso" => $_SERVER['HTTP_SEC_CH_UA'],
                "user_agent" => $_SERVER['HTTP_USER_AGENT'],
                "ip" => $_SERVER['SERVER_ADDR'],
                "mobile_or_computer" => accessInUrl(),
                "plataforma" => $_SERVER['HTTP_SEC_CH_UA_PLATFORM'],
                "plataformaSecond" => $_SERVER['HTTP_SEC_CH_UA_MOBILE']
            ];

            Model::create('accessfuncionario', $param);

            return $ResultLogin;
        }
    }

    //========================================
    // LER CLIENTE
    //========================================
    public function readClientes()
    {


        $resultEncomendas =  Model::read('encomendas', "status = 'pendente' GROUP BY id_cliente LIMIT 5");


        $idEncomendas = [];
        foreach ($resultEncomendas as $resultEncomenda) {
            $idEncomendas[] = $resultEncomenda->id_cliente;
        }

        $idEncomendas = implode(", ", $idEncomendas);

        if (!empty($idEncomendas)) {
            $resultClientes = Model::read('cliente', "id IN ($idEncomendas)");
            return $resultClientes;
        }
    }

    //========================================
    // LER CLIENTE
    //========================================
    public function readCliente($dados)
    {

        return Model::read('encomendas', "id_cliente = :id_cliente", [':id_cliente' => $dados])[0];
    }

    //========================================
    // LER CLIENTE PELA ENCOMENDA
    //========================================
    public function cliente($id)
    {

        return Model::read('cliente', "id = :id", [':id' => $id])[0];
    }

    public function buscarClientes()
    {
        $result = Model::read(
            'cliente',
            "",
            "",
            "id, 
            first_name, 
            last_name"
        );

        return $result;
    }

    public function buscarencomenda($id = null, $codigo_encomenda = null, $status = null)
    {

        $param = [
            ":id" => $id,
            ":codigo_encomenda" => $codigo_encomenda,
            ":status" => $status
        ];


        return Model::read(
            'cliente as cl 
        INNER JOIN encomendas as e ON cl.id = e.id_cliente
        INNER JOIN encomenda_produto AS ep ON ep.id_encomenda = e.id
        INNER JOIN produto AS p ON p.id = ep.id_produto
        INNER JOIN categoria AS c ON c.id = p.categoria 
        INNER JOIN bojo AS b ON b.id = p.bojo
        INNER JOIN tamanho AS t ON t.id = p.tamanho
        INNER JOIN tecidos AS tc ON tc.id = p.tecidos',
            "cl.id = :id AND e.codigo_encomenda = :codigo_encomenda AND e.status = :status",
            $param,
            "cl.id AS clid, 
            e.status AS estatus, 
            e.id_cliente AS eid_cliente, 
            e.vendedor AS evendedor, 
            e.codigo_encomenda AS ecodigo_encomenda,
            e.status AS estatus,
            e.id AS eid,
            ep.quantidade AS epquantidade, 
            ep.separado AS epseparado, 
            ep.id AS epid, 
            p.id AS pid, 
            p.nome AS pnome,
            p.preco AS ppreco,
            p.precoPromo AS pprecoPromo,
            p.promocao AS ppromocao,
            p.image AS pimage,
            c.nome AS cnome,
            b.nome AS bnome, 
            t.nome AS tnome, 
            tc.nome AS tcnome"
        );
    }

    public function buscarencomendass($id, $codigo_encomenda, $status)
    {

        $param = [
            ":id" => $id,
            ":codigo_encomenda" => $codigo_encomenda,
            ":status" => $status
        ];

        return Model::read(
            'cliente as cl 
        INNER JOIN encomendas as e ON cl.id = e.id_cliente
        INNER JOIN encomenda_produto AS ep ON ep.id_encomenda = e.id
        INNER JOIN produto AS p ON p.id = ep.id_produto
        INNER JOIN categoria AS c ON c.id = p.categoria 
        INNER JOIN bojo AS b ON b.id = p.bojo
        INNER JOIN tamanho AS t ON t.id = p.tamanho
        INNER JOIN tecidos AS tc ON tc.id = p.tecidos',
            "cl.id = :id AND e.codigo_encomenda = :codigo_encomenda AND e.status = :status",
            $param,
            "cl.id AS clid, 
            e.status AS estatus, 
            e.id_cliente AS eid_cliente, 
            e.vendedor AS evendedor, 
            e.codigo_encomenda AS ecodigo_encomenda,
            e.status AS estatus,
            e.id AS eid,
            ep.quantidade AS epquantidade, 
            ep.separado AS epseparado, 
            ep.id AS epid, 
            p.id AS pid, 
            p.nome AS pnome,
            p.preco AS ppreco,
            p.image AS pimage,
            c.nome AS cnome,
            b.nome AS bnome, 
            t.nome AS tnome, 
            tc.nome AS tcnome"
        )[0];
    }

    //========================================
    //BUSCAR ENCOMENDA PELA DATA DE CRIAÇÃO DO CLIENTE
    public function buscar_encomenda($data = null)
    {
        if (!empty($data)) {

            $data_um = $data['data_um'] . "  00:00:00";
            $data_dois = $data['data_dois'] . " 23:59:59";


            return Model::read("encomendas", "created_at BETWEEN '" . $data_um . " ' AND '" . $data_dois .  "' ");
        }
    }

    // BUSCANDO TODAS AS ENCOMENDAS
    public function buscarencomendas()
    {

        return Model::read("encomendas");
    }

    //========================================
    // BUSCANDO TODAS AS ENCOMENDAS POR STATUS
    public function buscarencomendasstatus($status = null)
    {
        return Model::read("encomendas", " status = '$status'");
    }

    //========================================
    // BUSCANDO TODOS OS STATUS
    public function buscarstatus()
    {
        return Model::read("encomendas GROUP BY status", "", "", "status");
    }

    public function inserirVendas($id_funcionario, $id_pdoruto, $qtd_produto, $id_encomenda)
    {
        $param = [
            'id_vendedor' => $id_funcionario,
            'id_produto' => $id_pdoruto,
            'id_encomenda' => $id_encomenda,
            'quantidade_produto' => $qtd_produto
        ];

        return Model::create('vendas', $param);
    }

    public function atualizarEncomenda($id_funcionario, $id_pdoruto)
    {

        $atualizarEncomenda = Model::update('encomenda_produto', ["separado" => $id_funcionario], "id = :id", "id=$id_pdoruto");
        var_dump($atualizarEncomenda);
    }


    public function encomendaSeparada($id_funcionario, $id_encomenda)
    {
        $param = [
            'id_vendedor' => $id_funcionario,
            'id_encomenda' => $id_encomenda
        ];
        return Model::create('encomenda_separada', $param);
    }

    //========================================
    // INSERIR VENDEDOR QUE SEPAROU A ENCOMENDA
    public function marcar($id_encomenda)
    {

        $dados = [

            "vendedor" => $_SESSION['funcionario']['id']
        ];
        if (!empty($id_encomenda)) {
            return Model::update("encomendas", $dados, "id = :id", "id=$id_encomenda");
        }
    }

    //========================================
    // LENDO FUNCIONÁRIO
    public function lerFuncionario($id = null)
    {
        $idFunc = ($_SESSION['funcionario']['id'] ?? "");

        if (isset($id) || !empty($idFunc)) {
            return Model::read('funcionario', "id = :id", [':id' => $id ?? $idFunc], "id,nome,sobre_nome,login,cargo,status")[0];
        } else {
            Message::alert("Produto ainda não separado");
        }
    }

    //========================================
    // LENDO VENDAS
    public function vendas()
    {
        $param = [
            ":id_vendedor" => $_SESSION['funcionario']['id']
        ];
        return Model::read("vendas", "id_vendedor = :id_vendedor", $param);
    }
    //========================================
    // LENDO VENDAS
    public function vendasDiarias()
    {
        $date = date("Y-m-d") . " 00:00:00";
        $dateT = date("Y-m-d") . " 23:59:59";

        return Model::read("vendas", "created_at BETWEEN '" . $date . "' AND '" . $dateT . "'");
    }

    //========================================
    // LENDO ENCOMENDAS SEPARADA
    public function encomendasSeparadaFuncionario()
    {
        $id = $_SESSION['funcionario']['id'];
        $date = date("Y-m-d") . " 00:00:00";
        $dateT = date("Y-m-d") . " 23:59:59";

        
        $param = [
            ":id" => $id
        ];

        return Model::read(
            " encomendas AS e INNER JOIN  vendas AS v ON e.id = v.id_encomenda
        ",
            "e.vendedor = :id AND v.created_at BETWEEN '" . $date . "' AND '" . $dateT . "' GROUP BY e.codigo_encomenda ",
            $param,
            "sum(v.quantidade_produto) as vquantidade_produto,
            e.vendedor as evendedor,
            e.id_cliente as ecliente,
            e.status as estatus,
            e.codigo_encomenda as ecodigo_encomenda,
            v.created_at as ecreated_at"
        );
    }

    //========================================
    // LENDO ENCOMENDAS SEPARADA POR MES
    public function encomendasSeparadaMes()
    {
        $id = $_SESSION['funcionario']['id'];

        $param = [
            ":id" => $id
        ];

        return  Model::read(
            "funcionario AS f INNER JOIN vendas AS v ON v.id_vendedor = f.id",
            "f.id = :id GROUP BY MONTH(v.created_at)",
            $param,
            "v.id_vendedor as vid_vendedor,
            SUM(v.quantidade_produto) AS vqtd, 
            MONTH(v.created_at) AS vvendido"
        );
    }

    //========================================
    // BUSCANDO TODAS AS ENCOMENDAS DO MES 
    public function encomendasMes($dados)
    {
        if (!is_numeric($dados)) {
            Message::alert("Mês não encontrado");
            redirect();
            return;
        }

        $id = $_SESSION["funcionario"]["id"];

        $param = [
            ":mes" => $dados,
            ":vendedor" => $id
        ];

        return Model::read("encomendas", " MONTH(created_at) = :mes AND vendedor = :vendedor", $param);
    }
}

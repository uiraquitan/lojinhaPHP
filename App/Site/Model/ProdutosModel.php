<?php

namespace App\Site\Model;

use App\Classes\Message;
use App\Core\Model;
use App\Core\DataBase;

//====================================
// BUSCANDO OS ITENS NA BASE DE DADOS
//====================================
class ProdutosModel extends Model
{
    // TABELAS
    protected static $produto = "produto";
    protected static $tamanho = "tamanho";
    protected static $tecidos = "tecidos";
    protected static $like = "like";
    protected static $categoria = "categoria";
    protected static $bojo = "bojo";

    //====================================
    // BUSCANDO OS ITENS NA BASE DE DADOS
    //====================================
    public function produtos($dados = null)
    {

        if (!empty($dados) && $dados == "promocao") {


            $resultProdutp = Model::read(self::$produto, " promocao = NULL");
        } else {
            $resultProdutp = Model::read(self::$produto);
        }

        return $resultProdutp;
    }

    //===============================================
    // BUSCANDO OS ITENS PELO SEARCH NA BASE DE DADOS
    //===============================================
    public function search($dados = null)
    {

        if (empty($dados)) {
            redirect();
            return;
        }
        $dados = implode("", $dados);

        return Model::read(self::$produto, " nome LIKE '%$dados%' OR preco LIKE '%$dados%'");
    }


    //====================================
    // BUSCANDO OS ITEm NA BASE DE DADOS
    //====================================
    public function single($dados)
    {
        return   Model::read(self::$produto, "id = :id", [":id" => $dados]);
    }

    //====================================
    // BUSCANDO OS ITENS ALEATÓRIOS NA BASE DE DADOS
    //====================================
    public function aleatorio()
    {
        $resultAleatorio = Model::read(self::$produto . " ORDER BY rand() LIMIT 4");
        return $resultAleatorio;
    }

    //====================================
    // BUSCANDO OS ITENS PROMOCAo NA BASE DE DADOS
    //====================================
    public function filtro($dados)
    {
        if (!isset($dados)) {
            Message::alert("Erro: o que está procurando");
            redirect();
            return;
        }

        if ($dados  == "promocao") {

            return Model::read("produto", " promocao = '1' IS NOT NULL");
        } else {

            return Model::read("produto", "  promocao IS NOT NULL");
        }
    }

    //====================================
    // BUSCANDO OS ITENS DO CARRINHO
    //====================================
    public function buscarItensCarrinho($ids)
    {
        return Model::read(self::$produto, " id IN ($ids)");
    }

    //====================================
    // BUSCANDO ENCOMENDA PEDIDO
    //====================================
    public function guardarEncomenda($encomendas, $produtos)
    {
        $resultEncomenda = Model::read('encomendas', 'codigo_encomenda = :codigo_encomenda', [':codigo_encomenda' => $_SESSION['codigo_encomenda_luz']]);
        if ($resultEncomenda) {
            Message::warning("Encomenda ja cadastrada :) ");
            redirect("produtos/finalizando");
            return;
        }

        $params = [
            'id_cliente' => $_SESSION['cliente']['id'],
            'pais' => $encomendas['pais'],
            'cep' => $encomendas['cep'],
            'estado' => $encomendas['estado'],
            'bairro' => $encomendas['bairro'],
            'cidade' => $encomendas['cidade'],
            'rua' => $encomendas['rua'],
            'numero' => $encomendas['numero'],
            'complemento' => $encomendas['complemento'],
            'email' => $_SESSION['cliente']['email'],
            'ddd' => $_SESSION['cliente']['ddd'],
            'phone' => $_SESSION['cliente']['phone'],
            'codigo_encomenda' => $_SESSION['codigo_encomenda_luz'],
            'status' => 'pendente'
        ];

        Model::create('encomendas', $params);
        $idEncomenda = DataBase::getInstance()->lastInsertId();
        
       
        foreach ($produtos as $produto) {

            $idPro = $produto['id_produto'][0];

            $resultValue =  Model::read("produto", "id = $idPro")[0];

            $preco = $resultValue->promocao == "" ? $resultValue->preco : $resultValue->precoPromo;

            $param = [
                'id_encomenda' => $idEncomenda,
                'id_produto' => $produto['id_produto'],
                'nome' => $produto['nome'],
                'categoria' => $produto['categoria'],
                'preco' => $preco,
                'quantidade' => $produto['quantidade'],
            ];

            Model::create('encomenda_produto', $param);
        }
    }

    //====================================
    // BUSCANDO ENCOMENDA DETALHES
    //====================================
    public function buscarEncomendas($id, $status = null, $codigo_encomenda = null)
    {


        if (!empty($status)) {
            $param = [
                ":id_cliente" => $id,
                ":status" => $status
            ];
            return Model::read('encomendas', "id_cliente = :id_cliente AND status = :status ORDER BY id DESC", $param);
        } else {
            return Model::read('encomendas', "id_cliente = $id  ORDER BY id DESC");
        }
    }

    //====================================
    // BUSCANDO ENCOMENDA DETALHES STATUS
    //====================================
    public function buscarEncomendasStatus($id, $status = null)
    {


        if (!empty($status)) {
            $param = [
                ":id_cliente" => $id,
                ":status" => $status
            ];
            return Model::read('encomendas', "id_cliente = :id_cliente AND status = :status  ORDER BY id DESC", $param);
        } else {

            return Model::read('encomendas', "id_cliente = :id_cliente GROUP BY status", [":id_cliente" => $id]);
        }
    }

    //====================================
    // BUSCANDO ENCOMENDA PEDIDOS DETALHES
    //====================================
    public function buscarEncomenda($user = null, $encomenda = null, $idEncomenda = null)
    {
        if (!isset($encomenda)) {
            redirect();
            return;
        }

        $param = [
            ":id_cliente" => $user,
            ":codigo_encomenda" => $encomenda,
            ":id" => $idEncomenda
        ];
        $result = Model::read('encomendas', "id_cliente = :id_cliente AND codigo_encomenda = :codigo_encomenda AND id = :id", $param)[0];


        return $result;
    }

    //====================================
    // BUSCANDO ENCOMENDA PEDIDOS DETALHES
    //====================================
    public function buscarEncomendaProduto($encomenda, $idEncomenda)
    {
        $param = [
            ":id_encomenda" => $idEncomenda
        ];

        return Model::read('encomenda_produto', "id_encomenda = :id_encomenda", $param);
    }
}

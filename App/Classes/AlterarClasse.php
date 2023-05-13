<?php

namespace App\Classes;

use App\Core\Model;

class AlterarClasse
{
    //Ler todos os dados

    public function lerEncomenda($id_encomenda)
    {
        return  Model::read('encomenda_produto', "id_encomenda = :id", [":id" => $id_encomenda]);
    }

    public function AlterandoStatus($id_encomenda)
    {

        if (!is_string($id_encomenda)) {
            Message::warning("Encomenda não encontrada");
            redirect("loja/ecommerce");
            return;
        }

        return Model::update('encomendas', ['status' => "processamento"], "id = :id AND status = 'pendente'", "id=$id_encomenda");
    }
}

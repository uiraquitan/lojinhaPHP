<?php

namespace App\Core;

use Exception;

class Controller
{


    public static function layout($estruturas, $dados = [])
    {
        if (!is_array($estruturas)) {
            throw new Exception("Erro ao recarregar pagina");
        }

        if (!empty($dados) && is_array($dados)) extract($dados);

        foreach ($estruturas as $estrutura) {
            include_once("../App/Site/View/themes/" . $estrutura . ".php");
        }
    }
}

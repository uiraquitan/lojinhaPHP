<?php

namespace App\Core;

class Router
{

    /**
     * String Controladora
     */
    private string $controller;

    /**
     * method 
     */
    private string $method;

    /**
     * params
     */
    private $params = [];

    private $uriData = [];

    //========================================
    // CONSTRUCT
    //========================================
    public function __construct()
    {

        $this->controller = "User";

        $this->method = "index";
        /**
         * Formata os dados
         */
        $this->format();
    }

    //========================================
    // FORMAT
    //========================================
    private function format()
    {
        $uri = rtrim(trim($_SERVER['REQUEST_URI']), "/");

        $uri = filter_var($uri, FILTER_SANITIZE_URL);

        // previnindo se contém a interrogação no navegador
        if (mb_strpos($uri, '?') > 0) {
            $ex = mb_substr($uri, 0, mb_strpos($uri, '?'));
        }

        $ex = explode("/", $uri);

        // Verifica se é um array
        if (!is_array($ex)) {
            return;
        }

        //reorganizando o array
        $ex = array_values(array_filter($ex));

        // retirado a entrada principal
        for ($i = 0; $i < 1; $i++) {
            unset($ex[$i]);
        }


        $this->uriData = array_values(array_filter($ex));

        $this->run();
    }

    //========================================
    // RUN
    //========================================
    private function run()
    {
        $controller = $this->getController();

        $methods = $this->getMethod($controller);

        $params = $this->getParams();

        call_user_func_array([new $controller, $methods], $params);
    }

    //========================================
    // CONTROLLER
    //========================================
    public function getController()
    {
        // Verificando se contém algo na posição 0
        if (isset($this->uriData[0])) {

            $count = $this->uriData[0];

            $count = "\\App\\Site\\Controller\\" . ucfirst($count) . "Controller";

            if (class_exists($count)) {
                return  $count;
            } else {
                redirect("user/error");
                return;
            }
        }

        return "\\App\\Site\\Controller\\" . ucfirst($this->controller) . "Controller";
    }

    //========================================
    // METHODS
    //========================================
    public function getMethod($controllerPath)
    {
        $method = $this->method;
        if (isset($this->uriData[1])) {
            $method = $this->uriData[1];
        } else {
            $this->method;
        }

        if (method_exists($controllerPath, $method)) {
            return $method;
        } else {
            redirect("user/error");
            return;
        }
        return $this->method;
    }

    //========================================
    // PARAMS
    //========================================
    private function getParams()
    {
        if (count($this->uriData) <= 2) {
            return [];
        } else {
            for ($i = 2; $i < count($this->uriData); $i++) {
                $this->params[] = $this->uriData[$i];
            }
            return $this->params;
        }
    }
}

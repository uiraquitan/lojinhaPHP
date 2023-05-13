<?php

namespace App\Classes;

// Class the HELP
class Helpers
{


    /**
     * REDIRECIONAMENTO
     * @param null $url 
     * 
     */
    public static function redirect($url = null)
    {
        header('Location: ' . URL . "/" . $url);
        return;
    }



}

<?php

namespace App\Classes;

// Class the HELP
class Message
{



    // Mostra a mensagem
    public static function seeMessage()
    {
        if (!empty($_SESSION['message'])) {
           echo $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            return;
        }
    }


    /**
     * Função para sessão, onde mostra e carrega ela
     */
    public static function message($message)
    {
        if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
            unset($_SESSION["message"]);
        } else {
            return $_SESSION["message"] = $message;
        }
    }

    /**
     * retorna a função alert
     */
    public static function alert(string $message)
    {
        $message = "<div class='message alert'>" . self::filterMessage($message) . "</div>";
        return self::message($message);
    }

    /**
     * retorna a função Danger
     */
    public static function danger(string $message)
    {
        $message = "<div class='message danger'>" . self::filterMessage($message) . "</div>";
        return self::message($message);
    }


    /**
     * retorna a função acess
     */
    public static function success(string $message)
    {
        $message = "<div class='message success'>" . self::filterMessage($message) . "</div>";
        return self::message($message);
    }

    /**
     * retorna a função warning
     */
    public static function warning(string $message)
    {

        $message = "<div class='message warning'>" . self::filterMessage($message) . "</div>";
        return self::message($message);
    }

    /**
     * retornaa mensagem filtrada
     */
    private static function filterMessage(string $message)
    {
        $message = filter_var($message, FILTER_SANITIZE_SPECIAL_CHARS);
        return $message;
    }
}

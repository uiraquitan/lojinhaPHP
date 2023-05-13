<?php

use App\Classes\Message;

//===========================================
// VALIDANDO E-MAIL
//===========================================
function is_mail($email)
{
    return (filter_var($email, FILTER_VALIDATE_EMAIL) ? true : null);
}

//===========================================
// REDIRECIONANDO
//===========================================
function redirect($url = "")
{
    return header("Location: " . URL . "/" . $url);
}

//===========================================
// CRIANDO HASH
//===========================================
/**
 * Criando Hash para controles e cadastros
 * @param int $num_caracter
 * 
 */
function createHash($num_caracter = 12)
{
    $char = "0123456789abcdefghijklmnopqrstuvxywzabcdefghijklmnopqrstuvxywzABCDEFGHIJKLMNOPQRSTUVXYWZABCDEFGHIJKLMNOPQRSTUVXYWZ";
    return mb_substr(str_shuffle($char), 0, $num_caracter);
}
//===========================================
// CRIANDO HASH PARA ENCOMENDA
//===========================================
/**
 * Criando Hash para controles e cadastros
 * @param int $num_caracter
 * 
 */
function createHashEncomenda()
{
    $hash = "ABCDEFGHIJKLMNOPQRSTUVXYWABCDEFGHIJKLMNOPQRSTUVXYWABCDEFGHIJKLMNOPQRSTUVXYW";
    $codigo = mb_substr(str_shuffle($hash), 0, 2);
    $codigo .= rand(100000, 999999);

    return $codigo;
}

//===========================================
// VERIFICANDO SE JÁ EXISTE ALGUEM LOGADO 
//===========================================
/**
 * Verifica se ja tem um cliente logado
 * @param mixed $login
 * 
 * @return [type]
 */
function is_login()
{
    return isset($_SESSION['cliente']);
}

function is_loja()
{
    return isset($_SESSION['funcionario']);
}

//===========================================
// VALIDANDO NUMERO
//===========================================

/**
 * Verifica se ja tem um cliente logado
 * @param mixed $login
 * 
 * @return [type]
 */
function VerificandoNumeroExistente($ddd, $telefone)
{

    $numeroTel = "(" . $ddd . ") - " . $telefone;
    Message::alert("Numero $numeroTel já existe, por favor tente outro ou entre em contato!");
    return;
}


//===========================================
// VALIDANDO SENHA
//===========================================

//Senha so pode ter entre 6 e 40 caracteres
function pass_count($strlenPass)
{
    return (mb_strlen($strlenPass) >= 6 && mb_strlen($strlenPass) <= 40 ? true : false);
}

//===========================================
// VALIDANDO ACESSO EM URL
//===========================================

/**
 * VALUIDANDO SE QUEM ACESSA ESTÁ DE UM SMART PHONE OU NÃO
 * @return [type]
 */
function accessInUrl()
{
    $mobile = FALSE;
    $user_agents = array("iPhone", "iPad", "Android", "webOS", "BlackBerry", "iPod", "Symbian", "IsGeneric");

    $modelo = "";
    foreach ($user_agents as $user_agent) {
        if (strpos($_SERVER['HTTP_USER_AGENT'], $user_agent) !== FALSE) {
            $mobile = TRUE;
            $modelo    = $user_agent;
            break;
        }
    }

    if ($mobile) {
        return strtolower($modelo);
    } else {
        return "Computer";
    }
}


//================================================================
// VALIDANDO SE É UMA STRING E NÂO CONTEM CARACTERES ESPERICIAS
//================================================================

/**
 * Validando se é  uma string e se nao contém caracteres especiais
 */
function dadosString(string $valor)
{
    return filter_var($valor, FILTER_SANITIZE_SPECIAL_CHARS);
}

//================================================================
// VALIDANDO A QUANTIDADE DE CLICKS NO FORMILÁRIO
//================================================================

/**
 * Validando se é  uma string e se nao contém caracteres especiais
 */
function qtdClicks()
{
    session_start();
    $maxTimeLim = 3;
    $maxVezesLim = 4;


    // verifica se há sessão já
    if (!isset($_SESSION['tmp_bot'])) {
        // cria uma sessão time
        $_SESSION['tmp_bot'] = time() * 60 * 3;
        $_SESSION['conta_vezbot'] = 1;
    }

    $diferentTime = time() - $_SESSION['tmp_bot'];

    // compara se o tempo e menor que o sugerido
    if ($diferentTime <= $maxTimeLim) {
        $_SESSION['conta_vezbot']++;

        // verifica se na sessão ja teve mais de 3 requisição
        if ($_SESSION['conta_vezbot'] > $maxVezesLim) {
            Message::warning("3 tentativas, espere 3 minutos e tente novamente");
            unset($_SESSION['conta_vezbot']);
            unset($_SESSION['tmp_bot']);
            redirect("user/login");
            return;
        }
    }
}

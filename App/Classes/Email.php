<?php

namespace App\Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email
{

    public function senvEmailCadastro($email, $first_name, $last_name, $codigoDeAtivacao)
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $purl = URL . "/user/confirmar_email/" . $codigoDeAtivacao;
        try {
            //Server settings
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->CharSet = "UTF-8";
            $mail->isSmtp();
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Host = EMAIL_HOST;
            $mail->SMTPAuth = true;
            $mail->Username   = EMAIL_USER;
            $mail->Password   = EMAIL_PASS;
            $mail->Port = EMAIL_PORT;

            //Recipients
            $mail->setFrom('atentoaqui@gmail.com', APP_NAME);
            $mail->addAddress($email, "{$first_name} - {$last_name}");


            //Assunto
            $mail->isHTML(true);
            $mail->Subject = APP_NAME . ' - Confirmação de E-mail';


            //Mensagem
            $html = '<p>Seja bem vindo a nossa loja' . APP_NAME . '</p> ';
            $html .= '<p>Para poder entrar em nossa loja, necessita congirmar o email</p> ';
            $html .= '<p>Para confirmar o e-mail, clique no link abaixo</p> ';
            $html .= '<p><a href="' . $purl . '">Confirmar E-mail</a> </p> ';
            $html .= '<p> <i> <small>' . APP_NAME . '</small></i> </p> ';


            $mail->Body    = $html;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function enviandoEmailConfirmacaoEncomenda($email, $dados)
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->CharSet = "UTF-8";
            $mail->isSmtp();
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Host = EMAIL_HOST;
            $mail->SMTPAuth = true;
            $mail->Username   = EMAIL_USER;
            $mail->Password   = EMAIL_PASS;
            $mail->Port = EMAIL_PORT;

            //Recipients
            $mail->setFrom('atentoaqui@gmail.com', APP_NAME);
            $mail->addAddress($email, "'" . $_SESSION['cliente']['cliente'] . "' - '" . $_SESSION['cliente']['last_name'] . "'");


            //Assunto
            $mail->isHTML(true);
            $mail->Subject = APP_NAME . ' - Confirmação de Compra';


            //Mensagem
            $html = '<p>' . APP_NAME . ' Agradece a sua compra ' . ucfirst($_SESSION['cliente']['cliente']) . ' ' . ucfirst($_SESSION['cliente']['last_name']) . '</p> ';
            $html .= '<p>Estamos enviando as suas encomendas por e-mail com o código da encomenda da loja, </p> ';
            $html .= '<p>com ele você consegue pesquisar suas compras e entrar em contato sobre referência a </p> ';
            $html .= '<p>sua compra, pedimos a compreenção e esperamos que fique atento ao meio de comunicação que solicitou, </p> ';
            $html .= '<p>pedimos que efetue o pagamento para que seja separado sua encomenda e enviada, em breve uma vendedora entrará em contato</p> ';
            $html .= '<hr>';
            $html .= '<p>Segue a baixo os itens que serão separados</p> ';
            $html .= '<p> <i> <small>' . APP_NAME . '</small></i> </p> ';

            $html .= '<hr>';

            $html .= '<ul>';
            foreach ($dados['lista_produtos'] as $value) {
                $html .= "<li> $value</li>";
            }
            $html .= '</ul>';

            $html .= '<hr>';

            $html .= '<p>Segue a informação a baixo sobre os dados da encomenda</p> ';
            $html .= "<p><strong>Numero do pedido: </strong> " . $dados['codigo_encomenda'] . "</p>";
            $html .= "<p><strong>Total da encomenda: </strong> <h1> R$ " . number_format($dados['total_encomenda'], 2, ',', '.') . " </h1></p>";
            $html .= '<hr>';

            $html .= '<p>A ' . APP_NAME . ' agradece sua preferência';

            $mail->Body    = $html;
            $mail->AltBody = 'Tenha uma boa compra';

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}

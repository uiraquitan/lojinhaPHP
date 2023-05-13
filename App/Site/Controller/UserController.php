<?php

namespace App\Site\Controller;

use App\Classes\Email;
use App\Classes\Message;
use App\Core\Controller;
use App\Site\Model\ProdutosModel;
use App\Site\Model\UserModel;

class UserController
{

    /**
     * Padina inicial 
     */
    public function index()
    {

        //====================================
        // BUSCANDO OS ITENS NA BASE DE DADOS
        //====================================

        $itens = new ProdutosModel();
        $result = $itens->produtos();

        $dados = [
            "dados" => $result
        ];

        Controller::layout([
            'luz/header',
            'luz/home',
            'luz/footer'
        ], $dados);
    }

    //===========================================
    // CADASTRO
    //===========================================

    public function search()
    {
        if (!empty($_POST['search'])) {
            $dados = $_POST['search'];
        } else {
            redirect();
            return;
        }

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $dados = is_array($dados) ? $dados : null;
        $itens = new ProdutosModel();
        if (!in_array("", $dados)) {

            //====================================
            // BUSCANDO OS ITENS NA BASE DE DADOS
            //====================================

            $result = $itens->search($dados);

            $dados = [
                "dados" => $result
            ];

            Controller::layout([
                'luz/header',
                'luz/home',
                'luz/footer'
            ], $dados);
        } else {
            $result = $itens->produtos();
            Controller::layout([
                'luz/header',
                'luz/home',
                'luz/footer'
            ], $dados);
        }
    }

    //===========================================
    // CADASTRO
    //===========================================

    public function cadastrar()
    {

        //verificando se ja existe alguem logado
        if (is_login()) {
            redirect();
            return;
        }

        Controller::layout([
            'luz/header',
            'luz/cadastrar',
            'luz/footer'
        ]);
    }

    //===========================================
    // CADASTRANDO USUÁRIO
    //===========================================

    public function cadastrando()
    {
        // --------------------------------------
        //verificando se ja existe alguem logado
        if (is_login()) {
            redirect();
            return;
        }




        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            redirect();
            return;
        }
        //---------------------------------------
        //FILTRANDO OS DADOS QUE VEM DO POST
        $dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $dados = is_array($dados) ? $dados : null;
        if ($dados == null) {
            redirect('user/login');
            return;
        }

        // --------------------------------------
        // Verificando se tem algum dado vazio
        if (!in_array("", $dados)) {



            // --------------------------------------
            // Validando se é ums string
            if (
                !dadosString($dados['first_name']) ||
                !dadosString($dados['last_name']) ||
                !dadosString($dados['email']) ||
                !dadosString($dados['password']) ||
                !dadosString($dados['confirmpassword']) ||
                !dadosString($dados['ddd']) ||
                !dadosString($dados['phone']) ||
                !is_numeric($dados['ddd']) ||
                !is_numeric($dados['phone'])
            ) {
                Message::warning("Por favor, insira dados válidos!");
                redirect("user/cadastrar");
                return;
            }

            if (is_numeric($dados['phone']) && mb_strlen($dados['phone'])  > 9) {
                Message::warning("Selecione o ddd e informe o seu número sem o DDD :) ");
                redirect("user/cadastrar");
                return;
            }

            if (!pass_count($dados['password'])) {
                Message::warning("Senha deve conter entre 6 e 40 caracteres :) ");
                redirect("user/cadastrar");
                return;
            }


            // --------------------------------------
            //Validar Email

            if (!is_mail($dados['email'])) {
                Message::warning("E-MAIL INVÁLIO!");
                redirect("user/cadastrar");
                return;
            }

            // --------------------------------------
            //Validar Senha
            if (!pass_count($dados['password'])) {
                Message::warning("Senha deve conter entre 6 e 40 caracteres!");
                redirect("user/cadastrar");
                return;
            }

            // --------------------------------------
            //Validar conferir senhas se são iguais
            if ($dados['password'] != $dados['confirmpassword']) {
                Message::warning("Senhas não conferem!");
                redirect("user/cadastrar");
                return;
            }

            //++++++++++++++++++++++++++++++++++++++++++++++
            // Validações no banco de dados
            //++++++++++++++++++++++++++++++++++++++++++++++
            //Instanciando o bando para deixar um modo global na classe

            $userModel = new UserModel();

            // --------------------------------------
            //Validar E-mail no banco de dados
            $validRmail = $userModel->findByEmail($dados['email']);
            if ($validRmail) {

                // se existir um e-mailna base de dados envia para a recuperação de senha
                Message::success("E-mail ja cadastrado, Tente recuperar sua senha!");
                redirect("user/recuperarsenha");
                return;
            }

            // --------------------------------------
            //Validar numero se ja contén dentro do bando de dados
            $validPhone = $userModel->validaPhone($dados['ddd'], $dados['phone']);

            if ($validPhone) {
                // se existir um e-mailna base de dados envia para a recuperação de senha
                Message::warning("Número ja cadastrado, por favor, entre em contato ou recupere sua senha");
                redirect("user/recuperarsenha");
                return;
            }

            // +++++++++++++++++++++++++++++++++++++++++++++++++++
            // Cadastrando no banco de dados e enviando e-mail
            // +++++++++++++++++++++++++++++++++++++++++++++++++++


            // ---------------------------------------------------
            // Criando hash para o e-mail
            $createdHash = createHash();



            //---------------------------------------------------
            // Cadastrando no banco
            $insertUserDb = $userModel->insertUser($dados, $createdHash);
            //---------------------------------------------------
            // Enviando E-mail de cadastro
            $userEmail = new Email();
            $email = $dados['email'];
            $userEmail->senvEmailCadastro($email, $dados['first_name'], $dados['last_name'], $createdHash);


            if ($insertUserDb) {


                Message::success("Cadastrado com sucesso, verifique seu e-mail para confirmar o cadastro");
                redirect("user/login");
                return;
            } else {

                // Se houver erro no cadastro
                Message::warning("Erro Verifique os dados ou entre em contato");
                redirect("user/recuperarsenha");
                return;
            }
        } else {

            // Se houver erro no cadastro
            Message::warning("Veridique os dados");
            redirect("user/cadastrar");
            return;
        }
    }

    //===============================================
    // CONFIRMANDO E-MAIL
    //===============================================
    public function confirmar_email($dados = null)
    {

        if (mb_strlen($dados) != "12") {
            Message::warning("Erro, entre em contato");
            redirect("user/contato");
            return;
        }



        // ------------------------------------------
        // Buscando o cliente pelo código e trasendo
        // o Cliente

        $cod = new UserModel();
        $result = $cod->findByCodEmail($dados);

        //------------------------------------------
        // alterando o banco de dados, status, cod, 
        $userResult = $result[0];


        $params = [
            "dados" => $userResult->id,
        ];


        // Instancinando o model e alterando dados do cliente
        $confirmEmailALterDados = new UserModel();
        $result =  $confirmEmailALterDados->confirmCodEmail($params);
        if ($result) {
            Message::warning("Conta ativada, vamos as compras :)");
            redirect();
            return;
        } else {
            Message::warning("Erro, entre em contato :)");
            redirect("user/contato");
            return;
        }
    }

    //===========================================
    // RECUPERAR SENHA
    //===========================================
    public function recuperarsenha()
    {
        if (is_login()) {
            Message::warning("Vamos começar a comprar :) ");
            redirect();
            return;
        }


        Controller::layout([
            'luz/header',
            'luz/recuperarsenha',
            'luz/footer'
        ]);
    }

    //===========================================
    // LOGIN
    //===========================================
    public function login()
    {
        if (is_login()) {
            Message::warning("Vamos começar a comprar :) ");
            redirect();
            return;
        }


        Controller::layout([
            'luz/header',
            'luz/login',
            'luz/footer'
        ]);
    }

    //===========================================
    // FAZENDO O LOGIN
    //===========================================
    public function signIn()
    {
        //Verificando se já existe alguem logado
        if (is_login()) {
            Message::warning("Vamos começar a comprar :) ");
            redirect();
            return;
        }

        // filtrando os dados 
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        // Validação para usar somente o numero
        if (is_numeric($dados['email_tel']) && mb_strlen($dados['email_tel'])  > 9) {
            Message::warning("Não deve usar o DDD para logar, somente o número :) ");
            redirect("user/login");
            return;
        }

        //+++++++++++++++++++++++++++++++++++++++++++
        // VALIDAÇÕES, E-MAIL, SENHA E NÚMERO
        //+++++++++++++++++++++++++++++++++++++++++++

        // Verificando E-mail
        if (!in_array("", $dados)) {


            $loginUser = $dados['email_tel'];

            if (!pass_count($dados['password'])) {
                Message::warning("Senha deve conter entre 6 e 40 caracteres :) ");
                redirect("user/login");
                return;
            }

            $password = $dados['password'];

            // Logando
            $login = new UserModel();
            $result = $login->logando($loginUser, $password);

            //Retornando os dados e guardando em uma sessão
            if ($result) {

                // Sessão cliente
                $_SESSION['cliente'] = [
                    'id' => $result['id'],
                    'cliente' => $result['first_nome'],
                    'last_name' => $result['last_name'],
                    'email' => $result['email'],
                    'ddd' => $result['ddd'],
                    'phone' => $result['phone']
                ];

                // se tentar finalizar sem estar logado
                if (isset($_SESSION['tmp_login'])) {
                    unset($_SESSION['tmp_login']);
                    Message::success("Logado com sucesso :) ");
                    redirect('produtos/finalizando');
                    return;
                }


                //Redirecionando o cliente
                Message::success("Logado com sucesso :) ");
                redirect();
                return;
            } else {


                redirect("user/login");
                return;
            }

            Message::success("erro ao logar :) ");
            redirect("user/login");
            return;

            // Travando depois de 3 tentativas

        } else {
            Message::warning("Verifique os Dados :) ");
            redirect("user/login");
            return;
        }
    }

    //===========================================
    // DESLOGANDO
    //===========================================
    public function logout()
    {
        if (!empty($_SESSION['cliente'])) {
            unset($_SESSION['cliente']);
            Message::warning("Não demore, estamos te esperando :) ");
            redirect("user/login");
            return;
        } else {
            Message::warning("Ops, deu um erro :) ");
            redirect();
            return;
        }
    }

    //===========================================
    // CONTATO
    //===========================================
    public function contato()
    {
        Controller::layout([
            'luz/header',
            'luz/contato',
            'luz/footer'
        ]);
    }

    //===========================================
    // SINGLE
    //===========================================

    public function single($dados = null)
    {

        //====================================
        // BUSCANDO OS ITENS NA BASE DE DADOS
        $itens = new ProdutosModel();
        $result = $itens->single($dados)[0];

        $dado = [
            "dados" => $result
        ];
        
        Controller::layout([
            'luz/header',
            'luz/single',
            'luz/footer'
        ], $dado);
    }

    //===========================================
    // FINALIZADA
    //===========================================
    public function finalizada()
    {

        Controller::layout([
            'luz/header',
            'luz/finalizada',
            'luz/footer'
        ]);
    }


    //===========================================
    // PAINEL
    //===========================================
    public function painel()
    {
        //se não existir ninguem logado, redireciona
        if (!is_login()) {
            redirect();
            return;
        }

        Controller::layout([
            'luz/header',
            'luz/painel',
            'luz/footer'
        ]);
    }

    //===========================================
    // ATULIZAR SENHA
    //===========================================
    public function alterarsenha($id = null)
    {
        //se não existir ninguem logado, redireciona
        if (!is_login()) {
            redirect();
            return;
        }

        if (isset($id) && !empty($id)) {
            //Verifica se a requisição e do tipo post
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                redirect();
                return;
            }

            $pass = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            // ---------------------------------
            // verifica se os méthodos que vem da url estão vazios
            if (!in_array("", $pass)) {

                // ---------------------------------
                // verifica se as senhas novas são igusis
                if ($pass['senha_nova'] != $pass['senha_confirm']) {
                    Message::warning("Senhas devem ser iguais");
                    redirect('user/alterarsenha');
                    return;
                }

                // ---------------------------------
                // verifica se a senha nova e igual a atual
                if ($pass['senha_nova'] == $pass['senha']) {
                    Message::warning("Senha nova não pode ser igual a senha atual");
                    redirect('user/security');
                    return;
                }

                // ---------------------------------
                // intancia o usuario model
                $passDb = new UserModel();

                // ---------------------------------
                // Se a senha atual for verdadeira, retorna coms eu valor  
                $resultPass = $passDb->verificar_senha_Atual($pass['senha'], $id);
                if ($resultPass) {

                    // ---------------------------------
                    // acessa o Usuario model e faz alteração da senha e em seguida retorn
                    $resulNewPass = $passDb->newpassword($pass['senha_nova'], $id);
                    if ($resulNewPass) {
                        Message::success("Senha alterada com sucesso!");
                        redirect('user/security');
                        return;
                    } else {
                        Message::danger("Erro: Ao alterar senha");
                        redirect('user/security');
                        return;
                    }
                } else {
                    Message::danger("Erro: Senha Atual não confere");
                    redirect('user/security');
                    return;
                }

                
            } else {
                Message::danger("Campos não podem estar vazios");
                redirect('user/security');
                return;
            }
        }
    }

    //===========================================
    // ATULIZAR SENHA
    //===========================================
    public function security()
    {
        //se não existir ninguem logado, redireciona
        if (!is_login()) {
            redirect();
            return;
        }
        Controller::layout([
            'luz/header',
            'luz/security',
            'luz/footer'
        ]);
    }

    //===========================================
    // DADOS
    //===========================================
    public function dados()
    {
        //se não existir ninguem logado, redireciona
        if (!is_login()) {
            redirect();
            return;
        }

        //===========================================
        // BUSCANDO DADOS DO USUÁRIO
        //===========================================

        $userDados = new UserModel();
        $endereco = $userDados->buscarEndereco();
        if ($endereco[0]->cep == null) {
            Message::alert("Por favor, cadastre umendereço primeiro");
            redirect('user/updatedados');
            return;
        }

        

        $dados = $userDados->findCliente($_SESSION['cliente']['id']);
        $_SESSION['cliente']['first_name'] = $dados[0]->first_name;
        $_SESSION['cliente']['last_name'] = $dados[0]->last_name;
        $_SESSION['cliente']['email'] = $dados[0]->email;



        $dados = [
            "endereco" => $endereco[0],
            "dados" => $dados[0],
        ];

        Controller::layout([
            'luz/header',
            'luz/dados',
            'luz/footer'
        ], $dados);
    }

    //===========================================
    // ATUALIZAR DADOS
    //===========================================
    public function updatedados()
    {
        //se não existir ninguem logado, redireciona
        if (!is_login()) {
            redirect();
            return;
        }
        Controller::layout([
            'luz/header',
            'luz/updatedados',
            'luz/footer'
        ]);
    }

    //===========================================
    // DADOS NOME E-MAIL
    //===========================================
    public function dadosAtualizar()
    {
        //se não existir ninguem logado, redireciona
        if (!is_login()) {
            redirect();
            return;
        }

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!in_array('', $dados)) {
            $userDados = new UserModel();
            $upDados = $userDados->atualizarDados($dados);

            if ($upDados) {
                Message::success("Dados atalizado com sucesso");
                redirect('user/dados');
                return;
            }
        } else {
            Message::warning("Erro: Dados não atalizado");
            redirect('user/dados');
            return;
        }

        //===========================================
        // BUSCANDO DADOS DO USUÁRIO
        //===========================================


    }

    public function updatedadosEndereco()
    {
        //se não existir ninguem logado, redireciona
        if (!is_login()) {
            redirect();
            return;
        }

        // if ($_SERVER['REQUEST_METHOD'] != 'post') {
        //     redirect();
        //     return;
        // }


        $dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $dados = is_array($dados) ?  $dados : "";
        if ($dados == null) {
            redirect('user/login');
            return;
        }


        $atualizandoEndereco = new UserModel();
        $resultAddress = $atualizandoEndereco->atualizandoEndereco($dados);
        if ($resultAddress) {
            Message::success("Dados atualizados com sucesso");
            redirect('user/updatedados');
            return;
        } else {
            Message::danger("Erro ao atualizados dados ");
            redirect('user/updatedados');
            return;
        }
        Controller::layout([
            'luz/header',
            'luz/updatedados',
            'luz/footer'
        ]);
    }

    //===========================================
    // ERROR
    //===========================================
    public function error()
    {
        Controller::layout([
            'luz/header',
            'luz/error',
            'luz/footer'
        ]);
    }
}

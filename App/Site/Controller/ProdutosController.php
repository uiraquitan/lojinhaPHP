<?php

namespace App\Site\Controller;

use App\Classes\Email;
use App\Classes\Message;
use App\Core\Controller;
use App\Site\Model\LojaModel;
use App\Site\Model\ProdutosModel;
use App\Site\Model\UserModel;

class ProdutosController
{

    //========================================
    // BUSCANDO OS ITENS NA BASE DE DADOS
    // PELO QUE VEM DO PARAMETRO
    //========================================
    public function filtro($dados)
    {

        if (!is_string($dados)) {
            Message::alert("Erro: confirme o que eta procurando ");
            redirect();
            return;
        }


        $itens = new ProdutosModel;
        $result = $itens->filtro($dados);


        foreach ($result as $item) {
            $item->preco = $item->precoPromo;
        }

        $dados = [
            "dados" => $result
        ];

        Controller::layout([
            'luz/header',
            'luz/home',
            'luz/footer'
        ], $dados);
    }


    //========================================
    // ADICIONANDO AO CARRINHO
    //========================================
    public function addCarrinho($id)
    {

        //============================================
        // Verifica se existe uma sessão
        if (!isset($id)) {
            echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : "";
            return;
        }


        //============================================
        // $carrinho recebeum array vazio onde serão
        // armazenados os valores
        $carrinho = [];

        //se ja existir um carrinho, devolve ele
        if (isset($_SESSION['carrinho'])) {
            $carrinho = $_SESSION['carrinho'];
        }

        //verificação no banco de dados fazer==


        // adiciona ao carrinho
        if (key_exists($id, $carrinho)) {
            $carrinho[$id]++;
        } else {
            $carrinho[$id] = 1;
        }
        //============================================
        // SESSÃO CARRINHO RECEBE OS VALORES
        $_SESSION['carrinho'] = $carrinho;

        //============================================
        // TOTAL CARRINHO
        $total_carrinho = 0;

        foreach ($carrinho as $qtd_carrinho) {
            $total_carrinho += $qtd_carrinho;
        }

        echo $total_carrinho;
    }

    //========================================
    // REMOVENDO DO CARRINHO
    //========================================
    public function removeCarrinho($id)
    {



        //============================================
        // Verifica se contem a sessão carrinho
        if (empty($_SESSION['carrinho'])) {
            Message::alert('Ops, você não tem nada no carrinho');
            redirect();
            return;
            //============================================
            // $carrinho recebe os ID's da sessão
        }


        $carrinho = $_SESSION['carrinho'];

        //============================================
        // Retira o ID da sessão
        unset($carrinho[$id]);

        //============================================
        // SESSÃO RECEBE NOVAMENTE OS ID
        $_SESSION['carrinho'] = $carrinho;

        Message::alert('Item removido');
        redirect('produtos/cart');
        return;
    }

    //===========================================
    //CARRINHO
    //===========================================
    public function cart()
    {


        if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) == 0) {
            Message::alert('Ops, você não tem nada no carrinho');
            redirect();
            return;
        } else {

            $ids = [];
            foreach ($_SESSION['carrinho'] as $key => $values) {

                array_push($ids, $key);
            }

            $ids = implode(', ', $ids);


            $buscarItensCart = new ProdutosModel();
            $resultCart = $buscarItensCart->buscarItensCarrinho($ids);

            $dados_tmp = [];

            // Fazendo um foreach no carrinho
            foreach ($_SESSION['carrinho'] as $id_produto => $qtd_carrinho) {

                //fazendo um for no id que vem da sessão para comparar com o banco
                foreach ($resultCart as $valProduto) {
                    if ($valProduto->id == $id_produto) {
                        $idProduto = $valProduto->id;
                        $nomeProduto = $valProduto->nome;
                        $imagemProduto = $valProduto->image;
                        $quantidadeProduto = $qtd_carrinho;
                        $precoProduto = $qtd_carrinho * ($valProduto->promocao == "" ? $valProduto->preco :  $valProduto->precoPromo);

                        array_push($dados_tmp, [
                            "id" => $idProduto,
                            "nome" => $nomeProduto,
                            "image" => $imagemProduto,
                            "quantidade" => $quantidadeProduto,
                            "preco" => $precoProduto
                        ]);
                        break;
                    }
                }
            }
        }

        $carrinho_total = 0;


        foreach ($dados_tmp as $values) {

            $carrinho_total += ($values['preco']);
        }
        $_SESSION['total_encomenda'] = $carrinho_total;

        array_push($dados_tmp, [
            "total_cart" => $carrinho_total
        ]);

        $dados = [
            "dados" => $dados_tmp
        ];

        Controller::layout([
            'luz/header',
            'luz/cart',
            'luz/footer'
        ], $dados);
    }

    //===========================================
    //FINALIZANDO ENCOMENDA
    //===========================================
    public function finalizando()
    {
        //Verificando se já existe alguem logado
        if (!is_login()) {
            Message::warning("Vamos começar a comprar :) ");
            redirect();
            return;
        }
        // =====================================
        // Verifica se contem na sessão um nome carrinho se não redireciona
        if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) == 0) {
            Message::alert('Ops, você não tem nada no carrinho');
            redirect();
            return;
        } else {

            // =====================================
            // guarda os ids do carrinho
            $ids = [];
            foreach ($_SESSION['carrinho'] as $key => $values) {

                // =====================================
                // adiciona os ids na variável
                array_push($ids, $key);
            }

            // =====================================
            // Separa os ids por virgura e espaço
            $ids = implode(', ', $ids);

            // =====================================
            // busca os itens no banco de dados
            $buscarItensCart = new ProdutosModel();
            $resultCart = $buscarItensCart->buscarItensCarrinho($ids);

            // =====================================
            // guarda itens em um carrinho
            $dados_tmp = [];

            // =====================================
            // Fazendo um foreach no carrinho que esta na sessão
            foreach ($_SESSION['carrinho'] as $id_produto => $qtd_carrinho) {

                // ===============================================================
                //fazendo um foreach no id que vem da sessão para comparar com o banco
                foreach ($resultCart as $valProduto) {
                    if ($valProduto->id == $id_produto) {
                        $idProduto = $valProduto->id;
                        $nomeProduto = $valProduto->nome;
                        $imagemProduto = $valProduto->image;
                        $quantidadeProduto = $qtd_carrinho;
                        $precoProduto = $qtd_carrinho * ($valProduto->promocao == "" ? $valProduto->preco :  $valProduto->precoPromo);

                        array_push($dados_tmp, [
                            "id" => $idProduto,
                            "nome" => $nomeProduto,
                            "image" => $imagemProduto,
                            "quantidade" => $quantidadeProduto,
                            "preco" => $precoProduto
                        ]);
                        break;
                    }
                }
            }

            if (!isset($_SESSION['codigo_encomenda_luz'])) {
                $codigo = createHashEncomenda();
                $_SESSION['codigo_encomenda_luz'] = $codigo;
            }
        }

        $carrinho_total = 0;


        foreach ($dados_tmp as $values) {
            $carrinho_total += $values['preco'];
        }
        $_SESSION['total_encomenda'] = $carrinho_total;

        array_push($dados_tmp, [
            "total_cart" => $carrinho_total
        ]);

        // =====================================
        // Buscando o endereço
        // =====================================
        $endereco = new UserModel();
        $resultEndereco = $endereco->buscarEndereco();
        $dados = [
            "dados" => $dados_tmp,
            "endereco" => $resultEndereco
        ];





        Controller::layout([
            'luz/header',
            'luz/finalizando',
            'luz/footer'
        ], $dados);
    }

    //===========================================
    //FINALIZANDO ENCOMENDA
    //===========================================
    public function finalizar()
    {
        if (!isset($_SESSION['cliente'])) {
            $_SESSION['tmp_login'] = true;
            Message::alert('Faça o login para continuar comprando');
            redirect('user/login');
            return;
        } else {

            redirect('produtos/finalizando');
            return;
        }
    }

    //===========================================
    //FINALIZANDO ENCOMENDA
    //===========================================
    public function finalizado()
    {



        //===========================================
        //Verificando se já existe alguem logado
        if (!is_login()) {
            Message::warning("Vamos começar a comprar :) ");
            redirect();
            return;
        }

        //===========================================
        // Verificando se há um carrinho na sessão
        if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) == '0') {
            Message::warning("Vamos começar a comprar :) ");
            redirect();
            return;
        }

        //===========================================
        // Guardando os ids em uma variável
        $ids = [];
        foreach ($_SESSION['carrinho'] as $key => $value) {
            array_push($ids, $key);
        }

        $ids = implode(", ", $ids);

        //===========================================
        // buscando produtos pelos ids
        $finalProdutos = new ProdutosModel();
        $resultProdutosFinal = $finalProdutos->buscarItensCarrinho($ids);

        //===========================================
        // guardando informação
        $string_produtos = [];
        foreach ($resultProdutosFinal as $resultado) {
            //===========================================
            // Salvando a quantidade dos itens no carrindo
            $quantidade = $_SESSION['carrinho'][$resultado->id];
            //===========================================
            // Adiconando no arraay a quantidade com o nome
            $string_produtos[] = "{$quantidade} x {$resultado->nome} - " . number_format($resultado->preco, 2, ",", ".");
        }

        //===========================================
        // Guardando a lista de produtos em um array para o e-mail

        $dados_encomenda = [];
        $dados_encomenda['lista_produtos'] = $string_produtos;

        //===========================================
        // Buscando o valor total da encomenda
        $dados_encomenda['total_encomenda'] = $_SESSION['total_encomenda'];

        //===========================================
        // Buscando o valor total da encomenda
        $dados_encomenda['codigo_encomenda'] = $_SESSION['codigo_encomenda_luz'];

        //===========================================
        // Buscando o valor total da encomenda
        $dados_encomenda['id_cliente'] = $_SESSION['cliente']["id"];

        //===========================================
        // ENVIAR E_MAIL    
        //===========================================

        if (!empty($_SESSION['cliente']['email'])) {
            $encomendaEmail = new Email();
            $encomendaEmail->enviandoEmailConfirmacaoEncomenda($_SESSION['cliente']['email'], $dados_encomenda);
        }

        //===========================================
        // GUARDAR OS DADOS DA ENCOMENDA NA BASE DE DADOS
        //===========================================
        $dados_encomenda = [];
        $dados_encomenda['id'] = $_SESSION['cliente']['id'];

        // ===========================================
        // VERIFICANDO O ENDEREÇO
        if (isset($_SESSION['endereco_alternativo']['cep']) && !empty($_SESSION['endereco_alternativo']['cep'])) {
            $dados_encomenda['pais'] = $_SESSION['endereco_alternativo']['pais'];
            $dados_encomenda['cep'] = $_SESSION['endereco_alternativo']['cep'];
            $dados_encomenda['estado'] = $_SESSION['endereco_alternativo']['estado'];
            $dados_encomenda['bairro'] = $_SESSION['endereco_alternativo']['bairro'];
            $dados_encomenda['cidade'] = $_SESSION['endereco_alternativo']['cidade'];
            $dados_encomenda['rua'] = $_SESSION['endereco_alternativo']['rua'];
            $dados_encomenda['numero'] = $_SESSION['endereco_alternativo']['numero'];
            $dados_encomenda['complemento'] = $_SESSION['endereco_alternativo']['complemento'];
        } else {
            $enderecoCliente = new UserModel();
            $resultEndereco = $enderecoCliente->findAddressCliente($_SESSION['cliente']['id']);

            $dados_encomenda['pais'] = $resultEndereco['address']->pais;
            $dados_encomenda['cep'] = $resultEndereco['address']->cep;
            $dados_encomenda['estado'] = $resultEndereco['address']->estado;
            $dados_encomenda['bairro'] = $resultEndereco['address']->bairro;
            $dados_encomenda['cidade'] = $resultEndereco['address']->cidade;
            $dados_encomenda['rua'] = $resultEndereco['address']->rua;
            $dados_encomenda['numero'] = $resultEndereco['address']->numero;
            $dados_encomenda['complemento'] = $resultEndereco['address']->complemento;

            if (empty($resultEndereco['address']->cep)) {
                Message::warning("Por favor, preencha um endereço! :) ");
                redirect("produtos/finalizando");
                return;
            }
        }

        //===========================================
        // GUARDAR OS DADOS DA ENCOMENDA PRODUTO NA BASE DE DADOS
        //===========================================
        $dados_produtos = [];
        foreach ($resultProdutosFinal as $resultDados) {
            $dados_produtos[] = [
                'id_produto' => $resultDados->id,
                'nome' => $resultDados->nome,
                'categoria' => $resultDados->categoria,
                'preco' => $resultDados->preco,
                'quantidade' => $_SESSION['carrinho'][$resultDados->id]
            ];
        }

        $encomendaModel = new ProdutosModel();
        $encomendaModel->guardarEncomenda($dados_encomenda, $dados_produtos);

        //===========================================
        // LIMPAR DADOS DA SESSÂO
        //===========================================

        unset($_SESSION['carrinho']);
        unset($_SESSION['total_encomenda']);
        unset($_SESSION['codigo_encomenda_luz']);
        unset($_SESSION['endereco_alternativo']);
        $dados = [
            "dados" => $dados_encomenda
        ];

        Controller::layout([
            'luz/header',
            'luz/finalizado',
            'luz/footer'
        ], $dados);
    }

    //===========================================
    //FINALIZANDO ENCOMENDA
    //===========================================
    public function enderecoalternativo()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $_SESSION['endereco_alternativo'] = [
            'pais' => $data['pais'],
            'cep' => $data['cep'],
            'bairro' => $data['bairro'],
            'cidade' => $data['cidade'],
            'estado' => $data['estado'],
            'rua' => $data['rua'],
            'numero' => $data['numero'],
            'complemento' => $data['complemento']
        ];
    }

    public function limparCarrinho()
    {
        if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
            unset($_SESSION['carrinho']);
        }

        Controller::layout([
            'luz/header',
            'luz/finalizando',
            'luz/footer'
        ]);
    }


    //===========================================
    // PEDIDOS
    //===========================================
    public function pedidos($dados = null)
    {
        //se não existir ninguem logado, redireciona
        if (!is_login()) {
            redirect();
            return;
        }

        //===========================================
        // BUSCANDO ENCOMENDAS
        $encomendas = new ProdutosModel();
        if (!empty($dados)) {
            // Se tiver alguma requisição a ser feita
            $resultDados = $encomendas->buscarEncomendas($_SESSION['cliente']['id'], $dados);
        } else {
            // Se não tiver alguma requisição a ser feita
            $resultDados = $encomendas->buscarEncomendas($_SESSION['cliente']['id']);
        }




        $dados = [
            "ecomenda" => $resultDados
        ];
        Controller::layout([
            'luz/header',
            'luz/pedidos',
            'luz/footer'
        ], $dados);
    }

    public function detalhes($user = null, $encomenda = null, $idEncomenda = null)
    {



        //se não existir ninguem logado, redireciona
        if (!is_login()) {
            redirect();
            return;
        }

        if (isset($user) && $user != $_SESSION['cliente']['id']) {
            redirect();
            return;
        }

        if (!isset($user) && $user == '') {
            redirect();
            return;
        }

        if (!isset($encomenda) && empty($encomenda)) {
            redirect();
            return;
        }

        if (isset($encomenda) && mb_strlen($encomenda) < "7") {
            redirect();
            return;
        }

        if (!isset($idEncomenda) && $idEncomenda == "") {
            redirect();
            return;
        }

        $detalhes = new ProdutosModel();

        $funcionario = new LojaModel();

        if (!empty($encomenda)) {

            $resultEncomenda = $detalhes->buscarEncomenda($user, $encomenda, $idEncomenda);
            $resultEncomendaProduto = $detalhes->buscarEncomendaProduto($encomenda, $idEncomenda);
            $funcionarioName = $funcionario->lerFuncionario($resultEncomenda->vendedor);

            if ($resultEncomenda == "") {
                redirect();
                return;
            }
        } else {
            Message::seeMessage("Não existe Encomendas");
            redirect();
            return;
        }

        $total_encomenda = null;
        foreach ($resultEncomendaProduto as $total) {
            $total_encomenda += $total->quantidade * $total->preco;
        }

        $dados = [
            "encomenda" => $resultEncomenda,
            "encomendaProdutos" => $resultEncomendaProduto,
            "total" => $total_encomenda,
            "funcionario" => $funcionarioName
        ];

        Controller::layout([
            'luz/header',
            'luz/detalhes',
            'luz/footer'
        ], $dados);
    }
}

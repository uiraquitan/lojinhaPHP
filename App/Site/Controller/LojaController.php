<?php

namespace App\Site\Controller;

use App\Classes\AlterarClasse;
use App\Classes\Message;
use App\Core\Controller;
use App\Core\Model;
use App\Site\Model\LojaModel;
use App\Site\Model\ProdutosModel;
use App\Site\Model\UserModel;

class LojaController
{
    public function index()
    {
        if (!empty(is_loja())) {
            redirect('loja/home');
            return;
        }
        //========================================
        // Verificando se há um admin logado
        Controller::layout([
            'loja/header',
            'loja/login',
            'loja/footer'
        ]);
    }

    //========================================
    // HOME
    //========================================
    public function home()
    {
        //========================================
        // Verificando se há um admin logado
        if (!is_loja()) {
            redirect('loja/login');
            return;
        }

        $clientesLoja = new LojaModel();
        $resultClientes = $clientesLoja->readClientes();

        $resultVendas = $clientesLoja->vendas();
        $total_vendas_vendedor = "0";

        foreach ($resultVendas as $resultVenda) {
            if ($_SESSION['funcionario']['id'] == $resultVenda->id_vendedor) {
                $total_vendas_vendedor += $resultVenda->quantidade_produto;
            }
        }
        $dados = [

            'clientes' => $resultClientes,
            'totalVendas' => $total_vendas_vendedor
        ];

        Controller::layout([
            'loja/header',
            'loja/home',
            'loja/footer'
        ], $dados);
    }

    //========================================
    // CLIENTES
    //========================================
    public function clientes()
    {
        //========================================
        // Verificando se há um admin logado
        if (!is_loja()) {
            redirect('loja/login');
            return;
        }

        $clientesLoja = new LojaModel();
        $resultClientes = $clientesLoja->buscarClientes();
        $resultClientess = $clientesLoja->readClientes();
        $buscar_encomenda = $clientesLoja->buscar_encomenda();

        $dados = [
            'clientes' => $resultClientess,
            'totalclientes' => $resultClientes,
            'encomendas' => $buscar_encomenda
        ];

        Controller::layout([
            'loja/header',
            'loja/clientes',
            'loja/footer'
        ], $dados);
    }

    //========================================
    // LOGIN
    //========================================
    public function login()
    {
        if (!empty(is_loja())) {
            redirect('loja/home');
            return;
        }

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($dados)) {

            if (!in_array("", $dados)) {

                //========================================
                // LOGIN
                $loginFuncionario = new LojaModel();
                $result = $loginFuncionario->login($dados['login'], $dados['password']);

                if ($result[0]) {
                    $_SESSION['funcionario'] = [
                        'id' => $result[0]->id,
                        'nome' => $result[0]->nome,
                        'sobre_nome' => $result[0]->sobre_nome

                    ];
                    Message::alert("Logado com sucesso");
                    redirect("loja/home");
                    return;
                } else {
                    Message::alert("Erro: Dados não confere");
                    redirect("loja/login");
                    return;
                }
            } else {
                Message::alert("Erro, Informe os dados");
                redirect("loja/login");
                return;
            }
        }

        Controller::layout([
            'loja/header',
            'loja/login',
            'loja/footer'
        ]);
    }

    //========================================
    // LOGIN
    //========================================
    public function logout()
    {

        if (!empty($_SESSION['funcionario'])) {
            unset($_SESSION['funcionario']);
            Message::warning("Deslogado com sucesso :) ");
            redirect("loja/login");
            return;
        } else {
            Message::warning("Ops, deu um erro :) ");
            redirect();
            return;
        }
    }

    //========================================
    // CLIENTES
    //========================================
    public function cliente($id, $status = null)
    {
        if (!is_loja()) {
            redirect('loja/login');
            return;
        }

        if (!is_numeric($id)) {
            Message::alert("Dados não conferem");
            redirect();
            return;
        }

        // INSTANCIANDO 
        $cliente = new LojaModel();
        $userCliente = new UserModel();
        $encomenda = new ProdutosModel();

        $cliente = new LojaModel();
        $resultCliente =  $cliente->cliente($id);
        $resultClientes = $cliente->readClientes();
        $resultEncomeda = $encomenda->buscarEncomendas($id, $status);
        $resultEncomedaStatus = $encomenda->buscarEncomendasStatus($id);
        $resultEndereco = $userCliente->endereco($id);

        $dados = [
            'cliente' => $resultCliente,
            'clientes' => $resultClientes,
            "resultEncomeda" => $resultEncomeda,
            "resultEncomedaStatus" => $resultEncomedaStatus,
            "endereco" => $resultEndereco
        ];

        Controller::layout([
            'loja/header',
            'loja/cliente',
            'loja/footer'
        ], $dados);
    }

    //========================================
    // ENCOMENDA LOJA
    //========================================
    public function encomenda($id = null, $codigo_encomenda = null, $status = null)
    {
        if (empty($_SESSION['funcionario']['id'])) {
            Message::warning("Não existe funcionario logado");
            redirect('loja');
            return;
        }
        if (!is_numeric($id)) {
            Message::warning("Não existe encomenda");
            redirect('loja');
            return;
        }

        //========================================
        // INSTANCIANDO
        //========================================
        $cliente = new LojaModel();
        $userCliente = new UserModel();
        $encomenda = new ProdutosModel();

        //========================================
        // CLIENTES E CLIENTE
        //========================================
        $resultCliente =  $cliente->cliente($id);
        $resultClientes = $cliente->readClientes();

        //========================================
        // ENCOMENDAS
        //========================================
        // Buscando por id e status
        $resultEncomedas = $encomenda->buscarEncomendas($id, $status);

        //========================================
        // Buscando por id, código, status
        $resultEncomeda = $cliente->buscarEncomenda($id, $codigo_encomenda, $status);

        //========================================
        // Buscando encomendas e selecionando apelas um status por GROUP
        $resultEncomedass = $cliente->buscarencomendass($id, $codigo_encomenda, $status);

        //========================================
        // Buscando funcionário pelo id da sessão
        $funcionario = $cliente->lerFuncionario();

        //========================================
        // Buscando por id
        $resultEncomedaStatus = $encomenda->buscarEncomendasStatus($id);
        //========================================
        // ENDEREÇO
        //========================================
        $alterarStatus = new AlterarClasse();
        if (!empty($resultEncomeda[0]->eid)) {
            $resultEncomendaAlter = $alterarStatus->lerEncomenda($resultEncomeda[0]->eid);
        }


        $resultEndereco = $userCliente->endereco($resultEncomeda[0]->eid);

        $status = true;
        foreach ($resultEncomendaAlter as $alterarStatus) {
            if ($alterarStatus->separado == "") {
                $status = false;
                break;
            }
        }


        if ($status == true) {
            $alterarStatusPro = new AlterarClasse();
            $resultAupdate = $alterarStatusPro->AlterandoStatus($resultEncomendaAlter[0]->id_encomenda);
            if ($resultAupdate) {
                redirect("loja/cliente/$id");
            }
        }

        //========================================
        // ENVIANDO DADPS
        //========================================
        $dados = [
            'cliente' => $resultCliente,
            'clientes' => $resultClientes,
            "resultEncomedas" => $resultEncomedas,
            "produtos" => $resultEncomeda,
            "produtoss" => $resultEncomedass,
            "resultEncomedaStatus" => $resultEncomedaStatus,
            "endereco" => $resultEndereco,
            "codigo" => $codigo_encomenda,
            "funcionario" => $funcionario
        ];
        Controller::layout([
            'loja/header',
            'loja/encomenda',
            'loja/footer'
        ], $dados);
    }

    //========================================
    // ENCOMENDAS LOJA
    //========================================
    public function encomendas($status = null)
    {
        //Instanciando MODEL LOJA
        $encomendas = new LojaModel();

        // RECEBENDO TODOS OS DADOS QUE VEM DO FORMULÁRIO
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        // VERIFICANDO SE OS DADOS DO FORMULÁRIO ESTA VAZIO
        $dados = is_array($dados) ? $dados : null;

        // BUSCANDO TODAS AS ENCOMENDAS
        $resultEncomenda = $encomendas->buscarencomendas();

        $allStatus = $encomendas->buscarstatus();
        $resultClientes = $encomendas->readClientes();

        // CHECANDO SE OS STATUS NÃO ESTÃO VAZIOS
        if (!empty($status)) {

            $resultEncomenda = $encomendas->buscarencomendasstatus($status);
        }

        // CHECANDO SE  OS DADOS NÃO ESTÃO NULOS
        if (!$dados == null) {

            $resultEncomenda = $encomendas->buscar_encomenda($dados);

            if ($dados['data_dois'] < $dados['data_um']) {
                Message::alert("Data inicial não pode ser maior que final");
                redirect('loja/encomendas');
                return;
            }
        }

        //========================================
        // ENVIANDO DADPS
        //========================================
        $dados = [
            "encomendas" => $resultEncomenda,
            "allStatus" => $allStatus,
            "clientes" => $resultClientes
        ];

        Controller::layout([
            'loja/header',
            'loja/encomendas',
            'loja/footer'
        ], $dados);
    }

    //========================================
    // CADASTRAR ENDEREÇO
    //========================================
    public function cadastrarendereco($id)
    {

        if (!is_loja()) {
            redirect('loja/home');
            return;
        }

        $user = new UserModel();

        // Busca endereço pelo id do cliente
        $clienteEndereco = $user->endereco($id);
        $clientesLoja = new LojaModel();
        // Busca o clientes que estão com status pendente
        $resultClientes = $clientesLoja->readClientes();


        $param = [
            'endereco' => $clienteEndereco,
            'clientes' => $resultClientes
        ];

        Controller::layout([
            'loja/header',
            'loja/cadastrarendereco',
            'loja/footer'
        ], $param);
    }

    //========================================
    // ATUALIZANDO ENDEREÇO
    //========================================
    public function updatedadosEndereco($id)
    {
        $dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $dados = is_array($dados) ?  $dados : "";

        if ($dados == null) {
            redirect('loja/encomenda');
            return;
        }

        if ($dados['numero'] == '') {
            Message::alert("Informe o número do local");
            redirect('loja/cadastrarendereco/' . $id);
            return;
        }

        $atualizandoEndereco = new UserModel();
        $resultAddress = $atualizandoEndereco->atualizandoEndereco($dados, $id);

        if ($resultAddress) {
            Message::success("Dados atualizados com sucesso");
            redirect('loja/cliente/' . $id);
            return;
        } else {
            Message::danger("Erro ao atualizados dados ");
            redirect('loja/cadastrarendereco/' . $id);
            return;
        }


        Controller::layout([
            'loja/header',
            'loja/encomenda',
            'loja/footer'
        ]);
    }

    //========================================
    // BUSCAR STATUS
    //========================================
    public function status($id, $status)
    {
        if (empty($id) && empty($status)) {
            Message::alert("Ops: Houve um erro");
            redirect('loja/home');
            return;
        }

        $encomenda = new ProdutosModel();
        $user = new UserModel();
        $cliente = new LojaModel();


        // Busca endereço pelo id do cliente
        $resultEncomendaStatus = $encomenda->buscarEncomendasStatus($id);

        // Busca encomenda pelo id do cliente
        $resultEncomeda = $encomenda->buscarEncomendas($id);

        // Busca cliente pelo id
        $resultCliente = $cliente->cliente($id);

        // Busca endereço pelo id do cliente
        $clienteEndereco = $user->endereco($id);

        // Busca o clientes que estão com status pendente
        $resultClientes = $cliente->readClientes();

        $dados = [
            'cliente' => $resultCliente,
            'clientes' => $resultClientes,
            'encomendas' => $resultEncomeda,
            'encomendaStatus' => $resultEncomendaStatus,
            "endereco" => $clienteEndereco,

        ];
        Controller::layout([
            'loja/header',
            'loja/encomenda',
            'loja/footer'
        ], $dados);
    }

    //========================================
    // SEPARANDO ENCOMENDAS
    //========================================
    public function separarencomenda($id_funcionario = null, $id_encomendaProduto = null, $qtd_produto = null, $id_encomenda = null)
    {


        // if ($_SERVER['REQUEST_METHOD'] != "POST") {

        //     redirect('loja/home');
        //     return;
        // }

        if ($_SESSION['funcionario']['id'] != $id_funcionario || empty($_SESSION['funcionario']['id'])) {
            Message::danger("Erro: Usuário não encontrado");
            redirect('loja/home');
            return;
        }

        if (empty($id_encomendaProduto) && !is_numeric($id_encomendaProduto)) {
            Message::danger("Erro: Produto não encontrado");
            redirect('loja/home');
            return;
        }

        if (!is_numeric($qtd_produto) && $qtd_produto) {
            Message::danger("Erro: Quantidade de itens Errada");
            redirect('loja/home');
            return;
        }

        if (!is_numeric($id_encomenda) && empty($id_encomenda)) {
            Message::danger("Erro: Encomenda não encontrada");
            redirect('loja/home');
            return;
        }


        $vendas = new LojaModel();

        // INSERINDO VENDAS NA TABELA DE VENDAS
        $vendas->inserirVendas($id_funcionario, $id_encomendaProduto, $qtd_produto, $id_encomenda);

        // ATUALIZAR ENCOMENDA PARA SEPARADA
        $vendas->atualizarEncomenda($id_funcionario, $id_encomendaProduto);


        // ENCOMENDA SEPARADA
        $vendas->encomendaSeparada($id_funcionario, $id_encomenda);
    }

    //========================================
    // MARCAR VENDEDOR NA ENCOMENDA COMO SEPARADA
    //========================================
    public function separar($cliente_id = null, $id_encomenda = null, $id_funcionario = null, $codigo_encomenda = null, $status_encomenda = null)
    {

        if (!isset($id_encomenda) && !isset($codigo_encomenda) && !isset($status_encomenda)) {
            Message::alert("Erro: Verifique se há uma encomenda para esse cliente");
            redirect("loja/encomenda");
            return;
        }

        if (!is_string($codigo_encomenda) && !isset($codigo_encomenda)) {
            Message::alert("Erro: Verifique se há uma encomenda para esse cliente");
            redirect("loja/encomenda");
            return;
        }

        if (!is_string($status_encomenda) && !isset($status_encomenda)) {
            Message::alert("Erro: Verifique se há uma encomenda para esse cliente");
            redirect("loja/encomenda");
            return;
        }

        if (!is_numeric($id_encomenda)) {
            Message::alert("Erro: Verifique se há uma encomenda para esse cliente");
            redirect("loja/encomenda");
            return;
        }

        if (!is_numeric($id_funcionario)) {
            Message::alert("Erro: Verifique se há uma encomenda para esse cliente");
            redirect("loja/encomenda");
            return;
        }

        if (!empty($status_encomenda) && $status_encomenda != "processamento") {
            Message::alert("Erro: Verifique se há uma encomenda em processamento para esse cliente");
            redirect("loja/encomenda");
            return;
        }
        $loja = new LojaModel();
        $loja->marcar($id_encomenda);

        redirect("loja/encomenda/{$cliente_id}/{$codigo_encomenda}/{$status_encomenda}");
    }

    //========================================
    // TOTAL DE VENDAS
    //========================================
    public function totalvendafuncionario()
    {
        if (!is_loja()) {
            Message::alert("Funcionário não existe");
            redirect("loja");
            return;
        }

        $vendas = new LojaModel();

        //========================================
        // LENDO VENDAS
        $resultVendas = $vendas->vendasDiarias();

        //========================================
        // SOMANDO VENDAS DO FUNCIONÁRIO
        $total_vendas_vendedor = "0";
        foreach ($resultVendas as $resultVenda) {

            //========================================
            // VERIFICANDO SE O FUNCIONÁRIO LOGADO É O MESMO DO BANCO
            if ($_SESSION['funcionario']['id'] == $resultVenda->id_vendedor) {

                $total_vendas_vendedor += $resultVenda->quantidade_produto;
            }
        }

        //========================================
        // DADOS DO FUNCIONÁRIO
        $funcionario = $vendas->lerFuncionario();

        //========================================
        // VENDAS DIÁRIA
        $vendasDiarias = $vendas->encomendasSeparadaFuncionario();


        //========================================
        // SOMANDO VENDAS DO FUNCIONÁRIO
        $total_vendas_vendedor_diaria = "0";

        foreach ($vendasDiarias as $vendasDiaria) {

            //========================================
            // VERIFICANDO SE O FUNCIONÁRIO LOGADO É O MESMO DO BANCO
            if ($_SESSION['funcionario']['id'] == $vendasDiaria->evendedor) {

                $total_vendas_vendedor_diaria += $vendasDiaria->vquantidade_produto;
            }
        }

        //========================================
        // BUSCANDO POR MES NO BANCO DE DADOS

        $month = [
            "1" => "Jan",
            "2" => "Fev",
            "3" => "Mar",
            "4" => "Abr",
            "5" => "Mai",
            "6" => "Jun",
            "7" => "Jul",
            "8" => "Ago",
            "9" => "Set",
            "10" => "Out",
            "11" => "Nov",
            "12" => "Dez"
        ];

        $vendasMes = $vendas->encomendasSeparadaMes();

        foreach ($vendasMes as $vendaMes) {
            foreach ($month as $key => $value) {
                if (strval($vendaMes->vvendido) == $key) {
                    $vendaMes->vvendido = $value;
                }
            }
        }

        $resultClientess = $vendas->readClientes();

        $dados = [
            "totalVendas" => $total_vendas_vendedor,
            "funcionario" => $funcionario,
            "vendasDiarias" => $vendasDiarias,
            "clientes" => $resultClientess,
            "mes" => $vendasMes

        ];

        Controller::layout([
            'loja/header',
            'loja/totaldevendas',
            'loja/footer'
        ], $dados);
    }

    //========================================
    // TODAS ENCOMENDAS DO MES VENDAS
    //========================================
    public function encomendasstatus($dados)
    {
        if (!is_string($dados)) {
            redirect();
            return;
        }

        //====================================
        // INSTANCIANDO MODELO MODEL
        $vendas = new LojaModel();

        //====================================
        // TRABALHANDO O MÊS QUE VEM DA URL
        //------------------------------------
        $month = [
            "1" => "Jan",
            "2" => "Fev",
            "3" => "Mar",
            "4" => "Abr",
            "5" => "Mai",
            "6" => "Jun",
            "7" => "Jul",
            "8" => "Ago",
            "9" => "Set",
            "10" => "Out",
            "11" => "Nov",
            "12" => "Dez"
        ];

        $mes = array_search(ucfirst($dados), $month);

        // var_dump($mes);

        $vendasMes = $vendas->encomendasMes($mes);

        $resultClientess = $vendas->readClientes();

        // var_dump($resultClientess);

        $dados = [
            "clientes" => $resultClientess,
            "vendasMes" => $vendasMes
        ];

        Controller::layout([
            'loja/header',
            'loja/encomendasstatus',
            'loja/footer'
        ], $dados);
    }
    public function minhasvendas()
    {
        //====================================
        // INSTANCIANDO MODELO MODEL
        $vendas = new LojaModel();
        $resultClientess = $vendas->readClientes();

        // var_dump($resultClientess);

        $dados = [
            "clientes" => $resultClientess
        ];

        Controller::layout([
            'loja/header',
            'loja/minhasvendas',
            'loja/footer'
        ], $dados);
    }
}

<?php

use App\Classes\Message;

Message::seeMessage();
?>
<main class="main">
    <div class="main_home">
        <div class="main_home_menu">
            <?php include(__DIR__ . "/aside.php"); ?>
        </div>
        <div class="main_home_conteudo">
            <div class="main_home_conteudo_h1">
                <h1>Cliente - <?= ucfirst($cliente->first_name) ?> <?= ucfirst($cliente->last_name) ?> # <?= ucfirst($codigo) ?> #

                    <?php if ($produtoss->evendedor == $funcionario->id) : ?>
                       <small>  |<?= $funcionario->nome ?> <?= $funcionario->sobre_nome ?> </small>
                    <?php endif; ?>

                    <?php if ($produtoss->estatus == "processamento" && $produtoss->evendedor == "") : ?>
                        <a class="button" href="<?= URL ?>/loja/separar/<?= $produtoss->clid ?>/<?= $produtoss->eid ?>/<?= $_SESSION['funcionario']["id"] ?>/<?= $produtoss->ecodigo_encomenda ?>/<?= $produtoss->estatus ?>">Marcar</a>
                    <?php endif; ?>

                </h1>
            </div>

            <div class="main_home_conteudo_status_pedidos">

                <?php foreach ($resultEncomedaStatus as $status) : ?>
                    <a href="<?= URL ?>/loja/encomenda/<?= $status->id_cliente ?>/<?= $status->codigo_encomenda ?>/<?= $status->status ?>"><?= ucfirst($status->status) ?></a>
                <?php endforeach; ?>

            </div>

            <div class="main_home_conteudo_cliente_itens">
                <?php if (!empty($produtos)) : ?>
                    <?php foreach ($produtos as $produto) : ?>
                        <div class="main_home_conteudo_cliente_itens_border">

                            <div class="main_home_conteudo_cliente_itens_item">
                                <img src="<?= URL ?>/public/assets/images/<?= $produto->pimage ?>" alt="">
                            </div>
                            <ul>
                                <li><b>Nome: </b><small> <?= ucfirst($produto->pnome) ?></small></li>
                                <li><b>Categoria: </b><small> <?= ucfirst($produto->cnome) ?></small></li>
                                <li><b>Valor: </b><small> <?= number_format($produto->ppromocao == "" ? $produto->ppreco :  $produto->pprecoPromo, 2, ',', '.'); ?> <?= $produto->ppromocao == "" ? "" : ' <i class="fa-brands fa-product-hunt"></i>' ?></small></li>
                                <li><b>Bojo: </b><small> <?= ucfirst($produto->bnome) ?></small></li>
                                <li><b>Tamanho: </b><small> <?= ucfirst($produto->tnome) ?></small></li>
                                <li><b>Tecido: </b><small> <?= ucfirst($produto->tcnome) ?></small></li>
                                <li><b>Quantidade: </b><small> <?= ucfirst($produto->epquantidade) ?></small></li>
                                <?php if ($produto->epseparado == "") : ?>
                                    <?php if ($produto->estatus == "pendente") : ?>
                                        <li><button class="button" id="button<?= $produto->epid ?>" onclick="separaproduto(<?= $_SESSION['funcionario']['id'] ?>,<?= $produto->epid ?>,<?= $produto->epquantidade ?>,<?= $produto->eid ?>)">Separar</button></li>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="main_home_conteudo_h1">
                <h1>ENDEREÇO DA ENTREGA</h1>
            </div>

            <div class="main_home_conteudo_cliente">
                <ul>

                    <li><b>Nome: </b><small> <?= ucfirst($cliente->first_name) ?></small></li>
                    <li><b>Sobre Nome: </b><small> <?= ucfirst($cliente->last_name) ?></small></li>
                    <li><b>Telefone: </b><small>(<?= ucfirst($cliente->ddd) ?>) <?= ucfirst($cliente->phone) ?></small></li>
                    <li><b>Pais: </b><small><?= ucfirst($endereco->pais) ?></small></li>
                    <li><b>Cep: </b><small><?= ucfirst($endereco->cep) ?></small></li>
                    <li><b>Estado: </b><small><?= ucfirst($endereco->estado) ?></small></li>
                    <li><b>Bairro: </b><small><?= ucfirst($endereco->bairro) ?></small></li>
                    <li><b>Cidade: </b><small><?= ucfirst($endereco->cidade) ?></small></li>
                    <li><b>Rua: </b><small><?= ucfirst($endereco->rua) ?></small></li>
                    <li><b>Numero: </b><small> <?= ucfirst($endereco->numero) ?></small></li>
                    <li><b>Complemento: </b><small> <?= ucfirst($endereco->complemento) ?></small></li>
                    <li><b>Inf. Adicionais: </b><small> <?= ucfirst($endereco->informacoes_adicionais) ?></small></li>

                </ul>
            </div>

            <div class="main_home_conteudo_h2">
                <h2>Pedidos</h2>
            </div>
            <div class="main_home_conteudo_pedidos">
                <ul>
                    <?php foreach ($resultEncomedas as $value) : ?>

                        <?php if ($value->codigo_encomenda != $codigo) : ?>

                            <!-- LEMBRAR DE CRIAR  UMA SHADOW BOX -->

                            <li><b>Pedido: </b><?= $value->codigo_encomenda ?> <small>status: </small> </b><?= ucfirst($value->status) ?> <a href="<?= URL ?>/loja/encomenda/<?= $value->id_cliente ?>/<?= $value->codigo_encomenda ?>/<?= $value->status ?> "><i class="fa-solid fa-eye"></i></a></li>

                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</main>
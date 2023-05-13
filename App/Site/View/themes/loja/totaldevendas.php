<?php

use App\Classes\Message;

Message::seeMessage();
?>
<main class="main">
    <div class="main_home">
        <div class="main_home_menu">
            <?php include_once(__DIR__ . "/aside.php"); ?>
        </div>

        <div class="main_home_conteudo">
            <div class="main_home_conteudo_info">
                <div class="painel_select_info">
                    <!-- TOTAL DE VENDAS -->
                    <div class="painel_select_total_vendas">
                        <?= $totalVendas ?>
                    </div>
                    <div class="painel_select_info_funcionario">
                        <div class="painel_select_info_funcionario_dados">
                            <ul>
                                <li><b>Nome: </b><small><?= ucfirst($funcionario->nome) ?></small></li>
                                <li><b>Sobre nome: </b><small><?= ucfirst($funcionario->sobre_nome) ?></small></li>
                                <li><b>Cargo: </b><small><?= ucfirst($funcionario->cargo) ?></small></li>
                                <li><b>Ativo: </b><small><?= ucfirst($funcionario->status) ?></small></li>
                                <li><b>Login: </b><small><?= ucfirst($funcionario->login) ?></small></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main_total_funcionario">

                <div class="main_total_conteudo_h2">
                    <h2>Vendas Diárias</h2>
                </div>

                <div class="main_total_funcionario_vendas">
                    <ul>
                        <?php if (!empty($vendasDiarias)) : ?>
                            <?php foreach ($vendasDiarias as $vendasDiaria) : ?>
                                <li><a href="<?= URL ?>/loja/encomenda/<?= $vendasDiaria->ecliente ?>/<?= $vendasDiaria->ecodigo_encomenda ?>/<?= $vendasDiaria->estatus ?>"><b><?= $vendasDiaria->ecodigo_encomenda ?></b><small> <?= $vendasDiaria->vquantidade_produto ?></small></a></li>
                            <?php endforeach; ?>

                        <?php else : ?>

                            <b>Vamos começar a vender ?</b>

                        <?php endif; ?>
                    </ul>

                </div>

            </div>

            <div class="main_total_funcionario">
                <div class="main_total_conteudo_h2">
                    <h2>Vendas Mensais</h2>
                </div>
                <div class="main_total_funcionario_vendas">
                    <ul>
                        <?php if (!empty($mes)) : ?>
                            <?php foreach ($mes as $valueMes) : ?>
                                <li><a href="<?= URL ?>/loja/encomendasstatus/<?= strtolower($valueMes->vvendido) ?>"><b><?= $valueMes->vqtd ?> </b><small><?= $valueMes->vvendido ?></small></a></li>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <b>Vamos começar a vender ?</b>
                        <?php endif; ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>

</main>
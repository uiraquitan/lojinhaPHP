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
                    <div class="painel_select_info_itens">
                        <p><i class="fa-solid fa-users"></i></p>
                        <a href="<?= URL ?>/">Meus Clientes</a>
                    </div>
                    <div class="painel_select_info_itens">
                        <p><i class="fa-solid fa-credit-card"></i></p>
                        <a href="<?= URL ?>/">Minhas Vendas</a>
                    </div>
                    <div class="painel_select_info_itens">
                        <p><i class="fa-sharp fa-solid fa-bag-shopping"></i></p>
                        <a href="<?= URL ?>/">Pedidos</a>
                    </div>
                    <div class="painel_select_info_itens">
                        <p><i class="fa-solid fa-paper-plane"></i></p>
                        <a href="<?= URL ?>/">Envios</a>
                    </div>
                    <div class="painel_select_info_itens">
                        <p><i class="fa-solid fa-hashtag"></i></p>
                        <a href="<?= URL ?>/loja/totalvendafuncionario"><?= $totalVendas ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
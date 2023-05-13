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
                <div class="painel_clientes">

                    <ul>
                        <?php if (!empty($totalclientes)) : ?>
                            <?php foreach ($totalclientes as $totalcliente) : ?>
                                <!-- ID - Nome - SObre Nome - Total Encomenda - se tem alguma pendente -->
                                <li>
                                    <a href="<?= URL ?>/loja/cliente/<?= $totalcliente->id ?>" title="">
                                        <?= $totalcliente->id ?> - <?= ucfirst($totalcliente->first_name) ?> <?= ucfirst($totalcliente->last_name) ?>
                                    </a>

                                </li>
                            <?php endforeach; ?>
                        <?php else : ?>
                            Não tem cliente cadastrado
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</main>
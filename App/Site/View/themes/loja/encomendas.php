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
            <div class="main_home_conteudo_data">

                <div class="main_home_conteudo_h2">
                    <h2>Escolha uma data:</h2>
                </div>
                <div class="main_home_conteudo_encomendas_data">
                    <form action="<?= URL ?>/loja/encomendas" method="POST">
                        <input type="date" name="data_um" value="<?= $_POST['data_um'] ?? "" ?>">
                        <input type="date" name="data_dois" value="<?= $_POST['data_dois'] ?? "" ?>">
                        <input type="submit" name="env" class="button" value="Buscar Data">
                    </form>
                </div>

            </div>
            <div class="main_home_conteudo_status_pedidos">
                <div class="main_home_conteudo_h2">
                    <h2>Estatus das encomendas</h2>
                </div>
                <?php foreach ($allStatus as $status) : ?>
                    <a href="<?= URL ?>/loja/encomendas/<?= $status->status ?>"><?= ucfirst($status->status) ?></a>
                <?php endforeach; ?>

            </div>
            <div class="main_home_conteudo_encomendas">
                <div class="main_home_conteudo_h2">
                    <h2>Encomendas</h2>
                </div>


                <div class="main_home_conteudo_pedidos">
                    <ul>
                        <?php if (!empty($encomendas)) : ?>
                            <?php foreach ($encomendas as $value) : ?>

                                <!-- LEMBRAR DE CRIAR  UMA SHADOW BOX -->

                                <li><b></b><?= $value->codigo_encomenda ?> <small> | </small> <?= ucfirst(substr($value->status, 0, 3) . ".") ?> <small> | <?= ucfirst(date('d/m/Y H:i', strtotime($value->created_at))) ?></small> <a href="<?= URL ?>/loja/encomenda/<?= $value->id_cliente ?>/<?= $value->codigo_encomenda ?>/<?= $value->status ?> "><i class="fa-solid fa-eye"></i></a></li>

                            <?php endforeach; ?>
                        <?php else : ?>
                            <h2 class='button'>Não existe encomendas, Selecione uma data</h2>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>
<?php

use App\Classes\Message;

Message::seeMessage();
?>
<main class="main">
    <div class="main_home">
        <div class="main_home_menu">
            <?php include_once(__DIR__ . "/aside.php"); ?>
        </div>

        <section class="main_home_conteudo">
            <div class="encomendas_mes">

                <header>
                    <h1>Todas as encomendas</h1>
                </header>

                <div class="encomendastatusmes">
                    <header>
                        <h2>Pendentes</h2>
                    </header>
                    <div>

                        <ul>
                            <?php if (!empty($vendasMes)) : ?>
                                <?php foreach ($vendasMes as $vendaMes) : ?>
                                    <?php if ($vendaMes->status == "pendente") : ?>
                                        <li><a href="<?= URL ?>/loja/encomenda/<?= $vendaMes->id_cliente ?>/<?= $vendaMes->codigo_encomenda ?>/<?= $vendaMes->status ?>"><b><?= $vendaMes->codigo_encomenda ?></b><small> </small></a></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            <?php else : ?>

                                <b> <i class="fa-solid fa-circle-xmark"></i></b>

                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <div class="encomendastatusmes">
                    <header>
                        <h2>Processamento</h2>
                    </header>
                    <div>
                        <ul>
                            <?php if (!empty($vendasMes)) : ?>
                                <?php foreach ($vendasMes as $vendaMes) : ?>
                                    <?php if ($vendaMes->status == "processamento") : ?>
                                        <li><a href="<?= URL ?>/loja/encomenda/<?= $vendaMes->id_cliente ?>/<?= $vendaMes->codigo_encomenda ?>/<?= $vendaMes->status ?>"><?= $vendaMes->codigo_encomenda ?></a></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            <?php else : ?>

                                <b> <i class="fa-solid fa-circle-xmark"></i></b>

                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <div class="encomendastatusmes">
                    <header>
                        <h2>Enviada</h2>
                    </header>
                    <div>
                        <ul>
                            <?php if (!empty($vendasMes)) : ?>
                                <?php foreach ($vendasMes as $vendaMes) : ?>
                                    <?php if ($vendaMes->status == "enviado") : ?>
                                        <li><a href="<?= URL ?>/loja/encomenda/<?= $vendaMes->id_cliente ?>/<?= $vendaMes->codigo_encomenda ?>/<?= $vendaMes->status ?>"><b><?= $vendaMes->codigo_encomenda ?></b><small> </small></a></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            <?php else : ?>

                                <b> <i class="fa-solid fa-circle-xmark"></i></b>

                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <div class="encomendastatusmes">
                    <header>
                        <h2>Cancelada</h2>
                    </header>
                    <div>
                        <ul>
                            <?php if (!empty($vendasMes)) : ?>
                                <?php foreach ($vendasMes as $vendaMes) : ?>
                                    <?php if ($vendaMes->status == "cancelado") : ?>
                                        <li><a href="<?= URL ?>/loja/encomenda/<?= $vendaMes->id_cliente ?>/<?= $vendaMes->codigo_encomenda ?>/<?= $vendaMes->status ?>"><b><?= $vendaMes->codigo_encomenda ?></b><small> </small></a></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            <?php else : ?>

                                <b> <i class="fa-solid fa-circle-xmark"></i></b>

                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>

</main>
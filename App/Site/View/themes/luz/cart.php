<?php


use App\Classes\Message;

?>

<main class="main">

    <section class="main_section_new">
        <header class="main_section_new_header">

            <h1>Meu Carrinho</h1>

        </header>
        <?= Message::seeMessage(); ?>
        <!-- CART -->
        <div class="cart">



            <div class="info_cart_pedido">

                <div class="cart_item">
                    <?php
                    $index = 0;
                    $totalCarrinho = count($dados);


                    if (!empty($dados)) : ?>

                        <?php foreach ($dados as $values) : ?>
                            <?php if ($index < $totalCarrinho - 1) : ?>
                                <ul>


                                    <li>
                                        <a href="<?= URL ?>/user/single/<?= $values['id'] ?>">
                                            <img src="<?= URL ?>/public/assets/images/<?= $values["image"] ?>" alt="" style="width: 25px;">
                                        </a>
                                    </li>
                                    <li><a href="<?= URL ?>/user/single/<?= $values['id'] ?>">Vestido evase no tecido</a></li>
                                    <li>
                                        <div>
                                            <p class="cart_unidade"><?= $values['quantidade']; ?></p>
                                        </div>
                                    </li>
                                    <li>R$ <?= number_format($values['preco'], 2, ",", "."); ?></li>
                                    <li><a href="<?= URL ?>/produtos/removeCarrinho/<?= $values['id'] ?>"><i class="fa-solid fa-trash-can"></i></a></li>
                                </ul>
                            <?php endif; ?>
                            <?php $index++; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <?php

                        Message::danger("Vamos as compas ?");
                        redirect();
                        return;
                        ?>
                    <?php endif; ?>
                </div>




                <div class="cart_info">
                    <a href="<?= URL ?>/produtos/finalizar">Finalizar Compra</a>
                    <div class="cart_info_total">
                        <?php
                        $total_produtos = 0;
                        if (isset($_SESSION['carrinho'])) {
                            foreach ($_SESSION['carrinho'] as $value) {
                                $total_produtos += $value;
                            }
                        }
                        ?>
                        <p><b>Total:</b> R$ <?= number_format($_SESSION['total_encomenda'], 2, ",", ".") ?></p>
                        <p><b>Qtd.:</b> <?= $total_produtos ?> <b>Uni</b></p>
                    </div>

                </div>
            </div>
        </div>

    </section>

    <!-- VEJA TAMBÉM -->

    <?php include(__DIR__ . "/more.php"); ?>


    <!-- DOBRA -->
    <?php include(__DIR__ . "/dobra_um.php"); ?>
</main>
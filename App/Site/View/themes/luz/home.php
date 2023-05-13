<main class="main">
    <!-- <section class="main_slide_top">
            slide
        </section> -->
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <section class="main_section_new">
        <header class="main_section_new_header">
            <h1>Novos modelos</h1>
            <hr />
        </header>
        <?php

        use App\Classes\Message;

        echo Message::seeMessage();

        ?>

        <div class="main_section_new_itens">
            <?php if (!empty($dados)) : ?>

                <?php foreach ($dados as $value) : ?>
                    <article class="main_section_new_itens_item">
                        <header>

                            <div class="price">
                                <a href="<?= URL ?>/user/single/<?= $value->id; ?>" class="link_index">

                                    <img src="<?= URL . "/assets/images/" . $value->image ?>" alt="">
                                    <span> R$ <?= number_format($value->promocao == "" ? $value->preco :  $value->precoPromo, 2, ',', '.'); ?> <?= $value->promocao == "" ? "" : ' <i class="fa-brands fa-product-hunt"></i>' ?></span></a>
                            </div>
                            <span class="tamanho"><?= $value->tamanhoMin; ?> - <?= $value->tamanhoMax; ?></span>
                            <!-- <span class="wish"><i class="fa-solid fa-heart-circle-plus"></i> </span> -->
                            <h2><?= $value->nome; ?></h2>

                        </header>
                        <div class="main_section_new_itens_opt">

                            <div class="addCart">
                                <button class="cart" onclick="adicionar_carrinho(<?= $value->id; ?>)"><i class="fa-solid fa-cart-plus"></i></button>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else : ?>
                não tha item
            <?php endif; ?>
        </div>
    </section>

    <?php include(__DIR__ . '/dobra_um.php') ?>
</main>
<main class="main">
    <!-- <section class="main_slide_top">
            slide
        </section> -->
    <section class="main_section_single">
        <header class="main_section_single_header">
            <h1>Novos modelos</h1>
        </header>
        <?php

        use App\Classes\Message;

        Message::seeMessage();
        ?>
        <article class="main_single">

            <div class="main_single_itens">
                <div class="main_single_itens_img">
                    <img src="<?= URL ?>/public/assets/images/<?= $dados->image; ?>" alt="<?= $dados->nome; ?>">
                </div>
            </div>

            <div class="main_single_itens main_single_itens_p">
                <header>
                    <h2><?= $dados->nome; ?></h1>
                        <small>cod: <?= $dados->cod; ?></small>


                </header>
                <div class="main_single_itens_item">
                    <p class="price_single"> R$ <?= number_format($dados->promocao == "" ? $dados->preco :  $dados->precoPromo, 2, ',', '.'); ?> <?= $dados->promocao == "" ? "" : ' <i class="fa-brands fa-product-hunt"></i>' ?> </p>

                    <p class="price_tamanho">Veste de <span><?= $dados->tamanhoMin; ?></span> a <span><?= $dados->tamanhoMax; ?></span></p>
                </div>

                <div class="main_single_itens_pay">
                    <p><i class="fa-solid fa-money-bill-transfer"></i> Transferência</p>
                    <p><i class="fa-solid fa-barcode"></i> Boleto</p>
                    <p><i class="fa-brands fa-pix"></i> Pix</p>
                    <p><i class="fa-solid fa-money-check-dollar"></i> Depósito</a></p>
                </div>
                <div class="main_single_itens_btn">
                    <button class="main_single_itens_btn_buy " onclick="adicionar_carrinho(<?= $dados->id; ?>)"><i class=" fa-solid fa-cart-plus"></i></button>
                </div>
            </div>


            <header class="main_section_single_info">
                <h2>Informações do Produto!</h2>
            </header>

            <div class="main_section_single_info_product">
                <ul>
                    <li>- Sutiã sem fecho nas costas;</li>
                    <li>- Possui área dos seios pré-moldada, modelando os seios;</li>
                    <li>- Laterais mais largas e cós duplo alongado trazem mais sustentação e conforto;</li>
                    <li>- Tecido extra fine, com brilho e toque acetinado;</li>
                    <li>- Os aviamentos metálicos na cor dourada trazem sofisticação para a peça;</li>
                    <li>- Poliamida Sensil® super macia;</li>
                    <li>- Tratamento hidrófilo permite que a pele respire livremente com total conforto;</li>
                    <li>- Sem costuras laterais.</li>
                    <li>IMPORTANTE: Ao vestir, evite o contato com acessórios que possam puxar fios. Devido ao perfeito balanceamento entre compressão e conforto, recomendamos comprar seu tamanho usual.</li>

                </ul>
            </div>
        </article>
    </section>

    <!-- VEJA TAMBÉM -->

    <?php include(__DIR__ . "/more.php"); ?>


    <!-- DOBRA -->
    <?php include(__DIR__ . "/dobra_um.php"); ?>
</main>
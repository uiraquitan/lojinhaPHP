<main class="main">
    <!-- <section class="main_slide_top">
            slide
        </section> -->
    <section class="main_selction_vitrine">
        <header class="main_section_new_header">
            <h1>Vitrine</h1>
        </header>
        <div class="separator_vitrine">
            <div class="main_selction_vitrine_menu">
                <span id="menu_vitrine"><i class="fa-solid fa-bars"></i></span>
                <ul class="menu_vitrine_active">
                    <li><a href="">Mid Zipor</a></li>
                    <li><a href="">VEstidos</a></li>
                    <li><a href="">Saias</a></li>
                    <li><a href="">Conjuntos</a></li>
                    <li><a href="">Com Gola</a></li>
                    <li><a href="">Com bojo</a></li>
                    <li><a href="">Sem bojo</a></li>
                    <li><a href="">Vestidos longo</a></li>
                    <li><a href="">Godê</a></li>
                    <li><a href="">Mid Canelado</a></li>
                </ul>
            </div>
            <div class="main_selction_vitrine_itens">


                <?php for ($i = 1; $i < 13; $i++) : ?>
                    <article class="main_selction_vitrine_itens_item">
                        <header>

                            <div class="price">
                                <a href="<?= URL ?>/user/single" class="link_index">
                                    <img src="<?= URL ?>/public/assets/images/<?= $i ?>.jpeg" alt="">
                                    <span> R$ 35.00</span></a>
                            </div>
                            <span class="tamanho">40 - 44</span>
                            <!-- <span class="wish"><i class="fa-solid fa-heart-circle-plus"></i> </span> -->
                            <h2>Vestido evase no tecido crepe Dior</h2>

                        </header>
                        <div class="main_section_new_itens_opt">
                            <div class="heart">
                                <a href=""><i class="fa-solid fa-heart-circle-plus"></i></a>
                            </div>

                            <div class="addCart">
                                <a href=""><i class="fa-solid fa-cart-plus"></i></a>
                            </div>
                        </div>
                    </article>
                <?php endfor; ?>

            </div>
        </div>
    </section>
    <section class="mais_modelos">
        <header>
            <h1>Veja também</h1>
        </header>

        <div class="main_modelos_algn">

            <article>
                <header>
                    <a href="">
                        <h2>CONJUNTO EM MALHA CANELADA</h2>
                        <img src="<?= URL ?>/public/assets/images/17.jpeg" alt="">
                    </a>
                </header>
            </article>

            <article>
                <header>
                    <a href="">
                        <h2>CONJUNTO EM MALHA CANELADA</h2>
                        <img src="<?= URL ?>/public/assets/images/16.jpeg" alt="">
                    </a>
                </header>
            </article>

            <article>
                <header>
                    <a href="">
                        <h2>CONJUNTO EM MALHA CANELADA</h2>
                        <img src="<?= URL ?>/public/assets/images/15.jpeg" alt="">
                    </a>
                </header>
            </article>

            <article>
                <header>
                    <a href="">
                        <h2>CONJUNTO EM MALHA CANELADA</h2>
                        <img src="<?= URL ?>/public/assets/images/14.jpeg" alt="">
                    </a>
                </header>

            </article>

        </div>

    </section>
    <?php include(__DIR__ . "/dobra_um.php"); ?>
</main>
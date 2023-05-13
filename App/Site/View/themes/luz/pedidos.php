<main class="main">
    <!-- <section class="main_slide_top">
            slide
        </section> -->
    <section class="main_section_new">
        <header class="main_section_new_header">

            <h1>Meus Pedidos</h1>
        </header>

        <!-- PAINEL PEDIDOS -->
        <div class="painel_pedidos">
            <div class="painel_pedidos_search_pedidos">

                <form action="">
                    <label for="search_pedido">Buscar Pedido</label>
                    <input type="text" name="" id="">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>

                <div class="status_pedido">
                    <div class="status">
                        <div class="status_icon">
                            STATUS <i class="fa-solid fa-bars"></i>
                        </div>
                        <div class="status_info_link">
                            <a href="<?= URL ?>/produtos/pedidos/pendente">Pendente</a><a href="<?= URL ?>/produtos/pedidos/processamento">Processamento</a><a href="<?= URL ?>/produtos/pedidos/enviado">Enviado</a><a href="cancelado">Cancelado</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="painel_pedidos_itens">
                <?php foreach ($ecomenda as $dado) : ?>
                    <!-- PEDIDOS -->
                    <div class="painel_pedidos_itens_item">

                        <div class="painel_pedidos_itens_item_info">
                            <div class="painel_pedidos_itens_item_info_dados">
                                <ul>
                                    <li><b>Pedido:</b> <a href="<?= URL ?>/produtos/detalhes/<?= $_SESSION['cliente']['id'] ?>/<?= $dado->codigo_encomenda ?>/<?= $dado->id ?>"> <?= $dado->codigo_encomenda ?><b>Ver</b></a></li>
                                    <li><b>Status:</b> <?= $dado->status ?></li>
                                    <li><b>data:</b> <?= date('d/m/Y', strtotime($dado->created_at)) ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


    </section>

    <!-- VEJA TAMBÉM -->

    <?php include(__DIR__ . "/more.php"); ?>


    <!-- DOBRA -->
    <?php include(__DIR__ . "/dobra_um.php"); ?>
</main>
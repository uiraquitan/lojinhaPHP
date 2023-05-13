<main class="main">
    <!-- <section class="main_slide_top">
            slide
        </section> -->
    <header class="main_section_new_header">
        <!-- <?= var_dump($_SESSION) ?> -->
        <h1>Ola <?= $_SESSION['cliente']['cliente'] ?>   <?= $_SESSION['cliente']['last_name'] ?></h1>
    </header>
    <section class="painel_select">
        <div class="painel_select_info">
            <div class="painel_select_info_itens">
                <p><i class="fa-solid fa-box-open"></i></p>
                <a href="<?= URL ?>/produtos/pedidos"> Meus Pedidos</a>
            </div>
            <div class="painel_select_info_itens">
                <p><i class="fa-solid fa-shield-halved"></i></p>
                <a href="<?= URL ?>/user/security">Alterar Senha</a>
            </div>
            <div class="painel_select_info_itens">
                <p><i class="fa-sharp fa-solid fa-users-gear"></i></p>
                <a href="<?= URL ?>/user/dados">Meus dados</a>
            </div>
            <div class="painel_select_info_itens">
                <p><i class="fa-solid fa-gears"></i></p>
                <a href="<?= URL ?>/user/updatedados">Atualizar Dados</a>
            </div>
            <div class="painel_select_info_itens">
                <p><i class="fa-solid fa-gears"></i></p>
                <a href="<?= URL ?>/loja/login">Admin</a>
            </div>
        </div>

    </section>

    <!-- DOBRA -->
    <?php include(__DIR__ . "/dobra_um.php"); ?>
</main>
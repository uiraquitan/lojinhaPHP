<!DOCTYPE html>
<?php
$total_produtos = 0;
if (isset($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $value) {
        $total_produtos += $value;
    }
}
?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Luz Modaz, Vendas em atacado e varejo">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Uiraquitan Pessoa">
    <link rel="stylesheet" href="<?= URL ?>/public/assets/css/boot.css">
    <link rel="stylesheet" href="<?= URL ?>/public/assets/css/style.css">
    <link rel="stylesheet" href="<?= URL ?>/public/assets/css/painel.css">
    <link rel="stylesheet" href="<?= URL ?>/public/assets/css/all.css">
    <title>Caah Modas</title>


</head>

<body>
    <!-- HEADER -->
    <header class="header">

        <!-- BG HEADER 1 -->
        <div class="main_header bg-gradiente">
            <!-- TRABALHANDO O HEADER -->
            <div class="main_header_top">
                <div class="main_header_logo">
                    <a href="<?= URL ?>" title="">
                        <h1> Luz Modas</h1>
                    </a>
                </div>
                <div class="main_header_cart">
                    <a href="<?= URL ?>/produtos/cart"><i class="fa-solid fa-cart-shopping"></i> <span id="produtos"><?= ($total_produtos == 0 ? '0' : $total_produtos) ?></span></a></li>
                </div>

                <div class="main_header_user">

                    <?php if (!isset($_SESSION['cliente'])) : ?>
                        <a href="<?= URL ?>/user/login"><i class="fa-solid fa-arrow-right-to-bracket"></i><span>Entrar</span></a>
                    <?php else : ?>
                        <a href="<?= URL ?>/user/painel"><i class="fa-regular fa-circle-question"></i> <span>Painel</span></a>
                    <?php endif; ?>
                </div>

                <div class="main_header_menu" id="menu">
                    <div class="main_header_hamburguer_menu" id="menu_active">
                        <i class="fa-solid fa-bars"></i> <span>Mais</span>
                    </div>
                    <ul>
                        <?php if (!isset($_SESSION['cliente'])) : ?>
                            <li><a href="<?= URL ?>/user/cadastrar"><i class="fa-solid fa-circle-arrow-right"></i> <span>Cadastrar</span></a></li>
                        <?php endif; ?>
                        <li><a href="<?= URL ?>/ajuda"><i class="fa-regular fa-circle-question"></i> Ajuda</a></li>
                        <li><a href="<?= URL ?>/user/contato"><i class="fa-solid fa-phone"></i> Contato</a></li>
                        <?php if (isset($_SESSION['cliente'])) : ?>
                            <li> <a href="<?= URL ?>/user/logout"><i class="fa-solid fa-arrow-right-to-bracket"></i><span>Sair</span></a> </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <!-- FIM TRABALHANDO TOPO -->
        </div>
        <!-- FIM HEADER 1 -->
        <div class="main_header bg-back">
            <div class="main_nav_menu" id="menu">
                <div class="main_nav_menu_second">

                    <div class="main_nav_hamburguer_menu" id="close_menu">
                        <p> <i class="fa-solid fa-bars"> </i> Menu</p>
                    </div>

                    <ul>
                        <li><a href="<?= URL ?>/produtos/filtro/vestidos"> VESTIDOS</a></li>
                        <li><a href="<?= URL ?>/produtos/filtro/conjunto"> CONJUNTO</a></li>
                        <li><a href="<?= URL ?>/produtos/filtro/saias"> SAIAS</a></li>
                        <li><a href="<?= URL ?>/produtos/filtro/promocoes"> Promoções</a></li>

                    </ul>

                </div>

                <div class="input">
                    <form action="<?= URL ?>/user/search" method="post">
                        <input type="text" name="search" value="<?= $_POST['search'] ?? "" ?>">
                        <!-- <input type="submit" name="s" value="Buscar"> -->
                        <button><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <!-- FIM HEADER -->
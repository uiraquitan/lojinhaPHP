<?php

use App\Classes\Message;
?>
<main class="main">

    <section class="main_section_new">
        <header class="main_section_new_header">

            <h1>Recuperar Senha</h1>
        </header>
        <section class="login">
            <form action="" method="">
                <header>
                    <h2>Login Luz Modas</h2>
                </header>
                <?= Message::seeMessage(); ?>


                <div class="form_div">
                    <label for="name">Email ou Telefone: </label>
                    <input type="text" id="name" name="name" placeholder="Login | E-mail ou Telefone">
                </div>

                <div class="form_div_btn">
                    <button>Recuperar Senha</button>
                </div>
                <div class="form_div_opt">
                    <a href="<?= URL ?>/user/cadastrar">Cadastrar</a><a href="<?= URL ?>/user/login'">Fazer login</a>
                </div>
            </form>
        </section>

        <div class="dobra_um_info_store">

            <div class="dobra_um_info_store_top">
                <ul>
                    <li>
                        <i class="fa-solid fa-tag"></i>
                        <p>Melhor preço de fábrica</p>
                    </li>
                    <li>
                        <i class="fa-solid fa-truck-arrow-right"></i>
                        <p>Entregamos em todo o Brasil</p>
                    </li>
                    <li>
                        <i class="fa-solid fa-cube"></i>
                        <p>Compre peças no atacado</p>
                    </li>
                    <li>
                        <i class="fa-solid fa-user-group"></i>
                        <p>Temos equipe para te atender!</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- VEJA TAMBÉM -->

    <?php include(__DIR__ . "/more.php"); ?>


    <!-- DOBRA -->
    <?php include(__DIR__ . "/dobra_um.php"); ?>
</main>
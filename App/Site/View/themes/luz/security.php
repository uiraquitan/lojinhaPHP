<main class="main">
    <!-- <section class="main_slide_top">
            slide
        </section> -->
    <section class="main_section_new">
        <header class="main_section_new_header">

            <h1>Alterar Senha</h1>
        </header>

        <section class="login">
            <form action="<?= URL ?>/user/alterarsenha/<?= $_SESSION['cliente']['id']; ?>" method="post">
                <header>
                    <h2>Altere sua senha</h2>
                </header>

                <?php

                use App\Classes\Message;

                Message::seeMessage();
                ?>
                <div class="form_div">
                    <label for="name">Senha Atual: </label>
                    <input type="password" id="senha-atual" name="senha" placeholder="Senha atual">
                </div>

                <div class="form_div">
                    <label for="senha">Nova Senha: </label>
                    <input type="password" id="senha_nova" name="senha_nova" placeholder="Nova Senha">
                </div>
                <div class="form_div">
                    <label for="senha">Confirme Senha: </label>
                    <input type="password" id="senha_confirm" name="senha_confirm" placeholder="Confirme a Senha">
                </div>

                <div class="form_div_btn">
                    <input type="submit" class="button" value="Alterar senha">
                </div>
                <div class="form_div_opt">
                    <a href="<?= URL ?>">Começar Comprar</a>
                </div>
            </form>

        </section>
    </section>
    <!-- VEJA TAMBÉM -->

    <?php include(__DIR__ . "/more.php"); ?>


    <!-- DOBRA -->
    <?php include(__DIR__ . "/dobra_um.php"); ?>

</main>
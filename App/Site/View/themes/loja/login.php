<main class="main">
    <div class="main_login_back background-login">

        <section class="main_section_login">
            <header>
                <h1>Acesso Administrativo</h1>
            </header>

            <article class="main_login">
                <header class="main_login_header">
                    <h2>Login</h2>
                </header>

                <div class="main_login_div">
                    <form action="<?= URL ?>/loja/login" method="post">

                        <?php

                        use App\Classes\Message;

                        Message::seeMessage();
                        ?>
                        <div class="form_div">
                            <label for="name">Login: </label>
                            <input type="text" name="login" placeholder="Login">
                        </div>
                        <div class="form_div">
                            <label for="senha">Senha: </label>
                            <input type="password" id="password" name="password" placeholder="Senha">
                        </div>
                        <div class="form_div_btn">
                            <input type="submit" value="Entrar" class="button">
                        </div>
                    </form>
                </div>
            </article>
        </section>
    </div>
</main>
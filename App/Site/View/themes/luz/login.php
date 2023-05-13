<main class="main">

    <section class="main_section_new">
        <header class="main_section_new_header">

            <h1>Faça o seu login</h1>
        </header>

        <section class="login">
            <form action="<?= URL ?>/user/signIn" method="post">
                <header>
                    <h2>Login Luz Modas</h2>
                </header>
                <?php

                use App\Classes\Message;

                Message::seeMessage(); 
                
                ?>
                <div class="form_div">
                    <label for="name">Email ou Telefone: </label>
                    <input type="text" id="email_tel" name="email_tel" placeholder="Login | E-mail ou Telefone" >
                </div>

                <div class="form_div">
                    <label for="senha">Senha: </label>
                    <input type="password" id="password" name="password" placeholder="Senha" >
                </div>

                <div class="form_div_btn">
                    
                    <input type="submit" value="Entrar" class="button">
                </div>
                <div class="form_div_opt">
                <a href="<?= URL ?>/user/cadastrar">Cadastrar</a><a href="<?= URL ?>/user/recuperarsenha'">Esqueci senha</a>
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
</main>
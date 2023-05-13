
<main class="main">
    <!-- <section class="main_slide_top">
            slide
        </section> -->
    <section class="main_section_new">
        <header class="main_section_new_header">

            <h1>Compra finalizada</h1>
        </header>

        <!-- CART -->
        <div class="finalizada">

            <p>Você receberá um e-mail se optou por essa opção</p>
            <p>Ou se optou pelo WhatsApp.</p>
            <p>Fique atento no no seu Painel sobre as alterações dos status da encomenda</p>
            <p class="finalizada_title">Itens serão enviados para </p>
            <hr>
            <p><b>Nome: </b><small> <?= $_SESSION['cliente']['cliente'] ?> <?= $_SESSION['cliente']['last_name'] ?></small></p>
            <p><b>Telefone: </b><small> (<?= $_SESSION['cliente']['ddd'] ?>) <?= $_SESSION['cliente']['phone'] ?></small></p>
            <p><b>E-mail:</b><small><?= $_SESSION['cliente']['email'] ?></small></p>
            <hr>
            <p><b>Pais: </b><small> <?= $dados['pais'] ?></small></p>
            <p><b>Cep:</b><small> <?= $dados['cep'] ?></small></p>
            <p><b>Estado: </b><small> <?= $dados['estado'] ?></small></p>
            <p><b>Bairro: </b><small> <?= $dados['bairro'] ?></small></p>
            <p><b>Cidade: </b><small> <?= $dados['cidade'] ?></small></p>
            <p><b>Rua: </b> <small><?= $dados['rua'] ?></small></p>
            <p><b>Numero: </b><small><?= $dados['numero'] ?></small></p>
            <p><b>Comple.: </b><small> <?= $dados['complemento'] ?></small></p>
            <p><b>Entrega: </b> <small>Correios</small></p>
            <a href="<?= URL ?>/">Continuar Comprando</a>


        </div>

    </section>


</main>
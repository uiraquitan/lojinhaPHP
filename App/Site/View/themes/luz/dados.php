<main class="main">
    <!-- <section class="main_slide_top">
            slide
        </section> -->
    <section class="main_section_new">
        <header class="main_section_new_header">

            <h1>Meus Dados</h1>
        </header>
        <div class="dados">
            <div class="dados_info">
                <p>Dados</p>
                <ul>
                    <li><b>Nome: </b><small><?= $dados->first_name ?></small></li>
                    <li><b>Sobre nome: </b><small><?= $dados->last_name ?></small></li>
                    <li><b>E-mail: </b><small><?= $dados->email ?></small></li>
                    <li><b>Telefone: </b><small>(<?= $_SESSION['cliente']['ddd']; ?>) <?= $_SESSION['cliente']['phone']; ?></small></li>
                </ul>
            </div>
            <div class="dados_info">
                <p>Endereço</p>
                <ul>
                    <li><b>Pais: </b> <small><?= $endereco->pais ?></small></li>
                    <li><b>Cep: </b><small><?= $endereco->cep ?></small></li>
                    <li><b>Estado: </b><small><?= $endereco->estado ?></small></li>
                    <li><b>Bairro: </b><small><?= $endereco->bairro ?></small></li>
                    <li><b>Cidade: </b><small><?= $endereco->cidade ?></small></li>
                    <li><b>Rua: </b><small><?= $endereco->rua ?></small></li>
                    <li><b>Número: </b><small><?= $endereco->numero ?></small></li>
                    <li><b>Complemento: </b><small><?= $endereco->complemento ?></small></li>
                    <li><b>Informação : </b><small><?= $endereco->informacoes_adicionais ?></small></li>
                </ul>
            </div>
        </div>

    </section>
    <!-- VEJA TAMBÉM -->

    <?php include(__DIR__ . "/more.php"); ?>


    <!-- DOBRA -->
    <?php include(__DIR__ . "/dobra_um.php"); ?>
</main>
<section class="mais_modelos">
    <header>
        <h1>Veja também</h1>
    </header>

    <div class="main_modelos_algn">
        <?php

        use App\Site\Model\ProdutosModel;
        use App\Classes\Message;

        echo Message::seeMessage();

        $produtos = new ProdutosModel();
        $itens = $produtos->aleatorio();
        ?>
        <?php foreach ($itens as $values) : ?>
            <article>
                <header>
                    <a href="<?= URL ?>/user/single/<?= $values->id; ?>">
                        <h2><?= $values->nome; ?></h2>
                        <img src="<?= URL ?>/public/assets/images/<?= $values->image; ?>" alt="<?= $values->nome; ?>" width="276px">
                        
                    </a>
                </header>
            </article>
        <?php endforeach; ?>


    </div>

</section>
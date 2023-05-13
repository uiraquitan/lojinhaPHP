<section class="dobra_um">
    <header>
        <h1>Mais Produtos Luz modas</h1>
    </header>
    <?php include(__DIR__ . '/tecidos_e_estampas.php') ?>
    <?php

    use App\Classes\Message;

    echo Message::seeMessage();
    ?>
    <article class="dobra_um_info">
        <header>
            <h2>categorias</h2>
        </header>
        <?php for ($i = 1; $i < 5; $i++) : ?>
            <div class="dobra_um_info_itens">
                <div class="dobra_um_itens_item">
                    
                    <img src="<?= URL ."/assets/images/$i.jpeg" ?>" alt="" height="276px">
                </div>
                <header class="dobra_um_itens_header">
                    <h2>Únicas Peças </h2>
                    <p>Temos algumas peças das quais ainda estão em estoque porém você deve correr</p>

                    <button>Ver</button>
                </header>
            </div>
        <?php endfor; ?>

    </article>

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
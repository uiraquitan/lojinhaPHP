<h1>Lista de Pendentes</h1>
<ul>
    <!-- VERIFICA SE HA ALGO VINDO DO BANCO DE DADOS -->
    <?php if (!empty($clientes)) : ?>

        <!-- FAZ UM LOOP COM OS DADOS -->

        <?php foreach ($clientes as $clientess) : ?>
            <li><a href="<?= URL ?>/loja/cliente/<?= $clientess->id ?>"><i class="fa-solid fa-user"></i> <?= ucfirst($clientess->first_name) ?> <?= ucfirst($clientess->last_name) ?> </a></li>
        <?php endforeach; ?>


    <?php else : ?>

        <?= "<p class='button'> Vazio </p>"; ?>

    <?php endif; ?>
</ul>
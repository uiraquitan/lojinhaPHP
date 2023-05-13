<main class="main">
    <!-- <section class="main_slide_top">
            slide
        </section> -->
    <header class="main_section_new_header">

        <h1>Detalhe da encomenda - <?= $encomenda->codigo_encomenda ?></h1>
    </header>
    <div class="painel_select">
        <div class="painel_select_detalhe">
            <div class="painel_select_detalhe_info">
                <p>Detalhes da encomenda <?= $encomenda->codigo_encomenda ?></p>
                <ul>
                    <li><b>Data Encomenda: </b><small><?= date("d/m/Y H:i:s", strtotime($encomenda->created_at)) ?></small></li>
                    <li><b>E-mail: </b><small><?= $encomenda->email ?></small></li>
                    <li><b>Estado: </b><small><?= $encomenda->estado ?></small></li>
                    <li><b>Bairro: </b><small><?= $encomenda->bairro ?></small></li>
                    <li><b>Cidade: </b> <small><?= $encomenda->cidade ?></small> </li>
                    <li><b>Rua: </b><small><?= $encomenda->rua ?></small></li>
                    <li><b>Numero: </b><small><?= $encomenda->numero ?></small></li>
                    <li><b>Telefone: </b><small>(<?= $encomenda->ddd ?>) <?= $encomenda->phone ?></small></li>
                    <li><b>Complemento: </b><small><?= $encomenda->complemento ?> </small></li>
                    <li><b>Info. Adicional: </b><small><?= $encomenda->informacoes_adicionais ?></small></li>

                    <li><b>Separada Por: </b><small><?= ($encomenda->vendedor ? '<i style="color: green;"class="fa-solid fa-check"></i> ' . ucfirst($funcionario->nome) :   '<i style="color: red;" class="fa-solid fa-circle-xmark"></i> Aguarde') ?></small></li>

                    <li><b>Status: </b><small><?= ucfirst($encomenda->status) ?></small></li>
                </ul>
            </div>
            <div class="painel_select_detalhe_encomenda">
                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>R$ / Un</th>
                            <th>QTD</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($encomendaProdutos as $encomendaProduto) : ?>

                            <tr>
                                <td><?= $encomendaProduto->nome ?></td>
                                <td><?= $encomendaProduto->preco ?></td>
                                <td><?= $encomendaProduto->quantidade ?></td>
                                <td>R$ <?= number_format($encomendaProduto->quantidade * $encomendaProduto->preco, 2, ",", ".") ?></td>
                            </tr>
                        <?php endforeach; ?>


                    </tbody>
                </table>
                <p class="button" style="text-align: center;">TOTAL: R$ <?= number_format($total, 2, ",", ".") ?></p>
            </div>
        </div>


    </div>

    <!-- DOBRA -->
    <?php include(__DIR__ . "/dobra_um.php"); ?>
</main>
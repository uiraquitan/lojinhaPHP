<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= URL ?>/public/assets/css/all.css">
    <link rel="stylesheet" href="<?= URL ?>/public/assets/css/admin/boot.css">
    <link rel="stylesheet" href="<?= URL ?>/public/assets/css/admin/style.css">
    <title>Admin - </title>
</head>

<body>
    <?php
    if (isset($_SESSION['funcionario'])) {
        echo ' <header class="header">
        <div class="main_header">
            <div class="main_header_logo">
                <h1><a href="' . URL . '/loja">Caah Modas - ' .  ucfirst($_SESSION["funcionario"]["nome"]) . ' </a></h1>
            </div>

            <div class="main_header_opc">
                <a href="#"><i class="fa-solid fa-gear"></i></a>
            </div>

            <div class="main_header_menu_admin">
                <div class="main_header_hamburguer_menu" id="menu_active_admin">
                    <i class="fa-solid fa-bars"></i> <span>Mais</span>
                </div>
                <ul>
                    <li><a href="#">Pendentes</a></li>
                    <li><a href="' . URL . '/loja/encomendas">Encomendas</a></li>
                    <li><a href="' . URL . '/loja/clientes">Clientes</a></li>
                    <li><a href="#">Enviada</a></li>
                </ul>
            </div>

            <div class="main_header_opc_other">
                <a href="' . URL . '/loja/logout"><i class="fa-solid fa-right-from-bracket"></i></i> <span>sair</span></a>
            </div>
        </div>
    </header>';
    } else {
        echo ' <header class="header">
        <div class="main_header">
            
            <div class="main_header_opc_other">
                <a href="' . URL . '"><i class="fa-solid fa-right-from-bracket"></i></i> Loja</a>
            </div>
        </div>
    </header>';
    }
    ?>
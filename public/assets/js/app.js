function adicionar_carrinho(id_produto) {
    axios.defaults.withCredentials = true;

    axios.get(window.location.origin + '/teste/produtos/addCarrinho/' + id_produto)
        .then(function (resposta) {
            const total_produtos = resposta.data;

            document.getElementById('produtos').innerText = total_produtos;
        });
}
function cheack_morada_alternativa() {
    const e = document.getElementById("check_morada_alternativa");

    if (e.checked == true) {
        document.getElementById("endereco_atual").style.display = "none";
        document.getElementById("endereco_novo").style.display = "block";
    } else {
        document.getElementById("endereco_atual").style.display = "block";
        document.getElementById("endereco_novo").style.display = "none";
    }
}
function endereco_alternativo() {
    axios({
        method: "post",
        url: window.location.origin + "/teste/produtos/enderecoalternativo",
        data: {
            pais: document.getElementById("pais").value,
            cep: document.getElementById("cep").value,
            bairro: document.getElementById("bairro").value,
            cidade: document.getElementById("localidade").value,
            estado: document.getElementById("uf").value,
            rua: document.getElementById("logradouro").value,
            numero: document.getElementById("numero").value,
            complemento: document.getElementById("complemento").value,
        }
    });
}


$(function () {
    $(".main_header_menu").on('click', function () {
        if (!$(".main_header_menu").hasClass("active")) {
            $(".main_header_menu").addClass("active");
        } else {
            $(".main_header_menu").removeClass("active");
        }
    });

    $(".main_nav_menu_second").on('click', function () {
        if (!$(".main_nav_menu_second").hasClass("active")) {
            $(".main_nav_menu_second").addClass("active");
        } else {
            $(".main_nav_menu_second").removeClass("active");
        }
    });

    $("#menu_vitrine").on('click', function () {
        if (!$(".menu_vitrine_active").hasClass("active")) {

            $(".menu_vitrine_active").addClass("active");
        } else {
            $(".menu_vitrine_active").removeClass("active");
        }
    });

    $(".status_icon").on('click', function () {
        if (!$(".status_info_link").hasClass("active")) {

            $(".status_info_link").addClass("active");
        } else {
            $(".status_info_link").removeClass("active");
        }
    });

    var alterar_dados = $('.update_dados form .form_div_btn.active, .update_dados form .form_div.active');
    $(".update_dados form header p:first").on('click', function () {
        if (!$(".form_div, .form_div_btn").hasClass("active")) {

            $(".form_div, .form_div_btn").addClass("active");
        } else {
            $(".form_div, .form_div_btn").removeClass("active");
        }
    });

    $(".menu_active").on('click', function () {
        console.log("aqui");
        if (!$(".main_header_menu_admin ul").hasClass("active")) {

            $(".main_header_menu_admin ul").addClass("active");
        } else {
            $(".main_header_menu_admin ul").removeClass("active");
        }
    });
});




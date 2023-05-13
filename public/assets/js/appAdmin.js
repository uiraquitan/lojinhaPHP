$(function () {
    $("#menu_active_admin").on('click', function () {
        if (!$(".main_header_menu_admin ul").hasClass("active")) {

            $(".main_header_menu_admin ul").addClass("active");
        } else {
            $(".main_header_menu_admin ul").removeClass("active");
        }
    });
});

function separaproduto(id_funcionario, id_encomendaProduto, qtd_produto, id_encomenda) {
    console.log(id_funcionario, id_encomendaProduto, qtd_produto, id_encomenda);
    axios.defaults.withCredentials = true;

    axios.post(window.location.origin + '/teste/loja/separarencomenda/' + id_funcionario + "/" + id_encomendaProduto + "/" + qtd_produto + "/" + id_encomenda)
        .then(function (resposta) {
            const insert = resposta.data;
            document.getElementById("button" + id_encomendaProduto).innerText = "Separado";
            console.log(insert);
        })
}


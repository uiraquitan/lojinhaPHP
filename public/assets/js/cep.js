const cep = document.querySelector("#cep");

cep.addEventListener("blur", () => {

    let search = cep.value.replace("-", "")

    const showData = (result) => {
        for (const campo in result) {
            if (document.querySelector("#" + campo)) {
                document.querySelector("#" + campo).value = result[campo]
            }
        }
    }

    const options = {
        method: "GET",
        mode: "cors",
        cache: "default"
    }

    fetch(`https://viacep.com.br/ws/${search}/json/`, options)
        .then(response => {
            response.json()
                .then(data => showData(data))
        })
        .catch(e => e.message)

})
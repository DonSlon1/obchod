function change_number(response) {
    let Pocet = response.data


    if (Pocet > 0) {
        const basket = document.getElementById("count")
        basket.style.display = "block";
        basket.innerText = Pocet.toString()
    }


    $('#success-modal').modal('show');
    setTimeout(function () {
        $('#success-modal').modal('hide');
    }, 3000);
}

function add_To_cart() {
    const Id_p = document.getElementById("ID_P").value
    const Cena = document.getElementById("cena").value


    axios.post('/pomoc/Add_To_cart', {
        function: "exist",
    }, {
        headers: {'X-Requested-With': 'XMLHttpRequest'}
    }).then(function (response) {
        console.log(response)
        if (response.data === 0) {
            axios.post('/pomoc/Add_To_cart', {
                function: "new",
                data: JSON.stringify([{Id_p: Id_p, Cena: Cena, Pocet: 1}])

            }, {
                headers: {'X-Requested-With': 'XMLHttpRequest'}
            }).then(function (response) {
                change_number(response)
            })


        } else if (response.data === 1) {
            axios.post('/pomoc/Add_To_cart', {
                function: "add",
                prid_ubr: 1,
                data: [{Id_p: Id_p, Cena: Cena, Pocet: 1}]

            }, {
                headers: {'X-Requested-With': 'XMLHttpRequest'}
            }).then(function (response) {
                change_number(response)
            })
        }
    })


}
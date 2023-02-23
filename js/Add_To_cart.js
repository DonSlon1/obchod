function Get_Basket() {
    let Pocet = 0;
    axios.post('pomoc/Add_To_cart.php',{
        function:"get",
    }).then(function (response) {

        Pocet = response.data

        if (Pocet > 0 ) {
            const basket = document.getElementById("count")
            basket.style.display = "block";
            basket.innerText = Pocet.toString()
        }
    })
}

window.onload = function () {
    Get_Basket()

}

function change_number(response) {
    let Pocet = response.data


    if (Pocet > 0 ) {
        const basket = document.getElementById("count")
        basket.style.display = "block";
        basket.innerText = Pocet.toString()
    }



    $('#success-modal').modal('show');
    setTimeout(function() {$('#success-modal').modal('hide');}, 3000);
}
function add_To_cart() {
    const Id_p = document.getElementById("ID_P").value
    const Cena = document.getElementById("cena").value


    axios.post('pomoc/Add_To_cart.php',{
        function:"exist",
    }).then(function (response){

        if (response.data === 0 ){
            axios.post('pomoc/Add_To_cart.php',{
                function: "new",
                data: JSON.stringify([{ Id_p:Id_p,Cena:Cena,Pocet:1 }])

            }).then(function (response){
                change_number(response)
            })


        }else if (response.data === 1){
            axios.post('pomoc/Add_To_cart.php',{
                function: "add",
                prid_ubr:1,
                data: [{ Id_p:Id_p,Cena:Cena,Pocet:1 }]

            }).then(function (response){
                change_number(response)
            })
        }
    })







}
window.onload = function () {
    let Pocet = 0;
    const sesion = JSON.parse(sessionStorage.getItem("basket"))
    for (let i = 0; i < sesion.length; i++) {
        Pocet+=sesion[i].Pocet
    }
    if (Pocet >0 ) {
        const basket = document.getElementById("count")
        basket.style.display = "block";
        basket.innerText = Pocet.toString()
    }
}
function add_To_cart() {
    const Id_p = document.getElementById("ID_P").value
    const Cena = document.getElementById("cena").value


    const basket = document.getElementById("count")
    console.log(Id_p)
    let Pocet = 0;

    axios.post('pomoc/Add_To_cart.php',{
        function:"exist",
    }).then(function (response){
        console.log(response)
        if (response.data === 0 ){
            axios.post('pomoc/Add_To_cart.php',{
                function: "new",
                data: JSON.stringify([{ Id_p:Id_p,Cena:Cena,Pocet:1 }])

            }).then(function (response){

                console.log(response)
                basket.style.display = "block";
                basket.innerText = Pocet.toString()

                $('#success-modal').modal('show');
                setTimeout(function() {$('#success-modal').modal('hide');}, 3000);
            })


        }else if (response.data === 1){
            axios.post('pomoc/Add_To_cart.php',{
                function: "add",
                data: [{ Id_p:Id_p,Cena:Cena,Pocet:1 }]

            }).then(function (response){

                console.log(response)
                basket.style.display = "block";
                basket.innerText = response.data.toString()

                $('#success-modal').modal('show');
                setTimeout(function() {$('#success-modal').modal('hide');}, 3000);
            })
        }
    })







}
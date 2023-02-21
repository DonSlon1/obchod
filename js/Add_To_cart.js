function add_To_cart() {
    const Id_p = document.getElementById("ID_P").value
    const Cena = document.getElementById("cena").value


    const basket = document.getElementById("count")
    console.log(Id_p)
    let Pocet = 0;


    if (sessionStorage.getItem("basket") === null){
        sessionStorage.setItem("basket" , JSON.stringify([{ Id_p:Id_p,Cena:Cena,Pocet:1 }]))
    }else {
        const before = JSON.parse(sessionStorage.getItem("basket"))

        let existuje = false;
        for (let i = 0; i < before.length; i++) {
            if (before[i].Id_p === Id_p){
                before[i].Pocet = before[i].Pocet+1
                console.log(before)
                existuje = true;
                break
            }
        }
        if (!existuje){
            before.push({Id_p: Id_p, Cena: Cena, Pocet: 1})
        }
        sessionStorage.setItem("basket",JSON.stringify(before))
        console.log(before)

    }
    const sesion = JSON.parse(sessionStorage.getItem("basket"))
    for (let i = 0; i < sesion.length; i++) {
        Pocet+=sesion[i].Pocet
    }
    basket.style.display = "block";
    basket.innerText = Pocet.toString()

    $('#success-modal').modal('show');
    // setTimeout(function() {$('#success-modal').modal('hide');}, 3000);

}
//? Získa input od uživatele z bootstrap modalu
function Get_Input() {
    return new Promise(function(resolve) {
        $('#delete_item').modal('show').on('hidden.bs.modal', function() {
            resolve("Save");
        });

        $('#Save').on('click', function(e) {
            e.preventDefault();

            $('#delete_item').modal('hide');

            resolve("Save");
        });

        $('#Remove').on('click', function(e) {
            e.preventDefault();


            $('#delete_item').modal('hide');

            resolve("Remove");
        });


    });
}


//? veme value z inputu v basketu a posle ji na server kde se zmeni pocet polozek
function update_basket(Id_p , element) {
    console.log(Id_p,typeof (element.value))
    if (element.value === "0"){
        Get_Input().then(function (result) {
            if (result === "Save"){
                element.value = 1;
            }else {
                axios.post('pomoc/Add_To_cart.php',{
                    function:"delete",
                    Id_p:Id_p
                }).then(location.reload())

            }
        })
    }else {
        axios.post('pomoc/Add_To_cart.php',{
            function:"update",
            Id_p:Id_p,
            Pocet: parseInt(element.value)
        }).then(function (response) {
            location.reload()
        })

    }
}

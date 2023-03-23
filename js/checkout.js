//jak provést funkci na začátku stránky

document.onreadystatechange = function () {
    console.log(document.readyState)
    if (document.readyState === 'complete') {


    }
    // získá věechny classy z elementu s id doprava


};

start()

function start() {
    let button = '<button class="dodani" type="button" onclick="reset_dodani()">Změnit způsob dodání</button>'
    const doprava = $('#doprava')
    if (doprava[0].classList.length === 2) {
        $("#" + doprava[0].classList[1]).prop("checked", true)
        doprava.append(button)
    }

    const platba = $("#platba")
    button = '<button class="dodani" type="button" onclick="reset_platby()">Změnit způsob platby</button>'
    if (platba[0].classList.length === 2) {
        $("#" + platba[0].classList[1]).prop("checked", true)
        platba.append(button)
    }


}

doprava()

function doprava() {
    function radio(response) {
        const radio = $("#" + response.data['id_checked'])[0]
        radio.checked = true
        $("#doprava-kosik").html(response.data['kosik_html']).css('display', 'flex')

    }

    const button = '<button class="dodani" type="button" onclick="reset_dodani()">Změnit způsob dodání</button>'

    const doprava = $("#doprava")

    $("input[name='doprava']").change(function () {
        const zpusob_dopravy = this.value
        axios.post('pomoc/doprava', {
            "funkce": "zadat",
            "zpusob_dopravy": zpusob_dopravy
        }).then(function () {
            axios.post('pomoc/doprava', {
                "funkce": "ziskat",
            }).then(function (response) {
                console.log(response, 1)
                doprava.html(response.data['html'])
                radio(response)
                doprava.append(button)
                platba()
            })
        })


    })


}

function platba() {
    const button = '<button class="dodani" type="button" onclick="reset_platby()">Změnit způsob platby</button>'

    function radio(response) {
        const radio = $("#" + response.data['id_checked'])[0]
        radio.checked = true
        $("#platba-kosik").html(response.data['kosik_html']).css('display', 'flex')

    }

    axios.post('pomoc/platba', {
        "funkce": "ziskat",
    }).then(function (response) {
        console.log(response.data)
        const platba = $("#platba")
        platba.html(response.data['html'])

        if (!response.data['checked']) {
            $("input[name='platba']").change(function () {
                const zpusob_dopravy = this.value
                axios.post('pomoc/platba', {
                    "funkce": "zadat",
                    "zpusob_platby": zpusob_dopravy
                }).then(function () {
                    axios.post('pomoc/platba', {
                        "funkce": "ziskat",
                    }).then(function (response) {
                        console.log(response.data)
                        platba.html(response.data['html'])

                        radio(response)
                        platba.append(button)

                    })
                })


            })
        } else {
            radio(response)
            platba.append(button)
        }
    })
}

function reset_dodani() {
    axios.post('pomoc/doprava', {
        "funkce": "reset",
        "dodani": true,
        "platba": true
    }).then(function (respons) {
        console.log(respons)
        $("#platba").html('')
        $("#doprava").html('')
        $("#doprava-kosik").html('').css('display', 'none')
        $("#platba-kosik").html('').css('display', 'none')
        axios.post('pomoc/doprava', {
            "funkce": "ziskat",
        }).then(function (response) {
            console.log(response.data)
            $("#doprava").html(response.data['html'])
            doprava()
        })

    })

}

function reset_platby() {
    axios.post('pomoc/doprava', {
        "funkce": "reset",
        "platba": true
    }).then(function (respons) {
        console.log(respons)
        $("#platba").html('')
        $("#platba-kosik").html('').css('display', 'none')
        platba()
    })
}
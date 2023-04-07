start()

function validate() {
    const form = $("#formular")
    const form_button = $("#submit_checkout")
    if (form[0].checkValidity()) {
        form_button.addClass('complete')

    } else {
        form_button.removeClass('complete')
        $("input[required]").change(function () {
            console.log(form[0].checkValidity())
            if (form[0].checkValidity()) {
                form_button.addClass('complete')
            }
        })
    }
}

function start() {
    let button =
        '<button class="dodani" type="button" onclick="reset_dodani()">Změnit způsob dodání ⯆</button>'
    const doprava = $("#doprava")
    if (doprava[0].classList.length === 2) {
        $("#" + doprava[0].classList[1]).prop("checked", true)
        doprava.append(button)
    }

    const platba = $("#platba")
    button =
        '<button class="dodani" type="button" onclick="reset_platby()">Změnit způsob platby ⯆</button>'
    if (platba[0].classList.length === 2) {
        $("#" + platba[0].classList[1]).prop("checked", true)
        platba.append(button)
    }
    validate()

}

doprava()
platba()

function doprava() {
    function radio(response) {
        const radio = $("#" + response.data["id_checked"])[0]
        radio.checked = true
        $("#doprava-kosik")
            .html(response.data["kosik_html"])
            .css("display", "flex")
    }

    const button =
        '<button class="dodani" type="button" onclick="reset_dodani()">Změnit způsob dodání ⯆</button>'

    const doprava = $("#doprava")

    $("input[name='doprava']").change(function () {
        const zpusob_dopravy = this.value
        axios
            .post("pomoc/doprava", {
                funkce: "zadat",
                zpusob_dopravy: zpusob_dopravy
            }, {
                headers: {'X-Requested-With': 'XMLHttpRequest'}
            })
            .then(function () {
                axios
                    .post("pomoc/doprava", {
                        funkce: "ziskat"
                    }, {
                        headers: {'X-Requested-With': 'XMLHttpRequest'}
                    })
                    .then(function (response) {
                        doprava.html(response.data["html"])
                        radio(response)
                        doprava.append(button)
                        axios
                            .post("pomoc/platba", {
                                funkce: "ziskat"
                            }, {
                                headers: {'X-Requested-With': 'XMLHttpRequest'}
                            })
                            .then(function (response) {
                                $("#platba").html(response.data["html"])
                                platba()
                                validate()
                            })
                    })
            })
    })
}

function platba() {
    const button =
        '<button class="dodani" type="button" onclick="reset_platby()">Změnit způsob platby ⯆</button>'

    function radio(response) {
        const radio = $("#" + response.data["id_checked"])[0]
        radio.checked = true
        $("#platba-kosik")
            .html(response.data["kosik_html"])
            .css("display", "flex")
    }

    const platba = $("#platba")
    $("input[name='platba']").change(function () {
        const zpusob_dopravy = this.value
        axios
            .post("pomoc/platba", {
                funkce: "zadat",
                zpusob_platby: zpusob_dopravy
            }, {
                headers: {'X-Requested-With': 'XMLHttpRequest'}
            })
            .then(function () {
                axios
                    .post("pomoc/platba", {
                        funkce: "ziskat"
                    }, {
                        headers: {'X-Requested-With': 'XMLHttpRequest'}
                    })
                    .then(function (response) {
                        platba.html(response.data["html"])

                        radio(response)
                        platba.append(button)
                        validate()
                    })
            })
    })
}

function reset_dodani() {
    $("#submit_checkout").removeClass('complete')
    axios
        .post("pomoc/doprava", {
            funkce: "reset",
            dodani: true,
            platba: true
        }, {
            headers: {'X-Requested-With': 'XMLHttpRequest'}
        })
        .then(function (respons) {
            $("#platba").html("")
            $("#doprava").html("")
            $("#doprava-kosik").html("").css("display", "none")
            $("#platba-kosik").html("").css("display", "none")
            axios
                .post("pomoc/doprava", {
                    funkce: "ziskat"
                }, {
                    headers: {'X-Requested-With': 'XMLHttpRequest'}
                })
                .then(function (response) {
                    $("#doprava").html(response.data["html"])

                    doprava()
                })
        })
}

function reset_platby() {
    $("#submit_checkout").removeClass('complete')
    axios
        .post("pomoc/doprava", {
            funkce: "reset",
            platba: true
        }, {
            headers: {'X-Requested-With': 'XMLHttpRequest'}
        })
        .then(function (respons) {
            $("#platba").html("")
            $("#platba-kosik").html("").css("display", "none")

            axios
                .post("pomoc/platba", {
                    funkce: "ziskat"
                }, {
                    headers: {'X-Requested-With': 'XMLHttpRequest'}
                })
                .then(function (response) {
                    $("#platba").html(response.data["html"])
                    platba()
                })


        })
}

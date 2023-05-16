document.addEventListener('DOMContentLoaded', function () {
    const passwordField = document.getElementById('loginPassword');
    const showPassword = document.getElementById('show-password');

    showPassword.addEventListener('click', function () {
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            this.innerHTML = '<i class="icon-eye-off"></i>';
        } else {
            passwordField.type = 'password';
            this.innerHTML = '<i class="icon-eye"></i>';
        }
    });
});


const login = () => {
    const email = document.getElementById("loginEmail").value
    const Password = document.getElementById("loginPassword").value
    const keepLogin = document.getElementById("login_keep_logged_in").checked
    axios.post('/login', {
        log_reg: "login",
        keepLogin: keepLogin,
        email: email,
        Password: Password
    }, {
        headers: {'X-Requested-With': 'XMLHttpRequest'}
    }).then(function (response) {
        if (response.data === "good") {
            location.reload();
        } else if (response.data === "notexist") {
            $("#ptih_h1_div").css('display', 'block')
            $("#loginEmail").one('change', function () {
                $("#ptih_h1_div").css('display', 'none')
            })
            $("#loginPassword").one('change', function () {
                $("#ptih_h1_div").css('display', 'none')
            })

        }
    }).catch(function (error) {
        console.log(error);
    });
}

const registration = () => {
    if ($("#formular").hasClass("form_disable")) {
        return;
    }
    const email = document.getElementById("registerEmail").value
    const password = document.getElementById("registerPassword").value
    const jmeno = document.getElementById("jmeno").value
    const prijmeni = document.getElementById("prijmeni").value
    const Ulice = document.getElementById("Ulice").value
    const Mesto = document.getElementById("Mesto").value
    const Telefon = document.getElementById("telefon").value
    const PSC = document.getElementById("PSC").value
    const keepLogin = document.getElementById("reg_keep-logged-in").checked
    const em_div = document.getElementById("registerEmail")


    axios.post('/login', {
        log_reg: 'registration',
        keepLogin: keepLogin,
        email: email,
        Password: password,
        Telefon: Telefon,
        jmeno: jmeno,
        prijmeni: prijmeni,
        Ulice: Ulice,
        Mesto: Mesto,
        PSC: PSC

    }, {
        headers: {'X-Requested-With': 'XMLHttpRequest'}
    })
        .then(function (response) {
            if (response.data === "good_reg") {
                location.replace("/")
            } else if (response.data === "email_nonempty") {
                $("#formular").addClass("form_disable");
                if (em_div.nextSibling !== null) {
                    em_div.parentElement.removeChild(em_div.nextSibling)
                }
                $(em_div.parentElement).append("<div class='invalid_text'>Tato adresa je již používána.\n" +
                    "Pokud chcete, můžete se přihlásit, nebo obnovit zapomenuté heslo.</div>")
            }
        })
        .catch(function (error) {
            $("#formular").addClass("form_disable");
            console.log(error);
        });
}


const email_validate = (e) => {
    if (e.checkValidity() && (e.value !== "")) {

        axios.post('/pomoc/CheckLoginAvailability',
            {
                'email': e.value
            }, {
                headers: {'X-Requested-With': 'XMLHttpRequest'}
            }).then(function (response) {
            if ($(e).nextAll().length >= 2) {
                e.parentElement.removeChild(e.parentElement.lastChild)
            }

            if (response.data) {
                $("#formular").removeClass("form_disable");
            } else {
                $("#formular").addClass("form_disable");

                $(e.parentElement).append("<div class='invalid_text'>Tato adresa je již používána.\n" +
                    "Pokud chcete, můžete se přihlásit, nebo obnovit zapomenuté heslo.</div>")
            }
        })
    }
}
$("#LoginModal").on("hidden.bs.modal", function () {
    document.getElementById("login-form").reset()
    $("#ptih_h1_div").css('display', 'none')

})

$("#registerEmail").on('blur', function () {
    email_validate(this)
})
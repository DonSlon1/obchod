document.addEventListener('DOMContentLoaded', function () {
    const passwordField = document.getElementById('loginPassword');
    const showPassword = document.getElementById('show-password');

    showPassword.addEventListener('click', function () {
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            this.innerHTML = '<i class="fa fa-eye-slash"></i>';
        } else {
            passwordField.type = 'password';
            this.innerHTML = '<i class="fa fa-eye"></i>';
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const passwordRegistrationField = document.getElementById('confirmPassword');
    const registerPassword = document.getElementById('registerPassword');
    const showPasswordRegistration = document.getElementById('show-passwordRegister');

    showPasswordRegistration.addEventListener('click', function () {
        if (passwordRegistrationField.type === 'password') {
            passwordRegistrationField.type = 'text';
            registerPassword.type = 'text';
            this.innerHTML = '<i class="fa fa-eye-slash"></i>';
        } else {
            registerPassword.type = 'password'
            passwordRegistrationField.type = 'password';
            this.innerHTML = '<i class="fa fa-eye"></i>';
        }
    });
});


const login = () => {
    const email = document.getElementById("loginEmail").value
    const Password = document.getElementById("loginPassword").value
    const keepLogin = document.getElementById("login_keep_logged_in").checked
    axios.post('login', {
        log_reg: "login",
        keepLogin: keepLogin,
        email: email,
        Password: Password
    }).then(function (response) {
        console.log(response)
        if (response.data === "good") {
            console.log("good");
            location.reload();
        }
    }).catch(function (error) {
        console.log(error);
    });
}

const registration = () => {
    const email = document.getElementById("registerEmail").value
    const password = document.getElementById("registerPassword").value
    const confirmPassword = document.getElementById("confirmPassword").value
    const jmeno = document.getElementById("jmeno").value
    const prijmeni = document.getElementById("prijmeni").value
    const Ulice = document.getElementById("Ulice").value
    const Mesto = document.getElementById("Mesto").value
    const PSC = document.getElementById("PSC").value
    const keepLogin = document.getElementById("reg_keep-logged-in").checked
    console.log(email)
    console.log(password)
    console.log(confirmPassword)
    axios.post('login', {
        log_reg: 'registration',
        keepLogin: keepLogin,
        email: email,
        Password: password,
        confirmPassword: confirmPassword,
        jmeno: jmeno,
        prijmeni: prijmeni,
        Ulice: Ulice,
        Mesto: Mesto,
        PSC: PSC

    })
        .then(function (response) {
            console.log(response);
            if (response.data === "good_reg") {
                location.reload()
            }
        })
        .catch(function (error) {
            console.log(error);
        });
}
const logout = () => {
    axios.post('login', {
        log_reg: 'logout'
    }).then(function (response) {
        location.reload();

    }).catch(function (error) {
        console.log(error);
    });

}
$("#LoginModal").on("hidden.bs.modal", function () {
    document.getElementById("login-form").reset()
    document.getElementById("reg-form").reset()

})
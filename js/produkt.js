$(window).on("load", function () {
    document.getElementById("positive").addEventListener('input', function () {
        add_new_textarea(this)
    }, {once: true})

    document.getElementById("negative").addEventListener('input', function () {
        add_new_textarea(this)
    }, {once: true})
    document.getElementById("recene").reset()
})


const stardiv = document.getElementById('rating');
const stars = document.querySelectorAll('#rating img');

stardiv.addEventListener('mouseout', function () {
    for (let i = 0; i < 5; i++) {
        stars[i].classList.remove("mousefocus")
        stars[i].classList.remove("mouseover");
        stars[i].classList.add("grayscalestar");
    }
    for (let i = 0; i < document.querySelector('#rating-value').value; i++) {

        stars[i].classList.remove("grayscalestar");
    }
})

stars.forEach(star => {
    star.classList.add("grayscalestar");

    star.addEventListener('mouseover', function () {
        const value = this.getAttribute('data-value');
        highlightStarsclass(value);
    })


    star.addEventListener('click', function () {
        const value = this.getAttribute('data-value');

        document.querySelector('#rating-value').value = value;

        highlightStars(value);
    });
});

function highlightStarsclass(value) {
    stars.forEach(star => {
        star.classList.add("grayscalestar");
    });
    for (let i = 0; i < value; i++) {
        if (i + 1 === parseInt(value)) {
            stars[i].classList.add("mousefocus");
        }
        stars[i].classList.add("mouseover");
    }
}

function highlightStars(value) {
    stars.forEach(star => {
        star.classList.add("grayscalestar");
    });

    for (let i = 0; i < value; i++) {
        stars[i].classList.remove("grayscalestar");

    }
}

highlightStars($("#rating-value")[0].value)

function add_new_textarea(element) {
    const parent = ((element.parentElement).parentElement).parentElement;
    const textarea = document.createElement("textarea")
    const elem = document.createElement("div")
    elem.classList.add('row')


    let div = document.createElement("div");

    div.classList.add('col', 'pr-0', 'fitcont', 'float-right')
    if (element.name === "positive[]") {
        div.innerHTML = "<svg class=\"rev-icon pos-icon \" focusable=\"false\" viewBox=\"0 0 24 24\" aria-hidden=\"true\">\n" +
            "                                                        <path d=\"M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4 11h-3v3c0 .55-.45 1-1 1s-1-.45-1-1v-3H8c-.55 0-1-.45-1-1s.45-1 1-1h3V8c0-.55.45-1 1-1s1 .45 1 1v3h3c.55 0 1 .45 1 1s-.45 1-1 1z\"></path>\n" +
            "                                                    </svg>"
    } else {
        div.innerHTML = "<svg class=\"rev-icon neg-icon \" focusable=\"false\" viewBox=\"0 0 24 24\" aria-hidden=\"true\">\n" +
            "                                                        <path d=\"M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4 11H8c-.55 0-1-.45-1-1s.45-1 1-1h8c.55 0 1 .45 1 1s-.45 1-1 1z\"></path>\n" +
            "                                                    </svg>"
    }

    elem.appendChild(div)

    textarea.addEventListener('input', function () {
        add_new_textarea(this)
    }, {once: true})
    textarea.addEventListener('input', function () {
        auto_grow(this)
    })
    textarea.name = element.name
    textarea.rows = 1
    textarea.classList.add('form-control', 'border-0', 'p-0')

    div = document.createElement("div");
    div.classList.add('col', 'm-auto')
    div.appendChild(textarea)
    console.log(element)
    elem.appendChild(div)
    parent.appendChild(elem)

}

function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight) + "px";
}


const recenze = () => {

    const positivarray = []
    let positivelements = document.getElementsByName("positive[]")
    for (let i = 0; i < positivelements.length; i++) {
        if (positivelements[i].value) {
            positivarray.push(positivelements[i].value)
        }
    }


    const negativarray = []
    let negativelements = document.getElementsByName("negative[]")
    for (let i = 0; i < negativelements.length; i++) {
        if (negativelements[i].value) {
            negativarray.push(negativelements[i].value)
        }
    }


    const rating = document.getElementById("rating-value").value
    const zkusenost = document.getElementById("zkusenost").value


    const ID_P = document.getElementById("ID_P").value
    let file = document.querySelector("#img").files
    console.log(file)
    let data = {
        negative: negativarray,
        positive: positivarray,
        zkusenost: zkusenost,
        ID_P: ID_P,
        rating: rating
    }

    if (file.length > 0) {
        file = file[0]
        data.img_type = file.type
    }
    let formData = new FormData();
    let error_div = $("#error-recen")
    if (file.size <= 10 * 1024 * 1024 || file.length === 0) {
        if (!(file.type in ['image/jpeg', 'image/png'])) {
            axios.post('/review', data, {
                headers: {'X-Requested-With': 'XMLHttpRequest'}
            }).then(function (response) {
                if (response.data.response === "good") {
                    document.getElementById("recene").reset()
                    $("#myModal1").modal('hide')
                    if ('ID_O' in response.data) {
                        const myNewFile = new File([file], response.data.ID_O, {type: file.type});
                        console.log(file.name)
                        formData.append("file", myNewFile);
                        axios({
                                method: "post",
                                url: "/pomoc/move_file",
                                data: formData,
                                headers: {
                                    'Accept': '*/*',
                                    'X-Requested-With': 'XMLHttpRequest'
                                }

                            }
                        ).then(function (response) {
                            if (parseInt(response.data) === 1) {
                                location.reload()
                            } else {

                            }
                        })
                    } else {
                        location.reload()
                    }
                } else if (response.data.response === "rating") {
                    error_div.text("Musíte vybrat počet hvězdiček").css('display', 'block')
                    setTimeout(function () {
                        error_div.css('display', 'none')
                    }, 10000)
                } else if (response.data.response === "type") {
                    error_div.text("Tento typ obrázku není podporován").css('display', 'block')
                    setTimeout(function () {
                        error_div.css('display', 'none')
                    }, 10000000)
                } else {
                    error_div.text("Omlováme se něco se pokazilo zkuste to později znova").css('display', 'block')
                    setTimeout(function () {
                        error_div.css('display', 'none')
                    }, 10000)
                }

            }).catch(function (error) {
                console.log(error);
            });
        } else {
            error_div.text("Tento typ obrázku není podporován").css('display', 'block')
            setTimeout(function () {
                error_div.css('display', 'none')
            }, 10000)
        }
    } else {
        error_div.text("Soubor je moc velký").css('display', 'block')
        setTimeout(function () {
            error_div.css('display', 'none')
        }, 10000)
    }


}

$("#myModal1").on("hidden.bs.modal", function () {
    const zapory = document.getElementById("zapory")
    const klady = document.getElementById("klady")
    while (zapory.childNodes.length > 2) {

        zapory.removeChild(zapory.lastChild)
    }
    while (klady.childNodes.length > 2) {
        klady.removeChild(klady.lastChild)
    }

    const node = document.getElementById("plforimg")

    while (node.children.length >= 1) {
        node.removeChild(node.children[0])
    }
    document.getElementById("recene").reset()
    let old_element = document.getElementById("positive")
    old_element.setAttribute('style', '')
    let new_element = old_element.cloneNode(true);
    old_element.parentNode.replaceChild(new_element, old_element);

    old_element = document.getElementById("negative")
    old_element.setAttribute('style', '')
    new_element = old_element.cloneNode(true);
    old_element.parentNode.replaceChild(new_element, old_element);
    document.getElementById('ddforimg').style.display = "none"

    document.getElementById("zkusenost").setAttribute('style', '')

    document.getElementById("positive").addEventListener('input', function () {
        add_new_textarea(this)
    }, {once: true})
    document.getElementById("negative").addEventListener('input', function () {
        add_new_textarea(this)
    }, {once: true})


});


$("#img").on('change', function (e) {
    img(e.target.files[0]);
})

function delete_img(url) {
    document.querySelector("#img").value = ""
    document.getElementById('ddforimg').style.display = "none"
    const node = document.getElementById("plforimg")

    while (node.children.length >= 1) {
        node.removeChild(node.children[0])
    }
    URL.revokeObjectURL(url)
}

function img(file) {

    document.getElementById('ddforimg').style.display = "block"
    const node = document.getElementById("plforimg")

    while (node.children.length >= 1) {
        node.removeChild(node.children[0])
    }
    const div = document.getElementById("plforimg")
    let element = document.createElement('img')
    let url = URL.createObjectURL(file)
    element.src = url
    element.alt = file.name
    element.classList.add("small-img")
    element.classList.add("align-self-center")

    div.appendChild(element)
    const help_div = document.createElement('div')
    help_div.classList.add("col")
    element = document.createElement('small')
    element.innerText = file.name
    element.classList.add("align-self-center")
    help_div.appendChild(element)
    element = document.createElement('small')
    element.innerText = formatBytes(file.size)
    element.classList.add("text-muted")
    element.classList.add("align-self-center")
    element.classList.add("ml-2")
    help_div.appendChild(element)
    const button = document.createElement('button')
    div.appendChild(help_div)

    button.addEventListener('click', function () {
        delete_img(url)
    })
    button.type = "button"
    button.classList.add("btn")
    button.classList.add("p-0")
    button.style.height = "fit-content"
    button.style.marginTop = "-0.30rem"
    button.style.marginRight = "-0.15rem"

    element = document.createElement('span')
    element.innerHTML = "&times;"
    button.appendChild(element)
    div.appendChild(button)

}


$('#big-product-gallery').on('slide.bs.carousel', function (e) {
    const slideFrom = $(this).find('.active').index();
    const slideTo = $(e.relatedTarget).index();
    const sideBar = document.getElementById("sideBar").children
    sideBar[slideFrom].children[0].classList.remove("blue-border")
    sideBar[slideTo].children[0].classList.add("blue-border")

}).carousel('pause');
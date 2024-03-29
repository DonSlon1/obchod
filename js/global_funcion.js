function check(e) {
    const element = $(e);
    if ((!e.checkValidity() || element.val() === "") && !element.hasClass('heslo')) {
        if (element.nextAll().length >= 2) {
            e.parentElement.removeChild(e.parentElement.lastChild)
        }

        if (element.val() === "") {
            $(e.parentElement).append("<div class='invalid_text'>tento údaj je povinný</div>")
        } else if (element.hasClass('email')) {
            if (element.val().length > 50) {
                $(e.parentElement).append("<div class='invalid_text'>maximální délka je 50 znaků</div>")
            } else {
                $(e.parentElement).append("<div class='invalid_text'>nesprávný formát e-mailu</div>")
            }


        } else if (element.hasClass('cena')) {
            $(e.parentElement).append("<div class='invalid_text'>Cena musí být mezi 1-10 000 000 000 Kč</div>")

        } else if (element.hasClass('phone')) {
            $(e.parentElement).append("<div class='invalid_text'>nesprávný formát telefonního čísla (+420602xxxxxx; 602 xxx xxx)</div>")

        } else if (element.hasClass('jmeno')) {
            if (element.val().length > 25) {
                $(e.parentElement).append("<div class='invalid_text'>maximální délka je 25 znaků</div>")
            }
        } else if (element.hasClass('prijmeni')) {
            if (element.val().length > 25) {
                $(e.parentElement).append("<div class='invalid_text'>maximální délka je 25 znaků</div>")
            }
        } else if (element.hasClass('ulice')) {
            if (element.val().length > 33) {
                $(e.parentElement).append("<div class='invalid_text'>maximální délka je 33 znaků</div>")
            } else if (!e.checkValidity()) {
                $(e.parentElement).append("<div class='invalid_text'>zadejte ulici včetně čísla ve tvaru Ulice 1234/5b nebo Ulice 1</div>")
            }
        } else if (element.hasClass('obec')) {
            if (element.val().length > 40) {
                $(e.parentElement).append("<div class='invalid_text'>maximální délka je 40 znaků</div>")
            }
        } else if (element.hasClass('psc')) {

            $(e.parentElement).append("<div class='invalid_text'>nesprávný tvar PSČ</div>")

        }
        element.next().addClass('invalid_text')
        element.addClass('invalid')


    } else if (element.hasClass('heslo')) {

        const hodnota = element.val()

        function heslo_good(objek) {
            objek.removeClass('nespravne')
            objek.addClass('good_heslo')
        }

        function heslo_spatne(objek) {
            objek.addClass('nespravne')
            objek.removeClass('good_heslo')
        }

        if (!RegExp("(?=.*[0-9])(?=.*[!?@#$%^&*])(^.{8,100}$)").test(hodnota)) {
            if (!RegExp("(?=.*[0-9])").test(hodnota)) {
                heslo_spatne($("#cislo"))
            } else {
                heslo_good($("#cislo"))
            }
            if (!RegExp("(?=.*[!@#$%^&*])").test(hodnota)) {
                heslo_spatne($("#znak"))
            } else {
                heslo_good($("#znak"))

            }
            if (!RegExp("(^.{8,100}$)").test(hodnota)) {
                heslo_spatne($("#delka"))
            } else {
                heslo_good($("#delka"))
            }

            $(".heslo_reqierd").addClass('vidim')

            element.addClass('invalid')
            element.next().addClass('invalid_text')
        } else if (element.hasClass('invalid')) {
            element.next().removeClass('invalid_text')
            element.removeClass('invalid')
            $(".heslo_reqierd").removeClass('vidim')
        }

    } else if (element.hasClass('invalid')) {
        element.removeClass('invalid')
        element.next().removeClass('invalid_text')

        if (element.nextAll().length >= 2) {
            e.parentElement.removeChild(e.parentElement.lastChild)
        }
    }
}


$(document).ready(function () {
    // Get the phone number input field
    let phoneInput = $('.phone');

    // Listen for changes to the input field
    phoneInput.on('input', function () {
        this.value = this.value.replace(/\D/g, '');
    });

    $(".reqierd_input").on('blur', function (event) {
        if (!$(event.target).hasClass('search-options')) {
            check(this)
        }
    }).each(function () {
        if ($(this.form).hasClass("user_logged")) {
            check(this)
        }
    })


    // get all input elements on the page


});
$(".validate").click(function (e) {
    const inputs = ($(e.target)[0].form).querySelectorAll('.reqierd_input')
    inputs.forEach(input => {
        if (input.type !== "file") {
            check(input)
        }
    })

})
document.addEventListener('invalid', (function () {
    return function (e) {
        //prevent the browser from showing default error bubble / hint
        e.preventDefault();
    };
})(), true);

const prevent = document.querySelectorAll(".preventDefault")
prevent.forEach(element => {
    element.addEventListener('submit', function (event) {
        event.preventDefault();

    });
})

function formatBytes(bytes, decimals = 2) {
    if (!+bytes) return '0 Bytes'

    const k = 1024
    const dm = decimals < 0 ? 0 : decimals
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']

    const i = Math.floor(Math.log(bytes) / Math.log(k))

    return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
}

function Get_Basket() {
    let Pocet = 0;
    axios.post('/pomoc/Add_To_cart', {
        function: "get",
    }, {
        headers: {'X-Requested-With': 'XMLHttpRequest'}
    }).then(function (response) {

        Pocet = response.data

        if (Pocet > 0) {
            $(document).ready(function () {
                const basket = document.getElementById("count")
                basket.style.display = "block";
                basket.innerText = Pocet.toString()
            })
        }
    })
}

Get_Basket()

window.onload = function () {


    $.fn.opendiv = function () {
        return this.each(function () {
            $(this).one("mousedown", function () {
                show("#" + this.id)
            })
        })
    }

    $('.open_div').opendiv();
}


function show(id) {

    const container = $(id + "_div");
    container.css('display', 'flex')
    container.addClass('1')

    function onMouseDown(e) {
        const container = $(id + "_div");
        if (container.hasClass('1')) {
            container.removeClass('1')
        } else {
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                $(document).off("mousedown", onMouseDown); // Remove the event listener
                $(id).one("mousedown", function () {
                    show(id)
                })
                container.css('display', 'none')
                return 0;
            }
        }
    }

    // Add the event listener to the document
    $(document).on("mousedown", onMouseDown);

}


(function ($) {

    $.fn.numberstyle = function (options) {

        /*
         * Default settings
         */
        let settings = $.extend({
            value: 0,
            step: undefined,
            min: undefined,
            max: undefined
        }, options);


        return this.each(function (i) {

            let input = $(this);

            let container = document.createElement('div'),
                btnAdd = document.createElement('a'),
                btnRem = document.createElement('a'),
                min = (settings.min) ? settings.min : input.attr('min'),
                max = (settings.max) ? settings.max : input.attr('max'),
                value = (settings.value) ? settings.value : parseFloat(input.val());
            container.className = 'numberstyle-qty';
            btnAdd.className = (max && value >= max) ? 'qty-btn qty-add disabled' : 'qty-btn qty-add';
            btnAdd.innerText = '⯅';
            btnRem.className = (min && value <= min) ? 'qty-btn qty-rem disabled' : 'qty-btn qty-rem';
            btnRem.innerText = '⯆';
            input.wrap(container);
            input.closest('.numberstyle-qty').append(btnRem).append(btnAdd);

            /*
             * Attach events
             */
            // use .off() to prevent triggering twice
            $(document).off('click', '.qty-btn').on('click', '.qty-btn', function (e) {

                let input = $(this).siblings('input'),
                    sibBtn = $(this).siblings('.qty-btn'),
                    step = (settings.step) ? parseFloat(settings.step) : parseFloat(input.attr('step')),
                    min = (settings.min) ? settings.min : (input.attr('min')) ? input.attr('min') : undefined,
                    max = (settings.max) ? settings.max : (input.attr('max')) ? input.attr('max') : undefined,
                    oldValue = parseFloat(input.val()),
                    newVal;

                //Add value
                if ($(this).hasClass('qty-add')) {

                    newVal = (oldValue >= max) ? oldValue : oldValue + step,
                        newVal = (newVal > max) ? max : newVal;

                    if (newVal == max) {
                        $(this).addClass('disabled');
                    }
                    sibBtn.removeClass('disabled');

                    //Remove value
                } else {

                    newVal = (oldValue <= min) ? oldValue : oldValue - step,
                        newVal = (newVal < min) ? min : newVal;

                    if (newVal == min) {
                        $(this).addClass('disabled');
                    }
                    sibBtn.removeClass('disabled');

                }

                //Update value
                input.val(newVal).trigger('change');

            });

            input.on('change', function () {

                const val = parseFloat(input.val()),
                    min = (settings.min) ? settings.min : (input.attr('min')) ? input.attr('min') : undefined,
                    max = (settings.max) ? settings.max : (input.attr('max')) ? input.attr('max') : undefined;

                if (val > max) {
                    input.val(max);
                }

                if (val < min) {
                    input.val(min);
                }
            });

        });
    };


    $('.numberstyle').numberstyle();


}(jQuery));


$("#search").on('input', function () {
    hleadat()
}).on('click', function () {
    if ($("#search-resoult").text() !== '') {
        enable()
    }

}).on('keydown', function (e) {
    if (e.key === 'Escape') {
        $("#h_nav").removeClass('active')
        $("#search-nav").removeClass('active')
        $("#search-resoult").removeClass('active')
    }
})
$("#search-form").on('reset', function () {
    $("#search-resoult").empty()
})

function enable() {
    $("#h_nav").addClass('active')
    $("#search-resoult").addClass('active')
    $("#search-nav").addClass('active')
}

function hleadat() {
    let search = $("#search").val()
    let search_resoult = $("#search-resoult")
    let predmet = $("#predmet")
    let kategorie = $("#kategorie-hledani")
    let vyrobce = $("#vyrobce-hledani")
    let search_nav = $("#search-nav")
    predmet.empty()
    let emptyp = false
    let h_nav = $("#h_nav")
    if (search !== "") {
        axios.post('/pomoc/hledat', {
            search: search
        }, {
            headers: {'X-Requested-With': 'XMLHttpRequest'}
        }).then(function (response) {
            predmet.append(response.data.predmet)
            let data = response.data.predmet
            if (data.length > 0) {

                enable()
                predmet.empty()
                let h = $('<span>', {
                    text: "Produkty",
                    class: "Nazev"
                })
                predmet.append(h)
                data.forEach(item => {
                    let obrazek = $('<img/>', {
                            src: "/images/" + item.H_Obrazek,
                            alt: "",
                            class: "search-image"
                        }),
                        text = $('<span/>', {
                            text: item.Nazev
                        }),
                        container = $('<a/>', {
                            href: "/produkt?ID_P=" + item.ID_P
                        })


                    container.append(obrazek).append(text)
                    h_nav.addClass('active')
                    predmet.addClass('active')
                    predmet.append(container).addClass('active')

                })

            } else {
                emptyp = true;
            }


            if (emptyp) {
                h_nav.removeClass('active')
                search_nav.removeClass('active')
            }

        })
    } else {
        search_resoult.removeClass('active')
        h_nav.removeClass('active')
        search_nav.removeClass('active')


    }
}

$(document).on('click', function (event) {
    if (!$(event.target).closest('#search , #search-resoult').length) {
        $("#h_nav").removeClass('active')
        $("#search-nav").removeClass('active')
        $("#search-resoult").removeClass('active')
    }
});

function set_parametr(name, value) {

    let currentUrl = window.location.href;

    if (currentUrl.indexOf(name + "=") !== -1) {
        let pattern = new RegExp('\\b(' + name + '=).*?(&|#|$)');

        let newUrl = currentUrl.replace(pattern, '$1' + value + '$2');

        // let newUrl = currentUrl.replace(pattern, name + '=' + value);
        window.history.pushState({}, '', newUrl);
    } else {
        let newUrl = currentUrl
        if (window.location.search === "") {
            newUrl = currentUrl + '?' + name + '=' + value;
        } else {
            newUrl = currentUrl + '&' + name + '=' + value;
        }
        window.history.pushState({}, '', newUrl);
    }
}

function remove_parametr(name) {
    let currentUrl = window.location.href;
    if (currentUrl.indexOf(name + "=") !== -1) {
        let pattern = new RegExp('\\b&?' + name + '=([^&#]*)\\b');
        let newUrl = currentUrl.replace(pattern, '');
        window.history.pushState({}, '', newUrl);
    }
}

function update_predmet(response, data) {
    $("html, body").animate({scrollTop: 0}, "slow");
    let obsah = $("#main-obsah")
    let error_span = $('<span>', {
        text: 'Nic takového jsme nenašli',
        class: 'Info_msg'
    })
    if (response.length === 0) {
        obsah.empty().append(error_span)
        return;
    }
    obsah.empty()
    for (let predmet of response) {
        let zobrazeni_predmetu = $('<div>', {class: 'predmet'}),
            odkaz_obrezek_predmet = $('<a>', {href: '/produkt.php?ID_P=' + predmet.ID_P.toString()}),
            obrezek_predmet = $('<img>', {src: '/images/' + predmet.H_Obrazek.toString(), alt: predmet.Nazev})

        odkaz_obrezek_predmet.append($('<div>', {class: 'obrazek'}).append(obrezek_predmet))
        zobrazeni_predmetu.append(odkaz_obrezek_predmet)

        odkaz_obrezek_predmet = $('<a>', {href: '/produkt.php?ID_P=' + predmet.ID_P.toString()})

        let div = $('<div>', {class: 'star-rating-wrapper hvezdy'})
        div.append($('<div>', {class: 'empty-stars-element'}))
        div.append($('<div>', {
            class: 'stars-element',
            style: 'width:' + (parseInt(predmet.Hodnocenii) * 20).toString() + '%'
        }))
        zobrazeni_predmetu.append(div)

        div = $('<div>', {class: 'informace'})

        let nazev = $('<span>', {class: 'nazev', html: predmet.Nazev})
        odkaz_obrezek_predmet.append(nazev)
        div.append(odkaz_obrezek_predmet)
        div.append($('<span>', {class: 'cena-produkt', text: predmet.Cena}))
        zobrazeni_predmetu.append(div)
        div = $('<div>', {class: 'popis', html: predmet.Popis})
        zobrazeni_predmetu.append(div)
        obsah.append(zobrazeni_predmetu)
    }
    strankovani(data)
}

function strankovani(data) {
    let total_pages = data.Celkem_Stranke,
        num_results_on_page = data.Vysledku_Na_Strance,
        page = data.Aktualni_Stranka

    if (Math.ceil(total_pages / num_results_on_page) > 0) {
        let pagination = $('<ul class="muj-pagination" id="muj-pagination"></ul>');

        if (page > 1) {
            pagination.append('<li class="prev page" data-page="' + (page - 1) + '"><span></span></li>');
        }

        if (page > 3) {
            pagination.append('<li class="start page" data-page="1"><span>1</span></li>');
            pagination.append('<li class="dots">...</li>');
        }

        if (page - 2 > 0) {
            pagination.append('<li class="page" data-page="' + (page - 2) + '"><span>' + (page - 2) + '</span></li>');
        }

        if (page - 1 > 0) {
            pagination.append('<li class="page" data-page="' + (page - 1) + '"><span>' + (page - 1) + '</span></li>');
        }

        pagination.append('<li class="currentpage page" id="currentpage" data-page="' + page + '"><span>' + page + '</span></li>');

        if (page + 1 < Math.ceil(total_pages / num_results_on_page) + 1) {
            pagination.append('<li class="page" data-page="' + (page + 1) + '"><span>' + (page + 1) + '</span></li>');
        }

        if (page + 2 < Math.ceil(total_pages / num_results_on_page) + 1) {
            pagination.append('<li class="page" data-page="' + (page + 2) + '"><span>' + (page + 2) + '</span></li>');
        }

        if (page < Math.ceil(total_pages / num_results_on_page) - 2) {
            pagination.append('<li class="dots">...</li>');
            pagination.append('<li class="end page" data-page="' + Math.ceil(total_pages / num_results_on_page) + '"><span>' + Math.ceil(total_pages / num_results_on_page) + '</span></li>');
        }

        if (page < Math.ceil(total_pages / num_results_on_page)) {
            pagination.append('<li class="next page" data-page="' + (page + 1) + '"><span></span></li>');
        }

        $('#muj-pagination').empty().append(pagination);
        pohyb_mezi_strankami()
    }
}

function pohyb_mezi_strankami() {
    $(".page").on('click', function () {
        let target = $(this)
        let hodnota = parseInt(target.attr('data-page'))
        let current = parseInt($('#currentpage').attr('data-page'))

        if (current === undefined || isNaN(current)) {
            current = 1
        }
        if (hodnota === undefined || hodnota < 1 || isNaN(hodnota)) {
            hodnota = 1
        }
        if (target.hasClass('next')) {
            set_parametr('Stranka', current + 1)
        } else if (target.hasClass('prev')) {
            set_parametr('Stranka', current - 1)

        } else {
            set_parametr('Stranka', hodnota)
        }
        axios.get('/pomoc/produkt_hledat' + window.location.search)
            .then(function (response) {
                update_predmet(response.data[0], response.data[1])
                strankovani(response.data[1])
            })

    })
}

pohyb_mezi_strankami()

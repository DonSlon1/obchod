var html5Slider = document.getElementById('slider');

let max_num = $('#max');
let min_num = $('#min');
let min_db = $('#min-db')
let max_db = $('#max-db')

noUiSlider.create(html5Slider, {
    start: [Number(min_num.val()), Number(max_num.val())],
    connect: true,
    range: {
        'min': Number(min_db.val()),
        'max': Number(max_db.val())
    },
    tooltips: {
        from: function (value) {
            return Number(value);
        },
        to: function (value) {
            return Math.round(value).toString() + "Kč";
        }
    }


});


html5Slider.noUiSlider.on('update', function (values, handle) {

    let value = Math.round(values[handle]);

    if (handle) {
        max_num.val(value)
    } else {
        min_num.val(value);
    }
});


min_num.on('keyup', function () {
    html5Slider.noUiSlider.set([this.value, null]);
});

max_num.on('keyup', function () {
    html5Slider.noUiSlider.set([null, this.value]);
});

const tooltips = slider.querySelectorAll('.noUi-tooltip');

slider.noUiSlider.on('start', function (values, handle) {
    tooltips[handle].style.display = 'block';
});

slider.noUiSlider.on('end', function (values, handle) {
    tooltips[handle].style.display = 'none';
});

slider.noUiSlider.on('set', function (values, handle) {
    let value = Math.round(values[handle]);

    if (handle) {
        max_num.trigger('change');
    } else {
        min_num.trigger('change');
    }
});


$(".noUi-tooltip").css('display', 'none')

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

const star_inputs = $('.stars > input[type="checkbox"]')
star_inputs.on('change', function (e) {
    let target = $(e.target)
    if (target.prop('checked')) {
        set_parametr('Hodnoceni', target.val())
        star_inputs.each(function () {

            if ($(this)[0] !== target[0]) {
                $(this).prop('checked', false)
            }

        })
    } else {
        remove_parametr('Hodnoceni')
    }
    window.location.reload()

})

min_num.on('change', function (e) {
    set_parametr('Min', $(e.target).val())
    window.location.reload()
})

max_num.on('change', function (e) {
    set_parametr('Max', $(e.target).val())
    window.location.reload()
})

function setsearch(vyrobce, hodnoceni) {
    if (hodnoceni) {
        let nazev = '#star-' + hodnoceni
        $(nazev).prop('checked', true)
    }
    if (vyrobce) {
        let values = vyrobce.split(',')
        values.forEach(function (value) {
            console.log(value)
            $("#vyrobce-" + value).prop('checked', true)
        })
    }
}


$('.vyrobce-nazev').on('change', function (e) {
    let target = $(e.target)
    let currentUrl = window.location.href
    if (target.prop('checked')) {
        if (currentUrl.indexOf("Vyrobce=") === -1) {
            set_parametr('Vyrobce', target.val())
        } else {
            let pattern = RegExp('Vyrobce=([^&#]*)');
            let atributs = pattern.exec(currentUrl)
            console.log(atributs)
            if (atributs.length === 2) {
                atributs[1] = atributs[1] + ',' + target.val()
                set_parametr('Vyrobce', atributs[1])
            } else {
                remove_parametr('Vyrobce')
            }
        }
    } else {
        if (currentUrl.indexOf("Vyrobce=") !== -1) {
            let pattern = RegExp('Vyrobce=([^&#]*)');
            let atributs = pattern.exec(currentUrl)
            remove_parametr('Vyrobce')
            if (atributs.length === 2) {
                let values = atributs[1]
                pattern = RegExp('\\b,?(' + target.val() + ')\\b')
                values = values.replace(pattern, '')
                if (values[0] === ",") {
                    values = values.substring(1)
                }

                if (values === '') {
                    remove_parametr('Vyrobce')
                } else {
                    set_parametr('Vyrobce', values)
                }
            }
        }
    }
    window.location.reload()

})

let vyrobce = $("#vyrobce")
let vyrobce_child = vyrobce.find('label')

for (let i = 0; i < vyrobce_child.length; i++) {
    if (i >= 5) {
        $(vyrobce_child[i]).hide()
    }
}

if (vyrobce_child.length > 5) {
    let role_div = $('<span>', {
        text: 'zobrazit všechny',
        class: 'zobrazit',
        'data-show': true

    })
    role_div.on('click', function (e) {
        let target = $(this)
        if (target.attr('data-show') === 'true') {
            target.text('zobrazit méně').attr('data-show', false)
            for (let i = 0; i < vyrobce_child.length; i++) {
                $(vyrobce_child[i]).show()
            }
        } else {
            target.text('zobrazit všechny').attr('data-show', true)
            for (let i = 0; i < vyrobce_child.length; i++) {
                if (i >= 5) {
                    $(vyrobce_child[i]).hide()
                }
            }
        }
    })
    vyrobce.append(role_div)
}



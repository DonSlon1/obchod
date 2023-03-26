function check(e) {
    const element = $(e);
    if ((!e.checkValidity() || element.val() === "") && !element.hasClass('heslo')) {
        e.parentElement.removeChild(e.nextSibling)

        if (element.val() === "") {
            $(e.parentElement).append("<div>tento údaj je povinný</div>")
        } else if (element.hasClass('email')) {
            if (element.val().length > 50) {
                $(e.parentElement).append("<div>maximální délka je 50 znaků</div>")
            } else {
                $(e.parentElement).append("<div>nesprávný formát e-mailu</div>")
            }


        } else if (element.hasClass('phone')) {

            $(e.parentElement).append("<div>nesprávný formát telefonního čísla (+420602xxxxxx; 602 xxx xxx)</div>")

        } else if (element.hasClass('jmeno')) {
            if (element.val().length > 25) {
                $(e.parentElement).append("<div>maximální délka je 25 znaků</div>")
            }
        } else if (element.hasClass('prijmeni')) {
            if (element.val().length > 25) {
                $(e.parentElement).append("<div>maximální délka je 25 znaků</div>")
            }
        } else if (element.hasClass('ulice')) {
            if (element.val().length > 33) {
                $(e.parentElement).append("<div>maximální délka je 33 znaků</div>")
            }
        } else if (element.hasClass('obec')) {
            if (element.val().length > 40) {
                $(e.parentElement).append("<div>maximální délka je 40 znaků</div>")
            }
        } else if (element.hasClass('psc')) {

            $(e.parentElement).append("<div>nesprávný tvar PSČ</div>")

        }

        element.addClass('invalid')


    } else if (element.hasClass('heslo')) {

        const hodnota = element.val()

        if (!RegExp("(?=.*[0-9])").test(hodnota)) {
            $("#cislo").addClass('nespravne')
        } else {
            $("#cislo").removeClass('nespravne')
        }
        if (!RegExp("(?=.*[!@#$%^&*])").test(hodnota)) {
            $("#znak").addClass('nespravne')
        } else {
            $("#znak").removeClass('nespravne')
        }
        if (!RegExp("^.{8,289}$").test(hodnota)) {
            $("#delka").addClass('nespravne')
        } else {
            $("#delka").removeClass('nespravne')
        }

    } else if (element.hasClass('invalid')) {
        element.removeClass('invalid')
        e.parentElement.removeChild(e.nextSibling)
    }
}


$(document).ready(function () {
    // Get the phone number input field
    let phoneInput = $('.phone');

    // Listen for changes to the input field
    phoneInput.on('input', function () {
        this.value = this.value.replace(/\D/g, '');
    });

    $(".reqierd_input").on('blur', function () {
        check(this)
    }).each(function () {
        if ($(this.form).hasClass("user_logged")) {
            check(this)
        }
    })
    // get all input elements on the page
    let inputs = $('input');

    // loop through each input element
    inputs.each(function () {
        let input = $(this);

        // set the custom validity message
        input.get(0).setCustomValidity('Invalid input');

        // disable the validation message on form submit
        input.on('invalid', function (event) {
            event.preventDefault();
        });
    });

});


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
    axios.post('pomoc/Add_To_cart', {
        function: "get",
    }).then(function (response) {

        Pocet = response.data

        if (Pocet > 0) {
            const basket = document.getElementById("count")
            basket.style.display = "block";
            basket.innerText = Pocet.toString()
        }
    })
}

window.onload = function () {
    Get_Basket()
    /*$("#user_open").one("mousedown", function () {
        show("#user")
    })*/

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
    console.log(1);

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

        /*
         * Init every element
         */
        return this.each(function (i) {

            /*
             * Base options
             */
            let input = $(this);

            /*
       * Add new DOM
       */
            let container = document.createElement('div'),
                btnAdd = document.createElement('a'),
                btnRem = document.createElement('a'),
                min = (settings.min) ? settings.min : input.attr('min'),
                max = (settings.max) ? settings.max : input.attr('max'),
                value = (settings.value) ? settings.value : parseFloat(input.val());
            container.className = 'numberstyle-qty';
            btnAdd.className = (max && value >= max) ? 'qty-btn qty-add disabled' : 'qty-btn qty-add';
            btnAdd.innerHTML = '⯅';
            btnRem.className = (min && value <= min) ? 'qty-btn qty-rem disabled' : 'qty-btn qty-rem';
            btnRem.innerHTML = '⯆';
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



$(document).ready(function () {
    let table = $('#tabuka-poduktu').DataTable({

        pagingType: 'numbers',
        dom: '<"top"lfi>rt<"bottom"p><"clear">',
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All'],
        ],
        "order": [[0, "asc"]]
    });


    $('#tabuka-poduktu tbody').on('click', '.showw', function () {
        let id = $(this).parent().parent().parent().attr('id')
        let row = table.row($(this).closest('tr'));

        if (row.child.isShown()) {
            row.child.hide();
            $(this).removeClass('shown');
            $(this).text("▲");

        } else {
            $(this).text("▼");
            axios.post('/pomoc/predmet_v_objed', {
                id: id
            }, {
                headers: {'X-Requested-With': 'XMLHttpRequest'}
            }).then(function (response) {
                if (response.data !== "" || response.data !== undefined) {
                    row.child(response.data).show();
                    $(this).addClass('shown');
                } else {
                    $('html, body').animate({scrollTop: 0}, 'fast');
                    let error = $("#error")
                    error.css('display', 'block')

                    setTimeout(function () {
                        error.css('display', 'none')
                    }, 15000)
                }

            })
        }
    });

    $(".zdodani").on('change', function (e) {
        let moznost = $(this).find(":selected").val()
        let id_ob = $(this).parent().find(".id_ob").val()

        axios.post('/pomoc/stav_obj', {
            moznost: moznost,
            id_ob: id_ob
        }, {
            headers: {'X-Requested-With': 'XMLHttpRequest'}
        }).then(function (response) {
            if (response.data !== 0) {
                $('html, body').animate({scrollTop: 0}, 'fast');
                let error = $("#error")
                error.css('display', 'block')

                setTimeout(function () {
                    error.css('display', 'none')
                }, 15000)
            }
        })
    })
});
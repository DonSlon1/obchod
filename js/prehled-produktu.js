if ($.fn.DataTable.isDataTable('#tabuka-poduktu')) {
    $('#tabuka-poduktu').DataTable().clear().destroy();
}

function inicializace_produkt() {
    $('#tabuka-poduktu').DataTable({
        "columnDefs": [{
            "targets": [2],
            "orderable": false
        }],
        pagingType: 'numbers',
        dom: '<"top"lfi>rt<"bottom"p><"clear">',
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All'],
        ],
        "order": [[0, "asc"]]
    });
}


function inicializace_recenze(group = 1) {
    let visible = (group) ? 0 : 1
    $('#tabuka-poduktu').DataTable({
        "columnDefs": [{
            visible: visible,
            targets: [0]
        }],

        pagingType: 'numbers',
        dom: '<"top"lfi>rt<"bottom"p><"clear">',
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All'],
        ],
        "order": [[0, "asc"]],

        "drawCallback": function (settings) {
            if (!group) {
                return;
            }
            var api = this.api();
            var rows = api.rows({page: 'current'}).nodes();
            var last = null;
            console.log(rows)
            api
                .column([0], {page: 'current'})
                .data()
                .each(function (group, i) {
                    if (last !== group) {
                        $(rows)
                            .eq(i)
                            .before('<tr class="group"><td colspan="5">' + group + '</td></tr>');

                        last = group;
                    }
                });
        }
    });


}

function smazat_prmise() {
    return new Promise(function (resolve) {
        $('#smazat-produkt').modal('show').on('hidden.bs.modal', function () {
            resolve("nechat");
        });

        $('#Ponechat').on('click', function (e) {
            e.preventDefault();

            $('#smazat-produkt').modal('hide');

            resolve("nechat");
        });

        $('#Odstranit').on('click', function (e) {
            e.preventDefault();


            $('#smazat-produkt').modal('hide');

            resolve("smazat");
        });


    });
}

function smazat_recenzi(ID_R) {

    smazat_prmise().then(function (result) {
        if (result === "smazat") {
            axios.post('/pomoc/smaz_recenzi', {
                ID_R: ID_R
            }, {
                headers: {'X-Requested-With': 'XMLHttpRequest'}
            }).then(function (response) {
                if (response.data === 0) {
                    location.reload();
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
    })
}

function smazat(ID_P) {

    smazat_prmise().then(function (result) {
        if (result === "smazat") {
            axios.post('/pomoc/smazat_produkt', {
                ID_P: ID_P
            }, {
                headers: {'X-Requested-With': 'XMLHttpRequest'}
            }).then(function (response) {
                if (response.data === 0) {
                    location.reload();
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
    })
}
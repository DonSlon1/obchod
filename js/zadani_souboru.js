$(".preview").on('change', function (e) {

    if (this.files && this.files.length > 0) {
        let reader;
        let img;
        let container = this;
        do {
            if (container.classList.contains('imagePreview')) {
                break;
            } else {
                container = container.nextElementSibling;

            }
        } while (container)
        if (!container) {
            return;
        }
        for (let i = 0; i < this.files.length; i++) {
            reader = new FileReader();

            reader.onload = function (e) {
                img = document.createElement("img");
                img.setAttribute("src", e.target.result);
                container.append(img);
            }

            reader.readAsDataURL(this.files[i]);
        }
    }

})

const dt = new DataTransfer();
$("#attachment").on('change', function (e) {
    // Přidání nového souboru do seznamu souborů
    for (let i = 0; i < this.files.length; i++) {

        let fileBloc = $('<span/>', {
                class: 'file-block'
            }),
            fileName = $('<span/>', {
                class: 'name',
                text: this.files.item(i).name
            }),
            fileSize = $('<span/>', {
                class: 'size',
                text: formatBytes(this.files.item(i).size)
            }),
            filePreview = $('<img/>', {
                class: 'preview'
            });
        fileBloc.append(filePreview)
            .append(fileName)
            .append(fileSize)
            .append('<span class="file-delete">×</span>');
        $("#filesList").append(fileBloc);

        // Zobrazení náhledu obrázku
        if (this.files[i].type.match('image.*')) {
            let reader = new FileReader();
            reader.onload = function (e) {
                filePreview.attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[i]);
        }
    }


    // Přidání souboru do objektu datového přenosu pro nahrávání souborů
    for (let file of this.files) {
        dt.items.add(file);
    }
    this.files = dt.files;

    // Nastavení události click na ikonu pro smazání souboru
    $('span.file-delete').click(function (e) {
        // Získání názvu souboru
        let name = $(this).parent().children().first().next('span.name').text();

        // Odstranění bloku souboru ze seznamu souborů
        $(this).parent().remove();

        // Odstranění souboru z objektu datového přenosu pro nahrávání souborů
        for (let i = 0; i < dt.items.length; i++) {
            if (name === dt.items[i].getAsFile().name) {
                dt.items.remove(i);

            }
        }

        // Aktualizace seznamu souborů v inputu file po smazání souboru
        document.getElementById('attachment').files = dt.files;
        file_size_check($($(e.target)[0].form).find('input[type="file"]'), e)

    });

    file_size_check($($(e.target)[0].form).find('input[type="file"]'), e)

});


const h_obr = new DataTransfer();
$("#h_obr").on('change', function (e) {

    if (this.files.length !== 0) {
        $('label[for="h_obr"]').text('Změnit Obrázek')
        // Přidání nového souboru do seznamu souborů

        let fileBloc = $('<span/>', {
                class: 'file-block'
            }),
            fileName = $('<span/>', {
                class: 'name',
                text: this.files.item(0).name
            }),
            fileSize = $('<span/>', {
                class: 'size',
                text: formatBytes(this.files.item(0).size)
            }),
            filePreview = $('<img/>', {
                class: 'preview'
            });
        fileBloc.append(filePreview)
            .append(fileName)
            .append(fileSize)
            .append('<span class="file-delete">×</span>');

        $("#h_obr_filesList").empty().append(fileBloc);

        // Zobrazení náhledu obrázku
        let reader = new FileReader();
        reader.onload = function (e) {
            filePreview.attr('src', e.target.result);
        };
        reader.readAsDataURL(this.files[0]);

        // Přidání souboru do objektu datového přenosu pro nahrávání souborů
        h_obr.items.clear();
        h_obr.items.add(this.files[0]);

    }

    this.files = h_obr.files;

    // Nastavení události click na ikonu pro smazání souboru
    $('span.file-delete').click(function (e) {

        // Odstranění bloku souboru ze seznamu souborů
        $(this).parent().remove();

        // Odstranění souboru z objektu datového přenosu pro nahrávání souborů
        h_obr.items.clear()

        // Aktualizace seznamu souborů v inputu file po smazání souboru
        document.getElementById('h_obr').files = h_obr.files;
        file_size_check($($(e.target)[0].form).find('input[type="file"]'), e)
        $('label[for="h_obr"]').text('Přidat Obrázek')

    });

    file_size_check($($(e.target)[0].form).find('input[type="file"]'), e)

});


const vyr_obr = new DataTransfer();
$("#vyr_obr").on('change', function (e) {

    if (this.files.length !== 0) {
        $('label[for="vyr_obr"]').text('Změnit Obrázek')
        // Přidání nového souboru do seznamu souborů

        let fileBloc = $('<span/>', {
                class: 'file-block'
            }),
            fileName = $('<span/>', {
                class: 'name',
                text: this.files.item(0).name
            }),
            fileSize = $('<span/>', {
                class: 'size',
                text: formatBytes(this.files.item(0).size)
            }),
            filePreview = $('<img/>', {
                class: 'preview'
            });
        fileBloc.append(filePreview)
            .append(fileName)
            .append(fileSize)
            .append('<span class="file-delete">×</span>');

        $("#vyr_obr_filesList").empty().append(fileBloc);

        // Zobrazení náhledu obrázku
        let reader = new FileReader();
        reader.onload = function (e) {
            filePreview.attr('src', e.target.result);
        };
        reader.readAsDataURL(this.files[0]);

        // Přidání souboru do objektu datového přenosu pro nahrávání souborů
        vyr_obr.items.clear();
        vyr_obr.items.add(this.files[0]);

    }

    this.files = vyr_obr.files;

    // Nastavení události click na ikonu pro smazání souboru
    $('span.file-delete').click(function (e) {

        // Odstranění bloku souboru ze seznamu souborů
        $(this).parent().remove();

        // Odstranění souboru z objektu datového přenosu pro nahrávání souborů
        vyr_obr.items.clear()

        // Aktualizace seznamu souborů v inputu file po smazání souboru
        document.getElementById('vyr_obr').files = vyr_obr.files;
        file_size_check_vyrobce($($(e.target)[0].form).find('input[type="file"]'), e)
        $('label[for="vyr_obr"]').text('Přidat Obrázek')

    });

    file_size_check_vyrobce($($(e.target)[0].form).find('input[type="file"]'), e)

});

$("#produkt").on('submit', function (e) {
    file_size_check($((e.target)[0].form).find('input[type="file"]'), e);
})


function file_size_check_vyrobce(file_inputs, e) {
    const error_div = $("#file_block_vyrobce").children().first();
    let size = 0;

    for (let i = 0; i < file_inputs.length; i++) {
        let file_liset = file_inputs[i].files

        for (let j = 0; j < file_liset.length; j++) {
            size += file_liset[j].size
        }
    }

    if (error_div.attr('id') === 'file_inv') {
        $('#file_inv').remove()
    }


    if ($("#vyr_obr")[0].files.length === 0 && e.type === "submit") {
        $("#file_block_vyrobce").prepend($('<div/>', {
            class: 'invlaid img-inv',
            id: 'file_inv',
            text: 'Obrázek nesmí být prázdný'
        }))
        if (e.type === "submit") {
            e.preventDefault()
        }
        $("#vyr_obr").parent().addClass('invalid_file')
    } else if (size >= 40 * 1024 * 1024) {
        $("#file_block_vyrobce").prepend($('<div/>', {
            class: 'invlaid',
            id: 'file_inv',
            text: 'Obrázky překročili maximální velikst(40 MB)'
        }))
        if (e.type === "submit") {
            e.preventDefault()
        }
        $(".file-input").addClass('invalid_file')
    } else {
        $(".file-input").removeClass('invalid_file')
    }


}

function file_size_check(file_inputs, e) {
    const error_div = $("#file_block").children().first();
    let size = 0;

    for (let i = 0; i < file_inputs.length; i++) {
        let file_liset = file_inputs[i].files

        for (let j = 0; j < file_liset.length; j++) {
            size += file_liset[j].size
        }
    }

    if (error_div.attr('id') === 'file_inv') {
        $('#file_inv').remove()
    }
    let error = false;
    if ($("#h_obr")[0].files.length === 0 && e.type === "submit") {
        $("#file_block").prepend($('<div/>', {
            class: 'invlaid img-inv',
            id: 'file_inv',
            text: 'Hlavní obrázek nesmí být prázdný'
        }))
        if (e.type === "submit") {
            e.preventDefault()
        }
        $("#h_obr").parent().addClass('invalid_file')
        error = true;
    } else {
        $("#h_obr").parent().removeClass('invalid_file')
    }

    if (size >= 40 * 1024 * 1024) {
        $("#file_block").prepend($('<div/>', {
            class: 'invlaid',
            id: 'file_inv',
            text: 'Obrázky překročili maximální velikst(40 MB)'
        }))
        if (e.type === "submit") {
            e.preventDefault()
        }
        $(".file-input").addClass('invalid_file')
    } else if (!error) {
        $(".file-input").removeClass('invalid_file')
    }


}

function new_paramet_category() {
    const parent = $("#full_parametrs");
    let child_lenght = parent.children().length.toString()
    let parametry = $('<div/>', {class: "form-input  parametry"}),
        prametr_nazev = $('<div/>', {class: "prametr-nazev"}),
        nazev_input = $('<input/>', {type: "text", name: 'vlasnoti[]', id: child_lenght}),
        label_input = $('<label/>', {for: child_lenght, text: "Název Kategorie:"});

    $(nazev_input).one('change', function () {
        new_paramet_category()
    })
    parent.append(parametry.append(prametr_nazev.append(nazev_input).append(label_input)))

    parametr_d(child_lenght, '0', parametry)
    return parametry
}

function parametr_d(number, count, parrent_div) {
    let prametr_div = $('<div/>', {class: "parametr-div"}),
        parametr_input = $('<div/>', {class: "parametr-input"}),
        nazecv_input = $('<input/>', {type: "text", name: number + 'N[]', id: number + 'N' + count}),
        nazev_label = $('<label/>', {for: number + 'N' + count, text: "Název Parametru:"})

    nazecv_input.one('change', function () {
        parametr_d(number, (parseInt(count) + 1).toString(), parrent_div)
    })

    prametr_div.append(parametr_input.append(nazecv_input).append(nazev_label))
    parametr_input = $('<div/>', {class: "parametr-input"})
    nazecv_input = $('<input/>', {type: "text", name: number + 'J[]', id: number + 'J' + count})
    nazev_label = $('<label/>', {for: number + 'J' + count, text: "Hodnota Parametru:"})

    prametr_div.append(parametr_input.append(nazecv_input).append(nazev_label))

    parrent_div.append(prametr_div)

}

new_paramet_category()

function on_change_delete(number, count, id) {

    let parrent_div = $("#" + id).parent().parent().parent();
    parametr_d(number.toString(), (count + 1).toString(), parrent_div)

    let element = document.getElementById(id);
    element.removeAttribute("onchange");
}

function error_msg(text, form) {
    if ($(form.children()[0]).hasClass('error-msg')) {
        $(form.children()[0]).remove()
    }
    let error_div = $('<div>', {
        class: 'error-msg',
        text: text

    })
    form.prepend(error_div)
    setTimeout(function () {
        error_div.remove()
    }, 5000)
}

function nova_kategorie() {

    let input = $("#new_kategorie")
    let form = $(input[0].form)
    let hodnota = (input.val()).toLocaleUpperCase();


    axios.post('/pomoc/pridat-vyrobce', {
        funkce: "kategorie",
        nazev: hodnota
    }, {
        headers: {'X-Requested-With': 'XMLHttpRequest'}
    }).then(function (response) {
        if (response.data === 1) {
            location.reload()
        } else if (response.data === "exist") {
            error_msg('Tato kategorie již existuje', form)

        } else {
            error_msg('Omlováme se něco se pokazilo zkuste to později', form)
        }
    })
}

function novy_vyrobce(e) {
    let input = $("#new_vyrobce")
    let form = $(input[0].form)
    let hodnota = (input.val()).toLocaleUpperCase();


    axios.post('/pomoc/pridat-vyrobce', {
        funkce: "vyrobce",
        nazev: hodnota
    }, {
        headers: {'X-Requested-With': 'XMLHttpRequest'}
    }).then(function (response) {
        if (response.data === 1) {
            form.submit()
        } else if (response.data === "exist") {
            error_msg('Tato kategorie již existuje', form)
            $("#vyrobce_form").one('submit', function (e) {
                e.preventDefault()
                file_size_check_vyrobce($((e.target)[0].form).find('input[type="file"]'), e);
                novy_vyrobce(e)
            })

        } else {
            error_msg('Omlováme se něco se pokazilo zkuste to později', form)
            $("#vyrobce_form").one('submit', function (e) {
                e.preventDefault()
                file_size_check_vyrobce($((e.target)[0].form).find('input[type="file"]'), e);
                novy_vyrobce(e)
            })
        }
    })
}

$("#kategorie_form").on('submit', function (e) {
    e.preventDefault()
    nova_kategorie()
})

$("#vyrobce_form").one('submit', function (e) {
    e.preventDefault()
    file_size_check_vyrobce($((e.target)[0].form).find('input[type="file"]'), e);
    novy_vyrobce(e)
})


setTimeout(function () {
    $("#message").remove()
}, 10000)

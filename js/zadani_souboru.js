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
            console.error('Nebyl nalezen div s class imagePreview')
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
    ;

    // Přidání souboru do objektu datového přenosu pro nahrávání souborů
    for (let file of this.files) {
        dt.items.add(file);
    }
    this.files = dt.files;

    // Nastavení události click na ikonu pro smazání souboru
    $('span.file-delete').click(function (e) {
        // Získání názvu souboru
        let name = $(this).next('span.name').text();

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
        // Získání názvu souboru
        let name = $(this).next('span.name').text();

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

$("#produkt").on('submit', function (e) {
    file_size_check($((e.target)[0].form).find('input[type="file"]'), e);
})

function file_size_check(file_inputs, e) {
    console.log(file_inputs)
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

    if ($("#h_obr")[0].files.length === 0 && e.type === "submit") {
        $("#file_block").prepend($('<div/>', {
            class: 'invlaid',
            id: 'file_inv',
            text: 'Hlavní obrázek nesmí být prázdný'
        }))
        if (e.type === "submit") {
            e.preventDefault()
        }
        $("#h_obr").parent().addClass('invalid_file')
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
    } else {
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
        console.log(number)
        console.log(count)
        parametr_d(number, (parseInt(count) + 1).toString(), parrent_div)
    })

    prametr_div.append(parametr_input.append(nazecv_input).append(nazev_label))
    parametr_input = $('<div/>', {class: "parametr-input"})
    nazecv_input = $('<input/>', {type: "text", name: number + 'J[]', id: number + 'J' + count})
    nazev_label = $('<label/>', {for: number + 'J' + count, text: "Hodnota Parametru:"})

    prametr_div.append(parametr_input.append(nazecv_input).append(nazev_label))

    parrent_div.append(prametr_div)

}

console.log(new_paramet_category())
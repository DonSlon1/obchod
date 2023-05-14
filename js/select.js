let search_options = $(".search-options")

search_options.on('click', function (event) {
    close()
    let target = $(event.target)
    target.addClass('active')
    $(target.parent().parent()).addClass('active')
    let list = $(target.parent().next())
    list.addClass('active')
    if (target.val() !== "") {

        find(target.val().toLowerCase(), $($(this).parent().parent().find('ul.value-list')))
    }
}).on("keyup", function () {

    find($(this).val().toLowerCase(), $($(this).parent().parent().find('ul.value-list')))

})

function find(value, value_list) {
    value_list.find("li").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });

    if (value_list.find("li:visible").length === 0) {
        if (value_list.find("li:visible:contains('Nenašli jsme žádnou shodu.')").length === 0) {
            value_list.append("<li class='not-select'>Nenašli jsme žádnou shodu.</li>")
        }
    } else {
        value_list.find("li:visible:contains('Nenašli jsme žádnou shodu.')").remove()
    }
}

function close() {

    let remove = $('.search-options.active')
    remove.removeClass('active')
    $(remove.parent().parent()).removeClass('active')
    $(remove.parent().next()).removeClass('active')


}


$('.value-list li:not(.not-select)').on('click', function () {
    $($(this).parent().prev().children()).val(this.textContent.trim())
    $($(this).parent().next()).val($(this).attr('data-id'))
    let search = $('.search-options.active')
    close()
    if (search[0]) {
        check(search[0])
    }

})

$(document).on('click keydown', function (event) {

    let target = $(event.target)
    let search = $('.search-options.active')
    if (!target.closest('.search-options.active , .value-list').length || event.key === "Escape") {


        if (search[0]) {
            check(search[0])
        }
        close()
    }
});

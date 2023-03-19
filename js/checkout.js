$("input[name='doprava']").change(function () {
    $("input[name='doprava']").each(function () {
        if (!$(this).is(":checked")) {

            $(this.parentElement).addClass('hide')
        }
    })
})
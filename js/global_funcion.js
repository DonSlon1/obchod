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
    $("#user_open").one("mousedown", function () {
        show("#user")
    })
}


function show(id) {

    const container = $(id + "_div");
    container.css('display', 'flex')
    container.addClass('1')
    console.log(1);
    $(document).on("mousedown", function (e) {
            const container = $(id + "_div");
            if (container.hasClass('1')) {
                container.removeClass('1')
            } else {

                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    $(document).off("mousedown")
                    $(id + "_open").one("mousedown", function () {
                        show(id)
                    })
                    container.css('display', 'none')
                    return 0;
                }
            }
        }
    )

}


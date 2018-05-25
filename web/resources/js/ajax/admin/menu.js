$(document).ready(function () {




    function menu(route) {

       $.get(
           route,
           function (data) {
               $('.contain-menu').append(data)
           }

       )

    }

    $('.admin-menu').click(function () {

        menu('/admin-product')

    })

});
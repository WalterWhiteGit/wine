$(document).ready(function () {

// Show search filter

    $('.contain-field').hide();

    $('.search-title').on('click',function () {

    $('.contain-field').slideToggle(800);

    });


// Ajax query field name


    var datalist = $('#listname');

    var name = $('#appbundle_products_productName');

    name.on('click',function () {

        $(this).val('');

    });


    name.keyup(function () {

        if (name.val().length > 2){

            datalist.empty();

            var winename = name.val();
            
// Ajax 
            $.ajax({
                method:'POST',
                dataType:'json',
                data:{'data' :winename},
                url:'/ajax',
                success:ajaxSearch
                });
            }
         });


    function ajaxSearch (data) {

       if(data.length == 0 ){


           let option = document.createElement('option');
           name.val('aucun résultat');

       }

       else {
           $.each(data, function (index, value) {

               var option = document.createElement('option');
               option.setAttribute('value', value.productName);
               datalist.append(option);
           })
       }
    }


// Ajax query field Région

    var aera = $('#appbundle_products_productArea');

    var dataAera = $('#listaera');

    aera.keyup(function () {

        if (aera.val().length > 2){

            dataAera.empty();

            var wineaera = aera.val();

// Ajax 
            $.ajax({
                method:'POST',
                dataType:'json',
                data:{'data' :wineaera},
                url:'/aera',
                success:aeraSearch
            });

        }
    });


    function aeraSearch (data) {

        if(data.length == 0 ){


            var option = document.createElement('option');
            aera.val('aucun résultat');

        }

        else {
            $.each(data, function (index, value) {

                var option = document.createElement('option');
                option.setAttribute('value', value.area);
                dataAera.append(option);

            })
        }
    }


 // Search by year

    var year = $('#appbundle_products_year');

    year.on('click',function () {

        $(this).val('');

    });



});

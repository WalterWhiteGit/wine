$(document).ready(function () {


    displayProducts();
    displayCountry();
    displayArea();


});

/****************************** Functions ***********************
 ****************************************************************/

// Afficher les produits

function displayProducts() {

    $.ajax({
        method:'POST',
        dataType:'json',
        url:'/shopwine',
        success:display
    });
}

// Afficher les pays
function displayCountry() {

    $.ajax({
        method: 'POST',
        dataType: 'json',
        url: '/pays',
        success: country
    });
}


// Afficher les régions viticoles
function displayArea() {

    $.ajax({
        method:'POST',
        dataType:'json',
        url:'/aera',
        success:area
    });
}

function area (data) {

    $('.contain-area').empty();


    $.each(data, function (index, value) {
        var contenu;
        contenu =  '<div class="filter-area">';
        contenu += '<div class="contain-value">';
        contenu += '<input type="checkbox" name="area" id="area" value='+value.area+'>'+value.area;
        contenu += '</div></div></div>';

        $('.contain-area').append(contenu);

    });

    /**********************************************
     SI CASE COCHEE ACTUALISER LA LISTE DES REGIONS
     *********************************************/

    $('input[name="area"]').on('change',function () {

// Create array
        var area_w = [];

// Effacer le contenu du filtre actif pays
        $('.area-filter').remove();

// Get all cases checkeds
        $('#area:checked').each(function () {

            // Fill array
            area_w.push($(this).val());

        });

        if (area_w.length > 0) {

            $.ajax({
                method: 'POST',
                dataType: 'JSON',
                data: {'data': area_w},
                url: '/aera',
                success: display
            });

            contenu = '<div class="area-filter">';

            for (i = 0; i < area_w.length; i++) {

                contenu += '<p>Région :' + area_w[i] + '</p>';
            }

            contenu += '<p class="clear-filter">Effacer tous les filtres</p></div>';

            $('.title-filter').append(contenu);
        }

// Si aucune case région est cochée.
        else {
            $('.contain-list').empty();
            $.ajax({
                method:'POST',
                dataType:'json',
                url:'/shopwine',
                success:display
            });
        }
    });

}


function country (data){

    $('.contain-country').empty();

    $.each(data, function (index,value){

        var contenu;

        contenu =  '<div class="filter-country">';
        contenu += '<div class="contain-value">';
        contenu += '<input type="checkbox" name="country" id="country" value='+value.productCountry+'>'+value.productCountry;
        contenu += '</div></div></div>';

        $('.contain-country').append(contenu);

    });

    /***************************************
     SI CASE COCHEE ACTUALISER LA LISTE PAYS
     **************************************/

    $('input[name="country"').on('change',function () {

        var country_w = [];

// Effacer le contenu du filtre actif pays
        $('.activ-filter,.area-filter').remove();

// Récupérer toutes les cases cochées.

        $('#country:checked').each(function () {

            country_w.push($(this).val());
        });

        if (country_w.length > 0) {

            $.ajax({
                method: 'POST',
                dataType: 'json',
                data: {'data': country_w},
                url: '/pays',
                success: countryProducts
            });

// Afficher les filtres actifs

            contenu = '<div class="activ-filter">';

            for (i = 0; i < country_w.length; i ++){

                contenu+='<p>Pays : '+ country_w[i] + '</p>';
            }

            contenu += '<p class="clear-filter">Effacer tous les filtres</p></div>';

            $('.title-filter').append(contenu);

        }


// Si aucune case pays est cochée.
        else {

            $('.contain-list').empty();
            $.ajax({
                method:'POST',
                dataType:'json',
                url:'/shopwine',
                success:display
            });

            $('.contain-area').empty();

            displayArea();

        }
    });

}




// Afficher les régions viticoles
function areaByCountry (data) {

    $('.contain-area').empty();
    $.each(data[1], function (index, value) {
        var contenu;

        contenu =  '<div class="filter-area">';
        contenu += '<div class="contain-value">';
        contenu += '<input type="checkbox" name="area" id="area" value='+value.area+'>'+value.area;
        contenu += '</div></div></div>';

        $('.contain-area').append(contenu);

    })
}


/********************************************* Filtre *************************************
******************************************************************************************/

// Country on click
$('.country').on('click',function () {

    $('.filter-country').toggle();

});

// Area on click

$('.area').on('click',function () {

    $('.filter-area').toggle();
});

// Year on click
$('.year').on('click',function () {

    $('.filter-year').toggle();
});


// type on click

$('.type').on('click',function () {

    $('.filter-type').toggle();

});

/*************************************** Trier les produits ***********************
 *********************************************************************************/

$('#tri').on('change',function () {

    if ($('#tri').val() !== 'nul'){

        var choice = $('#tri').val();

        $.ajax({
            method:'POST',
            dataType:'json',
            data:{'data': choice},
            url:'/desc-price',
            success:priceByAsc
        });
    }

    else {

        $('.contain-list').empty();
        $.ajax({
            method:'POST',
            dataType:'json',
            url:'/shopwine',
            success:displayProducts
        });
    }
});


function deleteDuplicates(array) {

    var area_array = [];

    for (var i = 0; i < array.length; i++){

        if(area_array.indexOf(array[i])== -1){

            area_array.push(array[i]);
        }
    }

    return area_array
}

/********************************* Affichage des produits en Ajax ************************
 *****************************************************************************************/

function display(data) {


        if (data.length == 0){

            $('.contain-list').append('<p>Aucun produits à afficher</p>');
        }

        else {
            $('.contain-list').empty();

            $.each(data, function (index, value) {
                // Create elements

                var str =  value.productDescription;
                var contenu;
                contenu = '<div class="contain-product">';
                contenu += '<div><img class="prod-img" src="resources/img/shop/'+value.productImage+'.png">' +
                                 '<p class="prod-price">'+value.salePrice+'&euro;</p></div>';

                contenu += '<div><h3 class="prod-title">'+value.productName.toUpperCase()+'</h3>';
                contenu += '<p class= "prod-country"><u>Pays</u> :<img src="resources/img/shop/flag/'+value.productCountry+'.png"></p>';
                contenu += '<p class="prod-line"><u>Région</u> : '+value.area+'</p>';
                contenu += '<p class="prod-color"><u>Type</u>: vin '+ value.type+'</p>';
                contenu += '<p class="prod-year"><u>Année</u> : '+value.year+'</p>';
                contenu += '<p class="prod-description">'+ str.substr(0,200)+'...</p>';
                if (value.quantityInStock > 5){

                    contenu += '<div class="circle-qtyH"></div><a class="prod-quantity">    Disponible dans notre cave</a></div>'
                }
                else if (value.quantityInStock == 0){

                    contenu += '<div class="circle-qtyN"></div><a class="prod-quantity">    Momentanément absent de notre cave</a>'
                }
                else {

                    contenu += '<div class="circle-qtyL"></div><a class="prod-quantity">    Plus que '+value.quantityInStock+' dans notre cave</a>'
                }

                contenu +='<p class="add-cart">Ajouter au panier</p>';

                contenu += '</div>';

                // Add elements
                $('.contain-list').append(contenu);
            })

        }
}


// Afficher les prix par ordre croissant ou décroissant
function priceByAsc (data) {

    if (data.length==0){

    }

    else {

        $('.contain-list').empty();
        $.each(data, function (index, value) {

            var contenu;
            contenu = '<div class="contain-product">';
            contenu += '<div><img class="prod-img" src="resources/img/shop/'+value.productImage+'.png"></div>';
            contenu += '<div><h2 class="prod-title">'+value.productName+'</h2>';
            contenu += '<p class= "prod-country"><u>Pays</u> :<img src="resources/img/shop/flag/'+value.productCountry+'.png"></p>';
            contenu += '<p class="prod-line"><u>Région</u> :'+value.area+'</p>';
            contenu += '<p class="prod-year"><u>Année</u> :'+value.year+'</p>';
            contenu += '<p class="prod-description">'+value.productDescription+'</p>';
            contenu += '<p class="prod-price">'+value.salePrice+'&euro;</p></div>';
            contenu += '</div>';

            // Add elements
            $('.contain-list').append(contenu);

        })
    }
}


function countryProducts(data) {

    if (data.length == 0){

        $('.contain-list').append('<p>Aucun produits à afficher</p>');
    }
    else {
        $('.contain-list').empty();

        $.each(data[0], function (index, value) {
            // Create elements

            var str =  value.productDescription;
            var contenu;
            contenu = '<div class="contain-product">';
            contenu += '<div><img class="prod-img" src="resources/img/shop/'+value.productImage+'.png">' +
                '<p class="prod-price">'+value.salePrice+'&euro;</p></div>';

            contenu += '<div><h3 class="prod-title">'+value.productName.toUpperCase()+'</h3>';
            contenu += '<p class= "prod-country"><u>Pays</u> :<img src="resources/img/shop/flag/'+value.productCountry+'.png"></p>';
            contenu += '<p class="prod-line"><u>Région</u> : '+value.area+'</p>';
            contenu += '<p class="prod-color"><u>Type</u>: vin '+ value.type+'</p>';
            contenu += '<p class="prod-year"><u>Année</u> : '+value.year+'</p>';
            contenu += '<p class="prod-description">'+ str.substr(0,200)+'...</p>';
            if (value.quantityInStock > 5){

                contenu += '<div class="circle-qtyH"></div><a class="prod-quantity">    Disponible dans notre cave</a></div>'
            }
            else if (value.quantityInStock == 0){

                contenu += '<div class="circle-qtyN"></div><a class="prod-quantity">    Momentanément absent de notre cave</a>'
            }
            else {

                contenu += '<div class="circle-qtyL"></div><a class="prod-quantity">    Plus que '+value.quantityInStock+' dans notre cave</a></div>'
            }
            contenu += '</div>';

            // Add elements
            $('.contain-list').append(contenu);
        })

        areaByCountry(data);
    }

}

/**************************
 * Effacer tous les filtres
 *************************/




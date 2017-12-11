$(document).ready(function () {

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

/****************************** Variables ***********************
****************************************************************/

    var country_w=[];
    var area_w =[];
    var type_w =[];

/*****************************************************************
/****************************** FUNCTIONS ***********************
 ****************************************************************/

// Call Ajax

function ajaxRequest (target,action)
    {
        $.ajax({
            method:'get',
            dataType:'json',
            url:target,
            success:action
        });
    }

// Call Ajax with data

function ajaxDataRequest (target,adata) {

    $.ajax({
        method:'post',
        dataType:'json',
        url:target,
        data:adata,
        success:display
    });
}

/**********************************************
SI CASE COCHEE, ACTUALISER LA LISTE DES REGIONS
*/
function showArea () {

    $('input[name="area"]').on('change', function () {

        alert('click');

// Initiate Array
        area_w = [];

// Delete actif contain by country
        $('.area-filter').remove();

// Get all cases checkeds
        $('#area:checked').each(function () {

// Fill array
            area_w.push($(this).val());
        });

/**************************************************************
Si on coche une région d'un pays on affiche les produits de la
 région du pays séléctionné.
**************************************************************/

 // Vériier que aucune Région est séléctionnée
        if (area_w.length > 0) {

// Vérifier que aucun pays est séléctionné
            if (country_w.length > 0) {

                alert(country_w);
                ajaxDataRequest('/aera',{'data':area_w,'array':country_w });

                }

            alert(area_w);

            contenu = '<div class="area-filter">';

            for (i = 0; i < area_w.length; i++) {

                contenu += '<p>Région :' + area_w[i] + '</p>';
             }

            contenu += '<p class="clear-filter">Effacer tous les filtres</p></div>';

            $('.title-filter').append(contenu);
        }

// Si aucune case région est cochée mais q'un pays reste coché, on affiche uniquement les vins de ce pays

        else {

            if (country_w.length > 0){

                alert('Pays :' +  country_w);

                $.ajax({
                    method: 'POST',
                    dataType: 'json',
                    data: {'data': country_w},
                    url: '/pays',
                    success: countryProducts
                });
            }

            else {
                $('.contain-list').empty();

                ajaxRequest('/shopwine',display);
            }
        }
    });
 }

/***************************************
SI CASE COCHEE ACTUALISER LA LISTE PAYS
**************************************/

function showCountry() {

        $('input[name="country"').on('change',function () {

            country_w = [];

// Effacer le contenu du filtre actif pays
            $('.activ-filter,.area-filter').remove();

// Récupérer toutes les cases cochées.

            $('#country:checked').each(function () {

                country_w.push($(this).val());
            });

            if (country_w.length > 0) {

                alert(country_w);

                if (type_w.length > 0) {

                    alert(type_w);

                    ajaxDataRequest('/type',{'type':type_w,'country': country_w });

                }

                else {

                    ajaxDataRequest('/pays',{"data":country_w });

// Afficher les filtres actifs

                    contenu = '<div class="activ-filter">';

                    for (i = 0; i < country_w.length; i++) {

                        contenu += '<p>Pays : ' + country_w[i] + '</p>';
                    }

                    contenu += '<p class="clear-filter">Effacer tous les filtres</p></div>';

                    $('.title-filter').append(contenu);
                    }
                }

// Si aucune case pays est cochée.
            else {

                    $('.contain-list').empty();

                    ajaxRequest('/shopwine',display);

                    $('.contain-area').empty();

                    ajaxRequest('/aera',area);
                }
        });
    }
/***************************************
SI CASE COCHEE ACTUALISER LA LISTE PAYS
**************************************/

function showType(){

    $('input[name="type"').on('change',function () {

            type_w = [];

            $('#type:checked').each(function () {

            type_w.push($(this).val());

        });

        if (type_w.length > 0) {


            if (country_w.length > 0) {


                alert('pays selectionné :' + country_w);

                ajaxDataRequest('/type',{'type':type_w,'country':country_w });

                $('.clear-filter').remove();

                console.log(type_w);

                for (i = 0; i < type_w.length; i++) {

                    contenu = '<p class="typefilter">Type : ' + type_w[i].toUpperCase() + '</p>';
                }

                contenu += '<p class="clear-filter">Effacer tous les filtres</p></div>';

                $('.activ-filter').append(contenu);
            }

            else {

                $('.activ-filter,.area-filter').remove();

                ajaxDataRequest('/type',{"type":type_w });


// Afficher les filtres actifs

                contenu = '<div class="activ-filter">';

                for (i = 0; i < type_w.length; i++) {

                    contenu += '<p class="typefilter">Type : ' + type_w[i] + '</p>';
                }

                contenu += '<p class="clear-filter">Effacer tous les filtres</p></div>';

                $('.title-filter').append(contenu);
            }
        }

    });
}

/***************************************************************************************
*************************** AFFICHAGE DE LA LISTE DES REGIONS ****************************
**************************************************************************************/
    function area (data) {

        $('.contain-area').empty();


        $.each(data, function (index, value) {
            var contenu;
            contenu =  '<div class="filter-area">';
            contenu += '<div class="contain-value">';
            contenu += '<div><input type="checkbox" name="area" id="area" value='+value.area+'>'+value.area+'</div>';
            contenu += '</div></div>';

            $('.contain-area').append(contenu);

        });
        showArea()
    }
/***************************************************************************************
 *************************** AFFICHAGE DE LA LISTE DES PAYS ****************************
 **************************************************************************************/

function country (data) {

    $('.contain-country').empty();

    $.each(data, function (index, value) {

        var contenu;

        contenu = '<div class="filter-country">';
        contenu += '<div class="contain-value">';
        contenu += '<div><input type="checkbox" name="country" id="country" value=' + value.productCountry + '><img class="filter-flag" src="resources/img/shop/flag/' + value.productCountry + '.png">' + value.productCountry + '</div>';
        contenu += '</div></div>';

        $('.contain-country').append(contenu);

    });

    showCountry();

}

/***********************************************************************************
*************************** AFFICHAGE DES TYPES DE VINS ****************************
************************************************************************************/

function type (data) {

        //$('.contain-type').empty();

        $.each(data, function (index, value) {

            var contenu;

            contenu = '<div class="filter-type">';
            contenu += '<div class="contain-value">';
            contenu += '<div><input type="checkbox" name="type" id="type" value=' + value.type +'>'+ value.type +'<img id="' + value.type + '" class="filter-flag" src="resources/img/shop/' + value.imgtype + '"></div>';
            contenu += '</div></div>';

            $('.contain-type').append(contenu);

        });

        showType();
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
    });

    showArea();
}


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
                                 '<p class="prod-price">'+value.salePrice.toFixed(2) +'&euro;</p>' +
                                 '<p class="add-cart">Ajouter au panier</p></div>';
// Add title product
                contenu += '<div><h3 class="prod-title">'+value.productName.toUpperCase()+'</h3>';
// Add picture product
                contenu += '<p class= "prod-country"><u>Pays</u> :<img src="resources/img/shop/flag/'+value.productCountry+'.png"></p>';
// Add aera product
                contenu += '<p class="prod-line"><u>Région</u> : '+value.area+'</p>';
//  Add type of product
                contenu += '<p class="prod-year"><u>Année</u> : '+value.year+'</p>';
// Add type of product
                contenu += '<p class="prod-color"><u>Type</u>: <img class="img-type" src="resources/img/shop/'+ value.imgtype +'"></p>';

                contenu += '<p class="prod-description">'+ str.substr(0,300)+'...<a class="prod-more" href="http://localhost:8000/Shop/'+ value.slug+'">';
                contenu +=  'En savoir plus</a></p>';
                if (value.quantityInStock > 5){

                    contenu += '<div class="circle-qtyH"></div><a class="prod-quantity">    Disponible dans notre cave</a></div>'
                }
                else if (value.quantityInStock == 0){

                    contenu += '<div class="circle-qtyN"></div><a class="prod-quantity">    Momentanément absent de notre cave</a>'
                }
                else {

                    contenu += '<div class="circle-qtyL"></div><a class="prod-quantity">    Plus que '+value.quantityInStock+' dans notre cave</a>'
                }

                contenu += '</div>';

                // Add elements
                $('.contain-list').append(contenu);

               // $('.prod-test').attr("href","{{ url('shop.product',{'slug':"+value.slug+"}) }}");
                //$('.prod-test').text(value.slug);
            })
        }
    }
/**************************
 * Effacer tous les filtres
 *************************/

    ajaxRequest('/aera',area);
    ajaxRequest('/type',type);
    ajaxRequest('/pays',country);
    ajaxRequest('/shopwine',display);

});





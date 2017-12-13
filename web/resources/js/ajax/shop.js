$(document).ready(function () {

/********************************************* Filtre *************************************
******************************************************************************************/
// Icone de chargement

    $('.buttonload').hide();

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
            beforeSend:function () {
               $('.buttonload').fadeIn();
            },
            complete:function () {
                $('.buttonload').fadeOut();
            },
            dataType:'json',
            url:target,
            success:action
        });
    }

// Call Ajax with data

function ajaxDataRequest (target,adata,action) {

    $.ajax({
        method:'post',
        dataType:'json',
        url:target,
        data:adata,
        success:action
    });
}


// Fill filter data
function filterData( array, data){

    contenu = '<div class="area-filter">';

        for (i = 0; i < array.length; i++) {
            contenu += '<p>Région :' + data[i] + '</p>';
        }
    contenu += '<p class="clear-filter">Effacer tous les filtres</p></div>';

    $('.title-filter').append(contenu);
}


/**********************************************
SI CASE COCHEE, ACTUALISER LA LISTE DES REGIONS
*/
function showArea () {

    $('input[name="area"]').on('change', function () {

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
            if (type_w.length > 0) { ajaxDataRequest('/aera',{'data':area_w, 'type':type_w},display);}

            else{ ajaxDataRequest('/aera',{'data': area_w},display);}

            }

// Si aucune case région est cochée mais q'un pays reste coché, on affiche uniquement les vins de ce pays

            else {
                    if (country_w.length > 0){ajaxDataRequest('/pays',{"data":country_w },display);}

                    else {
                        $('.contain-list').empty();
                        ajaxRequest('/shopwine', display);
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

                filterData(country_w,country_w);

                if (type_w.length > 0) {

                    alert(type_w);

                    ajaxDataRequest('/type',{'type':type_w,'country': country_w },display);

                }

                else {

                    ajaxDataRequest('/pays',{"data":country_w },display);

// Refresh area filter
                    ajaxDataRequest('/aera',{'aera':country_w},area);

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

                ajaxDataRequest('/aera',{'type':type_w},area);

                ajaxDataRequest('/type',{'type':type_w,'country':country_w },display);

                $('.clear-filter').remove();

                console.log(type_w);

                for (i = 0; i < type_w.length; i++) {

                    contenu = '<p class="typefilter">Type : ' + type_w[i].toUpperCase() + '</p>';
                }

                contenu += '<p class="clear-filter">Effacer tous les filtres</p></div>';

                $('.activ-filter').append(contenu);
            }

            else {

// Refresh filter Aera Wine
                ajaxDataRequest('/aera',{'type':type_w},area);

                $('.activ-filter,.area-filter').remove();

                ajaxDataRequest('/type',{"type":type_w },display);


            }
        }

        else {

            ajaxRequest('/shopwine',display);
            ajaxRequest('/aera',area);
        }

    });
}

/***************************************************************************************
*************************** AFFICHAGE DE LA LISTE DES REGIONS ****************************
**************************************************************************************/
    function area (data) {

        console.log(data);

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






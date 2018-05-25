$(document).ready(function () {

/********************************************* Filtre *************************************
******************************************************************************************/
// Display Price Range
    const pricemin = $('#price-min');
    const pricemax = $('#price-max');
    let prices;

    // Prix minimum
    pricemin.on('input',function () {

        prices = $(this).val();

        let minprice = $('#minprice');


        minprice.text(prices);

       minprice.append('<a>&euro;</a>');

    });

    // prix maximum
    pricemax.on('input',function () {

        prices = $(this).val();

        let maxprice = $('#maxprice');


        maxprice.text(prices);

        maxprice.append('<a>&euro;</a>');

    });

    pricemin.on('change',function () {

        ajaxDataRequest('/test',{'price':prices},display);
    });

// Icone de chargement


    $('.promo').delay(3000).slideDown(1000);
    $('.promo').delay(5000).slideUp(1000);

    $('.buttonload').hide();

// Country on click
    $('.country').on('click',function () {
        $('.filter-country').toggle(300);
    });

// Area on click

    $('.area').on('click',function () {
        $('.filter-area').toggle(300);
    });

// Year on click
    $('.year').on('click',function () {
        $('.filter-year').toggle(300);
    });

// type on click

    $('.type').on('click',function () {
        $('.filter-type').toggle(300);
    });

/****************************** Variables ***********************
****************************************************************/

    var country_w=[];
    var area_w =[];
    var type_w =[];
    var price_w=[];

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
function filterData( array,type, data,filter){

    var filtre = '"'+ filter +'"';

    contenu = '<div class="area-filter">';

        for (i = 0; i < array.length; i++) {
            contenu += '<p>'+ type +': ' + data[i] + '</p>';
        }

    contenu += '<p class="clear-filter">Effacer tous les filtres</p></div>';

            $('.title-filter').append(contenu);

            $('.clear-filter').on('click',function () {

            $('.area-filter').empty();

            ajaxRequest('/shopwine',display);
    /*
        $('input[name='+filtre+']').each(function() {

            this.checked = false;
        });
    */
    })
}

/**********************************************
SI CASE COCHEE, ACTUALISER LA LISTE DES REGIONS
*/
function showArea () {

    $('input[name="area"]').on('change', function () {

        var filter = $(this).attr('name');

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

            filterData(area_w,'Région',area_w,filter);

// Vérifier que aucun pays est séléctionné
            if (type_w.length > 0) {
                ajaxDataRequest('/aera',{'data':area_w, 'type':type_w},display);}

            else {

        // Afficher le type de vin par région séléctionnée
                ajaxDataRequest('/aera', {'data': area_w}, display);

// Refresh area filter
                ajaxDataRequest('/type', {'area': area_w}, type);

                }
            }

// Si aucune case région est cochée mais q'un pays reste coché, on affiche uniquement les vins de ce pays

            else {
                    if (country_w.length > 0){
                        ajaxDataRequest('/pays',{"data":country_w },display);

                    }

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

            var filter = $(this).attr('name');


// Effacer le contenu du filtre actif pays
            $('.activ-filter,.area-filter').remove();

// Récupérer toutes les cases cochées.

            $('#country:checked').each(function () {

                country_w.push($(this).val());
            });

            if (country_w.length > 0) {

                filterData(country_w,'Pays',country_w,filter);

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
***************************************/

function showType(){

    $('input[name="type"').on('change',function () {

            var filter = $(this).attr('name');

            type_w = [];

            $('.area-filter').remove();

            $('#type:checked').each(function () {

            type_w.push($(this).val());

        });

// Si au moins un type de vin est coché
        if (type_w.length > 0) {

// Si un pays était coché auparavant
            if (country_w.length > 0) {
                ajaxDataRequest('/aera',{'type':type_w},area);
                ajaxDataRequest('/type',{'type':type_w,'country':country_w },display);
            }

// Si aucun pays coché
            else if(area_w.length > 0){
                ajaxDataRequest('/type',{'type':type_w,'country':country_w },display);
            }

            else if (price_w.length >0){

                ajaxDataRequest('/type',{'type':type_w,'price':price_w},display);

            }


            else if (area_w.length > 0 && price_w.length > 0){

                ajaxDataRequest('/type',{'type':type_w,'area':area_w,'price':price_w},display);
            }


            else if (country_w.length > 0 && price_w.length > 0){

                ajaxDataRequest('/type',{'type':type_w,'country':country_w,'price':price_w},display)
            }

            else {

// Rafraichir le filtre

                ajaxDataRequest('/aera',{'type':type_w},area);

                $('.activ-filter,.area-filter').remove();

                ajaxDataRequest('/type',{"type":type_w },display);

                filterData(type_w,'Type de vin',type_w);

            }
        }

        else {

            ajaxRequest('/shopwine',display);
            ajaxRequest('/aera',area);

        }

    });
}



function showPrice(){

    $('input[name="price"]').on('change',function () {

       price_w =[];

       $('input[name="price"]:checked').each(function () {

           price_w.push($(this).data('id'));

       });

        if (price_w.length > 0){


            if(type_w.length > 0){

              ajaxDataRequest('/price',{"price":price_w,"type":type_w},display);

            }

            else {

               ajaxDataRequest('/test', {"price": price_w}, display);

            }

        }

        else {
                if(type_w.length > 0){

                    ajaxDataRequest('/type',{"type": type_w},display);
                }

                else {
                    ajaxRequest('/shopwine',display);
                }
        }

    })

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
            contenu += '<div><input type="checkbox" name="area" class="filter" id="area" value='+value.area+'>'+value.area+'</div>';
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
        contenu += '<div><input type="checkbox" name="country" class="filter" id="country" value=' + value.productCountry + '><img class="filter-flag" src="resources/img/shop/flag/' + value.productCountry + '.png">' + value.productCountry + '</div>';
        contenu += '</div></div>';

        $('.contain-country').append(contenu);

    });

    showCountry();

}

/***********************************************************************************
*************************** AFFICHAGE DES TYPES DE VINS ****************************
************************************************************************************/

function type (data) {

        $('.contain-type').empty();

        $.each(data, function (index, value) {

            var contenu;

            contenu = '<div class="filter-type">';
            contenu += '<div class="contain-value">';
            contenu += '<div><input type="checkbox" name="type" class="filter" id="type" value=' + value.type +'><img id="' + value.type + '" class="filter-flag" src="resources/img/shop/' + value.imgtype + '">'+ value.type +'</div>';
            contenu += '</div></div>';

            $('.contain-type').append(contenu);

        });

        showType();
    }

/***********************************************************************************
*************************** AFFICHAGE DES PRIX *************************************
************************************************************************************/

function price (){

    $('.contain-price').empty();

    var contenu;

    contenu  = '<div class="filter-price>';
    contenu += '<div class="contain-value">';
    contenu += '<div><input type="checkbox" name="price" class="filter"  data-id=1> - de 30&euro;</div>';
    contenu += '<div><input type="checkbox" name="price" class="filter"  data-id=2> 30&euro; à 50&euro;</div>';
    contenu += '<div><input type="checkbox" name="price" class="filter"  data-id=3> 50&euro; à 100&euro;</div>';
    contenu += '<div><input type="checkbox" name="price" class="filter"  data-id=4> + de 100&euro;</div>';
    contenu += '</div></div>';
    $('.contain-price').append(contenu);

    showPrice();
}




/********************************* Affichage des produits en Ajax ************************
 *****************************************************************************************/

function display(data) {


        if (data.length == 0){


            $('.contain-list').empty().append('<h1 class="no-results">Aucun produits correspondants</h1>');
        }

        else {
            $('.contain-list').empty();
            //$('more-')


            $.each(data, function (index, value) {
                // Create elements

                var str =  value.productDescription;
                var contenu;

                contenu  = '<div class="product">' ;
                contenu += '<h3 class="prod-title">'+value.productName.toUpperCase()+'</h3>';

                contenu += '<div class="contain-product">';
                contenu +=      '<div class="prod-price-img">';
                contenu +=          '<img class="prod-img" src="resources/img/shop/'+value.productImage+'.png">' +
                                    '<p class="prod-price">'+value.salePrice.toFixed(2) +'&euro;</p>' +
                                    '<p class="add-cart" data-id='+ value.id+'>Ajouter au panier</p>';
                contenu +=      '</div>';

// Add title product
                contenu +=      '<div class="prod-details">';
// Add picture product
                contenu +=          '<p class= "prod-country"><u>Pays</u> :<img src="resources/img/shop/flag/'+value.productCountry+'.png"></p>';
// Add aera product
                contenu +=          '<p class="prod-line"><u>Région</u> : '+value.area+'</p>';
// Add type of product
                contenu +=          '<p class="prod-year"><u>Année</u> : '+value.year+'</p>';
// Add type of product
                contenu +=          '<p class="prod-color"><u>Type</u>: <img class="img-type" src="resources/img/shop/'+ value.imgtype +'"></p>';

                contenu +=          '<p class="prod-description">'+ str.substr(0,300)+'...<a class="prod-more" href="http://localhost:8000/Shopping/Product/'+ value.slug+'">Plus d\'informations...</a></p>';

// Add Quantity in stock
                contenu +=          '<div class= "contain-qty">';
                if (value.quantityInStock > 5){

                contenu +=              '<div class="circle-qtyH"></div>';
                contenu +=              '<a class="prod-quantity">    Disponible dans notre cave</a>';
                contenu +=          '</div>';
                }
                else if (value.quantityInStock == 0){

                contenu +=              '<div class="circle-qtyN"></div>';
                contenu +=              '<a class="prod-quantity">    Momentanément absent de notre cave</a>';
                contenu +=          '</div>';

                }
                else {

                contenu +=              '<div class="circle-qtyL"></div>';
                contenu +=              '<a class="prod-quantity">    Plus que '+value.quantityInStock+' dans notre cave</a>'
                contenu +=          '</div>';

                }
// Close class prod-details
                contenu +=          '</div>';
// Close class contain products
                contenu +=      '</div>';
                contenu +=      '</div>';



                // Add elements
                $('.contain-list').append(contenu);


            });

            var moreprod = '<div><p class="contain-addprod"  >Afficher plus de produits</p></div>';
            $('.contain-list').after(moreprod);

        }
    }
/**************************
 * Effacer tous les filtres
 *************************/
    price();
    ajaxRequest('/aera',area);
    ajaxRequest('/type',type);
    ajaxRequest('/pays',country);
    ajaxRequest('/shopwine',display);
});






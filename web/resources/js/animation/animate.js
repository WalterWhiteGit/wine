$(document).ready(function () {


/*
Page : Homepage
Action : Slidephotos
 */
    function startSlide() {

        setInterval(slide, 5000);

        function slide() {

            // Variable
            var pos =  $(".contain-slides").scrollLeft();
            var size = $('.img-banner').width();

            $(".contain-slides").animate({scrollLeft: pos + size}, 1500);

            if (pos == 2800) {$(".contain-slides").animate({scrollLeft: 0}, 500);}

            }
        }

// Call function
    startSlide();


/*
Page : Contact
Action : Show nb caractères
*/
    $('.message').on('keyup',function(){


        var sizemess = $('.message').val().length;

        if (sizemess >0) {
            $('.size-message').fadeIn();
            $('.size-message').text('Nb de caractères : ' + sizemess+'/2000');
        }

        else {
            $('.size-message').fadeOut(1000);
        }
    });


    $('.flash-mess').delay(3000).fadeOut(1000);



});
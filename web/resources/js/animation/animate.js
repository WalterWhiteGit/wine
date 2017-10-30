$(document).ready(function () {



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



    $(window).scroll(function(){
        scrollPos = $(document).scrollTop();

        console.log(scrollPos);

    });

});
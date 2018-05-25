


    function remplissageStockage(product,type,price,quantity) {
        localStorage.setItem('Produit',product);
        localStorage.setItem('type',type);
        localStorage.setItem('Prix', price);
        localStorage.setItem('Quantité', quantity);

    }







const white = document.querySelector('.contain-list');

white.addEventListener('click', function (e) {

    let data = e.target.className;


    if(data === "add-cart" ) {

        let productId = e.target.getAttribute('data-id');



    }





});


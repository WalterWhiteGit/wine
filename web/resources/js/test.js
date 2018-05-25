
class wine {

    constructor(country, area, color) {
        var HP = HP;
        this.country = country;
        this.area = area;
        this.color = color;

        this.getHP = function () {
            return HP;
        };
    }

// Méthodes

    get getCountry() {
        return this.country;
    }

    set setCountry(newCountry) {
        this.country = newCountry;
        return this.country;
    }

    get getArea() {
        return this.area;
    }

    set setArea(Area) {
        this.area = Area;
        return this.area;
    }


    // ici une méthode classique (ni setter, ni getter)

    redWine() {
        return ' s\'accordent avec les viandes rouges';
    }

    whiteWine() {

        return 's\accordent avec les viandes blanches et poissons';

    }

}

function changeCountry(country) {
    vin.setCountry = country;
}


let vin;

vin = new wine('Espagne', 'Ribera Del Duero', 'Rouge');
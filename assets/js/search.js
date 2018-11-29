


function closeDisplayCountries(idButton) {

    var id = idButton.target.id.split("_")[1];
    var nodeDisplay = document.getElementById( "country_"+id );
    if ( nodeDisplay != null ) nodeDisplay.parentNode.removeChild(nodeDisplay);

}

function displayCountries() {

    var item = document.getElementById( 'select_country' );
    var idCountry = document.getElementById( 'select_country' ).value;

    // Se comprueba que no existe el contenido anteriormente.
    if ( document.getElementById( "country_"+idCountry ) == null ) {

        var nameCountry = item.options[item.selectedIndex].text;

        var card_country = document.createElement('div');
        card_country.setAttribute('class', 'item-display');
        card_country.setAttribute('id', 'country_' + idCountry);

        card_country.innerHTML =
            nameCountry + "\n" +
            "<button id=\"btn_" + idCountry + "\" type=\"button\" class=\"close\" aria-label=\"Close\">\n" +
            "    <span aria-hidden=\"true\">&times;</span>\n" +
            "</button>";

        document.getElementById("display-select-country").appendChild(card_country);
        document.getElementById("btn_" + idCountry).addEventListener('click', closeDisplayCountries);
    }
}

function closeDisplayCompany(idButton) {

    var id = idButton.target.id.split("_")[1];
    var nodeDisplay = document.getElementById( "company_"+id );
    if ( nodeDisplay != null ) nodeDisplay.parentNode.removeChild(nodeDisplay);

}

function displayCompany() {

    var item = document.getElementById( 'select_company' );
    var idCompany = document.getElementById( 'select_company' ).value;

    // Se comprueba que no existe el contenido anteriormente.
    if ( document.getElementById( "company_"+idCompany ) == null ) {

        var nameCompany = item.options[item.selectedIndex].text;

        var card_country = document.createElement('div');
        card_country.setAttribute('class', 'item-display');
        card_country.setAttribute('id', 'company_' + idCompany);

        card_country.innerHTML =
            nameCompany + "\n" +
            "<button id=\"btn_" + idCompany + "\" type=\"button\" class=\"close\" aria-label=\"Close\">\n" +
            "    <span aria-hidden=\"true\">&times;</span>\n" +
            "</button>";

        document.getElementById("display-select-company").appendChild(card_country);
        document.getElementById("btn_" + idCompany).addEventListener('click', closeDisplayCompany);
    }
}

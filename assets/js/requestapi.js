let zipcode = document.getElementById('simulator_zipCode');
zipcode.addEventListener('input', function (e) {
    let postalCode = $('#simulator_zipCode').val();
    $('#simulator_city').empty();

    if (this.value.length === 5) {
        fetch("https://api-adresse.data.gouv.fr/search/?q=" + postalCode + "&limit=100")
            .then((resp) => resp.json())
            .then((data) => fillSelector(data.features))
    }
});

function fillSelector(data) {

    let selectElt = document.getElementById('simulator_city');

    for (cityData of data) {
        if (cityData.properties.city === cityData.properties.name) {

            let newOptionElt = document.createElement('option');
            newOptionElt.innerText = cityData.properties.postcode + ' ' + cityData.properties.city;
            newOptionElt.value = cityData.properties.citycode;

            selectElt.appendChild(newOptionElt);
        }
    }

}
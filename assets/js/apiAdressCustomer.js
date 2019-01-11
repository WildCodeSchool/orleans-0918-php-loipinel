let zipcode = document.getElementById('civil_status_customerZipCode');

window.addEventListener('load', function (e) {
    getCity();
});

zipcode.addEventListener('input', function (e) {
    getCity();
});

function getCity() {
    let postalCode = $('#civil_status_customerZipCode').val();
    $('#civil_status_customerCity').empty();

    if (postalCode.length === 5) {
        fetch("https://api-adresse.data.gouv.fr/search/?q=" + postalCode + "&limit=100")
            .then((resp) => resp.json())
            .then((data) => fillSelector(data.features, postalCode))
    }
}

function fillSelector(data, postalCode) {

    let selectElt = document.getElementById('civil_status_customerCity');
    let newOptionElt = document.createElement('option');
    newOptionElt.innerText = 'Veuillez sélectionner une commune';
    newOptionElt.value='';
    selectElt.appendChild(newOptionElt);
    let cities=[];
    for (cityData of data) {
        if (!cities.hasOwnProperty(cityData.properties.citycode) && (cityData.properties.citycode !== postalCode)){
            cities[cityData.properties.citycode] = cityData.properties.city;
            let newOptionElt = document.createElement('option');
            newOptionElt.innerText = cityData.properties.city;
            selectElt.appendChild(newOptionElt);
        }
    }
    if(selectElt.dataset.city) {
        selectElt.value =selectElt.dataset.city;
    }
}

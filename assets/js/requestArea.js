let acquisitionDate = document.getElementById('simulator_acquisitionDate');
let city = document.getElementById('simulator_city');

city.addEventListener('change', function (e){
acquisitionDate.addEventListener('change', function (e){
    let date = $('#simulator_acquisitionDate').val();
    let cityCode = $('#simulator_city').val();

    $('#simulator_zone').empty();
    fetch("/area/"+ date +"/"+ cityCode)
        .then((resp) => resp.json())
        .then((data)=>setArea(data))

})});

function setArea(area) {
    let selectElt = document.getElementById('simulator_zone');
    selectElt.value = area;
}

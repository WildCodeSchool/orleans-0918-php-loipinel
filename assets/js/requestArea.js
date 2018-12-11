let acquisitionDate = document.getElementById('simulator_acquisitionDate');
let city = document.getElementById('simulator_city');

function request(){
    let date = $('#simulator_acquisitionDate').val();
    let cityCode = $('#simulator_city').val();

    $('#simulator_zone').empty();
    fetch("/area/"+ date +"/"+ cityCode)
        .then((resp) => resp.json())
        .then((data)=>setArea(data))
}

city.addEventListener('change', function (e){
acquisitionDate.addEventListener('change', function (e){
    request();

})});

let date = $('#simulator_acquisitionDate').val();
if(date !== ""){
    city.addEventListener('change', function (e)
     {
        request();
     });
}
let cityCode = $('#simulator_city').val();
if(cityCode !== ""){
    date.addEventListener('change', function (e)
     {
         request();
     });
}

function setArea(area) {
    let selectElt = document.getElementById('simulator_zone');
    selectElt.value = area;
}

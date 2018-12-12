let acquisitionDate = document.getElementById('simulator_acquisitionDate');
let city = document.getElementById('simulator_city');

function request(){
    if(acquisitionDate.value && city.value ){
        console.log(city.value);
        let date = $('#simulator_acquisitionDate').val();
        let cityCode = $('#simulator_city').val();
        $('#simulator_zone').empty();
        fetch("/area/"+ date +"/"+ cityCode)
            .then((resp) => resp.json())
            .then((data)=>setArea(data))
    }
}

acquisitionDate.addEventListener('input', function (e){
    request();
});

city.addEventListener('change', function (e) {
    request();
});

function setArea(area) {
    let selectElt = document.getElementById('simulator_zone');
    selectElt.value = area;
}

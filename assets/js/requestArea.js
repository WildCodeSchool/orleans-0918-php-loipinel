let acquisitionDate = document.getElementById('finance_acquisitionDate');
let city = document.getElementById('finance_city');

function request(){
    if(acquisitionDate.value && city.value ){
        let date = $('#finance_acquisitionDate').val();
        let cityCode = $('#finance_city').val();
        $('#finance_zone').empty();
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
    let selectElt = document.getElementById('finance_zone');
    selectElt.value = area;
}


let area = document.getElementById('finance_zone');
let overlay = document.getElementById('overlay');
let btnClose = document.getElementById('btnClose');

area.addEventListener('input', function (e){
    openPopup();
});


function openPopup() {
    let area = document.getElementById('finance_zone');
    if(area.value === 'C'){
        overlay.style.display = 'block';
    }
}

btnClose.addEventListener('click', function(e){
    closePopup();
});


function closePopup() {
    overlay.style.display = 'none';
}
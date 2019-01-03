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

let modal = document.getElementById('modal');
let btnClose = document.getElementById('btnClose');
let area = document.getElementById('finance_zone');

function openPopup() {
    if(area.value ==='C'){
        modal.style.display = 'block';
    }
}

area.addEventListener('input', function (e){
    openPopup();
});


function closePopup() {
        modal.style.display = 'none';
}

btnClose.addEventListener('click', function(e){
    closePopup();
});

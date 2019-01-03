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
    if(area === 'C') {
        modal.style.display = 'block';
        $(function () {
            $('#modal').modal().close();
        });
    }
}

let modal = document.getElementById('modal');

let ctx = document.getElementById('graphic').getContext('2d');
var myPieChart = new Chart(ctx,{
    type: 'pie',
    data: {
        labels: ["Loyers", "Avantage fiscal", "Coût réel"],
        datasets: [{
            backgroundColor: [('#ff6384'), ('#36a2eb'), ('#cc65fe'),
                ],
            data: [10, 20, 30],
        }]
    },

    // Configuration options go here
    options: {}
});
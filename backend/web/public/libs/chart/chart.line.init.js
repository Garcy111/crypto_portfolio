$(function(){
        
$.ajax({
    url: "/admin/default/chart",
    type: "POST",
    dataType: "json",
    success: function(data) {
        var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        var randomColorFactor = function() {
            return Math.round(Math.random() * 255);
        };
        var randomColor = function(opacity) {
            return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
        };

        var config = {
            type: 'line',
            data: {
                labels: MONTHS,
                datasets: data
            },
            options: {
                responsive: true,
                title:{
                    display:false,
                    text:'Sales Analytics'
                },
                tooltips: {
                    mode: 'label',
                },
                hover: {
                    mode: 'dataset'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            show: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            show: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 10,
                        }
                    }]
                }
            }
        };
    
        $.each(config.data.datasets, function(i, dataset) {
            dataset.borderColor = randomColor(0.4);
            dataset.backgroundColor = randomColor(0.5);
            dataset.pointBorderColor = randomColor(0.7);
            dataset.pointBackgroundColor = randomColor(0.5);
            dataset.pointBorderWidth = 1;
        });


        var ctx = document.getElementById("sales-analytics").getContext("2d");
        window.myLine = new Chart(ctx, config);
    }
});

        

});
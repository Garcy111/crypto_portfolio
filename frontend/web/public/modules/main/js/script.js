$.fn.mytoggle = function () {
    var b = arguments;
    return this.each(function (i, el) {
        var a = function () {
            var c = 0;
            return function () {
                b[c++ % b.length].apply(el, arguments);
            };
        }();
        $(el).click(a);
    });
};

$(function() {

    var coinsName = [];
    var coinsVal = [];
    var coinsColor = [];
    $('.coins_form').find('input').each(function(i, e) {
        var coinName = $(e).attr('data-name');
        var coinVal = $(e).val();
        var coinColor = $(e).attr('data-color');

        coinsName[i] = coinName;
        coinsVal[i] = coinVal;
        coinsColor[i] = coinColor;
    });

    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: coinsVal,
                backgroundColor: coinsColor,
                label: 'Dataset 1'
            }],
            labels: coinsName
        },
        options: {
            responsive: true,
            legend: {
	            labels: {
	                fontColor: '#fff'
	            }
	        }
        }
    };

    window.onload = function() {
        var ctx = document.getElementById("chart-area").getContext("2d");
        window.myPie = new Chart(ctx, config);
    };

    
    // $('#total_usd').click(function() {
    //     $(this).hide();
    //     $('#total_rub').show();
    // });
    // $('#total_rub').click(function() {
    //     $(this).hide();
    //     $('#total_usd').show();
    // });

    $('.cur_active').mytoggle(function() {
        $(this).parent().find('.cur_list').slideDown(150);
    }, function() {
        $(this).parent().find('.cur_list').slideUp(100);
    });

    $('.body-curency .col-7').mytoggle(function() {
        $(this).parent().find('.edit-block').slideDown(100);
    }, function() {
        $(this).parent().find('.edit-block').slideUp(100);
    });
    
});
$(document).ready(function() {
$(window).load( function() {
		var winWidth = $(window).width();
		var conWidth;
		if(winWidth < 440) {
			conWidth = 300;
			col = 1;
		}
		else if(winWidth < 660) {
			conWidth = 440;
			col = 1
		} else if(winWidth < 880) {
			conWidth = 660;
			col = 2
		} else if(winWidth < 1200) {
			conWidth = 880;
			col = 3;
		} else {
			conWidth = 1200;
			col = 3;
		}

		$('#grid').show();
		$('#grid').width(conWidth);
		$('#grid').BlocksIt({
			numOfCol: col,
			offsetX: 5,
			offsetY: 5
		});
	});

	//window resize
	var currentWidth = 1200;
	$(window).resize(function() {
	var winWidth = $(window).width();
		var conWidth;
		if(winWidth < 440) {
			conWidth = 300;
			col = 1;
		}
		else if(winWidth < 660) {
			conWidth = 440;
			col = 1;
		} else if(winWidth < 880) {
			conWidth = 660;
			col = 2;
		} else if(winWidth < 1200) {
			conWidth = 880;
			col = 3;
		} else {
			conWidth = 1200;
			col = 3;
		}
		
		if(conWidth != currentWidth) {
			currentWidth = conWidth;
			$('#grid').width(conWidth);
			$('#grid').BlocksIt({
				numOfCol: col,
				offsetX: 5,
				offsetY: 5
			});
		}
	});
});
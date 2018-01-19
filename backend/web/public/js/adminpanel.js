$.fn.mytoggle = function() {
  var b = arguments;
  return this.each(function(i, el) {
    var a = function() {
        var c = 0;
        return function() {
            b[c++ % b.length].apply(el, arguments)
        }
    }();
    $(el).click(a)
  })
};

$(function(){
  $('.nav-part').hover(function(){
    $(this).find('.nav-child').slideDown(150);
  },
  function(){
    $(this).find('.nav-child').hide();
  });
});

$(function(){
  $('.flex-item').hover(function(){
    $(this).find('i').css({'fontSize': '93px', 'transition': '.3s'});
  },
  function(){
    $(this).find('i').css({'fontSize': '90px'});
  });
});

$(function(){
  $(document).on('click', '.del-tag', function(){
    var post_id = $(this).attr('data-post-id');
    var tag_id = $(this).attr('data-tag-id');
    $.ajax({
      url: "/admin/tags/delete-tag",
      type: "POST",
      data: {'post_id': post_id, 'tag_id': tag_id},
      success: function(){
        window.location.reload();
      }
    });
  });
});

// function isLocalStorageAvailable() {
//     try {
//         return 'localStorage' in window && window['localStorage'] !== null;
//     } catch (e) {
//         return false;
//     }
// }

function setHeiHeight() {
    $('body').css({
        height: $(window).height() + 'px'
    });
}

$(function(){
	setHeiHeight(); // устанавливаем высоту окна при первой загрузке страницы
	$(window).resize( setHeiHeight ); // обновляем при изменении размеров окна
});

// Показать окно менеджера изображений
$(function(){
	$('.im-btn').click(function(){
		$('#im-modal').arcticmodal();
	});
});

//close\open navigation
$(function(){
	$('.menu').mytoggle(function() {
		$('.nav').hide();
		$('.content, .content-post').css({marginLeft: 0});
	}, function() {
		$('.nav').show();
    $('.content, .content-post').css({marginLeft: '220px'});
	});
});

// close\open navigation
// $(function(){
// 	if (isLocalStorageAvailable()) {
// 		var pos = localStorage.getItem('pos_menu');
// 		if (pos == 'close') {
// 			// alert(pos);
// 			closeMenu();
// 		}
// 		if (pos === 'open') {
// 			openMenu();
// 		}
// 	}
// });

// $(function(){
// 	$('.menu').mytoggle(function() {
// 		openMenu();
// 		savePositionMenu('close');
// 	}, function() {
// 		closeMenu();
// 		savePositionMenu('open');
// 	});
// });

// function closeMenu() {
// 	$('.nav').hide();
// 	$('.content, .content-post').css({marginLeft: 0});
// }

// function openMenu() {
// 	$('.nav').show();
// }

// function savePositionMenu(action) {
// 	if (isLocalStorageAvailable()) {
// 		localStorage.setItem('pos_menu', action);
// 	}
// }
//end

// $(function(){
// 	if (isLocalStorageAvailable()) {
// 		// localStorage.clear();
// 		var idOpen, idClose;
// 		for (var i=0; i < localStorage.length; i++) {
// 			if (localStorage.key(i) === 'open') {
// 				idOpen = localStorage.getItem(localStorage.key(i));
// 				openChildElems(idOpen, 'show');
// 			}
// 			if (localStorage.key(i) === 'close') {
// 				idClose = localStorage.getItem(localStorage.key(i));
// 				closeChildElems(idClose, 'hide');
// 			}
// 		}
// 	}
// });


// function savePosition(id, action) {
// 	if (isLocalStorageAvailable()) {
// 		localStorage.setItem(action, id);
// 	}
// }

// function openChildElems(id, animate) {
// 	$('#' + id).parent().find('.nav-right').hide();
// 	$('#' + id).parent().find('.nav-down').show();
// 	var elems = $('#' + id).parent().find('li');
// 	if (animate === 'slide') {
// 		elems.slideDown();
// 	} else elems.show();
// }

// function closeChildElems(id, animate) {
// 	$('#' + id).parent().find('.nav-down').hide();
// 	$('#' + id).parent().find('.nav-right').show();
// 	var elems = $('#' + id).parent().find('li');
// 	if (animate === 'slide') {
// 		elems.slideUp();
// 	} else elems.hide();
// }

// $(function(){
// 	$('.slide-parent').mytoggle(function() {
// 		var id = $(this).attr('id');
// 		openChildElems(id, 'slide');
// 		savePosition(id, 'open');
// 	}, function() {
// 		var id = $(this).attr('id');
// 		closeChildElems(id, 'slide');
// 		savePosition(id, 'close');
// 	});
// });
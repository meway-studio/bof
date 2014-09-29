var offset = 0;

function startTime (id, simbol) {
	var today = new Date();
	var h = today.getHours();
	var m = today.getMinutes();
	m = (m < 10) ? "0" + m : m;
	simbol = (simbol != ':') ? ':' : ' ';
	var date = today.getDate() + '/' + (today.getMonth() + 1) + '/' + today.getFullYear() + ' ' + h + simbol + m;
	document.getElementById(id).innerHTML = date;
	setTimeout(function() {
		startTime(id, simbol)
	}, 1000);
}

$(document).ready(function() {

	startTime('clock');

	$(".cartAdd").click(function() {

		$.post($(this).data('url'), { tips_id: $(this).data('id') }, function(data) {

			$("#cart-count").text(data.count);
			$().toastmessage('showNoticeToast', data.message);

		}, 'json');

		return false;
	});

	$("#show7moretips").click(function() {
		offset = offset + 7;
		var url = $(this).attr('href') + '/offset/' + offset;
		$.get(url, function(html) {

			$(html).find('table tr.rows').each(function(k, v) {

				if (v.outerHTML !== undefined) {
					$(".last-tips table").append(v.outerHTML);
				}
			});
		});

		return false;
	});

	var banner = $('.banner');
	if (banner.length) {
		setTimeout(function() {
			banner.fadeIn(1000);
		}, 2500);
	}

	var spoilerShow = false;
	$('.spoiler_showhide').click(function() {
		var obj = $(this);
		var article = obj.parents('.article');

		if (spoilerShow) {
			article.find('.spoiler .hide').click();
		}
		else {
			article.find('.spoiler .show').click();
		}
	});
	$('.article .spoiler .show').click(function() {
		var obj = $(this);
		var article = obj.parents('.article');
		article.find('.spoiler-text').show();
		article.removeClass('spoiler-hidden').addClass('spoiler-visible');
		article.find('.spoiler .hide').show();
		obj.hide();
		spoilerShow = true;
	});
	$('.article .spoiler .hide').click(function() {
		var obj = $(this);
		var article = obj.parents('.article');
		article.find('.spoiler-text').hide();
		article.removeClass('spoiler-visible').addClass('spoiler-hidden');
		article.find('.spoiler .show').show();
		obj.hide();
		spoilerShow = false;
	});
});

$(document).ready(function() {
	$(document).scroll(function() {
		var us = $(".guidline-us, .about-us");
		var usHeight = parseInt(us.height()) + parseInt(us.css('padding-top')) + parseInt(us.css('padding-bottom'));
		var left = $(".guidline-left, .about-left");
		var leftHeight = parseInt(left.height()) + parseInt(left.css('padding-top')) + parseInt(left.css('padding-bottom'));
		var offset = us.offset().top - 60;
		var scrollYBottom = parseInt($('#offset-br-fixed').offset().top) - leftHeight + 200;
		var stop = parseInt(us.offset().top) + usHeight;

		if (scrollYBottom < stop) {
			if (scrollY > (offset)) {
				left.css({"margin-top": (scrollY - offset)});
			}
			else {
				left.css({"margin-top": 0});
			}
		}

		if (scrollY > 90) {
			$(".menu").css({
				"position": "fixed",
				"top": "0px",
				"left": "0px",
				"right": "0px",
				"z-index": "500"
			});
			$("#header").css({"margin-bottom": "60px"});
		}
		else {
			$(".menu").css({"position": "static"});
			$("#header").css({"margin-bottom": "0px"});
		}
	});
});
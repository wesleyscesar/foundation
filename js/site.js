var deviceAgent = navigator.userAgent.toLowerCase();
var iOS = deviceAgent.match(/(iphone|ipod|ipad)/);
var htmlScrollbar;

document.body.className = document.body.className.replace(/\bno\-js\b/gi, "");

$(document).ready(function () {

	// initialize custom scrollbar
	if (!iOS) {
		htmlScrollbar = $("html").niceScroll({
			cursoropacitymax   : 0.8,
			cursorcolor        : '#000',
			cursorwidth        : "8px",
			cursorborder       : 'none',
			cursorborderradius : '6px',
			cursorminheight    : 50,
			mousescrollstep    : 50,
			grabcursorenabled  : false,
			dblclickzoom       : false
		});
	}

	// initialize tooltips
	$('.tooltip').tipsy({
		fade    : true,
		live    : true,
		opacity : 0.9,
		offset  : 3,
		gravity : $.fn.tipsy.autoNS
	});

	$('form .help').tipsy({
		trigger  : 'focus',
		opacity  : 0.9,
		offset   : 3,
		gravity  : $.fn.tipsy.autoWE
	});

	$('.tabs').tabify();

	$('.rotator .prev, .rotator .next').click( function (e) {
		$parent = $(this).parent();
		if ($(this).hasClass("next")) {
			$('.rotator-item:eq(0)',$parent).appendTo($parent);
		} else {
			$('.rotator-item:eq(-1)',$parent).prependTo($parent);
		}
		e.preventDefault();
		$('.prev,.next',$parent).appendTo($parent);
		$('.rotator-item',$parent).removeClass('first-child').eq(0).addClass('first-child');
	});
	$('.rotator .rotator-item:eq(0)').addClass("first-child");

	// initialize supersized plugin, only if it's placed in the markup
	if ($("#supersized").length > 0) {
		$.supersized({
			horizontal_center : 1,
			vertical_center   : 1,
			slideshow         : 1,
			autoplay          : 1,
			transition        : 1,
			transition_speed  : 500,
			image_protect     : 1,
			slides            : supersized_slides
		});

		theme = {
			beforeAnimation : function(state) {
				$('#supersized-info h2')
					.html(api.getField('article_title'))
					.attr('href',api.getField('article_url'));
				$('#supersized-info p').html(api.getField('article_text'));
			}
		}
		$('.supersized-prev, .supersized-next').click( function (e) {
			if ($(this).hasClass("supersized-next")) {
				api.nextSlide();
			} else if ($(this).hasClass("supersized-prev")) {
				api.prevSlide();
			}
			e.preventDefault();
		});
	}

	$('.accordion .accordion-title').click(function(e){
		$li = $(this).parent('li');
		$ul = $li.parent('.accordion');
		// check if only one accordion can be opened at a time
		if ($ul.hasClass('only-one-visible')) {
			$('li',$ul).not($li).removeClass('active');
		}
		$li.toggleClass('active');
		e.preventDefault();
	});

	$('#menu li').hover(
		function () {
			$(this).addClass("hover");
		},
		function () {
			$(this).removeClass("hover");
		}
	);

	$('#menu li.arrow a').click( function (e) {
		$el = $(this).parent();
		if ($el.hasClass('arrow')) {
			$el.toggleClass("hover");
			if ($el.parents('#menu').hasClass('mobile')) {
				$el.toggleClass('show-menu');
				if (!iOS) htmlScrollbar.resize();
			}
			e.preventDefault();
		}
	});

	$('#menu-switch').click(function(e) {
		$(this).toggleClass('on');
		$('#header nav').toggleClass('mobile');
		if (!iOS) htmlScrollbar.resize();
		return false;
	});

	$(document).click(function(e) {
		if ($(e.target).parents('#header nav').length > 0) return;
		$('#menu-switch').removeClass('on');
		$('#header nav').removeClass('mobile');
		if (!iOS) htmlScrollbar.resize();
	});

	$top_link = $('#top-link');
	$top_link.click(function(e) {
		$('html, body').animate({scrollTop:0}, 750, 'linear');
		e.preventDefault();
		return false;
	});

	$(window).scroll(function () {
		var nScrollY = $(window).scrollTop();
		var headerHeight = $('#header').outerHeight();
		if (nScrollY >= headerHeight) {
			if ($('#header').hasClass('normal-size')) {
				$('#header').addClass('small-size').removeClass('normal-size');
				if (!iOS) htmlScrollbar.resize();
			}
		} else {
			if ($('#header').hasClass('small-size')) {
				$('#header').addClass('normal-size').removeClass('small-size');
				if (!iOS) htmlScrollbar.resize();
			}
		}
		// uncomment if you prefer the "Go To Top" link to be shown when window is scrolled down (fixed position in css)
		// if (nScrollY > 300) {
		// 	$top_link.fadeIn(500);
		// } else {
		// 	$top_link.fadeOut(250);
		// }
	});

	$(window).smartresize(function() {
		$('#menu-switch').removeClass('on');
		$('#header nav').removeClass('mobile');
	});
});
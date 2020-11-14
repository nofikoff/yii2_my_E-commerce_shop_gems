

$(document).ready(function(){
	// clone DOM
	$('.nav-list').clone().prependTo('.main-menu__popup').addClass('nav-mobile');
	$('<div class="mobile-link__drop"></div>').appendTo('.main-menu__popup .nav-item');

	// mobile nav slider
	$('.mobile-link__drop').click(function() {
		$(this).toggleClass('js-active');
		$(this).siblings('.nav-drop').slideToggle(400);
	});

	$('#mnu_grid_step1').click(function() {
		$('#mnu_s2').addClass('chactive_step');
		$('#mnu_s3').addClass('chactive_step');
		$('#mnu_s1').removeClass('chactive_step');
		$('.cart_tab_blok').css({
			backgroundColor: '#fff'
		});
	});

	$('#mnu_grid_step2').click(function() {
		$('#mnu_s3').addClass('chactive_step');
		$('#mnu_s1').addClass('chactive_step');
		$('#mnu_s2').removeClass('chactive_step');

	});
	$('#mnu_grid_step3').click(function() {
		$('#mnu_s2').addClass('chactive_step');
		$('#mnu_s1').addClass('chactive_step');
		$('#mnu_s3').removeClass('chactive_step');
	});

	$('.search_butt').click(function() {
		$('.searchForm').fadeToggle(500, function() {
			$('.searchForm').css({
				display: 'blok'
			});
		});
	});

	$('#tab1').click(function() {
		$('.cart_tab_blok').removeClass('cart_tab_blok_big');
		$('#step2').addClass('tab_hidden');
		$('#step3').addClass('tab_hidden');
		$('#step1').removeClass('tab_hidden');
		$('#ghgh').css({
			background: 'url(pic/btn2.png) no-repeat center center',
			color: '#4d4d4d'
		});
		$('.dost_price').css({
			display: 'none'
		});
		$(".cart_tab_blok").css({
			background: '#fff'
		});

	});

	$('#tab2').click(function() {
		$('.cart_tab_blok').addClass('cart_tab_blok_big');
		$('#step3').addClass('tab_hidden');
		$('#step1').addClass('tab_hidden');
		$('#step2').removeClass('tab_hidden');
		$('#ghgh').css({
			background: 'url(pic/btn2.png) no-repeat center center',
			color: '#4d4d4d'
		});
		$('.dost_price').css({
			display: 'block'
		});
		$(".cart_tab_blok").css({
			background: '#FBF9FA'
		});


	});
	$('#tab3').click(function() {
		$('#step2').addClass('tab_hidden');
		$('#step1').addClass('tab_hidden');
		$('#step3').removeClass('tab_hidden');
		$('#ghgh').css({
			background: 'url(pic/ghgh.png) no-repeat center center',
			color: '#fff'
		});
		$('.dost_price').css({
			display: 'block'
		});
		$(".cart_tab_blok").css({
			background: '#F2F2F2'
		});

	});


	$('.cart_tab').click(function() {
		$('.cart_tab').removeClass('active_tab');
		$('.cart_tab').removeClass('chactive');
		$(this).addClass('active_tab');
		$(this).prev('.cart_tab').addClass('chactive');

	});

	$('.punkt_pay').click(function() {

		$('.punkt_pay .radio_p').attr({
			src: 'pic/radio.png'
		});

		$(this).children('.radio_p').attr({
			src: 'pic/radio_checked.png'
		});
	});

	$('.title_form').click(function() {
		var par = $(this).parent('.ndost');

		par.find('.radio_b').attr({
			src: 'pic/radio.png'
		});
		$(this).children('.radio_b').attr({
			src: 'pic/radio_checked.png'
		});
	});
	$('.punkt_form').click(function() {
		$('.punkt_form .radio_b').attr({
			src: 'pic/radio.png'
		});
		$(this).children('.radio_b').attr({
			src: 'pic/radio_checked.png'
		});
		
	});

	//sart placeholder
	if (!Modernizr.input.placeholder) 
	{
		$('input[placeholder]').each(function(){
			var el = $(this);
			var ph = el.attr('placeholder')
			if(el.val() == ''){el.val(ph)}
			el.focus(function(){
				if(el.val() == ph){el.val('')}
			}).blur(function(){
				if(el.val() == ''){el.val(ph)}
			})
		})
	}

	$('.owl-carousel').owlCarousel({
	    center: true,
	    items:1,
	    loop:true,
	    nav: true,
	    navText: ["<span class='controller' id='left'><i class='fa fa-angle-left'></i></span>",
		"<span class='controller' id='right'><i class='fa fa-angle-right'></i></span>"],
	    autoPlay: 3000,
	    stopOnHover: true
	});

	$('.breadcrumbs a').each(function(){
		var nav_el = $(this);	
		nav_el.after('<ins>&nbsp;&raquo;&nbsp;</ins>').css({padding:'0'})
	});

	$('.tabsContent').hover(function() {
		$(this).removeClass('ind');
	}, function() {
		$(this).addClass('ind');
	});

	$('.feedback').click(function() {
		$('.feedback_popup').fadeToggle(900, function() {
			$('.feedback_popup').css({
				display: 'block'
			});
		});
	});
	$('.mnu_cb').click(function() {
		$('.feedback_popup').fadeToggle(900, function() {
			$('.feedback_popup').css({
				display: 'block'
			});
		});
	});
	$('.close').click(function() {
		$('.feedback_popup').fadeToggle(900, function() {
			$('.feedback_popup').css({
				display: 'none'
			});
		});
	});

	var menu_drop = $('.mainMenu_popup');
	$('.mob_mnu').click(function() {
	    $('html, body').addClass('js--active');
		menu_drop.addClass('mainMenu_popup_active');
	});

	$('.main-menu__close').click(function() {
	    $('html, body').removeClass('js--active');
		menu_drop.removeClass('mainMenu_popup_active');
	});
  $(document).mouseup(function (e){
    if (!menu_drop.is(e.target) && menu_drop.has(e.target).length === 0){
		$('html, body').removeClass('js--active');
		menu_drop.removeClass('mainMenu_popup_active');
    }
  });

	$('.hb1').click(function() {
		$('.add_otziv').addClass('act_add_otziv');
		$('.hb1').css({
			display: 'none'
		});
		$('.hb2').css({
			display: 'block'
		});
	});
	$('.hb2').click(function() {
		$('.add_otziv').removeClass('act_add_otziv');
		$('.hb2').css({
			display: 'none'
		});
		$('.hb1').css({
			display: 'block'
		});
	});



	$('.radio').click(function() {
		if ($(this).children('i').hasClass('fa-circle-o')) {
			$(this).children('i').removeClass('fa-circle-o').addClass('fa-check-circle-o');
		} else {
			$(this).children('i').removeClass('fa-check-circle-o').addClass('fa-circle-o');
		}
	});

	$('#phone').focusout(function() {
		if ($(this).val().length < 10) {
			$('.submit').prop("disabled", true);
			$('.phone_error').css({
				display: 'block'
			});
			$('.phone_error').text("номер телефона должен быть больше 10 цифр.");
		}
		if ($(this).val().length >= 10) {
			$('.submit').prop("disabled", false);
			$('.phone_error').css({
				display: 'none'
			});;
		}
		
	});



});


/* https://blog.bitsrc.io/lazy-loading-images-using-the-intersection-observer-api-5a913ee226d */
document.addEventListener("DOMContentLoaded", function() {
	const imageObserver = new IntersectionObserver((entries, imgObserver) => {
		entries.forEach((entry) => {
			if (entry.isIntersecting) {
				const lazyImage = entry.target
				//console.log("lazy loading ", lazyImage)
				lazyImage.src = lazyImage.dataset.src
			}
		})
	});
	const arr = document.querySelectorAll('[data-src]');
	arr.forEach((v) => {
		imageObserver.observe(v);
	})
});
///////////////////////////////////////////////////////////////////////


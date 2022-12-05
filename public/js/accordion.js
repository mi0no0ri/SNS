'use strict';

// accordion menu
$(function () {
	$('.accordion_menu h3').on('click', function () {
		$(this).next().slideToggle();
		$(this).toggleClass("hidden");
	});
});

$('.accordion_menu').on('click', function () {
	$('h3').toggleClass('selected');
});

// モーダル
$(function () {
	$('.modal_btn').on('click', function () {
		var target = $(this).data('target');
		var modal = document.getElementById(target);
		$("#edit_content").val($(this).val());
		$(modal).fadeIn();
		return false;
	});
	$('.modal_close').on('click', function () {
		$('.modal_main').fadeOut();
	});
});

// プロフィール
$(function () {
	$('#profile_post').on('click', function () {
		$('.profile_post').removeClass('disable');
		$('.profile_favo').addClass('disable');
	});
	$('#profile_favo').on('click', function () {
		$('.profile_favo').removeClass('disable');
		$('.profile_post').addClass('disable');
	});
})

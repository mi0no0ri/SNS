'use strict';

$(function(){
	$('.accordion_menu h3').on('click',function(){
	  $(this).next().slideToggle();
	  $(this).toggleClass("hidden");
	});
  });
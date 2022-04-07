<script type="text/javascript">
$(function(){
	$('.Q > span').click(function(){
		$($(this).parent('.Q')).toggleClass('selected');
		$($(this).parent('.Q')).next('.A').slideToggle('fast');
	});
});
</script>

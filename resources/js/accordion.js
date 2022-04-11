<script>
'use strict';

$(document).ready(function(){
	$('.accordion_menu h3').on('click',function(){
		$(this).next().toggleClass('hidden');
	})
});
</script>

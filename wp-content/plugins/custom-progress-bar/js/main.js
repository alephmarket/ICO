(function ($) {
    $(function () {
		
		jQuery(document).ready(function($){
		
			
			// percentcircle_area

			$('.percentcircle').percentcircle({
			animate : true,
			diameter : 100,
			guage: 3,
			coverBg: '#fff',
			bgColor: '#efefef',
			fillColor: '#DA4453',
			percentSize: '18px',
			percentWeight: 'normal'
			});
			
        });
    });
})(jQuery);
jQuery(document).ready(function() {
	var gallery = jQuery('.idf_stock_gallery');
	if (gallery !== undefined && gallery.length > 0) {
		jQuery(gallery).show();
		openLB(gallery);
	}

	jQuery('.idf_stock_item_wrapper').click(function(e) {
		e.preventDefault();
		var item = jQuery(this).children('img');
		var url = jQuery(item).attr('src');
		if (url.length > 0) {
			jQuery.ajax({
				url: idf_ajaxurl,
				type: 'POST',
				data: {action: 'idf_stock_item_click', Url: url},
				success: function(res) {
					console.log(res);
					
				}
			});
		}
	});
});
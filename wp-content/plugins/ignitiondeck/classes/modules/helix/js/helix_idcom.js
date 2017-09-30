jQuery(document).ready(function() {
	jQuery('.helix-popup-logo-link .unlisted').click(function(e) {
		var userID = jQuery('.helix-popup-logo-link').data('id');
		if (userID > 0) {
			jQuery.ajax({
				url: idf_ajaxurl,
				type: 'POST',
				data: {action: 'idhelix_join_waitlist_ajax', USERID: userID},
				success: function(res) {
					//console.log(res);
					if (res > 0) {
						jQuery('.helix-popup-logo-link a').removeClass('unlisted');
						jQuery('span.waitlist-length').text(res);
						var img = jQuery('.helix-popup-logo-link a img').attr('src').replace('.png', '');
						jQuery('.helix-popup-logo-link a img').attr('src', img + '-saved.png');
					}
				}
			});
		}
	});
})
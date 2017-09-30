jQuery(document).ready(function() {
	jQuery('.ignitiondeck .add_media').click(function(e) {
		var button = jQuery(this);
		if (jQuery('body.wp-admin').length <= 0 ){
			//button = jQuery(this).id;
		}
		var inputID = jQuery(button).data('input');

		// use this trigger to prep your inputs
		jQuery(document).trigger('idfMediaPopup', inputID);
		wp.media.editor.send.attachment = function(props, attachment) {
			var attachID = jQuery(document.getElementById(inputID)).val(attachment.id);
			// Triggering an event that media is selected, passing attachment id as argument
			attachment.inputID = inputID;
			jQuery(document).trigger('idfMediaSelected', [attachment]);
		};
		wp.media.editor.open(button);
		return false;
	});
});
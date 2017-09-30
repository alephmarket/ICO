jQuery(document).ready(function() {
     "use strict";
     var numIcons = jQuery('.nav-icons li').size() - 1;
     var iconHeight = jQuery('.nav-icons li').eq(numIcons - 1).height() + (jQuery('.nav-icons li').eq(numIcons - 1).css('padding-top').replace('px', '') * 2);
     var lastOffset = jQuery('.nav-icons li').eq(numIcons - 1).position().top;
     var offsetMax = parseInt(lastOffset) + parseInt(iconHeight);
     var loggedOut = jQuery(".logged-out");
     logoCheck(iconHeight, offsetMax);
     jQuery(window).resize(function(e) {
          lastOffset = jQuery('.nav-icons li').eq(numIcons - 1).position().top;
          offsetMax = parseInt(lastOffset) + parseInt(iconHeight);
          logoCheck(iconHeight, offsetMax);
     });
     function logoCheck(iconHeight, offsetMax) {
          if (jQuery(window).height() - (iconHeight * 2) <= offsetMax) {
               jQuery('.helix-logo').fadeOut('fast');
          }
          else {
               jQuery('.helix-logo').fadeIn('fast');
          }
     }
  
  
     if (loggedOut.length <= 0) { 
          jQuery('.idhelix').hover(function() {
     	    jQuery('.helix-logo > div').toggleClass('pop-out-content pop-out-content-visible');
          });
     }
     else {
          jQuery('.idhelix .helix-logo').click(function() {
               jQuery('.helix-logo > div').toggleClass('pop-out-content pop-out-content-visible');
          });
     }
  
  
     jQuery('.login-frame #helix_login_user').attr( 'placeholder', 'Your User Name' );
     jQuery('.login-frame #helix_login_pass').attr( 'placeholder', 'Your Password' );
     jQuery('.login-frame .login-password').after(jQuery('.login-frame .helix-error'));
     var jQuerydashboardNavLeft = jQuery( ".dashboard-nav.left" ),
     jQuerydashboardNavRight = jQuery( ".dashboard-nav.right" ),
     jQuerynavIconsLeft = jQuerydashboardNavLeft.find( ".nav-icons" ),
     jQuerynavContentLeft = jQuerydashboardNavLeft.find( ".nav-content" ),
     jQuerynavIconsRight = jQuerydashboardNavRight.find( ".nav-icons" ),
     jQuerynavContentRight = jQuerydashboardNavRight.find( ".nav-content" ),
     jQuerynavContentLink = jQuery('.dashboard-nav li a'),
     $loggedOut = jQuery( ".logged-out" );

     if(typeof(Storage) !== "undefined") {
          var helix_session = Math.random();
          localStorage.setItem('helix_session', helix_session);
          if (localStorage.helix_state == 'open') {
               jQuery('.dashboard-nav').removeClass('close-menu').addClass('open');
          }
     }

     jQuery('.helixopen').click(function(e) {
          e.preventDefault();
          if (jQuery('.dashboard-nav').hasClass('active')) {
               localStorage.setItem('helix_state', 'closed');
               Query('.dashboard-nav').removeClass('active').addClass('close-menu');
               jQuery('.helix_avatar').addClass('active');
          }
          else {
               jQuery('.dashboard-nav').removeClass('close-menu').addClass('active');
               jQuery('.helix_avatar').removeClass('active open');
          }
     });


     jQuerydashboardNavLeft.find('.close-list').on({
          click : function (evt){
               jQuerydashboardNavLeft.addClass('close-menu').removeClass('active open');
               localStorage.setItem('helix_state', 'closed');
               jQuery('.helix_avatar').addClass('active');
          }
     });

     jQuerydashboardNavRight.find('.close-list').on({
          click : function (evt){
               jQuerydashboardNavRight.addClass('close-menu').removeClass('active open');
               localStorage.setItem('helix_state', 'closed');
               jQuery('.helix_avatar').addClass('active');
          }
     });

     if (idf_logged_in == "0") {
          jQuerydashboardNavLeft.find('.close-list.login-frame').unbind('click');
          jQuerydashboardNavRight.find('.close-list.login-frame').unbind('click');
     }

     jQuerynavIconsLeft.on({
          mouseenter : function() {
               if( !$loggedOut.length ){
                    jQuerynavContentLeft.children().eq( jQuery(this).index() ).addClass('active');
               }
               else{
                    if( jQuery(this).index() > 2 ){
                         jQuerynavContentLeft.children().eq( jQuery(this).index() ).addClass('active');
                    }
               }
          },
          mouseleave : function () {
               jQuerynavContentLeft.children().eq( jQuery(this).index() ).removeClass('active');
          }
     }, 'li');

     jQuerynavIconsRight.on({
          mouseenter : function() {
               if( !$loggedOut.length ){
                    jQuerynavContentRight.children().eq( jQuery(this).index() ).addClass('active');
               }
               else{
                    if( jQuery(this).index() > 2 ){
                         jQuerynavContentRight.children().eq( jQuery(this).index() ).addClass('active');
                    }
               }
          },
          mouseleave : function () {
               jQuerynavContentRight.children().eq( jQuery(this).index() ).removeClass('active');
          }
     }, 'li');

     jQuery(jQuerynavContentLink).click(function(e) {
          if (helix_session !== 'undefined') {
               localStorage.setItem('helix_state', 'open');
          }
     });

	jQuery('.login-frame [name="wp-submit"]').click(function(e) {
		var error = false;
		var blank_username = false;
		var blank_password = false;
		if (jQuery('.login-frame input[name="log"]').val() === "") {
			error = true;
			blank_username = true;
		}
		if (jQuery('.login-frame input[name="pwd"]').val() === "") {
			error = true;
			blank_password = true;
		}
		// there is an error, output it
		if (error && (blank_username || blank_password)) {
			jQuery('.login-frame .login-password').after(jQuery(
				'.login-frame .helix-error'));
			jQuery('.login-frame .helix-error.blank-field').show();
			return false;
		} else if (error) {
			return false;
		}
		jQuery('.login-frame .helix-error').hide();
		return true;
	});
});
"use strict";
function isJson(str) {
	try {
		JSON.parse(str);
	} catch (e) {
		return false;
	}
	return true;
}
function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	var expires = "expires=" + d.toUTCString();
	document.cookie = cname + "=" + cvalue + "; " + expires;
}
jQuery(document).ready(function () {
	setCookie('woocommerce_cart_hash', 'currency_changed', 1);
	var wmc_rate_time_block = jQuery('#div_temp_setting_update_rate_time').children('tbody').html();
	jQuery('#div_temp_setting_update_rate_time').remove();
	jQuery('input#wmc_auto_update_rates').closest('tr').after(wmc_rate_time_block);
	jQuery('#wmc_auto_update_time_type').select2();
	jQuery("#wmc_auto_update_rates_time").on("keypress keyup blur", function (event) {
		jQuery(this).val(jQuery(this).val().replace(/[^\d].+/, ""));
		if (event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) {
			return true;
		}
		else if ((event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});
	jQuery(".wmc_rate").on("keypress keyup blur", function (event) {
		jQuery(this).val(jQuery(this).val().replace(/[^0-9\.]/g, ''));
		if (event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) {
			return true;
		}
		else if ((event.which != 46 || jQuery(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});
	if (jQuery("input[name='wmc_rate[]']").length > 1) {
		jQuery('.btn_delete').attr('disabled', false);
		jQuery('.btn_get_exchange').attr('disabled', false);
	}
	else {
		jQuery('.btn_delete').attr('disabled', true);
		jQuery('.btn_get_exchange').attr('disabled', true);
	}
	jQuery('.wmc_sort').sortable();
	jQuery('#btn_add_curr').click(function () {
		var temp_currency = jQuery('#temcurrency').html();
		jQuery('#wmc_sort').append(temp_currency);
		jQuery('#wmc_sort #temp_wmc_hidden_is_main').attr('name', 'wmc_hidden_is_main[]').attr('id', 'wmc_hidden_is_main');
		jQuery('#wmc_sort #temp_wmc_is_main').attr('name', 'wmc_is_main[]').attr('id', 'wmc_is_main').attr('class', 'wmc_is_main');
		jQuery('#wmc_sort #temp_wmc_currency').attr('name', 'wmc_currency[]').attr('id', 'wmc_currency').select2();
		jQuery('#wmc_sort #temp_wmc_pos').attr('name', 'wmc_pos[]').attr('id', 'wmc_pos').select2();
		jQuery('#wmc_sort #temp_wmc_rate').attr('name', 'wmc_rate[]').attr('id', 'wmc_rate');
		if (jQuery("input[name='wmc_rate[]']").length > 1) {
			jQuery('.btn_delete').attr('disabled', false);
			jQuery('.btn_get_exchange').attr('disabled', false);
		}
	});

	jQuery('.wmc_is_main').click(function () {
		jQuery('.wmc_is_main').next('input[type=hidden]').val(0);
		jQuery('.wmc_is_main').prop('checked', 0);
		jQuery(this).next('input[type=hidden]').val(1);
		jQuery(this).prop('checked', 1);
	});
	jQuery('.num_of_dec').on("keypress keyup blur", function (event) {
		jQuery(this).val(jQuery(this).val().replace(/[^\d].+/, ""));
		if (event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) {
			return true;
		}
		else if ((event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});

	jQuery('.wmc_is_main').live('change', function () {
		var old_rate = jQuery("input[name='wmc_rate[]']")
			.map(function () {
				return jQuery(this).val();
			}).get();
		var radioButtons = jQuery('.wmc_is_main');
		var selectedIndex = radioButtons.index(radioButtons.filter(':checked'));
		var selected_rate = old_rate[selectedIndex];
		if (selected_rate < 0) selected_rate = selected_rate * (-1);
		for (var i = 0; i < old_rate.length; i++) {
			if (old_rate[i] < 0) old_rate[i] = old_rate[i] * (-1)
			jQuery("input[name='wmc_rate[]']").eq(i).val(old_rate[i] / selected_rate);
			jQuery("input[name='wmc_rate[]']").eq(i).prop('readonly', false);
		}
		jQuery("input[name='wmc_rate[]']").eq(selectedIndex).prop('readonly', true);
	}).change();
	jQuery('.btn_get_exchange').live('click', function () {
		var currencies_list = jQuery("select[name='wmc_currency[]']")
			.map(function () {
				return jQuery(this).val();
			}).get();
		var radioButtons = jQuery('.wmc_is_main');
		var selectedIndex = radioButtons.index(radioButtons.filter(':checked'));
		var main_currency = currencies_list[selectedIndex];
		var second_currency = jQuery(this).parent().find("select[name='wmc_currency[]']").val();
		var _this = this;
		jQuery.post(
			ajaxurl,
			{
				'action'         : 'wmc_get_rate',
				'main_currency'  : main_currency,
				'second_currency': second_currency,
			},
			function (response) {
				if (isJson(response)) {
					response = JSON.parse(response);
				}
				if (jQuery.isArray(response)) {
					jQuery(_this).parent().find("input[name='wmc_rate[]']").val(response[0]);
				}
				else {
					alert('Failed! Check your internet connection.');
				}
			}
		);
	});

	jQuery('.btn_delete').live('click', function () {
		if (confirm(jQuery('#btn_delete').data('confirm'))) {
			var is_main = jQuery(this).parent().find("input[type=hidden]").val();
			jQuery(this).parent().remove();
			if (is_main == 1) {
				jQuery('.wmc_is_main').eq(0).attr('checked', 'checked');
				jQuery("input[name='wmc_hidden_is_main[]']").eq(0).val(1);

				var old_rate = jQuery("input[name='wmc_rate[]']")
					.map(function () {
						return jQuery(this).val();
					}).get();
				var radioButtons = jQuery('.wmc_is_main');
				var selectedIndex = radioButtons.index(radioButtons.filter(':checked'));
				var selected_rate = old_rate[selectedIndex];
				if (selected_rate < 0) selected_rate = selected_rate * (-1);
				for (var i = 0; i < old_rate.length; i++) {
					if (old_rate[i] < 0) old_rate[i] = old_rate[i] * (-1)
					jQuery("input[name='wmc_rate[]']").eq(i).val(old_rate[i] / selected_rate);
				}
			}
			if (jQuery("input[name='wmc_rate[]']").length == 1) {
				jQuery('.btn_delete').attr('disabled', true);
				jQuery('.btn_get_exchange').attr('disabled', true);
				jQuery("input[name='wmc_rate[]']").prop('readonly', true);
			}
		}
	});

	jQuery('#btn_get_all_exchange').live('click', function () {
		jQuery('#getting_rates').show();
		jQuery('#btn_get_all_exchange').hide();
		var wmc_is_main = jQuery('.wmc_is_main');
		var wmc_currency = jQuery("select[name='wmc_currency[]']");
		var wmc_rate = jQuery("input[name='wmc_rate[]']");
		var selectedIndex = wmc_is_main.index(wmc_is_main.filter(':checked'));
		var currencies_list = jQuery("select[name='wmc_currency[]']")
			.map(function () {
				return jQuery(this).val();
			}).get();
		var main_currency = currencies_list[selectedIndex];
		jQuery.post(
			ajaxurl,
			{
				'action'         : 'wmc_get_rate',
				'main_currency'  : main_currency,
				'second_currency': currencies_list,
			},
			function (response) {
				if (isJson(response)) {
					response = JSON.parse(response);
				}
				if (jQuery.isArray(response)) {
					for (var i = 0; i < currencies_list.length; i++) {
						wmc_rate.eq(i).val(response[i]);
					}
				}
				else {
					alert('Failed! Check your internet connection.');
				}
				jQuery('#getting_rates').hide();
				jQuery('#btn_get_all_exchange').show();
			}
		);

	});
	jQuery('input#wmc_auto_update_rates').change(function () {
		if (jQuery(this).is(':checked')) {
			jQuery('#wmc_auto_update_rates_time').closest('tr').show();
		} else {
			jQuery('#wmc_auto_update_rates_time').closest('tr').hide();
		}
	}).change();
});
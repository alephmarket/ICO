<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<p><?php
	/* translators: 1: user display name 2: logout url */
	printf(
		__( 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce' ),
		'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
		esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )
	);
?></p>

<p><?php
	printf(
		__( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a> and <a href="%3$s">edit your password and account details</a><br><br><a href="#" class="myButton">REINVEST</a>
		<style>.myButton {
	-moz-box-shadow:inset 0px -9px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px -9px 0px 0px #ffffff;
	box-shadow:inset 0px -9px 0px 0px #ffffff;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ffffff), color-stop(1, #ffffff));
	background:-moz-linear-gradient(top, #ffffff 5%, #ffffff 100%);
	background:-webkit-linear-gradient(top, #ffffff 5%, #ffffff 100%);
	background:-o-linear-gradient(top, #ffffff 5%, #ffffff 100%);
	background:-ms-linear-gradient(top, #ffffff 5%, #ffffff 100%);
	background:linear-gradient(to bottom, #ffffff 5%, #ffffff 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ffffff',GradientType=0);
	background-color:#ffffff;
	-moz-border-radius:19px;
	-webkit-border-radius:19px;
	border-radius:19px;
	border:3px solid #bd26bd;
	display:inline-block;
	cursor:pointer;
	color:#666666;
	font-family:Arial;
	font-size:19px;
	font-weight:bold;
	padding:16px 48px;
	text-decoration:none;
}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ffffff), color-stop(1, #ffffff));
	background:-moz-linear-gradient(top, #ffffff 5%, #ffffff 100%);
	background:-webkit-linear-gradient(top, #ffffff 5%, #ffffff 100%);
	background:-o-linear-gradient(top, #ffffff 5%, #ffffff 100%);
	background:-ms-linear-gradient(top, #ffffff 5%, #ffffff 100%);
	background:linear-gradient(to bottom, #ffffff 5%, #ffffff 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ffffff',GradientType=0);
	background-color:#ffffff;
}
.myButton:active {
	position:relative;
	top:1px;
}</style>.', 'woocommerce' ),
		esc_url( wc_get_endpoint_url( 'orders' ) ),
		esc_url( wc_get_endpoint_url( 'edit-address' ) ),
		esc_url( wc_get_endpoint_url( 'edit-account' ) )
	);
?></p>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */

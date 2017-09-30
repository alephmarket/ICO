<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Utm_Switcher
 * @author    David Alberts and Jeff Shamley <mrrockgroin@gmail.com>
 * @license   GPL-2.0+
 * @link      https://jeffshamley.com
 * @copyright 2016
 */

?>

<div class="wrap">
    <h1><?php echo esc_html( __( 'UTM Switcher Help', 'utm-switcher' ) ); ?></h1>
	<h2 class="nav-tab-wrapper">
		<a href="<?php echo esc_html( admin_url( 'edit.php?post_type=utm_switcher&page=utm_switcher_ref_general' ) ); ?>" class="nav-tab"><?php esc_attr_e( 'General', 'utm-switcher' ); ?></a>
		<a href="<?php echo esc_html( admin_url( 'edit.php?post_type=utm_switcher&page=utm_switcher_ref_cf7' ) ); ?>" class="nav-tab nav-tab-active"><?php esc_attr_e( 'Contact Form 7', 'utm-switcher' ); ?></a>
	</h2>
	<h2><?php esc_attr_e( 'General Usage', 'utm-switcher' ); ?></h2>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">

						<h2><span><?php esc_attr_e( 'Main Content Header', 'utm-switcher' ); ?></span></h2>

						<div class="inside">
							<p><?php esc_attr_e( 'WordPress started in 2003 with a single bit of code to enhance the typography of everyday writing and with fewer users than you can count on your fingers and toes. Since then it has grown to be the largest self-hosted blogging tool in the world, used on millions of sites and seen by tens of millions of people every day.', 'utm-switcher'); ?></p>
						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->

				</div>
				<!-- .meta-box-sortables .ui-sortable -->

			</div>
			<!-- post-body-content -->

			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">

				<div class="meta-box-sortables">

					<div class="postbox">

						<h2><span><?php esc_attr_e('Sidebar Content Header', 'utm-switcher'); ?></span></h2>

						<div class="inside">
							<p><?php esc_attr_e('Everything you see here, from the documentation to the code itself, was created by and for the community. WordPress is an Open Source project, which means there are hundreds of people all over the world working on it. (More than most commercial platforms.) It also means you are free to use it for anything from your cat’s home page to a Fortune 500 web site without paying anyone a license fee and a number of other important freedoms.', 'utm-switcher'); ?></p>
						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->

				</div>
				<!-- .meta-box-sortables -->

			</div>
			<!-- #postbox-container-1 .postbox-container -->

		</div>
		<!-- #post-body .metabox-holder .columns-2 -->

		<br class="clear">
	</div>
	<!-- #poststuff -->
</div>

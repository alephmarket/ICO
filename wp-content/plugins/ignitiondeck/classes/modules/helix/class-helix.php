<?php

define( 'HELIX_PATH', plugin_dir_path(__FILE__) );
define( 'HELIX_URL', 'https://ignitiondeck.com/helix/');

Class Helix {

	function __construct() {
		$this->autoload();
		$this->set_filters();
	}

	private function autoload() {
		global $crowdfunding;
		//require dirname(__FILE__) . '/' . 'helix_hooks.php';
		require dirname(__FILE__) . '/' . 'helix-functions.php';
		require dirname(__FILE__) . '/' . 'helix-menu.php';
		require dirname(__FILE__) . '/' . 'helix-admin.php';
		require dirname(__FILE__) . '/' . 'helix-idcom.php';

		switch (idf_platform()) {
			case 'idc':
				if (idf_has_idc()) {
					require dirname(__FILE__) . '/' . 'inc/helix-idc.php';
				}
				break;
			case 'wc':
				require dirname(__FILE__) . '/' . 'inc/helix-wc.php';
				break;
			default:
				# do nothing
				break;
		}

		if (idf_crowdfunding()) {
			require dirname(__FILE__) . '/' . 'helix-idcf.php';
		}
	}

	private function set_filters() {
		add_action('id_set_module_status_before', array($this, 'helix_status_actions'), 10, 2);
		add_action('wp_enqueue_scripts', array($this, 'helix_scripts'));
		add_action('wp_head', array($this, 'helix_head'));
	}

	function helix_status_actions($module, $status) {
		if ($module == 'helix') {
			idf_flush_object('helix_params');
		}
	}

	function helix_scripts() {
		wp_register_script('helix_js', plugins_url('js/helix.js', __FILE__));
		wp_register_style('helix_icons', plugins_url('ignitiondeck-icons/style.css', __FILE__));
		wp_register_style('helix_css', plugins_url('css/styles-green.css', __FILE__));
		wp_enqueue_script('jquery');
		wp_enqueue_script('helix_js');
		wp_enqueue_style('helix_icons');
		wp_enqueue_style('helix_css');
	}

	function helix_head() {
		helix_display_menu();
	}
}

$helix = new Helix();
?>
<?php

define( 'MAVEN_PATH', plugin_dir_path(__FILE__) );

Class Maven {

	function __construct() {
		$this->autoload();
		$this->set_filters();
	}

	private function autoload() {
		require dirname(__FILE__) . '/' . 'class-maven_msg_init.php';
		require dirname(__FILE__) . '/' . 'class-maven_msg.php';
		require dirname(__FILE__) . '/' . 'class-maven_msg_single.php';
		require dirname(__FILE__) . '/' . 'class-maven_msg_team.php';
	}

	private function set_filters() {
		add_action('wp_enqueu_scripts', array($this, 'maven_scripts'));
	}

	function maven_status_actions($module, $status) {
		if ($module == 'maven') {
			idf_flush_object('maven_params');
		}
	}

	function maven_scripts() {

	}

}

$maven = new Maven();
?>
<?php
class ID_Dev_Tools {
	var $dev_mode;
	
	function __construct() {
		if (defined('ID_DEV_MODE')) {
			$this->dev_mode = ID_DEV_MODE;
		}
		else {
			$this->dev_mode = false;
		}
	}

	function dev_mode() {
		return $this->dev_mode;
	}
}
?>
<?php
class Maven_Msg {

	var $id;
	var $msg;
	
	function __construct($id_or_msg = null) {
		if (is_int($id_or_msg)) {
			$this->id = $id_or_msg;
			$this->msg = $this->get_message();
		}
		else if (is_object($id_or_msg)) {
			$this->msg = $id_or_msg;
		}
	}

	function get_message() {
		$msg = get_post($this->id);
		return $msg;
	}

	function save_message() {
		$id = wp_insert_post($this->msg);
		if (!is_wp_error($send)) {
			$this->id = $id;
			return $this->id;
		}
		else {
			return $id->get_error_msg();
		}
	}
}
?>
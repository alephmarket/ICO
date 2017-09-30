<?php
class IDF_Cache {

	function __construct($class = '', $method = '') {
		$this->set_filters();
	}

	private function set_filters() {
		//add_action('idf_activation', array($this, 'idf_flush_cache'));
		add_action('idf_cache_object', array($this, 'idf_cache_object'), 10, 3);
		add_action('idf_cache_object_event', array($this, 'idf_cache_object_event'), 10, 3);
	}

	function idf_flush_cache() {
		$transients = get_transient('idf_transient_cache');
		if (!empty($transients)) {
			foreach ($transients as $k=>$v) {
				delete_transient($k);
			}
		}
	}

	function idf_cache_object($transient = '', $object = null, $exp = 3600) {
		/*$transients = get_transient('idf_transient_cache');
		if (empty($transients)) {
			$transients = array();
		}
		$transients[$transient] = strtotime('now');
		set_transient('idf_transient_cache', $transients);*/
		set_transient($transient, $object, $exp);
	}

	function idf_cache_object_event($transient, $object, $exp) {
		set_transient($transient, $object, $exp);
	}

	function idf_get_object($transient) {
		return get_transient($transient);
	}

	function idf_flush_object($transient) {
		delete_transient($transient);
	}
}
$cache = new IDF_Cache(); 
?>
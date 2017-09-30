<?php
class ID_Modules {
	public static $PHP_EXTENSION = '.php';
	var $moddir;
	var $exdir;

	function __construct() {
		$this->exdir = array('cgi-bin', '.', '..');
		// run functions
		$this->set_moddir();
		$this->set_module_hooks();
		$this->load_modules();
	}

	function set_moddir() {
		$this->moddir = dirname(__FILE__). '/' . 'modules/';
	}

	private function set_module_hooks() {
		// add idc modules to idf menu
		add_filter('id_module_list', array($this, 'show_modules'));
		// check for change in module status
		add_action('init', array($this, 'module_status'));
		add_filter('id_modules', array($this, 'id_default_modules'));
		add_filter('id_module_list_wrapper_class', array($this, 'module_list_wrapper_class'), 10, 2);
	}

	function show_modules($modules) {
		// show modules in the IDF modules menu
		$id_modules = $this->get_modules();
		foreach ($id_modules as $module) {
			$thisfile = $this->moddir . $module;
			if (is_dir($thisfile) && !in_array($module, $this->exdir)) {
				$info = json_decode(file_get_contents($thisfile . '/' . 'module_info.json'), true);
				$new_module = (object) array(
					'title' => $info['title'],
					'short_desc' => $info['short_desc'],
					'link' => apply_filters('id_module_link', menu_page_url('idf-extensions', false) . '&id_module='.$module),
					'doclink' => $info['doclink'],
					'thumbnail' => plugins_url('modules/' . $module . '/thumbnail.png', __FILE__),
					'basename' => $module,
					'type' => $info['type'],
					'requires' => $info['requires'],
					'priority' => (isset($info['priority']) ? $info['priority'] : ''),
					'category' => (isset($info['category']) ? $info['category'] : ''),
					'tag' => (isset($info['tag']) ? $info['tag'] : ''),
				);
				if ($info['status'] == 'test') {
					// allow devs to activate
					if (defined('ID_DEV_MODE') && 'ID_DEV_MODE' == true) {
						$info['status'] = 'live';
						$new_module->short_desc .= ' '.__('(DEV_MODE)', 'idf');
					}
				}
				if ($info['status'] == 'live') {
					$modules[] = $new_module;
				}
			}
		}
		return $modules;
	}

	function get_modules() {
		$modules = array();
		$subfiles = scandir($this->moddir);
		foreach ($subfiles as $file) {
			$thisfile = $this->moddir . $file;
			if (is_dir($thisfile) && !in_array($file, $this->exdir) && substr($file, 0, 1) !== '.') {
				$modules[] = $file;
			}
		}
		return apply_filters('id_modules', $modules);
	}

	public function load_modules() {
		// Load the list of active modules
		$modules = self::get_active_modules();
		if (!empty($modules)) {
			foreach ($modules as $module) {
				$this->load_module($module);
			}
		}
	}

	public function get_module_home() {
		// Helps us find where the module is located

	}

	public function load_module($module) {
		// Loading the class file of the module
		if (file_exists($this->moddir . $module . '/' . 'class-' . $module . self::$PHP_EXTENSION)) {
			require_once $this->moddir . $module . '/' . 'class-' . $module . self::$PHP_EXTENSION;
		}
	}

	function module_status() {
		if (is_admin() && current_user_can('manage_options')) {
			if (isset($_GET['id_module'])) {
				$module = $_GET['id_module'];
				if (!empty($module)) {
					if (isset($_GET['module_status'])) {
						$status = $_GET['module_status'];
						do_action('id_set_module_status_before', $module, $status);
						$this->set_module_status($module, $status);
						do_action('id_set_module_status', $module, $status);
					}
				}
			}
		}
	}

	function id_default_modules($modules) {
		return $modules;
	}

	function module_list_wrapper_class($classes, $item) {
		if (!empty($item->category)) {
			$classes .= ' '.$item->category;
		}
		if (!empty($item->tag)) {
			$classes .= ' '.$item->tag;
		}
		return $classes;
	}

	public static function get_active_modules() {
		// Get list of active modules
		$modules = get_transient('id_modules');
		return apply_filters('id_modules', $modules);
	}

	public static function is_module_active($module) {
		$modules = self::get_active_modules();
		return (in_array($module, $modules));
	}

	public static function set_module_status($module, $status) {
		$modules = self::get_active_modules();
		switch ($status) {
			case true:
				if (empty($modules)) {
					$modules = array();
					$modules[] = $module;
				}
				else if (!in_array($module, $modules)) {
					$modules[] = $module;
				}
				break;
			default:
				// deactivate
				if (!empty($modules)) {
					if (in_array($module, $modules)) {
						foreach ($modules as $k=>$v) {
							if ($module == $v) {

								$elem = $k;
								break;
							}
						}
						if (isset($elem)) {
							unset($modules[$elem]);
						}
					}
				}
				break;
		}
		self::save_modules($modules);
	}

	public static function save_modules($modules = null) {
		set_transient('id_modules', $modules, 0);
	}
}
new ID_Modules();
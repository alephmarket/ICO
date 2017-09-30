<div class="wrap">
	<div class="extension_header">
		<h1><?php _e('IgnitionDeck Modules', 'idf'); ?><?php echo (idf_dev_mode() ? '<button class="bulk_deactivate_modules button left" onclick="idf_flush_object(\'id_modules\')">'.__('Flush Module Cache', 'idf').'</button>' : ''); ?></h1>
	</div>
	<?php
	foreach ($data as $item) {
		$title = $item->title;
		$desc = $item->short_desc;
		$link = $item->link;
		$doclink = $item->doclink;
		$thumbnail = $item->thumbnail;
		$basename = $item->basename;
		$installed = false;
		$active = false;
		$is_plugin = false;
		$text = __('Get Module', 'idf');
		$type = (isset($item->type) ? $item->type : 'plugin');
		$plugin_path = dirname(IDF_PATH).'/'.$basename.'/'.$basename.'.php';
		if (file_exists($plugin_path)) {
			// is an installed plugin
			$installed = true;
			$is_plugin = true;
			$text = __('Activate Plugin', 'idf');
			$link = '';//admin_url('/plugins.php/?idf_activate_extension='.$basename);
			if (is_plugin_active($basename.'/'.$basename.'.php')) {
				$active = true;
				$text = __('Installed', 'idf');
			}
		}
		if (!($is_plugin) && $type == 'module') {
			$new_status = (!empty($active_modules) && in_array($basename, $active_modules) ? 0 : 1);
			$link .= '&module_status='.$new_status;
			switch ($new_status) {
				case 1:
					$text = __('Activate', 'idf');
					break;
				
				case 0:
					$text = __('Deactivate', 'idf');
					break;
			}
		}
		?>
		<div class="<?php echo apply_filters('id_module_list_wrapper_class', 'extension', $item); ?>">
			<div class="extension-image" style="background-image: url(<?php echo $thumbnail; ?>);"></div>
			<p class="extension-desc"><?php echo $desc; ?></p>
			<div class="extension-link">
				<button class="button <?php echo (!$active && !$installed ? 'button-primary' : 'active-installed'); ?>" <?php echo (!empty($link) ? 'onclick="location.href=\''.html_entity_decode($link).'\'"' : ''); ?> <?php echo ($active ? 'disabled="disabled"' : ''); ?> data-extension="<?php echo $basename; ?>"><?php echo $text; ?></button>
				<?php if (!empty($doclink)) { ?>
					<button class="button" onclick="window.open('<?php echo $doclink; ?>')"><?php _e('Docs', 'idf'); ?></button>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
</div>
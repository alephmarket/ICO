<?php
function idf_fetch_stock($content = '') {
	$url = 'https://unsplash.com';
	/*$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

	$data = curl_exec($ch);
	curl_close($ch);
	*/
	$data = file_get_contents($url);
	$doc = new DOMDocument();
	@$doc->loadHTML($data);
	$images = $doc->getElementsByTagName('img');
	$photos = new stdClass();
	$i = 0;
	foreach ($images as $image) {
		$class = $image->getAttribute('class');
		$strpos = strpos($class, 'photo__image');
		if ($strpos !== false) {
			$photo = $image->getAttribute('src');
			$photos->$i = $photo;
		}
		$i++;
	}
	return $photos;
}

//add_action('the_content', 'idf_stock_test');

function idf_stock_test($content) {
	$photos = idf_fetch_stock();
	if (!empty($photos)) { 
		$content .= '<div class="idc_lightbox idf_stock_gallery" style="display: none;">';
		foreach ($photos as $photo) {
			$content .= '<a class="idf_stock_item_wrapper" href="#"><img class="idf_stock_item" src="'.$photo.'"/></a>';
		}
		$content .= '</div>';
	}
	return $content;
}

add_action('wp_ajax_idf_stock_item_click', 'idf_stock_item_click');

function idf_stock_item_click() {
	if (isset($_POST['Url'])) {
		$url = sanitize_text_field($_POST['Url']);
		if (!empty($url)) {
			$type = exif_imagetype($url);
			$extension = image_type_to_extension($type);
			$wp_upload_dir = wp_upload_dir();
			$file = $wp_upload_dir['path'].'/id_stock_'.uniqid().$extension;
			$copy = copy($url, $file);
			$title = preg_replace('/\.[^.]+$/', '', basename($file, $extension));
			$mime = mime_content_type($file);
			if ($copy) {
				$file_info = array(
					'name' => $title.$extension,
					'type' => $mime,
					'tmp_name' => $file,
					'error' => 0,
					'size' => filesize($file),
				);
				if ( ! function_exists( 'wp_handle_sideload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
				$sideload = wp_handle_sideload($file_info, array('test_form' => false));
				$attachment = array(
			    	'guid' => $sideload['url'], 
			    	'post_mime_type' => $mime,
			    	'post_title' => $title,
			    	'post_content' => '',
			    	'post_status' => 'inherit'
			  	);
			  	$insert = wp_insert_attachment($attachment, $sideload['file']);
			  	// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
				require_once (ABSPATH . 'wp-admin/includes/image.php');
				require_once (ABSPATH . 'wp-admin/includes/media.php');
				// Generate the metadata for the attachment, and update the database record.
				$attach_data = wp_generate_attachment_metadata($insert, $sideload['file']);
				wp_update_attachment_metadata($insert, $attach_data);
			}
		}
	}
	exit;
}
?>
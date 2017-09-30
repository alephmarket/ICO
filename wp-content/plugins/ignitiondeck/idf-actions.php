<?php
add_action('idf_transfer_key', 'idf_transfer_key');

function idf_transfer_key() {
	update_option('idf_transfer_key', 1);
}
?>
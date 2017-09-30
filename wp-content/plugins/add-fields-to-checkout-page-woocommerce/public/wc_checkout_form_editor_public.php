<?php



/**

 * The public-facing functionality of the plugin.

 *

 * @since      1.0.0

 *

 * @package    wc_checkout_form_editor

 * @subpackage wc_checkout_form_editor/public

 */



/**

 * The public-facing functionality of the plugin.

 *

 * Defines the plugin name, version, and two examples hooks for how to

 * enqueue the admin-specific stylesheet and JavaScript.

 *

 * @package    wc_checkout_form_editor

 * @subpackage wc_checkout_form_editor/public

 * @author     Junaid <junaidali.it@gmail.com>

 */

class WC_Checkout_Form_Editor_Public {



	/**

	 * The ID of this plugin.

	 *

	 * @since    1.0.0

	 * @access   private

	 * @var      string    $plugin_name    The ID of this plugin.

	 */

	private $plugin_name;



	/**

	 * The version of this plugin.

	 *

	 * @since    1.0.0

	 * @access   private

	 * @var      string    $version    The current version of this plugin.

	 */

	private $version;


	public $custom_heading;
	public $custom_heading_class;
	public $custom_heading_sort_key;
	public $custom_heading_order;
	public $custom_heading_data;



	/**

	 * Initialize the class and set its properties.

	 *

	 * @since    1.0.0

	 * @param      string    $plugin_name       The name of the plugin.

	 * @param      string    $version    The version of this plugin.

	 */

	public function __construct( $plugin_name, $version ) {



		$this->plugin_name = $plugin_name;

		$this->version = $version;

        $this->adhoc_calculator_options = get_option($this->plugin_name);



	}


function wcfe_woo_default_address_fields( $original ) {
		global $supress_field_modification;

		if($supress_field_modification){
			return $original;
		}
				
		$sname = 'billing';
		$fields = $original;
		$address_fields = get_option('wc_fields_'.$sname);
		
		if(is_array($address_fields) && !empty($address_fields) && !empty($fields)){	
			foreach($original as $name => $ofield) {
				$new_field = isset($address_fields[$sname.'_'.$name]) ? $address_fields[$sname.'_'.$name] : false;
				
				if($new_field && !( isset($new_field['enabled']) && $new_field['enabled'] == false )){
					if(isset($ofield['autocomplete'])){
						$new_field['autocomplete'] = $ofield['autocomplete'];
					}
					
					if(isset($new_field['required']) && $new_field['required']){
						$new_field['required'] = isset($ofield['required']) ? $ofield['required'] : 0;
					}
					
					$fields[$name] = $new_field;
				}
			}
		}
		
		return $fields;
	}	




/**
	 * wc_checkout_fields_modify_billing_fields function.
	 *
	 * @param mixed $old
	 */
	public function wcfe_billing_fields_lite($old){
		global $supress_field_modification;

		if($supress_field_modification){
			return $old;
		}

		return $this->wcfe_prepare_checkout_fields_lite(get_option('wc_fields_billing'), $old);
	}
	

	/**
	 * wc_checkout_fields_modify_shipping_fields function.
	 *
	 * @param mixed $old
	 */
	public function wcfe_shipping_fields_lite($old){
		global $supress_field_modification;

		if ($supress_field_modification){
			return $old;
		}

		return $this->wcfe_prepare_checkout_fields_lite(get_option('wc_fields_shipping'), $old);
	}
	



/**
	 * wc_checkout_fields_modify_account_fields function.
	 *
	 * @param mixed $old
	 */
	public function wcfe_account_fields_lite($old){
		global $supress_field_modification;

		if($supress_field_modification){
			return $old;
		}

		if(is_array(get_option('wc_fields_account'))){

			$Regfields = '';



			foreach (get_option('wc_fields_account') as $key => $value){

				

				if($key == 'account_username' || $key == 'account_password')
					continue;


			if($value['type'] == 'text'){
				$Regfields .=  '
       <p class="form-row form-row-wide">';
       $Regfields .= '<label for="reg_billing_'.$key.'">'.$value['label'].'</label>
       <input type="text" class="input-text" name="'.$key.'" id="reg_billing_'.$key.'"  />
       </p>'; 
			}
			else if ($value['type'] == 'select'){
				$Regfields .=  '
       <p class="form-row form-row-wide">';
       $Regfields .= '<label for="reg_billing_'.$key.'">'.$value['label'].'</label>
       <select class="input-select" name="'.$key.'" id="reg_billing_'.$key.'">';

       if(is_array($value['options'])){
       	foreach ($value['options'] as $key => $value) {
       		$Regfields .= '<option value="'.$key.'">'.$value.'</option>';
       	}
       }

       $Regfields .=  '</select></p>'; 
			}

		else if ($value['type'] == 'textarea'){
			$Regfields .=  '
       <p class="form-row form-row-wide">';
       $Regfields .= '<label for="reg_billing_'.$key.'">'.$value['label'].'</label>
       <textarea class="input-text" name="'.$key.'" id="reg_billing_'.$key.'" ></textarea>
       </p>'; 
		}
				

			} // loop through all fields

			$Regfields .= '<div class="clear"></div>';
			 echo $Regfields;
		}
		

		
	}


	/**
 * Save the extra register fields.
 *
 * @param  int  $customer_id Current customer ID.
 *
 * @return void
 */
function save_wcfe_account_fields_lite( $customer_id ) {
	if(is_array(get_option('wc_fields_account'))){
		foreach (get_option('wc_fields_account') as $key => $value){

			if($key == 'account_username' || $key == 'account_password')
				continue;

			
			
			if ( isset( $_POST[$key] ) ) {
        // WooCommerce billing phone
	        update_user_meta( $customer_id, $key, sanitize_text_field( $_POST[$key] ) );
	    }

		}
	}
}


function wcfe_show_data_my_account_page() {
 
	$user_id = get_current_user_id();
	$user = get_userdata( $user_id );
 
	if ( !$user )
		return;

 
 if(is_array(get_option('wc_fields_account'))){
 	$html = '';
 	$html .= '<table>';
 	$html .= '<tr><th>Custom Field Name</th><th>Field Value</th></tr>';

		foreach (get_option('wc_fields_account') as $key => $value){

			if($key == 'account_username' || $key == 'account_password')
				continue;


			$customField = get_user_meta( $user_id, $key, true );

			
			$html .= '<tr><td>'.$value['label'].'</td><td>'.$customField.'</td></tr>';
			

		}

		$html .= '</table>';
	}

	

	echo $html;
	

}


function wcfe_custom_heading( $field, $key ){

	$data = $this->custom_heading_data;

	foreach( $data as $name => $values ) {

		if($data[$name]['order'] == $this->custom_heading_order){
			
			$this->custom_heading_sort_key = $name;

		}
	}
    // will only execute if the field is billing_company and we are on the checkout page...
    if ( is_checkout() && ( $key == $this->custom_heading_sort_key) ) {
    	
        $field .= '<div id="add_custom_heading" class=""><h2>' . __($this->custom_heading) . '</h2></div>';
    }
    return $field;
}


/**
	 * checkout_fields_modify_fields function.
	 *
	 * @param mixed $data
	 * @param mixed $old
	 */
	function wcfe_prepare_checkout_fields_lite( $data, $old_fields ) {
		//global $WC_Checkout_Field_Editor;

		if( empty( $data ) ) {
			return $old_fields;
			
		}else {

			

			$fields = $data;	


			$this->custom_heading_data = $fields;

			$orderHeading = 0;
			


			foreach( $fields as $name => $values ) {
				// enabled
				if ( $values['enabled'] == false ) {
					unset( $fields[ $name ] );
				}



				if($data[ $name ]['type'] == 'heading'){

					$this->custom_heading_order = $data[ $name ]['order'] - 1;
			
					if(isset($data[ $name ]['class'][0])){
						$this->custom_heading_class = $data[ $name ]['class'][0];
					}


					
					$this->custom_heading = $data[ $name ]['label'];
						
				}

				
				


				// Replace locale field properties so they are unchanged
				if ( in_array( $name, array(
					'billing_country', 'billing_state', 'billing_city', 'billing_postcode',
					'shipping_country', 'shipping_state', 'shipping_city', 'shipping_postcode',
					'order_comments', 'account_username', 'account_password'
				) ) ) {
					if ( isset( $fields[ $name ] ) ) {
						$fields[ $name ]          = $old_fields[ $name ];
						$fields[ $name ]['label'] = ! empty( $data[ $name ]['label'] ) ? $data[ $name ]['label'] : $old_fields[ $name ]['label'];

						if ( ! empty( $data[ $name ]['placeholder'] ) ) {
							$fields[ $name ]['placeholder'] = $data[ $name ]['placeholder'];

						} elseif ( ! empty( $old_fields[ $name ]['placeholder'] ) ) {
							$fields[ $name ]['placeholder'] = $old_fields[ $name ]['placeholder'];

						} else {
							$fields[ $name ]['placeholder'] = '';
						}

						$fields[ $name ]['class'] = $data[ $name ]['class'];
						$fields[ $name ]['clear'] = $data[ $name ]['clear'];
					}
				}
				
				if(isset($fields[$name])){
					if(isset($fields[$name]['label'])){
						$fields[ $name ]['label'] = __($fields[ $name ]['label'], 'woocommerce');
					}
					if(isset($fields[$name]['placeholder'])){
						$fields[ $name ]['placeholder'] = __($fields[ $name ]['placeholder'], 'woocommerce');
					}
				}
			}								
			return $fields;
		}
	}


	function get_fields($key){
        $fields = array_filter(get_option('wc_fields_'. $key, array()));

        if(empty($fields) || sizeof($fields) == 0){
            if($key === 'billing' || $key === 'shipping'){
                $fields = WC()->countries->get_address_fields(WC()->countries->get_base_country(), $key . '_');

            } else if($key === 'additional'){
                $fields = array(
                    'order_comments' => array(
                        'type'        => 'textarea',
                        'class'       => array('notes'),
                        'label'       => __('Order Notes', 'woocommerce'),
                        'placeholder' => _x('Notes about your order, e.g. special notes for delivery.', 'placeholder', 'woocommerce')
                    )
                );
            }

            else if($key === 'account'){
                $fields = array(
                    
                    'account_username' => array(
                        'type' => 'text',
                        'label' => __('Account username', 'woocommerce'),
                        'placeholder' => _x('Username', 'placeholder', 'woocommerce')
                    ),
                    'account_password' => array(
                        'type' => 'password',
                        'label' => __('Account password', 'woocommerce'),
                        'placeholder' => _x('Password', 'placeholder', 'woocommerce'),
                        'class' => array('form-row-first')
                    )

                );
            }
        }
        return $fields;
    }


/**
	 * wc_checkout_fields_validation function.
	 *
	 * @param mixed $posted
	 */
	function wcfe_checkout_fields_validation_lite($posted){
		foreach(WC()->checkout->checkout_fields as $fieldset_key => $fieldset){

			// Skip shipping if its not needed
			if($fieldset_key === 'shipping' && (WC()->cart->ship_to_billing_address_only() || !empty($posted['shiptobilling']) || 
			(!WC()->cart->needs_shipping() && get_option('woocommerce_require_shipping_address') === 'no'))){
				continue;
			}

			foreach($fieldset as $key => $field){
				if(!empty($field['validate']) && is_array($field['validate']) && !empty($posted[$key])){
					foreach($field['validate'] as $rule){
						switch($rule) {
							case 'number' :
								if(!is_numeric($posted[$key])){
									if(defined('WC_VERSION') && version_compare(WC_VERSION, '2.3.0', '>=')){
										wc_add_notice('<strong>'. $field['label'] .'</strong> '. sprintf(__('(%s) is not a valid number.', 'woocommerce'), $posted[$key]), 'error');
									} else {
										WC()->add_error('<strong>'. $field['label'] .'</strong> '. sprintf(__('(%s) is not a valid number.', 'woocommerce'), $posted[$key]));
									}
								}
								break;
							case 'email' :
								if(!is_email($posted[$key])){
									if(defined('WC_VERSION') && version_compare(WC_VERSION, '2.3.0', '<')){
										WC()->add_error('<strong>'. $field['label'] .'</strong> '. sprintf(__('(%s) is not a valid email address.', 'woocommerce'), $posted[$key]));
									}
								}
								break;
						}
					}
				}
			}
		}
	}

	

	
	/**
	 * Display custom fields in emails
	 *
	 * @param array $keys
	 * @return array
	 */
	function wcfe_display_custom_fields_in_emails_lite($keys){
		$custom_keys = array();
		$fields = array_merge($this->get_fields('billing'), $this->get_fields('shipping'), 
		$this->get_fields('additional'));

		// Loop through all custom fields to see if it should be added
		foreach( $fields as $name => $options ) {
			if(isset($options['show_in_email']) && $options['show_in_email']){
				$custom_keys[ esc_attr( $options['label'] ) ] = esc_attr( $name );
			}
		}

		return array_merge( $keys, $custom_keys );
	}	
		
	/**
	 * Display custom checkout fields on view order pages
	 *
	 * @param  object $order
	 */
	function wcfe_order_details_after_customer_details_lite($order){
		$order_id = $order->id;				
		
		$fields = array();		
		if(!wc_ship_to_billing_address_only() && $order->needs_shipping_address()){
			$fields = array_merge($this->get_fields('billing'), $this->get_fields('shipping'), 
			$this->get_fields('additional'));
		}else{
			$fields = array_merge($this->get_fields('billing'), $this->get_fields('additional'));
		}

		$found = false;
		$html = '';

		// Loop through all custom fields to see if it should be added
		foreach($fields as $name => $options){
			$enabled = (isset($options['enabled']) && $options['enabled'] == false) ? false : true;
			$is_custom_field = (isset($options['custom']) && $options['custom'] == true) ? true : false;
		
			if(isset($options['show_in_order']) && $options['show_in_order'] && $enabled && $is_custom_field){
				$found = true;
				$html .= '<dt>' . esc_attr( $options['label'] ) . ':</dt>';
				$html .= '<dd>' . get_post_meta( $order_id, $name, true ) . '</dd>';
			}
		}
		if($found){
			echo '<dl>'. $html .'</dl>';
		}
	}





}


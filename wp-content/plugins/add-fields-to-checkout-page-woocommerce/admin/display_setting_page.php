<h2>Checkout Woocommerce Editor</h2>



<?php
        if( isset( $_GET[ 'tab' ] ) ) {
            $active_tab = $_GET[ 'tab' ];
            $tabParts = explode("_", $active_tab);
            $currentTab = $tabParts[0];
        } // end if
        else{
            $currentTab = 'billing';   
        }


    if ( isset( $_POST['save_fields'] ) )
                echo save_options( $currentTab );


    if ( isset( $_POST['reset_fields'] ) )
                echo reset_checkout_fields();


?>
<h2 class="nav-tab-wrapper">
<?php
if (isset( $_GET[ 'tab' ] ) ){
    
    ?>
            <a href="?page=checkout_editor_woocommerce&tab=billing_fields" class="nav-tab <?php echo $active_tab == 'billing_fields' ? 'nav-tab-active' : ''; ?>">Billing Fields</a>
<?php
}
else
{
?>
<a href="?page=checkout_editor_woocommerce&tab=billing_fields" class="nav-tab nav-tab-active">Billing Fields</a>
<?php
}
?>
            <a href="?page=checkout_editor_woocommerce&tab=shipping_fields" class="nav-tab <?php echo $active_tab == 'shipping_fields' ? 'nav-tab-active' : ''; ?>">Shipping Fields</a>
            <a href="?page=checkout_editor_woocommerce&tab=additional_fields" class="nav-tab <?php echo $active_tab == 'additional_fields' ? 'nav-tab-active' : ''; ?>">Additional Fields</a>
            <a href="?page=checkout_editor_woocommerce&tab=account_fields" class="nav-tab <?php echo $active_tab == 'account_fields' ? 'nav-tab-active' : ''; ?>">MyAccount Fields</a>
        </h2>

    <?php

    if($currentTab != 'register')
        {

        ?>




<form method="post" id="wcfe_checkout_fields_form" action="">
            	<table id="wcfe_checkout_fields" class="wc_gateways widefat" cellspacing="0">
					<thead>
                    	<tr>        
                         <th colspan="7">
            <button type="button" class="button button-primary" onclick="openNewFieldForm('<?php echo $currentTab; ?>')"><?php _e( '+ Add field', 'wcfe' ); ?></button>
            <button type="button" class="button" onclick="removeSelectedFields()"><?php _e( 'Remove', 'wcfe' ); ?></button>
            <button type="button" class="button" onclick="enableSelectedFields()"><?php _e( 'Enable', 'wcfe' ); ?></button>
            <button type="button" class="button" onclick="disableSelectedFields()"><?php _e( 'Disable', 'wcfe' ); ?></button>
        </th>
        <th colspan="4">
            <input type="submit" name="save_fields" class="button-primary" value="<?php _e( 'Save changes', 'wcfe' ) ?>" style="float:right" />
            <input type="submit" name="reset_fields" class="button" value="<?php _e( 'Reset to default fields', 'wcfe' ) ?>" style="float:right; margin-right: 5px;" />
        </th>  
    	</tr>
                    	<tr>		<th class="sort"></th>
		<th class="check-column" style="padding-left:0px !important;"><input style="margin-left:7px;" onclick="wcfeSelectAllCheckoutFields(this)" type="checkbox"></th>
		<th class="name">Name</th>
		<th class="id">Type</th>
		<th>Label</th>
		<th>Placeholder</th>
		<th>Validation Rules</th>
        <th class="status">Required</th>
		<th class="status">Clear Row</th>
		<th class="status">Enabled</th>	
        <th class="status">Edit</th>	
        </tr>						
					</thead>
                    <tfoot>
                    	<tr>		<th class="sort"></th>
		<th class="check-column" style="padding-left:0px !important;"><input style="margin-left:7px;" onclick="wcfeSelectAllCheckoutFields(this)" type="checkbox"></th>
		<th class="name">Name</th>
		<th class="id">Type</th>
		<th>Label</th>
		<th>Placeholder</th>
		<th>Validation Rules</th>
        <th class="status">Required</th>
		<th class="status">Clear Row</th>
		<th class="status">Enabled</th>	
        <th class="status">Edit</th>	
        </tr>
					<tr>        
                         <th colspan="7">
            <button type="button" class="button button-primary" onclick="openNewFieldForm('<?php echo $currentTab; ?>')"><?php _e( '+ Add field', 'wcfe' ); ?></button>
            <button type="button" class="button" onclick="removeSelectedFields()"><?php _e( 'Remove', 'wcfe' ); ?></button>
            <button type="button" class="button" onclick="enableSelectedFields()"><?php _e( 'Enable', 'wcfe' ); ?></button>
            <button type="button" class="button" onclick="disableSelectedFields()"><?php _e( 'Disable', 'wcfe' ); ?></button>
        </th>
        <th colspan="4">
            <input type="submit" name="save_fields" class="button-primary" value="<?php _e( 'Save changes', 'wcfe' ) ?>" style="float:right" />
            <input type="submit" name="reset_fields" class="button" value="<?php _e( 'Reset to default fields', 'wcfe' ) ?>" style="float:right; margin-right: 5px;" />
        </th>  
        </tr>
					</tfoot>
					<tbody class="ui-sortable">
                    					
<?php 


					$i=0;
					foreach( get_fields($currentTab) as $name => $options ) :	
						if ( isset( $options['custom'] ) && $options['custom'] == 1 ) {
							$options['custom'] = '1';
						} else {
							$options['custom'] = '0';
						}
											
						if ( !isset( $options['label'] ) ) {
							$options['label'] = '';
						}
						
						if ( !isset( $options['placeholder'] ) ) {
							$options['placeholder'] = '';
						}
												
						if( isset( $options['options'] ) && is_array($options['options']) ) {
							$options['options'] = implode("|", $options['options']);
						}else{
							$options['options'] = '';
						}
						
						if( isset( $options['class'] ) && is_array($options['class']) ) {
							$options['class'] = implode(",", $options['class']);
						}else{
							$options['class'] = '';
						}
						
						if( isset( $options['label_class'] ) && is_array($options['label_class']) ) {
							$options['label_class'] = implode(",", $options['label_class']);
						}else{
							$options['label_class'] = '';
						}
						
						if( isset( $options['validate'] ) && is_array($options['validate']) ) {
							$options['validate'] = implode(",", $options['validate']);
						}else{
							$options['validate'] = '';
						}
												
						if ( !isset( $options['required'] ) || $options['required'] == 1 ) {
							$options['required'] = '1';
						} else {
							$options['required'] = '0';
						}
						
						if ( isset( $options['clear'] ) && $options['clear'] == 1 ) {
							$options['clear'] = '1';
						} else {
							$options['clear'] = '0';
						}
						
						if ( !isset( $options['enabled'] ) || $options['enabled'] == 1 ) {
							$options['enabled'] = '1';
						} else {
							$options['enabled'] = '0';
						}

						if ( !isset( $options['type'] ) ) {
							$options['type'] = 'text';
						} 
						
						if ( isset( $options['show_in_email'] ) && $options['show_in_email'] == 1 ) {
							$options['show_in_email'] = '1';
						} else {
							$options['show_in_email'] = '0';
						}
						
						if ( isset( $options['show_in_order'] ) && $options['show_in_order'] == 1 ) {
							$options['show_in_order'] = '1';
						} else {
							$options['show_in_order'] = '0';
						}
					?>
                    						<tr class="row_<?php echo $i; echo($options['enabled'] == 1 ? '' : ' wcfe-disabled') ?>">
                        	<td width="1%" class="sort ui-sortable-handle">
                            	<input type="hidden" name="f_custom[<?php echo $i; ?>]" class="f_custom" value="<?php echo $options['custom']; ?>" />
                                <input type="hidden" name="f_order[<?php echo $i; ?>]" class="f_order" value="<?php echo $i; ?>" />
                                                                                                
                                <input type="hidden" name="f_name[<?php echo $i; ?>]" class="f_name" value="<?php echo esc_attr( $name ); ?>" />
                                <input type="hidden" name="f_name_new[<?php echo $i; ?>]" class="f_name_new" value="" />
                                <input type="hidden" name="f_type[<?php echo $i; ?>]" class="f_type" value="<?php echo $options['type']; ?>" />                                
                                <input type="hidden" name="f_label[<?php echo $i; ?>]" class="f_label" value="<?php echo $options['label']; ?>" />
                                <input type="hidden" name="f_placeholder[<?php echo $i; ?>]" class="f_placeholder" value="<?php echo $options['placeholder']; ?>" />
                                <input type="hidden" name="f_options[<?php echo $i; ?>]" class="f_options" value="<?php echo($options['options']) ?>" />
                                
                                <input type="hidden" name="f_class[<?php echo $i; ?>]" class="f_class" value="<?php echo $options['class']; ?>" />
                                <input type="hidden" name="f_label_class[<?php echo $i; ?>]" class="f_label_class" value="<?php echo $options['label_class']; ?>" />
                                                                
                                <input type="hidden" name="f_required[<?php echo $i; ?>]" class="f_required" value="<?php echo($options['required']) ?>" />
                                <input type="hidden" name="f_clear[<?php echo $i; ?>]" class="f_clear" value="<?php echo($options['clear']) ?>" />
                                                                
                                <input type="hidden" name="f_enabled[<?php echo $i; ?>]" class="f_enabled" value="<?php echo($options['enabled']) ?>" />
                                <input type="hidden" name="f_validation[<?php echo $i; ?>]" class="f_validation" value="<?php echo($options['validate']) ?>" />
                                <input type="hidden" name="f_show_in_email[<?php echo $i; ?>]" class="f_show_in_email" value="<?php echo($options['show_in_email']) ?>" />
                                <input type="hidden" name="f_show_in_order[<?php echo $i; ?>]" class="f_show_in_order" value="<?php echo($options['show_in_order']) ?>" />
                                <input type="hidden" name="f_deleted[<?php echo $i; ?>]" class="f_deleted" value="0" />
                                
                                <!--$properties = array('type', 'label', 'placeholder', 'class', 'required', 'clear', 'label_class', 'options');-->
                            </td>
                            <td class="td_select"><input type="checkbox" name="select_field"/></td>
                            <td class="td_name"><?php echo esc_attr( $name ); ?></td>
                            <td class="td_type"><?php echo $options['type']; ?></td>
                            <td class="td_label"><?php echo $options['label']; ?></td>
                            <td class="td_placeholder"><?php echo $options['placeholder']; ?></td>
                            <td class="td_validate"><?php echo $options['validate']; ?></td>
                            <td class="td_required status"><?php echo($options['required'] == 1 ? '<span class="status-enabled tips">Yes</span>' : '-' ) ?></td>
                            <td class="td_clear status"><?php echo($options['clear'] == 1 ? '<span class="status-enabled tips">Yes</span>' : '-' ) ?></td>
                            <td class="td_enabled status"><?php echo($options['enabled'] == 1 ? '<span class="status-enabled tips">Yes</span>' : '-' ) ?></td>
                            <td class="td_edit">
                            	<button type="button" class="f_edit_btn" <?php echo($options['enabled'] == 1 ? '' : 'disabled') ?> 
                                onclick="openEditFieldForm(this,<?php echo $i; ?>)"><?php _e( 'Edit', 'wcfe' ); ?></button>
                            </td>
                    	</tr>
                    <?php $i++; endforeach; ?>
                    						
                                    	</tbody>
				</table> 
            </form>

<?php
}
else
{
?>
 <div id="message" class="wc-connect updated wcfe-notice">
            <div >
                <table>
                    <tr>
                        <td width="70%">
                            <p><strong><i>WooCommerce Checkout Form Editor Pro</i></strong> premium version provides more features to design your checkout page.</p>
                            <ul>
                            <li>Customized My account register page fields.</li>
                                <li>12 field types available,<br/>(<i>Text, Hidden, Password, Textarea, Radio, Checkbox, Select, Multi-select, Date Picker, Time Picker, Heading, Label</i>).</li>
                                <li>Conditionally display fields based on cart items and other field(s) values.</li>
                                <li>Add an extra cost to the cart total based on field selection.</li>
                                <li>Option to add more sections in addition to the core sections (billing, shipping and additional) in checkout page.</li>
                            </ul>
                        </td>
                        <td>
                            <a target="_blank" href="http://themelocation.com/" class="">
                                Upgrade
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
<?php
}
?>



 <div id="wcfe_new_field_form" title="New Checkout Field" class="wcfe_new_field_form_popup_wrapper">
          <form>
          	<table>
            	<tr>                
                	<td colspan="2" class="err_msgs"></td>
				</tr>
            	<tr>                    
                	<td width="40%">Type</td>
                    <td>
                    	<select name="ftype" style="width:150px;" onchange="fieldTypeChangeListner(this)">
                                                	<option value="text">Text</option>
                                                	<option value="select">Select</option>
                                                    <option value="checkbox">Checkbox</option>
                                                    <option value="radio">Radio button</option>
                                                    <option value="textarea">Text Area</option>
                                                    
                                                </select>
                    </td>
				</tr>
            	<tr>                
                	<td>Name</td>
                    <td><input type="text" name="fname" style="width:250px;"/></td>
				</tr>                
                <tr class="rowLabel">
                    <td class="labeltxt">Label</td>
                    <td><input type="text" name="flabel" style="width:250px;"/></td>
				</tr>
                
                <tr class="rowPlaceholder">                    
                    <td>Placeholder</td>
                    <td><input type="text" name="fplaceholder" style="width:250px;"/></td>
				</tr>
                <tr class="rowOptions">                    
                    <td>Options</td>
                    <td><input type="text" name="foptions" placeholder="Seperate options with pipe(|)" style="width:250px;"/></td>
				</tr>
                <tr class="rowClass">
                    <td>Class</td>
                    <td><input type="text" name="fclass" placeholder="Seperate classes with comma" style="width:250px;"/></td>
				</tr>
                <tr class="rowLabelClass">
                    <td>Label Class</td>
                    <td><input type="text" name="flabelclass" placeholder="Seperate classes with comma" style="width:250px;"/></td>
				</tr>                                   
                
                <tr class="rowRequired">
                	<td>&nbsp;</td>                     
                    <td>                    	
                    	<input type="checkbox" name="frequired" value="yes" checked/>
                        <label class="freqlabel">Required</label><br/>
                                                
                    	<input type="checkbox" name="fclearRow" value="yes" checked/>
                        <label>Clear Row</label><br/>
                                                
                    	<input type="checkbox" name="fenabled" value="yes" checked/>
                        <label>Enabled</label>
                    </td>
                </tr>      
                <tr class="rowShowInEmail"> 
                	<td>&nbsp;</td>                   
                    <td>                    	
                    	<input type="checkbox" name="fshowinemail" value="email" checked/>
                        <label>Display in Emails</label>
                    </td>
                </tr> 
                <tr class="rowShowInOrder"> 
                	<td>&nbsp;</td>                   
                    <td>                    	
                    	<input type="checkbox" name="fshowinorder" value="order-review" checked/>
                        <label>Display in Order Detail Pages</label>
                    </td>
            	</tr>                           
            </table>
          </form>
        </div>


        <div id="wcfe_edit_field_form" title="Edit Checkout Field" class="wcfe_popup_wrapper">
          <form>
            <table>
                <tr>                
                    <td colspan="2" class="err_msgs"></td>
                </tr>
                <tr>                
                    <td width="40%">Name</td>
                    <td>
                        <input type="hidden" name="rowId"/>
                        <input type="hidden" name="fname"/>
                        <input type="text" name="fnameNew" style="width:250px;"/>
                    </td>
                </tr>
                <tr>                   
                    <td>Type</td>
                    <td>
                        <select name="ftype" style="width:150px;" onchange="fieldTypeChangeListner(this)">                  
                                                    <option value="text">Text</option>
                                                    <option value="select">Select</option>
                                                    <option value="checkbox">Checkbox</option>
                                                    <option value="radio">Radio button</option>
                                                    <option value="textarea">Text Area</option>
                                                    
                                                </select>
                    </td>
                </tr>                
                <tr>
                    <td>Label</td>
                    <td><input type="text" name="flabel" style="width:250px;"/></td>
                </tr>
                <tr class="rowPlaceholder">                    
                    <td>Placeholder</td>
                    <td><input type="text" name="fplaceholder" style="width:250px;"/></td>
                </tr>
                <tr class="rowOptions">                    
                    <td>Options</td>
                    <td><input type="text" name="foptions" placeholder="Seperate options with pipe(|)" style="width:250px;"/></td>
                </tr>                
                <tr class="rowClass">
                    <td>Class</td>
                    <td><input type="text" name="fclass" placeholder="Seperate classes with comma" style="width:250px;"/></td>
                </tr>
                <tr class="rowLabelClass">
                    <td>Label Class</td>
                    <td><input type="text" name="flabelclass" placeholder="Seperate classes with comma" style="width:250px;"/></td>
                </tr>                                   
                <tr class="rowValidate">                    
                    <td>Validation</td>
                    <td>
                        <select multiple="multiple" name="fvalidate" placeholder="Select validations" class="wcfe-enhanced-multi-select" 
                        style="width: 250px; height:30px;">
                            <option value="email">Email</option>
                            <option value="phone">Phone</option>
                        </select>
                    </td>
                </tr>  
                <tr class="rowRequired">  
                    <td>&nbsp;</td>                     
                    <td>                        
                        <input type="checkbox" name="frequired" value="yes" checked/>
                        <label>Required</label><br/>
                                                
                        <input type="checkbox" name="fclearRow" value="yes" checked/>
                        <label>Clear Row</label><br/>
                                                
                        <input type="checkbox" name="fenabled" value="yes" checked/>
                        <label>Enabled</label>
                    </td>                    
                </tr>  
                <tr class="rowShowInEmail"> 
                    <td>&nbsp;</td>                   
                    <td>                        
                        <input type="checkbox" name="fshowinemail" value="email" checked/>
                        <label>Display in Emails</label>
                    </td>
                </tr> 
                <tr class="rowShowInOrder"> 
                    <td>&nbsp;</td>                   
                    <td>                        
                        <input type="checkbox" name="fshowinorder" value="order-review" checked/>
                        <label>Display in Order Detail Pages</label>
                    </td>
                </tr> 
            </table>
          </form>
        </div>


<?php


function sort_fields_by_order($a, $b){
        if(!isset($a['order']) || $a['order'] == $b['order']){
            return 0;
        }
        return ($a['order'] < $b['order']) ? -1 : 1;
    }

    /**
     * Reset checkout fields.
     */
    function reset_checkout_fields() {
        delete_option('wc_fields_billing');
        delete_option('wc_fields_shipping');
        delete_option('wc_fields_additional');
        delete_option('wc_fields_account');
        echo '<div class="updated"><p>'. __('SUCCESS: Checkout fields successfully reset', 'wcfe') .'</p></div>';
    }


    function is_reserved_field_name( $field_name ){
        if($field_name && in_array($field_name, array(
            'billing_first_name', 'billing_last_name', 'billing_company', 'billing_address_1', 'billing_address_2', 'billing_city', 'billing_state', 
            'billing_country', 'billing_postcode', 'billing_phone', 'billing_email',
            'shipping_first_name', 'shipping_last_name', 'shipping_company', 'shipping_address_1', 'shipping_address_2', 'shipping_city', 'shipping_state', 
            'shipping_country', 'shipping_postcode', 'customer_note', 'order_comments', 'account_username', 'account_password'
        ))){
            return true;
        }
        return false;
    }
    
    function is_default_field_name($field_name){
        if($field_name && in_array($field_name, array(
            'billing_first_name', 'billing_last_name', 'billing_company', 'billing_address_1', 'billing_address_2', 'billing_city', 'billing_state', 
            'billing_country', 'billing_postcode', 'billing_phone', 'billing_email',
            'shipping_first_name', 'shipping_last_name', 'shipping_company', 'shipping_address_1', 'shipping_address_2', 'shipping_city', 'shipping_state', 
            'shipping_country', 'shipping_postcode', 'customer_note', 'order_comments', 'account_username', 'account_password'
        ))){
            return true;
        }
        return false;
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


    function save_options( $section ) {

         $locale_fields = array(
            'billing_address_1', 'billing_address_2', 'billing_state', 'billing_postcode', 'billing_city',
            'shipping_address_1', 'shipping_address_2', 'shipping_state', 'shipping_postcode', 'shipping_city',
            'order_comments',
            'account_username', 'account_password'
        );


        $o_fields      = get_fields( $section );
        $fields        = $o_fields;
        //$core_fields   = array_keys( WC()->countries->get_address_fields( WC()->countries->get_base_country(), $section . '_' ) );
        //$core_fields[] = 'order_comments';
        
        $f_order       = ! empty( $_POST['f_order'] ) ? $_POST['f_order'] : array();
        
        $f_names       = ! empty( $_POST['f_name'] ) ? $_POST['f_name'] : array();
        $f_names_new   = ! empty( $_POST['f_name_new'] ) ? $_POST['f_name_new'] : array();
        $f_types       = ! empty( $_POST['f_type'] ) ? $_POST['f_type'] : array();
        $f_labels      = ! empty( $_POST['f_label'] ) ? $_POST['f_label'] : array();
        $f_placeholder = ! empty( $_POST['f_placeholder'] ) ? $_POST['f_placeholder'] : array();
        $f_options     = ! empty( $_POST['f_options'] ) ? $_POST['f_options'] : array();
        
        $f_class       = ! empty( $_POST['f_class'] ) ? $_POST['f_class'] : array();
        $f_label_class = ! empty( $_POST['f_label_class'] ) ? $_POST['f_label_class'] : array();
        
        $f_required    = ! empty( $_POST['f_required'] ) ? $_POST['f_required'] : array();
        $f_clear       = ! empty( $_POST['f_clear'] ) ? $_POST['f_clear'] : array();        
        $f_enabled     = ! empty( $_POST['f_enabled'] ) ? $_POST['f_enabled'] : array();
        
        $f_show_in_email = ! empty( $_POST['f_show_in_email'] ) ? $_POST['f_show_in_email'] : array();
        $f_show_in_order = ! empty( $_POST['f_show_in_order'] ) ? $_POST['f_show_in_order'] : array();
        
        $f_validation  = ! empty( $_POST['f_validation'] ) ? $_POST['f_validation'] : array();
        $f_deleted     = ! empty( $_POST['f_deleted'] ) ? $_POST['f_deleted'] : array();
                        
        $f_position        = ! empty( $_POST['f_position'] ) ? $_POST['f_position'] : array();              
        $f_display_options = ! empty( $_POST['f_display_options'] ) ? $_POST['f_display_options'] : array();
        $max               = max( array_map( 'absint', array_keys( $f_names ) ) );
            
        for ( $i = 0; $i <= $max; $i ++ ) { 
            $name     = empty( $f_names[$i] ) ? '' : urldecode( sanitize_title( wc_clean( stripslashes( $f_names[$i] ) ) ) );
            $new_name = empty( $f_names_new[$i] ) ? '' : urldecode( sanitize_title( wc_clean( stripslashes( $f_names_new[$i] ) ) ) );
            
            if(!empty($f_deleted[$i]) && $f_deleted[$i] == 1){
                unset( $fields[$name] );
                continue;
            }
                        
            // Check reserved names
            if(is_reserved_field_name( $new_name )){
                continue;
            }
                        
            //if update field
            if( $name && $new_name && $new_name !== $name ){
                if ( isset( $fields[$name] ) ) {
                    $fields[$new_name] = $fields[$name];
                } else {
                    $fields[$new_name] = array();
                }

                unset( $fields[$name] );
                $name = $new_name;
            } else {
                $name = $name ? $name : $new_name;
            }

            if(!$name){
                continue;
            }
                        
            //if new field
            if ( !isset( $fields[$name] ) ) {
                $fields[$name] = array();
            }

            $o_type  = isset( $o_fields[$name]['type'] ) ? $o_fields[$name]['type'] : 'text';
            
            //$o_class = isset( $o_fields[$name]['class'] ) ? $o_fields[$name]['class'] : array();
            //$classes = array_diff( $o_class, array( 'form-row-first', 'form-row-last', 'form-row-wide' ) );

            $fields[$name]['type']        = empty( $f_types[$i] ) ? $o_type : wc_clean( $f_types[$i] );
            $fields[$name]['label']       = empty( $f_labels[$i] ) ? '' : wp_kses_post( trim( stripslashes( $f_labels[$i] ) ) );
            $fields[$name]['placeholder'] = empty( $f_placeholder[$i] ) ? '' : wc_clean( stripslashes( $f_placeholder[$i] ) );
            $fields[$name]['options']     = empty( $f_options[$i] ) ? array() : array_map( 'wc_clean', explode( '|', $f_options[$i] ) );
            
            $fields[$name]['class']       = empty( $f_class[$i] ) ? array() : array_map( 'wc_clean', explode( ',', $f_class[$i] ) );
            $fields[$name]['label_class'] = empty( $f_label_class[$i] ) ? array() : array_map( 'wc_clean', explode( ',', $f_label_class[$i] ) );
            
            $fields[$name]['required']    = empty( $f_required[$i] ) ? false : true;
            $fields[$name]['clear']       = empty( $f_clear[$i] ) ? false : true;
            
            $fields[$name]['enabled']     = empty( $f_enabled[$i] ) ? false : true;
            $fields[$name]['order']       = empty( $f_order[$i] ) ? '' : wc_clean( $f_order[$i] );
                    
            if (!empty( $fields[$name]['options'] )) {
                $fields[$name]['options'] = array_combine( $fields[$name]['options'], $fields[$name]['options'] );
            }

            if (!in_array( $name, $locale_fields )){
                $fields[$name]['validate'] = empty( $f_validation[$i] ) ? array() : explode( ',', $f_validation[$i] );
            }

            if (!is_default_field_name( $name )){
                $fields[$name]['custom'] = true;
                $fields[$name]['show_in_email'] = empty( $f_show_in_email[$i] ) ? false : true;
                $fields[$name]['show_in_order'] = empty( $f_show_in_order[$i] ) ? false : true;
            } else {
                $fields[$name]['custom'] = false;
            }
            
            $fields[$name]['label']       = __($fields[$name]['label'], 'woocommerce');
            $fields[$name]['placeholder'] = __($fields[$name]['placeholder'], 'woocommerce');
        }
        
        uasort( $fields, "sort_fields_by_order" );

        $result = update_option( 'wc_fields_' . $section, $fields );

        if ( $result == true ) {
            echo '<div class="updated"><p>' . __( 'Your changes were saved.', 'wcfe' ) . '</p></div>';
        } else {
            echo '<div class="error"><p> ' . __( 'Your changes were not saved due to an error (or you made none!).', 'wcfe' ) . '</p></div>';
        }
    }


?>
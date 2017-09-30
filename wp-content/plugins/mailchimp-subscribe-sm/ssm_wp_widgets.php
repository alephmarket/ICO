<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class SSM_Form_Widget extends WP_Widget {



	function __construct() {
		parent::__construct(
			'ssm_form_widget', 
			__('Subscribe Form', 'ssm_widget' ),
			array('description' => __( 'Subscribe From Widget - Select your subscribe form.', 'ssm_widget' ), )
		);
	}


	public function widget( $args, $instance ) {
		echo $args['after_title'];
		if ( ! empty( $instance['ssm_form_title'] ) ) {
			echo do_shortcode($instance['ssm_form_title']);
		}else{
			echo "Please select a form from widget.";
		}
		
	}


	public function form( $instance ) {
		$args = array(
			'posts_per_page'   => 99,
			'offset'           => 0,
			'orderby'          => 'date',
			'order'            => 'ASC',
			'post_type'        => 'subscribe_me_forms',
			'post_status'      => 'publish',
		);
		
		$subscribe_forms = get_posts( $args );
		$ssm_fieldname = $this->get_field_name( 'ssm_form_title' );
		?>
		<br>
		<br>
		<label for="<?php echo $this->get_field_id( 'ssm_form_title' ); ?> ">Please select a form to display : </label>
		<select  id="<?php echo $this->get_field_id( 'ssm_form_title' ); ?>" name="<?php echo $ssm_fieldname ?>" >
		<?php
		foreach ($subscribe_forms as $form) {
			$currentID = $form->ID;
			$title = get_the_title($currentID);
		?>
		<option value="<div> [ssm_form id='<?php echo $currentID ?>'] </div> " <?php selected("[ssm_form id='$currentID']" , $ssm_fieldname); ?>  > <?php echo $title ?> </option>
		<?php
		}
		echo "</select> <br> <br>";
	}


	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['ssm_form_title'] = ( ! empty( $new_instance['ssm_form_title'] ) ) ? strip_tags( $new_instance['ssm_form_title'] ) : '';

		return $instance;
	}

} 


function register_ssm_form_widget() {
    register_widget( 'SSM_Form_Widget' );
}
add_action( 'widgets_init', 'register_ssm_form_widget' );
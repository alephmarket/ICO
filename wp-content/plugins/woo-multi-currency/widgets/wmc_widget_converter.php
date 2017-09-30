<?php
/**
 * Created by PhpStorm.
 * User: FalconNguyen
 * Date: 5/31/2016
 * Time: 10:05 AM
 */

/**
 * Widget currency
 * Class WMC_Widget_Converter
 */
class WMC_Widget_Converter extends WP_Widget {

	function __construct() {
		parent::__construct(
			'wmc_widget_converter', // Base ID
			esc_attr__( 'Woo Currency Calculator', 'woo-multi-currency' ), // Name
			array( 'description' => esc_attr__( 'You can calculate from currency to other currency.', 'woo-multi-currency' ), ) // Args
		);
	}

	/**
	 * Show front end
	 *
	 * @param $args
	 * @param $instance
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		echo do_shortcode( apply_filters( 'wmc_converter_shortcode', "[woo_multi_currency_converter]", $instance ) );

		echo $args['after_widget'];
	}

	/**
	 * Fields in widget configuration
	 *
	 * @param $instance
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_attr__( 'Currency Calculator', 'woo-multi-currency' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
				   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
				   value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php do_action( 'wmc_after_widget_converter_form', $instance, $this ) ?>
		<?php
	}

	/**
	 * Save widget configuration
	 *
	 * @param $new_instance
	 * @param $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return apply_filters( 'wmc_save_widget_converter_data', $instance, $new_instance, $old_instance );
	}

}

?>
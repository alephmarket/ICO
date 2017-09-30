<?php
/**
 * Crowdfunding for WooCommerce - Progress Bar Shortcodes
 *
 * @version 2.3.6
 * @since   2.3.6
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_Crowdfunding_Shortcodes_Progress_Bar' ) ) :

class Alg_WC_Crowdfunding_Shortcodes_Progress_Bar extends Alg_WC_Crowdfunding_Shortcodes {

	/**
	 * Constructor.
	 *
	 * @version 2.3.6
	 * @since   2.3.6
	 */
	function __construct() {
		add_shortcode( 'product_crowdfunding_goal_remaining_progress_bar',         array( $this, 'alg_product_crowdfunding_goal_remaining_progress_bar' ) );
		add_shortcode( 'product_crowdfunding_goal_backers_remaining_progress_bar', array( $this, 'alg_product_crowdfunding_goal_backers_remaining_progress_bar' ) );
		add_shortcode( 'product_crowdfunding_goal_items_remaining_progress_bar',   array( $this, 'alg_product_crowdfunding_goal_items_remaining_progress_bar' ) );
		add_shortcode( 'product_crowdfunding_time_remaining_progress_bar',         array( $this, 'alg_product_crowdfunding_time_remaining_progress_bar' ) );
		// Deprecated
		add_shortcode( 'product_crowdfunding_goal_progress_bar',                   array( $this, 'alg_product_crowdfunding_goal_progress_bar' ) );
		add_shortcode( 'product_crowdfunding_time_progress_bar',                   array( $this, 'alg_product_crowdfunding_time_progress_bar' ) );
	}

	/**
	 * get_progress_bar.
	 *
	 * @version 2.3.0
	 * @since   2.3.0
	 */
	function get_progress_bar( $atts, $value, $max_value ) {
		if ( ! isset( $atts['type'] ) ) {
			$atts['type'] = 'standard';
		}
		if ( ! isset( $atts['color'] ) ) {
			$atts['color'] = '#2bde73';
		}
		if ( ! isset( $atts['text_color'] ) ) {
			$atts['text_color'] = '#999';
		}
		if ( ! isset( $atts['width'] ) ) {
			$atts['width'] = '200px'; // todo
//			$atts['width'] = '100%';
		}
		if ( ! isset( $atts['height'] ) ) {
			$atts['height'] = ( 'line' === $atts['type'] ) ? '8px' : '200px';
		}
		if ( ! isset( $atts['style'] ) ) {
			$atts['style'] = '';
		}
		if ( $value < 0 ) {
			$value = 0;
		}
		if ( $max_value < 0 ) {
			$max_value = 0;
		}
		switch ( $atts['type'] ) {
			case 'line':
			case 'circle':
				return '<div class="alg-progress-bar"' .
					' type="' . $atts['type'] . '"' .
					' color="' . $atts['color'] . '"' .
					' text_color="' . $atts['text_color'] . '"' .
					' style="width:' . $atts['width'] . ';height:' . $atts['height'] . ';position:relative;' . $atts['style'] . '"' .
					' value="' . ( 0 != $max_value ? $value / $max_value : 0 ) . '">' .
				'</div>';
			default: // 'standard'
				return '<progress value="' . $value . '" max="' . $max_value . '"></progress>';
		}
	}

	/**
	 * alg_product_crowdfunding_time_remaining_progress_bar.
	 *
	 * @version 2.3.2
	 * @since   2.2.1
	 */
	function alg_product_crowdfunding_time_remaining_progress_bar( $atts ) {
		$product_id = isset( $atts['product_id'] ) ? $atts['product_id'] : get_the_ID();
		if ( ! $product_id ) return '';

		$deadline_datetime  = trim( get_post_meta( $product_id, '_' . 'alg_crowdfunding_deadline', true )  . ' ' . get_post_meta( $product_id, '_' . 'alg_crowdfunding_deadline_time', true ), ' ' );
		$startdate_datetime = trim( get_post_meta( $product_id, '_' . 'alg_crowdfunding_startdate', true ) . ' ' . get_post_meta( $product_id, '_' . 'alg_crowdfunding_starttime', true ), ' ' );

		$seconds_remaining = strtotime( $deadline_datetime ) - ( (int) current_time( 'timestamp' ) );
		$seconds_total     = strtotime( $deadline_datetime ) - strtotime( $startdate_datetime );

		return $this->output_shortcode( $this->get_progress_bar( $atts, $seconds_remaining, $seconds_total ), $atts );
	}

	/**
	 * alg_product_crowdfunding_time_progress_bar.
	 *
	 * @version     2.2.1
	 * @since       1.2.0
	 * @deprecated
	 */
	function alg_product_crowdfunding_time_progress_bar( $atts ) {
		return $this->alg_product_crowdfunding_time_remaining_progress_bar( $atts );
	}

	/**
	 * alg_product_crowdfunding_goal_items_remaining_progress_bar.
	 *
	 * @version 2.3.0
	 * @since   2.2.0
	 */
	function alg_product_crowdfunding_goal_items_remaining_progress_bar( $atts ) {
		$product_id = isset( $atts['product_id'] ) ? $atts['product_id'] : get_the_ID();
		if ( ! $product_id ) return '';
		$current_value = alg_get_product_orders_data( 'total_items', $atts );
		$max_value     = get_post_meta( $product_id, '_' . 'alg_crowdfunding_goal_items', true );
		return $this->output_shortcode( $this->get_progress_bar( $atts, $current_value, $max_value ), $atts );
	}

	/**
	 * alg_product_crowdfunding_goal_backers_remaining_progress_bar.
	 *
	 * @version 2.3.0
	 * @since   2.2.0
	 */
	function alg_product_crowdfunding_goal_backers_remaining_progress_bar( $atts ) {
		$product_id = isset( $atts['product_id'] ) ? $atts['product_id'] : get_the_ID();
		if ( ! $product_id ) return '';
		$current_value = alg_get_product_orders_data( 'total_orders', $atts );
		$max_value     = get_post_meta( $product_id, '_' . 'alg_crowdfunding_goal_backers', true );
		return $this->output_shortcode( $this->get_progress_bar( $atts, $current_value, $max_value ), $atts );
	}

	/**
	 * alg_product_crowdfunding_goal_remaining_progress_bar.
	 *
	 * @version 2.3.0
	 * @since   2.2.0
	 */
	function alg_product_crowdfunding_goal_remaining_progress_bar( $atts ) {
		$product_id = isset( $atts['product_id'] ) ? $atts['product_id'] : get_the_ID();
		if ( ! $product_id ) return '';
		$current_value = alg_get_product_orders_data( 'orders_sum', $atts );
		$max_value     = get_post_meta( $product_id, '_' . 'alg_crowdfunding_goal_sum', true );
		return $this->output_shortcode( $this->get_progress_bar( $atts, $current_value, $max_value ), $atts );
	}

	/**
	 * alg_product_crowdfunding_goal_progress_bar.
	 *
	 * @version     2.2.0
	 * @since       1.2.0
	 * @deprecated
	 */
	function alg_product_crowdfunding_goal_progress_bar( $atts ) {
		return $this->alg_product_crowdfunding_goal_remaining_progress_bar( $atts );
	}

}

endif;

return new Alg_WC_Crowdfunding_Shortcodes_Progress_Bar();

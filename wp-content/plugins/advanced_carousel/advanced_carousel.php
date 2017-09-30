<?php
/*
Plugin Name: Advanced Carousel for Visual Composer
Plugin URI: http://codecanyon.net/user/BrainstormForce
Author: Brainstorm Force
Author URI: http://codecanyon.net/user/BrainstormForce
Version: 1.1.4
Description: Convert any layout into carousel slider by using this plugin with Visual Composer.
*/
if(!class_exists("Ultimate_Carousel")){
	class Ultimate_Carousel{

		function __construct(){
			add_shortcode( "ultimate_carousel", array($this, "ultimate_carousel_shortcode"));
			add_action( "wp_enqueue_scripts", array( $this, "ultimate_front_scripts"),100 );
			add_action( "admin_enqueue_scripts", array( $this, "custom_param_styles") );
			add_action( "admin_enqueue_scripts", array( $this, "ultimate_admin_scripts"),100 );
			if(defined('WPB_VC_VERSION') && version_compare(WPB_VC_VERSION, 4.8) >= 0) {
				if(function_exists('vc_add_shortcode_param'))
				{
					// Generate param type "slick_icon"
					vc_add_shortcode_param('slick_icon' , array($this, 'icon_settings_field' ) );
					// Generate param type "checkboxes"
					vc_add_shortcode_param('ult_switch' , array($this, 'checkbox_param')) ;
					// Generate param type "number"
					vc_add_shortcode_param('number' , array($this, 'number_settings_field' ));
				}
			}
			else {
				if ( function_exists('add_shortcode_param'))
				{
					// Generate param type "slick_icon"
					add_shortcode_param('slick_icon' , array($this, 'icon_settings_field' ) );
					// Generate param type "checkboxes"
					add_shortcode_param('ult_switch' , array($this, 'checkbox_param')) ;
					// Generate param type "number"
					add_shortcode_param('number' , array($this, 'number_settings_field' ));
				}
			}
			add_action( "admin_init", array($this, "init_carousel_addon"));
		}
		function custom_param_styles(){
			echo '<style type="text/css">
					.wpb_ultimate_carousel.wpb_sortable.wpb_content_holder {
						background-image: url('.plugins_url("assets/img/icon-advanced-carousel.png",__FILE__).');
					}
					.items_to_show.vc_shortcode-param {
						background: #E6E6E6;
						padding-bottom: 10px;
					}
					.items_to_show.ult_margin_bottom{
						margin-bottom: 15px;
					}
					.items_to_show.ult_margin_top{
						margin-top: 15px;
					}
					/*On Off Checkbox Switch*/
					.onoffswitch {
						position: relative;
						width: 95px;
						display: inline-block;
						float: left;
						margin-right: 15px;
						-webkit-user-select:none;
						-moz-user-select:none;
						-ms-user-select: none;
					}
					.onoffswitch-checkbox {
						display: none !important;
					}
					.onoffswitch-label {
						display: block;
						overflow: hidden;
						cursor: pointer;
						border: 0px solid #999999;
						border-radius: 0px;
					}
					.onoffswitch-inner {
						width: 200%;
						margin-left: -100%;
						-moz-transition: margin 0.3s ease-in 0s;
						-webkit-transition: margin 0.3s ease-in 0s;
						-o-transition: margin 0.3s ease-in 0s;
						transition: margin 0.3s ease-in 0s;
					}
					.onoffswitch-inner > div {
						float: left;
						position: relative;
						width: 50%;
						height: 24px;
						padding: 0;
						line-height: 24px;
						font-size: 12px;
						color: white;
						font-weight: bold;
						-moz-box-sizing: border-box;
						-webkit-box-sizing: border-box;
						box-sizing: border-box;
					}
					.onoffswitch-inner .onoffswitch-active {
						padding-left: 15px;
						background-color: #CCCCCC;
						color: #FFFFFF;
					}
					.onoffswitch-inner .onoffswitch-inactive {
						padding-right: 15px;
						background-color: #CCCCCC;
						color: #FFFFFF;
						text-align: right;
					}
					.onoffswitch-switch {
						/*width: 50px;*/
						width:35px;
						margin: 0px;
						text-align: center;
						border: 0px solid #999999;
						border-radius: 0px;
						position: absolute;
						top: 0;
						bottom: 0;
					}
					.onoffswitch-active .onoffswitch-switch {
						background: #3F9CC7;
						left: 0;
					}
					.onoffswitch-inactive .onoffswitch-switch {
						background: #7D7D7D;
						right: 0;
					}
					.onoffswitch-active .onoffswitch-switch:before {
						content: " ";
						position: absolute;
						top: 0;
						/*left: 50px;*/
						left:35px;
						border-style: solid;
						border-color: #3F9CC7 transparent transparent #3F9CC7;
						/*border-width: 12px 8px;*/
						border-width: 15px;
					}
					.onoffswitch-inactive .onoffswitch-switch:before {
						content: " ";
						position: absolute;
						top: 0;
						/*right: 50px;*/
						right:35px;
						border-style: solid;
						border-color: transparent #7D7D7D #7D7D7D transparent;
						/*border-width: 12px 8px;*/
						border-width: 50px;
					}
					.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
						margin-left: 0;
					}
				</style>';
		}
		function ultimate_front_scripts(){
			wp_enqueue_script("jQuery");
			wp_enqueue_script("ult-slick", plugins_url("assets/slick/slick.js",__FILE__));
			wp_enqueue_script("ult-slick-custom", plugins_url("assets/slick/custom.js",__FILE__));
			wp_enqueue_style("ult-slick", plugins_url("assets/slick/slick.css",__FILE__));
			wp_enqueue_style("ult-icons", plugins_url("assets/slick/icons.css",__FILE__));
			wp_enqueue_style("ult-slick-animate", plugins_url("assets/slick/animate.min.css",__FILE__));
		}

		function ultimate_admin_scripts($hook){
			if($hook == "post.php" || $hook == "post-new.php"){
				wp_enqueue_style("ult-icons", plugins_url("assets/slick/icons.css",__FILE__));
			}
		}

		function init_carousel_addon(){
			if(function_exists("vc_map")){
				vc_map(
					array(
						"name" => "Advanced Carousel",
						"base" => "ultimate_carousel",
						"icon" => plugins_url("assets/img/icon-advanced-carousel.png",__FILE__),
						"class" => "ultimate_carousel",
						"as_parent" => array('except' => 'ultimate_carousel'),
						"content_element" => true,
						"controls" => "full",
                        "weight" => 93,
						"show_settings_on_create" => true,
						"category" => "content",
						"description" => "Convert anything into carousel slider.",
						"params" => array(
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Slider Type","smile"),
								"param_name" => "slider_type",
								"value" => array(
										"Horizontal" => "horizontal",
										"Vertical" => "vertical",
										"Horizontal Full Width" => "full_width"
									),
								"description" => __("","smile"),
								"group"=> "General",
						  	),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Slides to Scroll","smile"),
								"param_name" => "slide_to_scroll",
								"value" => array("All visible" => "all", "One at a Time" => "single"),
								"description" => __("","smile"),
								"group"=> "General",
						  	),
							array(
								"type" => "text",
								"param_name" => "title_text_typography",
								"heading" => __("<p>Items to Show‏ - </p>"),
								"value" => "",
								"edit_field_class" => "vc_col-sm-12 items_to_show ult_margin_top",
								"group" => "General"
							),
							array(
								"type" => "number",
								"class" => "",
								"edit_field_class" => "vc_col-sm-4 items_to_show ult_margin_bottom",
								"heading" => __("On Desktop","smile"),
								"param_name" => "slides_on_desk",
								"value" => "5",
								"min" => "1",
								"max" => "25",
								"step" => "1",
								"description" => __("","smile"),
								"group"=> "General",
						  	),
							array(
								"type" => "number",
								"class" => "",
								"edit_field_class" => "vc_col-sm-4 items_to_show ult_margin_bottom",
								"heading" => __("On Tabs","smile"),
								"param_name" => "slides_on_tabs",
								"value" => "3",
								"min" => "1",
								"max" => "25",
								"step" => "1",
								"description" => __("","smile"),
								"group"=> "General",
						  	),
							array(
								"type" => "number",
								"class" => "",
								"edit_field_class" => "vc_col-sm-4 items_to_show ult_margin_bottom",
								"heading" => __("On Mobile","smile"),
								"param_name" => "slides_on_mob",
								"value" => "2",
								"min" => "1",
								"max" => "25",
								"step" => "1",
								"description" => __("","smile"),
								"group"=> "General",
						  	),
							array(
								"type" => "ult_switch",
								"class" => "",
								"heading" => __("Infinite loop", "smile"),
								"param_name" => "infinite_loop",
								// "admin_label" => true,
								"value" => "on",
								"default_set" => "true",
								"options" => array(
										"on" => array(
												"label" => "Restart the slider automatically as it passes the last slide.",
												"on" => "Yes",
												"off" => "No",
											),
									),
								"description" => __("", "smile"),
								"dependency"  => "",
								"group"=> "General",
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Transition speed","smile"),
								"param_name" => "speed",
								"value" => "300",
								"min" => "100",
								"max" => "10000",
								"step" => "100",
								"suffix" => "ms",
								"description" => __("Speed at which next slide comes.","smile"),
								"group"=> "General",
						  	),
							array(
								"type" => "ult_switch",
								"class" => "",
								"heading" => __("Autoplay Slides‏", "smile"),
								"param_name" => "autoplay",
								// "admin_label" => true,
								"value" => "on",
								"default_set" => "true",
								"options" => array(
										"on" => array(
												"label" => "Enable Autoplay",
												"on" => "Yes",
												"off" => "No",
											),
									),
								"description" => __("", "smile"),
								"dependency"  => "",
								"group"=> "General",
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Autoplay Speed","smile"),
								"param_name" => "autoplay_speed",
								"value" => "5000",
								"min" => "100",
								"max" => "10000",
								"step" => "10",
								"suffix" => "ms",
								"description" => __("","smile"),
								"dependency" => Array("element" => "autoplay", "value" => array("on")),
								"group"=> "General",
						  	),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Extra Class","smile"),
								"param_name" => "el_class",
								"value" => "",
								"description" => __("","smile"),
								"group"=> "General",
						  	),
							array(
								"type" => "ult_switch",
								"class" => "",
								"heading" => __("Navigation Arrows", "smile"),
								"param_name" => "arrows",
								// "admin_label" => true,
								"value" => "show",
								"default_set" => "true",
								"options" => array(
										"show" => array(
												"label" => "Display next / previous navigation arrows",
												"on" => "Yes",
												"off" => "No",
											),
									),
								"description" => __("", "smile"),
								"dependency"  => "",
								"group"=> "Navigation",
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Arrow Style","smile"),
								"param_name" => "arrow_style",
								"value" => array(
									"Default" => "default",
									"Circle Background" => "circle-bg",
									"Square Background" => "square-bg",
									"Circle Border" => "circle-border",
									"Square Border" => "square-border",
								),
								"description" => __("","smile"),
								"dependency" => Array("element" => "arrows", "value" => array("show")),
								"group"=> "Navigation",
						  	),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Background Color","smile"),
								"param_name" => "arrow_bg_color",
								"value" => "",
								"description" => __("","smile"),
								"dependency" => Array("element" => "arrow_style", "value" => array("circle-bg","square-bg")),
								"group"=> "Navigation",
						  	),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Border Color","smile"),
								"param_name" => "arrow_border_color",
								"value" => "",
								"description" => __("","smile"),
								"dependency" => Array("element" => "arrow_style", "value" => array("circle-border","square-border")),
								"group"=> "Navigation",
						  	),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Border Size","smile"),
								"param_name" => "border_size",
								"value" => "2",
								"min" => "1",
								"max" => "100",
								"step" => "1",
								"suffix" => "px",
								"description" => __("","smile"),
								"dependency" => Array("element" => "arrow_style", "value" => array("circle-border","square-border")),
								"group"=> "Navigation",
						  	),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Arrow Color","smile"),
								"param_name" => "arrow_color",
								"value" => "#333333",
								"description" => __("","smile"),
								"dependency" => Array("element" => "arrows", "value" => array("show")),
								"group"=> "Navigation",
						  	),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Arrow Size","smile"),
								"param_name" => "arrow_size",
								"value" => "24",
								"min" => "10",
								"max" => "75",
								"step" => "1",
								"suffix" => "px",
								"description" => __("","smile"),
								"dependency" => Array("element" => "arrows", "value" => array("show")),
								"group"=> "Navigation",
						  	),
							array(
								"type" => "slick_icon",
								"class" => "",
								"heading" => __("Select icon for 'Next Arrow'", "smile"),
								"param_name" => "next_icon",
								"value" => "ultsl-arrow-right4",
								"description" => __("","smile"),
								"dependency" => Array("element" => "arrows", "value" => array("show")),
								"group"=> "Navigation",
							),
							array(
								"type" => "slick_icon",
								"class" => "",
								"heading" => __("Select icon for 'Previous Arrow'", "smile"),
								"param_name" => "prev_icon",
								"value" => "ultsl-arrow-left4",
								"description" => __("","smile"),
								"dependency" => Array("element" => "arrows", "value" => array("show")),
								"group"=> "Navigation",
							),
							array(
								"type" => "ult_switch",
								"class" => "",
								"heading" => __("Dots Navigation", "smile"),
								"param_name" => "dots",
								// "admin_label" => true,
								"value" => "show",
								"default_set" => "true",
								"options" => array(
										"show" => array(
												"label" => "Display dot navigation",
												"on" => "Yes",
												"off" => "No",
											),
									),
								"description" => __("", "smile"),
								"dependency"  => "",
								"group"=> "Navigation",
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Color of dots","smile"),
								"param_name" => "dots_color",
								"value" => "#333333",
								"description" => __("","smile"),
								"dependency" => Array("element" => "dots", "value" => array("show")),
								"group"=> "Navigation",
						  	),
							array(
								"type" => "slick_icon",
								"class" => "",
								"heading" => __("Select icon for 'Navigation Dots'", "smile"),
								"param_name" => "dots_icon",
								"value" => "ultsl-record",
								"description" => __("","smile"),
								"dependency" => Array("element" => "dots", "value" => array("show")),
								"group"=> "Navigation",
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Item Animation","smile"),
								"param_name" => "item_animation",
								"value" => array(
							 		__("No Animation","smile") => "",
									__("Swing","smile") => "swing",
									__("Pulse","smile") => "pulse",
									__("Fade In","smile") => "fadeIn",
									__("Fade In Up","smile") => "fadeInUp",
									__("Fade In Down","smile") => "fadeInDown",
									__("Fade In Left","smile") => "fadeInLeft",
									__("Fade In Right","smile") => "fadeInRight",
									__("Fade In Up Long","smile") => "fadeInUpBig",
									__("Fade In Down Long","smile") => "fadeInDownBig",
									__("Fade In Left Long","smile") => "fadeInLeftBig",
									__("Fade In Right Long","smile") => "fadeInRightBig",
									__("Slide In Down","smile") => "slideInDown",
									__("Slide In Left","smile") => "slideInLeft",
									__("Slide In Left","smile") => "slideInLeft",
									__("Bounce In","smile") => "bounceIn",
									__("Bounce In Up","smile") => "bounceInUp",
									__("Bounce In Down","smile") => "bounceInDown",
									__("Bounce In Left","smile") => "bounceInLeft",
									__("Bounce In Right","smile") => "bounceInRight",
									__("Rotate In","smile") => "rotateIn",
									__("Light Speed In","smile") => "lightSpeedIn",
									__("Roll In","smile") => "rollIn",
									),
								"description" => __("", "smile"),
								"group"=> "Animation",
						  	),
							array(
								"type" => "ult_switch",
								"class" => "",
								"heading" => __("Draggable Effect", "smile"),
								"param_name" => "draggable",
								// "admin_label" => true,
								"value" => "on",
								"default_set" => "true",
								"options" => array(
										"on" => array(
												"label" => "Allow slides to be draggable",
												"on" => "Yes",
												"off" => "No",
											),
									),
								"description" => __("", "smile"),
								"dependency"  => "",
								"group"=> "Advanced",
							),
							array(
								"type" => "ult_switch",
								"class" => "",
								"heading" => __("Touch Move", "smile"),
								"param_name" => "touch_move",
								// "admin_label" => true,
								"value" => "on",
								"default_set" => "true",
								"options" => array(
										"on" => array(
												"label" => "Enable slide moving with touch",
												"on" => "Yes",
												"off" => "No",
											),
									),
								"description" => __("", "smile"),
								"dependency" => Array("element" => "draggable", "value" => array("on")),
								"group"=> "Advanced",
							),
							array(
								"type" => "ult_switch",
								"class" => "",
								"heading" => __("RTL Mode", "smile"),
								"param_name" => "rtl",
								// "admin_label" => true,
								"value" => "",
								"options" => array(
										"on" => array(
												"label" => "Turn on RTL mode",
												"on" => "Yes",
												"off" => "No",
											),
									),
								"description" => __("", "smile"),
								"dependency"  => "",
								"group"=> "Advanced",
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Space between two items","smile"),
								"param_name" => "item_space",
								"value" => "15",
								"min" => "0",
								"max" => "1000",
								"step" => "1",
								"suffix" => "px",
								"description" => __("","smile"),
								"group"=> "Advanced",
						  	),
						),
						"js_view" => 'VcColumnView'
					)
				); // vc_map
			}
		}

		function ultimate_carousel_shortcode($atts, $content){
			$slider_type = $slides_on_desk = $slides_on_tabs = $slides_on_mob = $slide_to_scroll = $speed = $infinite_loop = $autoplay = $autoplay_speed = '';
			$lazyload = $arrows = $dots = $dots_icon = $next_icon = $prev_icon = $dots_color = $draggable = $swipe = $touch_move = '';
			$rtl = $arrow_color = $arrow_size = $arrow_style = $arrow_bg_color = $arrow_border_color = $border_size = $item_space = $el_class = '';
			$item_animation = '';
			extract(shortcode_atts(array(
				"slider_type" => "horizontal",
				"slides_on_desk" => "5",
				"slides_on_tabs" => "3",
				"slides_on_mob" => "2",
				"slide_to_scroll" => "all",
				"speed" => "300",
				"infinite_loop" => "on",
				"autoplay" => "on",
				"autoplay_speed" => "5000",
				"lazyload" => "",
				"arrows" => "show",
				"dots" => "show",
				"dots_icon" => "ultsl-record",
				"next_icon" => "ultsl-arrow-right4",
				"prev_icon"=> "ultsl-arrow-left4",
				"dots_color" => "#333333",
				"arrow_color" => "#333333",
				"arrow_size" => "24",
				"arrow_style" => "default",
				"arrow_bg_color" => "",
				"arrow_border_color" => "",
				"border_size" => "2",
				"draggable" => "on",
				"swipe" => "true",
				"touch_move" => "on",
				"rtl" => "",
				"item_space" => "15",
				"el_class" => "",
				"item_animation" => "",
			),$atts));
			$uid = uniqid();

			$settings = $responsive = $infinite = $dot_display = $custom_dots = $arr_style = '';

			if($slide_to_scroll == "all")
				$slide_to_scroll = $slides_on_desk;
			else
				$slide_to_scroll = 1;

			$arr_style .= 'color:'.$arrow_color.'; font-size:'.$arrow_size.'px;';
			if($arrow_style == "circle-bg" || $arrow_style == "square-bg"){
				$arr_style .= "background:".$arrow_bg_color.";";
			} elseif($arrow_style == "circle-border" || $arrow_style == "square-border"){
				$arr_style .= "border:".$border_size."px solid ".$arrow_border_color.";";
			}

			if($dots !== "off" && $dots !== "")
				$settings .= 'dots: true,';
			else
				$settings .= 'dots: false,';
			if($autoplay !== 'off' && $autoplay !== '')
				$settings .= 'autoplay: true,';
			if($autoplay_speed !== '')
				$settings .= 'autoplaySpeed: '.$autoplay_speed.',';
			if($speed !== '')
				$settings .= 'speed: '.$speed.',';
			if($infinite_loop !== 'off' && $infinite_loop !== '')
				$settings .= 'infinite: true,';
			else
				$settings .= 'infinite: false,';
			if($lazyload !== 'off' && $lazyload !== '')
				$settings .= 'lazyLoad: true,';

			if($arrows !== 'off' && $arrows !== ''){
				$settings .= 'arrows: true,';
				$settings .= 'nextArrow: \'<button type="button" style="'.$arr_style.'" class="slick-next '.$arrow_style.'"><i class="'.$next_icon.'"></i></button>\',';
				$settings .= 'prevArrow: \'<button type="button" style="'.$arr_style.'" class="slick-prev '.$arrow_style.'"><i class="'.$prev_icon.'"></i></button>\',';
			} else {
				$settings .= 'arrows: false,';
			}

			if($slide_to_scroll !== '')
				$settings .= 'slidesToScroll:'.$slide_to_scroll.',';
			if($slides_on_desk !== '')
				$settings .= 'slidesToShow:'.$slides_on_desk.',';
			if($slides_on_mob == '')
				$slides_on_mob = $slides_on_desk;
			if($slides_on_tabs == '')
				$slides_on_tabs = $slides_on_desk;
			if($draggable !== 'off' && $draggable !== ''){
				$settings .= 'swipe: true,';
				$settings .= 'draggable: true,';
			} else {
				$settings .= 'swipe: false,';
				$settings .= 'draggable: false,';
			}

			if($touch_move !== "off" && $touch_move !== "")
				$settings .= 'touchMove: true,';
			else
				$settings .= 'touchMove: false,';
			if($rtl !== "off" && $rtl !== "")
				$settings .= 'rtl: true,';

			if($slider_type == "vertical"){
				$settings .= 'vertical: true,';
			}

			$settings .= 'responsive: [
							{
							  breakpoint: 1024,
							  settings: {
								slidesToShow: '.$slides_on_desk.',
								slidesToScroll: '.$slide_to_scroll.',
								'.$infinite.'
								'.$dot_display.'
							  }
							},
							{
							  breakpoint: 768,
							  settings: {
								slidesToShow: '.$slides_on_tabs.',
								slidesToScroll: '.$slides_on_tabs.'
							  }
							},
							{
							  breakpoint: 480,
							  settings: {
								slidesToShow: '.$slides_on_mob.',
								slidesToScroll: '.$slides_on_mob.'
							  }
							}
						],';
			$settings .= 'pauseOnHover: true,
						pauseOnDotsHover: true,';
			if($dots_icon !== 'off' && $dots_icon !== ''){
				if($dots_color !== 'off' && $dots_color !== '')
					$custom_dots = 'style="color:'.$dots_color.';"';
				$settings .= 'customPaging: function(slider, i) {
                   return \'<i type="button" '.$custom_dots.' class="'.$dots_icon.'" data-role="none"></i>\';
                },';
			}

			if($item_animation == ''){
				$item_animation = 'no-animation';
			}
			ob_start();
			echo '<div class="ult-carousel-wrapper ult_'.$slider_type.'">';
				echo '<div class="ult-carousel-'.$uid.' '.$el_class.'">';
					ultimate_override_shortcodes($item_space, $item_animation);
					echo do_shortcode($content);
					ultimate_restore_shortcodes();
				echo '</div>';
			echo '</div>';
			?>
            <script type="text/javascript">
                jQuery('.ult-carousel-<?php echo $uid; ?>').slick({<?php echo $settings; ?>});
			</script>
            <?php
			return ob_get_clean();
		}

		// create icon style attribute
		function icon_settings_field($settings, $value)
		{
			$dependency = '';
			$uid = uniqid();
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			if($param_name == "next_icon" || $param_name == "prev_icon"){
				$icons = array('ultsl-arrow-right','ultsl-arrow-right2','ultsl-arrow-right3','ultsl-arrow-right4','ultsl-arrow-right6');
			}
			if($param_name == "prev_icon"){
				$icons = array('ultsl-arrow-left','ultsl-arrow-left2','ultsl-arrow-left3','ultsl-arrow-left4','ultsl-arrow-left6');
			}

			if($param_name == "dots_icon"){
				$icons = array('ultsl-checkbox-unchecked','ultsl-checkbox-partial','ultsl-stop','ultsl-radio-checked','ultsl-radio-unchecked','ultsl-record');
			}

			$output = '<input type="hidden" name="'.$param_name.'" class="wpb_vc_param_value '.$param_name.' '.$type.' '.$class.'" value="'.$value.'" id="trace-'.$uid.'"/>';
			//$output .= '<div class="ult-icon-preview icon-preview-'.$uid.'"><i class="'.$value.'"></i></div>';
			//$output .='<input class="search" type="text" placeholder="Search" />';
			$output .='<div id="icon-dropdown-'.$uid.'" >';
			$output .= '<ul class="icon-list">';
			$n = 1;
			foreach($icons as $icon)
			{
				$selected = ($icon == $value) ? 'class="selected"' : '';
				$id = 'icon-'.$n;
				$output .= '<li '.$selected.' data-icon="'.$icon.'"><i class="ult-icon '.$icon.'"></i><label class="ult-icon">'.$icon.'</label></li>';
				$n++;
			}
			$output .='</ul>';
			$output .='</div>';
			$output .= '<script type="text/javascript">
					jQuery("#icon-dropdown-'.$uid.' li").click(function() {
						jQuery(this).attr("class","selected").siblings().removeAttr("class");
						var icon = jQuery(this).attr("data-icon");
						jQuery("#trace-'.$uid.'").val(icon);
						jQuery(".icon-preview-'.$uid.'").html("<i class=\'ult-icon "+icon+"\'></i>");
					});
			</script>';
			$output .= '<style type="text/css">';
			$output .= 'ul.icon-list li {
							display: inline-block;
							float: left;
							padding: 5px;
							border: 1px solid #ddd;
							font-size: 18px;
							width: 18px;
							height: 18px;
							line-height: 18px;
							margin: 0 auto;
						}
						ul.icon-list li label.ult-icon {
							display: none;
						}
						.ult-icon-preview {
							padding: 5px;
							font-size: 24px;
							border: 1px solid #ddd;
							display: inline-block;
						}
						ul.icon-list li.selected {
							background: #3486D1;
							padding: 10px;
							margin: 0 -1px;
							margin-top: -7px;
							color: #fff;
							font-size: 24px;
							width: 24px;
							height: 24px;
						}';
			$output .= '</style>';
			return $output;
		}
		// ult_switch param
		function checkbox_param($settings, $value){
			$dependency = '';
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$options = isset($settings['options']) ? $settings['options'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$output = $checked = '';
			$un = uniqid();
			if(is_array($options) && !empty($options)){
				foreach($options as $key => $opts){
					if($value == $key){
						$checked = "checked";
					} else {
						$checked = "";
					}
					$uid = uniqid();
					$output .= '<div class="onoffswitch">
							<input type="checkbox" name="'.$param_name.'" value="'.$value.'" '.$dependency.' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . ' '.$dependency.' onoffswitch-checkbox chk-switch-'.$un.'" id="switch'.$uid.'" '.$checked.'>
							<label class="onoffswitch-label" for="switch'.$uid.'">
								<div class="onoffswitch-inner">
									<div class="onoffswitch-active">
										<div class="onoffswitch-switch">'.$opts['on'].'</div>
									</div>
									<div class="onoffswitch-inactive">
										<div class="onoffswitch-switch">'.$opts['off'].'</div>
									</div>
								</div>
							</label>
						</div>';
					$output .= '<div class="chk-label">'.$opts['label'].'</div><br/>';
				}
			}

			//$output .= '<input type="hidden" id="chk-switch-'.$un.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" />';
			$output .= '<script type="text/javascript">
				jQuery("#switch'.$uid.'").change(function(){

					 if(jQuery("#switch'.$uid.'").is(":checked")){
						jQuery("#switch'.$uid.'").val("'.$key.'");
						jQuery("#switch'.$uid.'").attr("checked","checked");
					 } else {
						jQuery("#switch'.$uid.'").val("off");
						jQuery("#switch'.$uid.'").removeAttr("checked");
					 }

				});
			</script>';

			return $output;
		}

		// Function generate param type "number"
		function number_settings_field($settings, $value)
		{
			$dependency = '';
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$min = isset($settings['min']) ? $settings['min'] : '';
			$max = isset($settings['max']) ? $settings['max'] : '';
			$step = isset($settings['step']) ? $settings['step'] : '';
			$suffix = isset($settings['suffix']) ? $settings['suffix'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$output = '<input type="number" min="'.$min.'" max="'.$max.'" step="'.$step.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" style="max-width:100px; margin-right: 10px;" />'.$suffix;
			return $output;
		}

	}
	add_action('init','advanced_carousel_vc_init');
	function advanced_carousel_vc_init(){
		new Ultimate_Carousel;
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
			class WPBakeryShortCode_ultimate_carousel extends WPBakeryShortCodesContainer {
			}
		}
	}
}
if(!function_exists('ultimate_override_shortcodes')){
	function ultimate_override_shortcodes($item_space, $item_animation) {
		global $shortcode_tags, $_shortcode_tags;
		// Let's make a back-up of the shortcodes
		$_shortcode_tags = $shortcode_tags;
		// Add any shortcode tags that we shouldn't touch here
		$disabled_tags = array( '' );
		foreach ( $shortcode_tags as $tag => $cb ) {
			if ( in_array( $tag, $disabled_tags ) ) {
				continue;
			}
			// Overwrite the callback function
			$shortcode_tags[ $tag ] = 'ultimate_wrap_shortcode_in_div';
			$_shortcode_tags["ult_item_space"] = $item_space;
			$_shortcode_tags["item_animation"] = $item_animation;
		}
	}
}
// Wrap the output of a shortcode in a div with class "ult-item-wrap"
// The original callback is called from the $_shortcode_tags array
if(!function_exists('ultimate_wrap_shortcode_in_div')){
	function ultimate_wrap_shortcode_in_div( $attr, $content = null, $tag ) {
		global $_shortcode_tags;

		return '<div class="ult-item-wrap" data-animation="animated '.$_shortcode_tags["item_animation"].'" style="padding:0 '.$_shortcode_tags["ult_item_space"].'px;">' . call_user_func( $_shortcode_tags[ $tag ], $attr, $content, $tag ) . '</div>';
	}
}

if(!function_exists('ultimate_restore_shortcodes')){
	function ultimate_restore_shortcodes() {
		global $shortcode_tags, $_shortcode_tags;
		// Restore the original callbacks
		if ( isset( $_shortcode_tags ) ) {
			$shortcode_tags = $_shortcode_tags;
		}
	}
}

// bsf core
$bsf_core_version_file = realpath(dirname(__FILE__).'/admin/bsf-core/version.yml');
if(is_file($bsf_core_version_file)) {
	global $bsf_core_version, $bsf_core_path;
	$bsf_core_dir = realpath(dirname(__FILE__).'/admin/bsf-core/');
	$version = file_get_contents($bsf_core_version_file);
	if(version_compare($version, $bsf_core_version, '>')) {
		$bsf_core_version = $version;
		$bsf_core_path = $bsf_core_dir;
	}
}
add_action('init', 'bsf_core_load', 999);
if(!function_exists('bsf_core_load')) {
	function bsf_core_load() {
		global $bsf_core_version, $bsf_core_path;
		if(is_file(realpath($bsf_core_path.'/index.php'))) {
			include_once realpath($bsf_core_path.'/index.php');
		}
	}
}

// BSF CORE commom functions
if(!function_exists('bsf_get_option')) {
	function bsf_get_option($request = false) {
		$bsf_options = get_option('bsf_options');
		if(!$request)
			return $bsf_options;
		else
			return (isset($bsf_options[$request])) ? $bsf_options[$request] : false;
	}
}
if(!function_exists('bsf_update_option')) {
	function bsf_update_option($request, $value) {
		$bsf_options = get_option('bsf_options');
		$bsf_options[$request] = $value;
		return update_option('bsf_options', $bsf_options);
	}
}
add_action( 'wp_ajax_bsf_dismiss_notice', 'bsf_dismiss_notice');
if(!function_exists('bsf_dismiss_notice')) {
	function bsf_dismiss_notice() {
		$notice = $_POST['notice'];
		$x = bsf_update_option($notice, true);
		echo ($x) ? true : false;
		die();
	}
}

add_action('admin_init', 'bsf_core_check',10);
if(!function_exists('bsf_core_check')) {
	function bsf_core_check() {
		if(!defined('BSF_CORE')) {
			if(!bsf_get_option('hide-bsf-core-notice'))
				add_action( 'admin_notices', 'bsf_core_admin_notice' );
		}
	}
}

if(!function_exists('bsf_core_admin_notice')) {
	function bsf_core_admin_notice() {
		?>
		<script type="text/javascript">
		(function($){
			$(document).ready(function(){
				$(document).on( "click", ".bsf-notice", function() {
					var bsf_notice_name = $(this).attr("data-bsf-notice");
				    $.ajax({
				        url: ajaxurl,
				        method: 'POST',
				        data: {
				            action: "bsf_dismiss_notice",
				            notice: bsf_notice_name
				        },
				        success: function(response) {
				        	console.log(response);
				        }
				    })
				})
			});
		})(jQuery);
		</script>
		<div class="bsf-notice update-nag notice is-dismissible" data-bsf-notice="hide-bsf-core-notice">
            <p><?php _e( 'License registration and extensions are not part of plugin/theme anymore. Kindly download and install "BSF CORE" plugin to manage your licenses and extensins.', 'bsf' ); ?></p>
        </div>
		<?php
	}
}

if(isset($_GET['hide-bsf-core-notice']) && $_GET['hide-bsf-core-notice'] === 're-enable') {
	$x = bsf_update_option('hide-bsf-core-notice', false);
}

// end of common functions
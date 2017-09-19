<?php

if (!class_exists('IdeoThemoGeneratePageCss')) {
	class IdeoThemoGeneratePageCss
	{
		/** @var  boolean */
		private $safeMode;

		/** @var bool Blocks auto generation of styles (f.i. while importing) */
		public static $BlockAutoGenerate = false;

		/**
		 * @param bool $safeMode True - when error occurs generator will throw exception but not die
		 */
		function __construct($safeMode = false)
		{
			$this->safeMode = $safeMode;

			add_action( 'wp_insert_post', array( $this, 'action' ), 99, 3 );
		}

		public function action($post_ID, $post, $update) {
            
            if ( self::$BlockAutoGenerate || $post->post_status != 'publish' || $post->post_type == 'nav_menu_item'
				|| $post->post_type == 'revision' || $post->post_type == 'vc_settings_preset'
				|| $post->post_type == 'the_grid') {
				return;
			}
            if (isset($_POST['_inline_edit']) && wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce')){
                return;                
            }
            
            if (!class_exists('Less_Parser')) {
                return array('error' => 'error_2');
            }

			$options = array('compress' => true, 'sourceMap' => false);
			$parser = new Less_Parser($options);
            
            wp_cache_delete('ideo_options');
                        
			$modifyVars = array(
                'is_global_style' => '0',
					
				'boxed_background_type' => ideothemo_get_custom_post_meta('generals.background.boxed_background_type', $post_ID),
				'boxed_background_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('generals.background.boxed_background_color'), 'undefined'),
				'boxed_background_cover' => ideothemo_get_custom_post_meta('generals.background.boxed_background_cover'),
				'boxed_background_upload_image' => ideothemo_is_image( ideothemo_get_custom_post_meta('generals.background.boxed_background_upload_image') ),
				'boxed_background_image_position' => ideothemo_get_custom_post_meta_to_css('generals.background.boxed_background_image_position'),
				'boxed_background_image_repeat' => ideothemo_get_custom_post_meta_to_css('generals.background.boxed_background_image_repeat', '-'),
				'boxed_background_image_motion' => ideothemo_get_custom_post_meta('generals.background.boxed_background_image_motion'),
				'boxed_background_overlay' => ideothemo_get_boxed_background_overlay_type(1),
				'boxed_background_overlay_color' => ideothemo_is_color(ideothemo_get_boxed_background_overlay_color(1)),
				'boxed_background_pattern' => ideothemo_get_boxed_background_overlay_type(1) == 'pattern' ? 'url(' . ideothemo_get_boxed_overlay_pattern(1) . ')' : '',

				'content_background_type' => ideothemo_get_custom_post_meta('generals.background.content_background_type'),
				'content_background_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('generals.background.content_background_color'), 'undefinde'),
				'content_background_cover' => ideothemo_get_custom_post_meta('generals.background.content_background_cover'),
				'content_background_upload_image' => ideothemo_is_image( ideothemo_get_custom_post_meta('generals.background.content_background_upload_image') ),
				'content_background_image_position' => ideothemo_get_custom_post_meta_to_css('generals.background.content_background_image_position'),
				'content_background_image_repeat' => ideothemo_get_custom_post_meta_to_css('generals.background.content_background_image_repeat', '-'),
				'content_background_image_motion' => ideothemo_get_custom_post_meta('generals.background.content_background_image_motion'),
				'content_background_overlay' => ideothemo_get_content_background_overlay_type(1),
				'content_background_overlay_color' => ideothemo_is_color(ideothemo_get_content_background_overlay_color(1)),
                                'content_background_pattern' => ideothemo_get_content_background_overlay_type(1) == 'pattern' ? 'url(' . ideothemo_get_content_overlay_pattern(1) . ')' : '',
				'pt_title_area_background' => ideothemo_get_custom_post_meta('pagetitle.page_title_background.page_title_area_background'),
				'pt_background_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('pagetitle.page_title_background.pt_background_color')),
				'pt_background_upload_image' => ideothemo_is_image(ideothemo_get_custom_post_meta('pagetitle.page_title_background.pt_background_upload_image')),
				'pt_background_cover' => ideothemo_get_custom_post_meta('pagetitle.page_title_background.pt_background_cover'),
				'pt_background_image_position' => ideothemo_get_custom_post_meta_to_css('pagetitle.page_title_background.pt_background_image_position'),
				'pt_background_image_repeat' => ideothemo_get_custom_post_meta_to_css('pagetitle.page_title_background.pt_background_image_repeat', '-'),
				'pt_background_overlay' => ideothemo_get_pt_background_overlay_type(1),
				'pt_background_overlay_color' => ideothemo_get_pt_background_overlay_color(1),
				'pt_background_pattern' => ideothemo_get_pt_background_overlay_type(1) == 'pattern' ? 'url(' . ideothemo_get_pt_overlay_pattern(1) . ')' : '',
				'copyrights_text_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('footer.copyrights_coloring.copyrights_text_color'), 'undefined'),
				'copyrights_background_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('footer.copyrights_coloring.copyrights_background_color'), 'undefined'),

				'footer_column_paddings' => ideothemo_get_custom_post_meta('footer.standard_footer_layout.footer_column_paddings'),
				'footer_padding_top' => 0, 
				'footer_padding_bottom' => 0, 
				'footer_layout' => ideothemo_get_custom_post_meta('footer.standard_footer_layout.footer_layout'),
				'footer_custom_layout' => (int)ideothemo_get_custom_post_meta('footer.standard_footer_layout.footer_custom_layout'),

				//FOOTER WIDGET TITLE
				'widget_title_font_size' => ideothemo_get_css_value_with_unit(ideothemo_get_custom_post_meta('footer.widgets_title_font.widget_title_font_size'), 'px'),
				'widget_title_line_height' =>  ideothemo_get_css_value_with_unit(ideothemo_get_custom_post_meta('footer.widgets_title_font.widget_title_line_height'), ''),
				'widget_title_font_family' => ideothemo_get_custom_post_meta('footer.widgets_title_font.widget_title_font_family'),
				'widget_title_font_weight' => ideothemo_get_custom_post_meta('footer.widgets_title_font.widget_title_font_weight'),

				//STANDARD FOOTER CONTENT COLORING
				'standard_footer_skin' => ideothemo_get_footer_skin($post_ID),
				'standard_footer_accent_color_light' => ideothemo_is_color(ideothemo_get_custom_post_meta('footer.standard_footer_coloring.footer_light_accent_color'), 'undefined'),
				'standard_footer_widget_title_light' => ideothemo_is_color(ideothemo_get_custom_post_meta('footer.standard_footer_coloring.footer_light_widgets_title_color'), 'undefined'),
				'standard_footer_widget_text_light' => ideothemo_is_color(ideothemo_get_custom_post_meta('footer.standard_footer_coloring.footer_light_widgets_text_color'), 'undefined'),

				//STANDARD FOOTER BACKGROUND
				'footer_background_type' => ideothemo_get_custom_post_meta('footer.standard_footer_background.footer_background_type'),
				'footer_background_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('footer.standard_footer_background.footer_background_color')),
				'footer_background_cover' => -1,
				'footer_background_upload_image' => ideothemo_is_image( ideothemo_get_custom_post_meta('footer.standard_footer_background.footer_background_upload_image') ),
				'footer_background_image_position' => ideothemo_get_custom_post_meta_to_css('footer.standard_footer_background.footer_background_image_position'),
				'footer_background_image_repeat' => ideothemo_get_custom_post_meta_to_css('footer.standard_footer_background.footer_background_image_repeat', '-'),

				'footer_background_overlay' => ideothemo_get_footer_background_overlay_type(1),
				'footer_background_overlay_color' => ideothemo_is_color(ideothemo_get_footer_background_overlay_color(1)),
				'footer_background_pattern' => ideothemo_get_footer_background_overlay_type(1) == 'pattern' ? 'url(' . ideothemo_get_footer_overlay_pattern(1) . ')' : '',

				//COPYRIGHT
				'copyright_text_align' => ideothemo_get_custom_post_meta('footer.footer_settings.copyright_text_align'),
				'copyright_paddings' => (int)ideothemo_get_custom_post_meta('footer.footer_settings.copyright_paddings'),

				//COPYRIGHT FONTS
				'copyrights_font_size' => ideothemo_get_css_value_with_unit(ideothemo_get_custom_post_meta('footer.copyrights_font.copyrights_font_size'), 'px'),
				'copyrights_line_height' => ideothemo_get_css_value_with_unit(ideothemo_get_custom_post_meta('footer.copyrights_font.copyrights_line_height'), ''),
				'copyrights_font_family' => ideothemo_get_custom_post_meta('footer.copyrights_font.copyrights_font_family'),
				'copyrights_font_weight' => ideothemo_get_custom_post_meta('footer.copyrights_font.copyrights_font_weight'),

				//COPYRIGHT COLORING
				'copyrights_light_background_color' => ideothemo_is_color( ideothemo_get_custom_post_meta('footer.copyrights_coloring.copyrights_light_background_color'), 'undefined'),
				'copyrights_light_text_color' => ideothemo_is_color( ideothemo_get_custom_post_meta('footer.copyrights_coloring.copyrights_light_text_color'), 'undefined'),

				'copyrights_dark_background_color' => ideothemo_is_color( ideothemo_get_custom_post_meta('footer.copyrights_coloring.copyrights_dark_background_color'), 'undefined'),
				'copyrights_dark_text_color' => ideothemo_is_color( ideothemo_get_custom_post_meta('footer.copyrights_coloring.copyrights_dark_text_color'), 'undefined'),

				'skin'         => ideothemo_get_sidebar_skin($post_ID),//ideothemo_blog_get_option(ideothemo_get_general_theme_skin(), ideothemo_get_custom_post_meta('sidebar.sidebar_settings.sidebar_skin', $post_ID)),
				'accent_color' => ideothemo_is_color( ideothemo_get_custom_post_meta( 'sidebar.sidebar_coloring.sidebar_light_accent_color' ) , 'undefined' ),
				'title_color'  => ideothemo_is_color( ideothemo_get_custom_post_meta( 'sidebar.sidebar_coloring.sidebar_light_titles_color' ) , 'undefined' ),
				'text_color'   => ideothemo_is_color( ideothemo_get_custom_post_meta( 'sidebar.sidebar_coloring.sidebar_light_text_color' ) , 'undefined' ),

				'pt_title_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('pagetitle.page_title_coloring.pt_title_color'), 'undefined'),
				'pt_subtitle_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('pagetitle.page_title_coloring.pt_subtitle_color'), 'undefined'),
				'pt_b_border_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('pagetitle.page_title_coloring.pt_b_border_color'), 'undefined'),
				'pt_b_background_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('pagetitle.page_title_coloring.pt_b_background_color'), 'undefined'),
				'pt_b_text_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('pagetitle.page_title_coloring.pt_b_text_color'), 'undefined'),
				'pt_b_text_accent_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('pagetitle.page_title_coloring.pt_b_text_accent_color'), 'undefined'),

                
				'page_title_area_height' => ideothemo_get_css_value_with_unit(ideothemo_get_custom_post_meta('pagetitle.page_title_settings.page_title_area_height'), 'px'),
				'page_title_area_content_align' => ideothemo_get_custom_post_meta('pagetitle.page_title_settings.page_title_area_content_align'),

				// PAGE TITLE COLORING
				'pt_light_title_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('pagetitle.page_title_coloring.pt_light_title_color')),
				'pt_light_subtitle_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('pagetitle.page_title_coloring.pt_light_subtitle_color')),

				'pt_dark_title_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('pagetitle.page_title_coloring.pt_dark_title_color')),
				'pt_dark_subtitle_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('pagetitle.page_title_coloring.pt_dark_subtitle_color')),

				//BREDCRUMBS COLORING
				'pt_light_b_text_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('pagetitle.page_title_coloring.pt_light_b_text_color', null, 'undefined')),
				'pt_light_b_text_accent_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('pagetitle.page_title_coloring.pt_light_b_text_accent_color', null, 'undefined')),
				'pt_light_b_background_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('pagetitle.page_title_coloring.pt_light_b_background_color', null, 'undefined')),
				'pt_light_b_border_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('pagetitle.page_title_coloring.pt_light_b_border_color', null, 'undefined')),

				'pt_dark_b_text_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('pagetitle.page_title_coloring.pt_dark_b_text_color', null, 'undefined')),
				'pt_dark_b_text_accent_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('pagetitle.page_title_coloring.pt_dark_b_text_accent_color', null, 'undefined')),
				'pt_dark_b_background_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('pagetitle.page_title_coloring.pt_dark_b_background_color', null, 'undefined')),
				'pt_dark_b_border_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('pagetitle.page_title_coloring.pt_dark_b_border_color', null, 'undefined')),


				//PAGE TITLE FONTS
				'pt_title_font_size' => ideothemo_get_css_value_with_unit(ideothemo_get_custom_post_meta('pagetitle.page_title_fonts.pt_title_font_size'), 'px'),
				'pt_title_line_height' => '1em',
				'pt_title_font_family' => ideothemo_get_custom_post_meta('pagetitle.page_title_fonts.pt_title_font_family', null, 'undefined'),
				'pt_title_font_weight' => (int)ideothemo_get_custom_post_meta('pagetitle.page_title_fonts.pt_title_font_weight'),
				'pt_title_font_italic' => ideothemo_font_is_italic(ideothemo_get_custom_post_meta('pagetitle.page_title_fonts.pt_title_font_weight')),
				'pt_subtitle_font_size' => ideothemo_get_css_value_with_unit(ideothemo_get_custom_post_meta('pagetitle.page_title_fonts.pt_subtitle_font_size'), 'px'),
				'pt_subtitle_line_height' => '1.2em',
				'pt_subtitle_font_family' => ideothemo_get_custom_post_meta('pagetitle.page_title_fonts.pt_subtitle_font_family', null, 'undefined'),
				'pt_subtitle_font_weight' => (int)ideothemo_get_custom_post_meta('pagetitle.page_title_fonts.pt_subtitle_font_weight'),

				//BREADCRUMBS FONT
				'pt_breadcrumbs_font_size' => ideothemo_get_css_value_with_unit(ideothemo_get_custom_post_meta('pagetitle.page_title_fonts.pt_breadcrumbs_font_size'), 'px'),
				'pt_breadcrumbs_line_height' => ideothemo_get_css_value_with_unit(ideothemo_get_custom_post_meta('pagetitle.page_title_fonts.pt_breadcrumbs_line_height'), ''),
				'pt_breadcrumbs_font_family' => ideothemo_get_custom_post_meta('pagetitle.page_title_fonts.pt_breadcrumbs_font_family', null, 'undefined'),
				'pt_breadcrumbs_font_weight' => (int)ideothemo_get_custom_post_meta('pagetitle.page_title_fonts.pt_breadcrumbs_font_weight'),

				'header_menu_top_height' => (int)ideothemo_get_header_setting('top.height'),
				'header_menu_enabled' => ideothemo_get_header_setting('overwrite_global_header'),
				'header_menu_real_height' => (int)ideothemo_calc_header_menu_height(),
                
                //TOPBAR
                'header_top_bar_height' => (int)ideothemo_get_header_setting( 'top.topbar.height' ) ?: 35,

				'parametrs_font_size' => ideothemo_get_css_value_with_unit(ideothemo_get_custom_post_meta('parametrs_font_size'), 'px'),
				'parametrs_label_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('parametrs_label_color'), 'undefined'),
				'parametrs_value_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('parametrs_value_color'), 'undefined'),

				'navbar_background_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('navbar_background_color'), 'undefined'),
                'navbar_border_top_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('navbar_border_top_color'), 'undefined'),
                'navbar_border_bottom_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('navbar_border_bottom_color'), 'undefined'),
				'navbar_icons_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('navbar_icons_color'), 'undefined'),
				'navbar_icons_hover_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('navbar_icons_hover_color'), 'undefined'),
				'navbar_share_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('navbar_share_color'), 'undefined'),

				'content_padding_top' =>  ideothemo_get_css_value_with_unit( ideothemo_get_custom_post_meta('generals.layout.content_padding_top'), 'px'),
				'content_padding_bottom' => ideothemo_get_css_value_with_unit( ideothemo_get_custom_post_meta('generals.layout.content_padding_bottom'), 'px'),
                
				'header_border_bottom_thickness' => (int) ideothemo_get_header_setting( 'top_sticky.'.(str_replace('-', '.', ideothemo_get_header_style( true, 'top'))).'.border_bottom.thickness' ) , ///pobranie border_bottom.thickness dla aktuanie wybranego stylu

				'member_image_border_color' => ideothemo_is_color(ideothemo_get_custom_post_meta('member_image_border_color'), 'undefined'),
                
               
                'colored_dark_title_color' => ideothemo_is_color( ideothemo_get_custom_post_meta( 'shortcodes.shortcodes_coloring.sc_colored_dark_title_color' ) ),
                'colored_dark_text_color' => ideothemo_is_color( ideothemo_get_custom_post_meta( 'shortcodes.shortcodes_coloring.sc_colored_dark_text_color' ) ),
                'colored_dark_alternative_title_color' => ideothemo_is_color( ideothemo_get_custom_post_meta( 'shortcodes.shortcodes_coloring.sc_colored_dark_alternative_title_color' ) ),
                'colored_light_title_color' => ideothemo_is_color( ideothemo_get_custom_post_meta( 'shortcodes.shortcodes_coloring.sc_colored_light_title_color' ) ),                
                'colored_light_text_color' => ideothemo_is_color( ideothemo_get_custom_post_meta( 'shortcodes.shortcodes_coloring.sc_colored_light_text_color' ) ),
                'colored_light_alternative_title_color' => ideothemo_is_color( ideothemo_get_custom_post_meta( 'shortcodes.shortcodes_coloring.sc_colored_light_alternative_title_color' ) ),

				//HEADER
                'header_menu_top_top_distance' => is_numeric(ideothemo_get_custom_post_meta('header.top.top_distance')) ? ideothemo_get_css_value_with_unit(ideothemo_get_custom_post_meta('header.top.top_distance'), 'px') : (int)ideothemo_get_header_setting('top.top_distance'),
                'header_menu_top_top_distance_custom' => is_numeric(ideothemo_get_custom_post_meta('header.top.top_distance')) ? ideothemo_get_css_value_with_unit(ideothemo_get_custom_post_meta('header.top.top_distance'), 'px') : 'false',
				'header_menu_sticky_height' => (int)ideothemo_get_header_setting( 'sticky.height' ),
				'header_menu_sticky_top_distance' => is_numeric(ideothemo_get_custom_post_meta('header.sticky.top_distance')) ? ideothemo_get_css_value_with_unit(ideothemo_get_custom_post_meta('header.sticky.top_distance'), 'px') : (int)ideothemo_get_header_setting('sticky.top_distance'),
				'header_menu_sticky_top_distance_custom' => is_numeric(ideothemo_get_custom_post_meta('header.sticky.top_distance')) ? ideothemo_get_css_value_with_unit(ideothemo_get_custom_post_meta('header.sticky.top_distance'), 'px') : 'false',

				'header_side_offcanvas_topbar_height'                                                     => (int)ideothemo_get_header_setting( 'side.offcanvas.topbar.height' ),  
			);

            //set default values content padding 
            $modifyVars['post_content_padding_top'] = $modifyVars['content_padding_top'];
            $modifyVars['post_content_padding_top_custom'] = ($modifyVars['content_padding_top'] !== 'false' ? 'true' : 'false');
            
            $modifyVars['content_padding_top_custom'] = ($modifyVars['content_padding_top'] !== 'false' ? 'true' : 'false');
            $modifyVars['content_padding_bottom_custom'] = ($modifyVars['content_padding_bottom'] !== 'false' ? 'true' : 'false');
            
            if($modifyVars['content_padding_top'] === 'false'){
                $modifyVars['content_padding_top'] = 50;
            }           
            
            if($modifyVars['post_content_padding_top'] === 'false'){
                $modifyVars['post_content_padding_top'] = 40;
            }
            if($modifyVars['content_padding_bottom'] === 'false'){
                $modifyVars['content_padding_bottom'] = 40;
            }

			$text_color = ideothemo_get_custom_post_meta('footer.copyrights_coloring.copyrights_text_color');
			$background_color = ideothemo_get_custom_post_meta('footer.copyrights_coloring.copyrights_background_color');

			if ($text_color) {
				$modifyVars['copyrights_light_text_color'] = $text_color;
				$modifyVars['copyrights_dark_text_color'] = $text_color;
			}

			if ($background_color) {
				$modifyVars['copyrights_light_background_color'] = $background_color;
				$modifyVars['copyrights_dark_background_color'] = $background_color;
			}
                        
            if('image' === $modifyVars['footer_background_type']) {
                $modifyVars['footer_background_cover'] = ideothemo_get_custom_post_meta('footer.standard_footer_background.footer_background_cover');
            }
            
			$parser->ModifyVars($modifyVars);
            
			$css = '';
            
			try {
				$parser -> parseFile(IDEOTHEMO_LESS_DIR . 'page-options.less');
                if(!empty($modifyVars['boxed_background_type'])) {
                    $parser->parseFile(IDEOTHEMO_LESS_DIR . 'background/boxed.less');
                }

                if(!empty($modifyVars['content_background_type'])) {
                    $parser->parseFile(IDEOTHEMO_LESS_DIR . 'background/content.less');
                }
                
				if ( ! empty( $modifyVars['pt_title_area_background'] ) ) {
					$parser->parseFile( IDEOTHEMO_LESS_DIR . 'background/header.less' );
				}
                
				$parser->parseFile(IDEOTHEMO_LESS_DIR . 'footer/styling/default.less');
				$parser->parseFile(IDEOTHEMO_LESS_DIR . 'footer/coloring/page-options.less');
				$parser->parseFile(IDEOTHEMO_LESS_DIR . 'sidebar/coloring/page-options.less');
				$parser->parseFile(IDEOTHEMO_LESS_DIR . 'header/styling/default.less');
				$parser->parseFile(IDEOTHEMO_LESS_DIR . 'header/coloring/page-options.less');
				$parser->parseFile(IDEOTHEMO_LESS_DIR . 'header/styling/portfolio.less');
				$parser->parseFile(IDEOTHEMO_LESS_DIR . 'header/styling/team.less');

				$css = $parser->getCss();

			} catch (Exception $e) {
				if (!$this->safeMode)
					throw $e;

				return array('error' => 'error');
			}

			ideothemo_save_cache_css( '/post-' . $post_ID . '.css', $css );
			add_post_meta( $post_ID, 'ideo_css_date', time(), 1 );
            
            return true;
		}

		public function allPages()
		{
			global $post;

            $posts = get_posts(array('posts_per_page' => -1, 'post_type' => array('page','post',ideothemo_get_portfolio_slug(),'team')));
            
            $this->action(0, (object)array('post_status' => 'publish'), false);
            
			foreach ($posts as $post)
			{
				setup_postdata( $post );
				$this->action($post->ID, $post, false);
			}
            
            
			wp_reset_postdata();
		}
	}

	new IdeoThemoGeneratePageCss;
}
<?php

if ( ! class_exists('IdeoThemoGenerateGeneralCss')) {
    class IdeoThemoGenerateGeneralCss
    {
		/** @var boolean */
		private $safeMode;

		/**
		 * IdeoGenerateGeneralCss constructor.
		 * @param bool $safeMode True - when error occurs generator will throw exception but not die
		 */
        function __construct($safeMode = false)
        {
			$this->safeMode = $safeMode;
            add_action('after_setup_theme', array($this, 'render'));
        }

        public function customizer()
        {
            $atts['vars']  = $this->default_vars();
            $atts['files'] = array( IDEOTHEMO_LESS_DIR . 'style.less' );

            $css = $this->generate_css( $atts );
            
            if(isset($css['error'])){
                return $css;
            }

            if ($css) {
                ideothemo_save_cache_css( 'style.css', $css );
                update_option( 'ideo_css_date', time(), 1 );
            }
            
            return true;
        }

        public function shortcodes()
        {
            $atts['vars']  = $this->default_vars(); 
            
            $atts['files'] = array(
                IDEOTHEMO_SC_LESS_DIR .'/page-section.less',
                IDEOTHEMO_SC_LESS_DIR .'/column.less',
                IDEOTHEMO_SC_LESS_DIR .'/button.less',
                IDEOTHEMO_SC_LESS_DIR .'/tabs.less',
                IDEOTHEMO_SC_LESS_DIR .'/accordion.less',
                IDEOTHEMO_SC_LESS_DIR .'/column-text.less',
                IDEOTHEMO_SC_LESS_DIR .'/column-text-styled.less',
                IDEOTHEMO_SC_LESS_DIR .'/diver.less',
                IDEOTHEMO_SC_LESS_DIR .'/progress-bar.less',
                IDEOTHEMO_SC_LESS_DIR .'/calltoaction.less',
                IDEOTHEMO_SC_LESS_DIR .'/iconbox.less',
                IDEOTHEMO_SC_LESS_DIR .'/imagebox.less',
                IDEOTHEMO_SC_LESS_DIR .'/pie-chart.less',
                IDEOTHEMO_SC_LESS_DIR .'/counter.less',
                IDEOTHEMO_SC_LESS_DIR .'/message-box.less',
                IDEOTHEMO_SC_LESS_DIR .'/custom-list.less',
                IDEOTHEMO_SC_LESS_DIR .'/testimonials-slider.less',
                IDEOTHEMO_SC_LESS_DIR .'/single-image.less',
                IDEOTHEMO_SC_LESS_DIR .'/icons.less',
                IDEOTHEMO_SC_LESS_DIR .'/google-map.less',
                IDEOTHEMO_SC_LESS_DIR .'/wow-title.less',
                IDEOTHEMO_SC_LESS_DIR .'/box.less',
                IDEOTHEMO_SC_LESS_DIR .'/pricing-table.less',
                IDEOTHEMO_SC_LESS_DIR .'/team-box.less',
                IDEOTHEMO_SC_LESS_DIR .'/team-box-caption.less',
                IDEOTHEMO_SC_LESS_DIR .'/lightbox.less',
                IDEOTHEMO_SC_LESS_DIR .'/contact-form-7.less'
            );

            $css = $this->generate_css( $atts );
            
            if(isset($css['error'])){
                return $css;
            }

            if ($css) {
                ideothemo_save_cache_css( 'style.css', $css, FILE_APPEND );
                update_option( 'ideo_css_date', time(), 1 );
            }
            
            return true;
        }

        private function default_vars()
        {
            wp_cache_delete('ideo_options');
            
            $ideo_theme_options = ideothemo_get_theme_mod();

          
            $generals_styling_accent_color = ideothemo_is_color( ideothemo_get_general_accent_color() , ideothemo_get_themo_default_value('generals.styling.custom_accent_color') );

            $accent_color = ideothemo_is_color( ideothemo_get_general_accent_color(), $generals_styling_accent_color );

            $colored_dark_accent_color = ideothemo_is_color( ideothemo_is_color( ideothemo_get_accent_color( 'shortcodes.shortcodes_coloring.sc_colored_dark_accent_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_dark_accent_color') ), $accent_color);
            $colored_light_accent_color = ideothemo_is_color( ideothemo_is_color( ideothemo_get_accent_color( 'shortcodes.shortcodes_coloring.sc_colored_light_accent_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_light_accent_color') ), $accent_color);
            $transparent_dark_accent_color  = ideothemo_is_color( ideothemo_is_color( ideothemo_get_accent_color( 'shortcodes.shortcodes_coloring.sc_transparent_dark_accent_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_transparent_dark_accent_color') ), $accent_color);
            $transparent_light_accent_color = ideothemo_is_color( ideothemo_is_color( ideothemo_get_accent_color( 'shortcodes.shortcodes_coloring.sc_transparent_light_accent_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_transparent_light_accent_color') ), $accent_color);
           
            return array(
                'is_global_style'                                                                          => 1,
                'body_font_family'                                                                         => ideothemo_get_global_font(),
                'body_font_size'                                                                           => ideothemo_get_css_value_with_unit( ideothemo_get_body_font_size(), 'px' ),
                'body_font_weight'                                                                         => ideothemo_font_weight_parser( ideothemo_get_body_font_weight() ),
                'body_font_italic'                                                                         => ideothemo_font_is_italic( ideothemo_get_body_font_weight() ),
                'body_line_height'                                                                         => ideothemo_get_css_value_with_unit( ideothemo_get_body_line_height(), '' ),
                'body_letter_spacing'                                                                      => ideothemo_get_css_value_with_unit( ideothemo_get_body_letter_spacing(), '' ),
                'a_font_weight'                                                                            => ideothemo_font_weight_parser( ideothemo_get_font_weight_tag( 'link' ) ),
                'a_font_text_decoration'                                                                   => ideothemo_get_font_text_decoration_tag( 'link' ),
                'a_font_style'                                                                             => ideothemo_get_font_style_tag( 'link' ),
                'p_font'                                                                                   => ideothemo_get_font_family_tag( 'p' ),
                'p_font_size'                                                                              => ideothemo_get_css_value_with_unit(ideothemo_get_font_size_tag( 'p' ), 'px'),
                'p_font_line_height'                                                                       => ideothemo_get_css_value_with_unit(ideothemo_get_font_line_height_tag( 'p' ), ''),
                'p_font_weight'                                                                            => ideothemo_font_weight_parser( ideothemo_get_font_weight_tag( 'p' ) ),
                'p_font_letter_spacing'                                                                    => ideothemo_get_css_value_with_unit(ideothemo_get_font_letter_spacing_tag( 'p' ), 'px'),
                'p_font_text_transform'                                                                    => ideothemo_get_font_text_transform_tag( 'p' ),
                'p_font_italic'                                                                            => ideothemo_font_italic_tag_enabled( 'p' ),
                'h1_font'                                                                                  => ideothemo_get_font_family_tag( 'h1', 'inherit' ),
                'h1_font_size'                                                                             => ideothemo_get_css_value_with_unit(ideothemo_get_font_size_tag( 'h1' ), 'px'),
                'h1_font_line_height'                                                                      => ideothemo_get_css_value_with_unit(ideothemo_get_font_line_height_tag( 'h1' ), ''),
                'h1_font_weight'                                                                           => ideothemo_font_weight_parser( ideothemo_get_font_weight_tag( 'h1' ) ),
                'h1_font_letter_spacing'                                                                   => ideothemo_get_css_value_with_unit(ideothemo_get_font_letter_spacing_tag( 'h1' ), 'px'),
                'h1_font_text_transform'                                                                   => ideothemo_get_font_text_transform_tag( 'h1' ),
                'h1_font_italic'                                                                           => ideothemo_font_italic_tag_enabled( 'h1' ),
                'h2_font'                                                                                  => ideothemo_get_font_family_tag( 'h2', 'inherit' ),
                'h2_font_size'                                                                             => ideothemo_get_css_value_with_unit(ideothemo_get_font_size_tag( 'h2' ), 'px'),
                'h2_font_line_height'                                                                      => ideothemo_get_css_value_with_unit(ideothemo_get_font_line_height_tag( 'h2' ), ''),
                'h2_font_weight'                                                                           => ideothemo_font_weight_parser( ideothemo_get_font_weight_tag( 'h2' ) ),
                'h2_font_letter_spacing'                                                                   => ideothemo_get_css_value_with_unit(ideothemo_get_font_letter_spacing_tag( 'h2' ), 'px'),
                'h2_font_text_transform'                                                                   => ideothemo_get_font_text_transform_tag( 'h2' ),
                'h2_font_italic'                                                                           => ideothemo_font_italic_tag_enabled( 'h2' ),
                'h3_font'                                                                                  => ideothemo_get_font_family_tag( 'h3', 'inherit' ),
                'h3_font_size'                                                                             => ideothemo_get_css_value_with_unit(ideothemo_get_font_size_tag( 'h3' ), 'px'),
                'h3_font_line_height'                                                                      => ideothemo_get_css_value_with_unit(ideothemo_get_font_line_height_tag( 'h3' ), ''),
                'h3_font_weight'                                                                           => ideothemo_font_weight_parser( ideothemo_get_font_weight_tag( 'h3' ) ),
                'h3_font_letter_spacing'                                                                   => ideothemo_get_css_value_with_unit(ideothemo_get_font_letter_spacing_tag( 'h3' ), 'px'),
                'h3_font_text_transform'                                                                   => ideothemo_get_font_text_transform_tag( 'h3' ),
                'h3_font_italic'                                                                           => ideothemo_font_italic_tag_enabled( 'h3' ),
                'h4_font'                                                                                  => ideothemo_get_font_family_tag( 'h4', 'inherit' ),
                'h4_font_size'                                                                             => ideothemo_get_css_value_with_unit(ideothemo_get_font_size_tag( 'h4' ), 'px'),
                'h4_font_line_height'                                                                      => ideothemo_get_css_value_with_unit(ideothemo_get_font_line_height_tag( 'h4' ), ''),
                'h4_font_weight'                                                                           => ideothemo_font_weight_parser( ideothemo_get_font_weight_tag( 'h4' ) ),
                'h4_font_letter_spacing'                                                                   => ideothemo_get_css_value_with_unit(ideothemo_get_font_letter_spacing_tag( 'h4' ), 'px'),
                'h4_font_text_transform'                                                                   => ideothemo_get_font_text_transform_tag( 'h4' ),
                'h4_font_italic'                                                                           => ideothemo_font_italic_tag_enabled( 'h4' ),
                'h5_font'                                                                                  => ideothemo_get_font_family_tag( 'h5', 'inherit' ),
                'h5_font_size'                                                                             => ideothemo_get_css_value_with_unit(ideothemo_get_font_size_tag( 'h5' ), 'px'),
                'h5_font_line_height'                                                                      => ideothemo_get_css_value_with_unit(ideothemo_get_font_line_height_tag( 'h5' ), ''),
                'h5_font_weight'                                                                           => ideothemo_font_weight_parser( ideothemo_get_font_weight_tag( 'h5' ) ),
                'h5_font_letter_spacing'                                                                   => ideothemo_get_css_value_with_unit(ideothemo_get_font_letter_spacing_tag( 'h5' ), 'px'),
                'h5_font_text_transform'                                                                   => ideothemo_get_font_text_transform_tag( 'h5' ),
                'h5_font_italic'                                                                           => ideothemo_font_italic_tag_enabled( 'h5' ),
                'h6_font'                                                                                  => ideothemo_get_font_family_tag( 'h6', 'inherit' ),
                'h6_font_size'                                                                             => ideothemo_get_css_value_with_unit(ideothemo_get_font_size_tag( 'h6' ), 'px'),
                'h6_font_line_height'                                                                      => ideothemo_get_css_value_with_unit(ideothemo_get_font_line_height_tag( 'h6' ), ''),
                'h6_font_weight'                                                                           => ideothemo_font_weight_parser( ideothemo_get_font_weight_tag( 'h6' ) ),
                'h6_font_letter_spacing'                                                                   => ideothemo_get_css_value_with_unit(ideothemo_get_font_letter_spacing_tag( 'h6' ), 'px'),
                'h6_font_text_transform'                                                                   => ideothemo_get_font_text_transform_tag( 'h6' ),
                'h6_font_italic'                                                                           => ideothemo_font_italic_tag_enabled( 'h6' ),
                // BLOG - SINGLE POST, ARCHIVES, SEARCH
                'blog_text_color_light'                                                                    => ideothemo_is_color( ideothemo_get_theme_mod_sc_color( 'colored-light',
                    'text_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_light_text_color') ),
                'blog_title_color_light'                                                                   => ideothemo_is_color( ideothemo_get_theme_mod_sc_color( 'colored-light',
                    'title_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_light_title_color') ),
                'blog_accent_color_light'                                                                  => ideothemo_is_color( ideothemo_get_theme_mod_sc_color( 'colored-light',
                    'accent_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_light_accent_color') ),
                'blog_alternative_color_light'                                                             => ideothemo_is_color( ideothemo_get_theme_mod_sc_color( 'colored-light',
                    'alternative_title_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_light_alternative_title_color') ),
                'blog_text_color_dark'                                                                     => ideothemo_is_color( ideothemo_get_theme_mod_sc_color( 'colored-dark',
                    'text_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_dark_text_color') ),
                'blog_title_color_dark'                                                                    => ideothemo_is_color( ideothemo_get_theme_mod_sc_color( 'colored-dark',
                    'title_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_dark_text_color') ),
                'blog_accent_color_dark'                                                                   => ideothemo_is_color( ideothemo_get_theme_mod_sc_color( 'colored-dark',
                    'accent_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_dark_text_color') ),
                'blog_alternative_color_dark'                                                              => ideothemo_is_color( ideothemo_get_theme_mod_sc_color( 'colored-dark',
                    'alternative_title_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_dark_text_color') ),
				'blog_background_color_dark'                                                               => ideothemo_is_color( ideothemo_get_theme_mod_sc_color( 'colored-dark',
					'background_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_dark_text_color') ),
				'blog_background_color_light'                                                              => ideothemo_is_color( ideothemo_get_theme_mod_sc_color( 'colored-light',
					'background_color' ) ),
				'blog_archives_block_distance'															   => ideothemo_is_number(ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_block_distance'), 30),
                // PAGE TITLE SETTING
                'page_title_area_height'                                                                   => (int) ideothemo_get_theme_mod_parse( 'pagetitle.page_title_settings.page_title_area_height' ),
                'page_title_area_content_align'                                                            => ideothemo_get_theme_mod_parse( 'pagetitle.page_title_settings.page_title_area_content_align' ),
                // PAGE TITLE COLORING
                'pt_light_title_color'                                                                     => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'pagetitle.page_title_coloring.pt_light_title_color' ), ideothemo_get_themo_default_value('pagetitle.page_title_coloring.pt_light_title_color') ),
                'pt_light_subtitle_color'                                                                  => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'pagetitle.page_title_coloring.pt_light_subtitle_color' ) ),
                'pt_dark_title_color'                                                                      => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'pagetitle.page_title_coloring.pt_dark_title_color' ), ideothemo_get_themo_default_value('pagetitle.page_title_coloring.pt_dark_title_color') ),
                'pt_dark_subtitle_color'                                                                   => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'pagetitle.page_title_coloring.pt_dark_subtitle_color' ) ),
                //BREDCRUMBS COLORING
                'pt_light_b_text_color'                                                                    => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'pagetitle.page_title_coloring.pt_light_b_text_color' ), 'undefined' ),
                'pt_light_b_text_accent_color'                                                             => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'pagetitle.page_title_coloring.pt_light_b_text_accent_color' ), 'undefined' ),
                'pt_light_b_background_color'                                                              => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'pagetitle.page_title_coloring.pt_light_b_background_color' ), 'undefined' ),
                'pt_light_b_border_color'                                                                  => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'pagetitle.page_title_coloring.pt_light_b_border_color' ), 'undefined' ),
                'pt_dark_b_text_color'                                                                     => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'pagetitle.page_title_coloring.pt_dark_b_text_color' ), 'undefined' ),
                'pt_dark_b_text_accent_color'                                                              => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'pagetitle.page_title_coloring.pt_dark_b_text_accent_color' ), 'undefined' ),
                'pt_dark_b_background_color'                                                               => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'pagetitle.page_title_coloring.pt_dark_b_background_color' ), 'undefined' ),
                'pt_dark_b_border_color'                                                                   => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'pagetitle.page_title_coloring.pt_dark_b_border_color' ), 'undefined' ),
                //PAGE TITLE FONTS
                'pt_title_font_size'                                                                       => ideothemo_get_css_value_with_unit(ideothemo_get_theme_mod_parse( 'pagetitle.page_title_fonts.pt_title_font_size' ),  'px'),
                'pt_title_line_height'                                                                     => ideothemo_get_css_value_with_unit(ideothemo_get_theme_mod_parse( 'pagetitle.page_title_fonts.pt_title_line_height' ), ''),
                'pt_title_font_family'                                                                     => ideothemo_get_theme_mod_parse( 'pagetitle.page_title_fonts.pt_title_font_family', 'inherit' ),
                'pt_title_font_weight'                                                                     =>  ideothemo_get_font_weight( ideothemo_get_theme_mod_parse( 'pagetitle.page_title_fonts.pt_title_font_weight' , '400' )),
                'pt_title_font_italic'                                                                     => ideothemo_font_is_italic( ideothemo_get_theme_mod_parse( 'pagetitle.page_title_fonts.pt_title_font_weight' ) ),
                'pt_title_letter_spacing'                                                                  => ideothemo_get_css_value_with_unit(ideothemo_get_theme_mod_parse( 'pagetitle.page_title_fonts.pt_title_letter_spacing' ), 'px'),
                'pt_title_text_transform'                                                                  => ideothemo_get_theme_mod_parse( 'pagetitle.page_title_fonts.pt_title_text_transform', 'none'),
                'pt_subtitle_font_size'                                                                    => ideothemo_get_css_value_with_unit(ideothemo_get_theme_mod_parse( 'pagetitle.page_title_fonts.pt_subtitle_font_size' ),  'px'),
                'pt_subtitle_line_height'                                                                  => ideothemo_get_css_value_with_unit(ideothemo_get_theme_mod_parse( 'pagetitle.page_title_fonts.pt_subtitle_line_height' ), ''),
                'pt_subtitle_font_family'                                                                  => ideothemo_get_theme_mod_parse( 'pagetitle.page_title_fonts.pt_subtitle_font_family', 'inherit' ),
                'pt_subtitle_font_weight'                                                                  => ideothemo_get_font_weight(ideothemo_get_theme_mod_parse( 'pagetitle.page_title_fonts.pt_subtitle_font_weight' )),
                'pt_subtitle_letter_spacing'                                                               => ideothemo_get_css_value_with_unit(ideothemo_get_theme_mod_parse( 'pagetitle.page_title_fonts.pt_subtitle_letter_spacing' ), 'px'),
				'pt_subtitle_text_transform'                                                               => ideothemo_get_theme_mod_parse( 'pagetitle.page_title_fonts.pt_subtitle_text_transform', 'none'),
                //BREADCRUMBS FONT
                'pt_breadcrumbs_font_size'                                                                 => ideothemo_get_css_value_with_unit(ideothemo_get_theme_mod_parse( 'pagetitle.page_title_fonts.pt_breadcrumbs_font_size' ),  'px'),
                'pt_breadcrumbs_line_height'                                                               => ideothemo_get_css_value_with_unit(ideothemo_get_theme_mod_parse( 'pagetitle.page_title_fonts.pt_breadcrumbs_line_height' ), ''),
                'pt_breadcrumbs_font_family'                                                               => apply_filters( 'ideothemo_font_family', ideothemo_get_theme_mod_parse( 'pagetitle.page_title_fonts.pt_breadcrumbs_font_family', 'inherit' ) ),
                'pt_breadcrumbs_font_weight'                                                               => ideothemo_get_font_weight( ideothemo_get_theme_mod_parse( 'pagetitle.page_title_fonts.pt_breadcrumbs_font_weight' )),
                'pt_breadcrumbs_letter_spacing'                                                            => ideothemo_get_css_value_with_unit(ideothemo_get_theme_mod_parse( 'pagetitle.page_title_fonts.pt_breadcrumbs_letter_spacing' ), 'px'),
				'pt_breadcrumbs_text_transform'                                                            => ideothemo_get_theme_mod_parse( 'pagetitle.page_title_fonts.pt_breadcrumbs_text_transform', 'none'),
                //PAGE TITLE BACKGROUND
                'pt_background_color'                                                                      => ideothemo_get_pt_background_color(),
                'pt_background_upload_image'                                                               => ideothemo_is_image( ideothemo_get_pt_background_upload_image() ),
                'pt_background_cover'                                                                      => ideothemo_get_pt_background_cover(),
                'pt_background_image_position'                                                             => ideothemo_get_pt_background_image_position(),
                'pt_background_image_repeat'                                                               => ideothemo_get_pt_background_image_repeat(),
                'pt_background_overlay'                                                                    => ideothemo_get_pt_background_overlay_type(),
                'pt_background_overlay_color'                                                              => ideothemo_get_pt_background_overlay_color(),
                'pt_background_pattern'                                                                    => ideothemo_get_pt_background_overlay_type() == 'pattern' ? 'url(' . ideothemo_get_pt_overlay_pattern() . ')' : '',
                // SIDEBAR
                'sidebar_widget_text_color_light'                                                          => ideothemo_is_color( ideothemo_get_sidebar_text_color( 'light' ), ideothemo_get_themo_default_value('sidebar.sidebar_coloring.sidebar_light_text_color') ),
                'sidebar_widget_accent_color_light'                                                        => ideothemo_is_color( ideothemo_get_sidebar_accent_color( 'light' ), $colored_light_accent_color ),
                'sidebar_widget_title_color_light'                                                         => ideothemo_is_color( ideothemo_get_sidebar_title_color( 'light' ) ),
                'sidebar_widget_text_color_dark'                                                           => ideothemo_is_color( ideothemo_get_sidebar_text_color( 'dark' ), ideothemo_get_themo_default_value('sidebar.sidebar_coloring.sidebar_dark_text_color') ),
                'sidebar_widget_accent_color_dark'                                                         => ideothemo_is_color( ideothemo_get_sidebar_accent_color( 'dark' ), $colored_dark_accent_color ),
                'sidebar_widget_title_color_dark'                                                          => ideothemo_is_color( ideothemo_get_sidebar_title_color( 'dark' ) ),
                //SIDEBAR TITLE FONT
                'sidebar_title_font_size'                                                                  => ideothemo_get_css_value_with_unit(ideothemo_get_sidebar_title_font_size(), 'px'),
                'sidebar_title_line_height'                                                                => ideothemo_get_css_value_with_unit(ideothemo_get_sidebar_title_line_height(),  ''),
                'sidebar_title_font_family'                                                                => ideothemo_get_sidebar_title_font_family(),
                'sidebar_title_font_weight'                                                                => ideothemo_get_sidebar_title_font_weight(),
                'sidebar_title_letter_spacing'                                                             => ideothemo_get_css_value_with_unit(ideothemo_get_sidebar_title_letter_spacing(), 'px'),
                //PORTFOLIO NAVIGATION
                'portfolio_navigation_background_color'                                                    => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'portfolio.portfolio_navigation.background_color' ), 'undefined' ),
                'portfolio_navigation_border_top_color'                                                    => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'portfolio.portfolio_navigation.border_top_color' ), 'undefined' ),
                'portfolio_navigation_border_bottom_color'                                                 => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'portfolio.portfolio_navigation.border_bottom_color' ), 'undefined' ),
                'portfolio_navigation_text_color'                                                          => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'portfolio.portfolio_navigation.text_color' ), 'undefined' ),
                'portfolio_navigation_accent_color'                                                        => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'portfolio.portfolio_navigation.accent_color' ), 'undefined' ),
                //FOOTER
                'footer_column_paddings'                                                                   => ideothemo_get_standard_footer_layout_footer_column_paddings(),
                'footer_padding_top'                                                                       => (int)ideothemo_get_standard_footer_layout_footer_padding_top(),
                'footer_padding_bottom'                                                                    => (int)ideothemo_get_standard_footer_layout_footer_padding_bottom(),
                'footer_layout'                                                                            => ideothemo_get_standard_footer_layout_footer_layout(),
                'footer_custom_layout'                                                                     => (int)ideothemo_get_standard_footer_layout_footer_custom_layout(),
                //FOOTER WIDGET TITLE
                'widget_title_font_size'                                                                   => ideothemo_get_css_value_with_unit(ideothemo_get_theme_mod_parse( 'footer.widgets_title_font.widget_title_font_size' ), 'px'),
                'widget_title_line_height'                                                                 => ideothemo_get_css_value_with_unit(ideothemo_get_theme_mod_parse( 'footer.widgets_title_font.widget_title_line_height' ), ''),
                'widget_title_font_family'                                                                 => ideothemo_get_widget_title_font_family(),
                'widget_title_font_weight'                                                                 => ideothemo_get_font_weight( ideothemo_get_theme_mod_parse( 'footer.widgets_title_font.widget_title_font_weight' )),
                'widget_title_letter_spacing'                                                              => ideothemo_get_css_value_with_unit(ideothemo_get_theme_mod_parse( 'footer.widgets_title_font.widget_title_letter_spacing' ), 'px'),
                //STANDARD FOOTER CONTENT COLORING
                'standard_footer_accent_color_light'                                                       => ideothemo_is_color( ideothemo_get_standard_footer_accent_color( 'light' ), $colored_light_accent_color ),
                'standard_footer_accent_color_dark'                                                        => ideothemo_is_color( ideothemo_get_standard_footer_accent_color( 'dark' ), $colored_dark_accent_color ),
                'standard_footer_widget_title_light'                                                       => ideothemo_is_color( ideothemo_get_standard_footer_coloring_footer( 'light', 'widgets_title_color' ) ),
                'standard_footer_widget_title_dark'                                                        => ideothemo_is_color( ideothemo_get_standard_footer_coloring_footer( 'dark', 'widgets_title_color' ) ),
                'standard_footer_widget_text_light'                                                        => ideothemo_is_color( ideothemo_get_standard_footer_coloring_footer( 'light', 'widgets_text_color' ), ideothemo_get_themo_default_value('footer.standard_footer_coloring.footer_light_widgets_text_color') ),
                'standard_footer_widget_text_dark'                                                         => ideothemo_is_color( ideothemo_get_standard_footer_coloring_footer( 'dark', 'widgets_text_color' ), ideothemo_get_themo_default_value('footer.standard_footer_coloring.footer_dark_widgets_text_color') ),
                //STANDARD FOOTER BACKGROUND
                'footer_background_type'                                                                   => ideothemo_get_standard_footer_background_type(),
                'footer_background_color'                                                                  => ideothemo_get_standard_footer_background_color(),
                'footer_background_cover'                                                                  => ideothemo_get_standard_footer_background_cover(),
                'footer_background_upload_image'                                                           => ideothemo_is_image( ideothemo_get_standard_footer_background_upload_image() ),
                'footer_background_image_position'                                                         => ideothemo_get_standard_footer_background_image_position(),
                'footer_background_image_repeat'                                                           => ideothemo_get_standard_footer_background_image_repeat(),
                'footer_background_overlay'                                                                => ideothemo_get_footer_background_overlay_type(),
                'footer_background_overlay_color'                                                          => ideothemo_get_footer_background_overlay_color(),
                'footer_background_pattern'                                                                => ideothemo_get_footer_background_overlay_type() == 'pattern' ? 'url(' . ideothemo_get_footer_overlay_pattern() . ')' : '',
                //COPYRIGHT
                'copyright_text_align'                                                                     => ideothemo_get_footer_copyright_text_align(),
                'copyright_paddings'                                                                       => (int)ideothemo_get_footer_copyright_paddings(),
                //COPYRIGHT FONTS
                'copyrights_font_size'                                                                     => ideothemo_get_css_value_with_unit(ideothemo_get_copyright_fonts( 'font_size' ), 'px'),
                'copyrights_line_height'                                                                   => ideothemo_get_css_value_with_unit(ideothemo_get_copyright_fonts( 'line_height' )?:'', ''),
                'copyrights_font_family'                                                                   => ideothemo_get_copyright_font_family(),
                'copyrights_font_weight'                                                                   => ideothemo_get_font_weight(ideothemo_get_copyright_fonts( 'font_weight' )),
                'copyrights_letter_spacing'                                                                => ideothemo_get_css_value_with_unit(ideothemo_get_copyright_fonts( 'letter_spacing' )?:'', 'px'),
                //COPYRIGHT COLORING
                'copyrights_light_background_color'                                                        => ideothemo_get_copyright_colorings( 'light',
                    'background_color' ),
                'copyrights_light_text_color'                                                              => ideothemo_get_copyright_colorings( 'light',
                    'text_color' ),
                'copyrights_dark_background_color'                                                         => ideothemo_get_copyright_colorings( 'dark',
                    'background_color' ),
                'copyrights_dark_text_color'                                                               => ideothemo_get_copyright_colorings( 'dark',
                    'text_color' ),
                //SHORTCODE
                'sc_button_default_radius'                                                                 => ideothemo_get_page_option_setting( 'shortcodes.button_radius.button_default_radius' ),
                'sc_button_radius_small'                                                                   => ideothemo_get_page_option_setting( 'shortcodes.button_radius.button_radius_small' ),
                'sc_button_radius_big'                                                                     => ideothemo_get_page_option_setting( 'shortcodes.button_radius.button_radius_big' ),
                'sc_button_font_family'                                                                    => ideothemo_get_theme_mod_parse('shortcodes.button_font.button_font_family', 'inherit'),
            	'sc_button_font_weight'												                       => ideothemo_font_weight_parser(ideothemo_get_theme_mod_parse('shortcodes.button_font.button_font_weight', '400')),
            	'sc_button_font_style'									   			                       => ideothemo_font_style_parser(ideothemo_get_theme_mod_parse('shortcodes.button_font.button_font_weight')),
            	'sc_button_letter_spacing'											                       => ideothemo_get_css_value_with_unit(ideothemo_get_theme_mod_parse('shortcodes.button_font.button_letter_spacing'), 'px'),
            	'sc_button_text_transform'												                   => ideothemo_get_theme_mod_parse('shortcodes.button_font.button_text_transform', 'none'),
                'masonry_column_lg_num'                                                                    => 4,
                'masonry_column_md_num'                                                                    => 2,
                'masonry_column_sm_num'                                                                    => 2,
                'masonry_column_xs_num'                                                                    => 1,
                'generals_layout_site_width'                                                               => $ideo_theme_options['generals']['layout']['site_width'] . 'px',
                'generals_styling_accent_color'                                                            => $generals_styling_accent_color,
                'sc_colored_light_alternative_title_color'                                                 => ideothemo_is_color( $ideo_theme_options['shortcodes']['shortcodes_coloring']['sc_colored_light_alternative_title_color'], ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_light_alternative_title_color') ),
                // BOXED BACKGROUND
                'boxed_background_type'                                                                    => ideothemo_get_boxed_background_type(),
                'boxed_background_color'                                                                   => ideothemo_get_boxed_background_color(),
                'boxed_background_cover'                                                                   => ideothemo_get_boxed_background_cover(),
                'boxed_background_upload_image'                                                            => ideothemo_is_image( ideothemo_get_boxed_background_upload_image() ),
                'boxed_background_image_position'                                                          => ideothemo_get_boxed_background_image_position(),
                'boxed_background_image_repeat'                                                            => ideothemo_get_boxed_background_image_repeat(),
                'boxed_background_image_motion'                                                            => ideothemo_get_boxed_background_image_motion(),
                'boxed_background_overlay'                                                                => ideothemo_get_boxed_background_overlay_type(),
                'boxed_background_overlay_color'                                                          => ideothemo_get_boxed_background_overlay_color(),
                'boxed_background_pattern'                                                                => ideothemo_get_boxed_background_overlay_type() == 'pattern' ? 'url(' . ideothemo_get_boxed_overlay_pattern() . ')' : '',
                // CONTENT BACKGROUND
                'content_background_type'                                                                  => ideothemo_get_content_background_type(),
                'content_background_color'                                                                 => ideothemo_get_content_background_color(),
                'content_background_cover'                                                                 => ideothemo_get_content_background_cover(),
                'content_background_upload_image'                                                          => ideothemo_is_image( ideothemo_get_content_background_upload_image() ),
                'content_background_image_position'                                                        => ideothemo_get_content_background_image_position(),
                'content_background_image_repeat'                                                          => ideothemo_get_content_background_image_repeat(),
                'content_background_image_motion'                                                          => ideothemo_get_content_background_image_motion(),
                'content_background_overlay'                                                                => ideothemo_get_content_background_overlay_type(),
                'content_background_overlay_color'                                                          => ideothemo_get_content_background_overlay_color(),
                'content_background_pattern'                                                                => ideothemo_get_content_background_overlay_type() == 'pattern' ? 'url(' . ideothemo_get_content_overlay_pattern() . ')' : '',
                // back top button
                'back_top_button_border_radius'                                                            => ideothemo_get_back_top_button_border_radius(),
                'back_top_button_background_color'                                                         => ideothemo_get_back_top_button_background_color(),
                'back_top_button_background_hover_color'                                                   => ideothemo_get_back_top_button_background_hover_color(),
                'back_top_button_icon_color'                                                               => ideothemo_get_back_top_button_icon_color(),
                'back_top_button_icon_hover_color'                                                         => ideothemo_get_back_top_button_icon_hover_color(),
                'colored_dark_accent_color'                                                                => ideothemo_is_color( $colored_dark_accent_color ),
                'colored_dark_title_color'                                                                 => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'shortcodes.shortcodes_coloring.sc_colored_dark_title_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_dark_title_color') ),
                'colored_dark_text_color'                                                                  => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'shortcodes.shortcodes_coloring.sc_colored_dark_text_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_dark_text_color') ),
                'colored_dark_alternative_title_color'                                                     => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'shortcodes.shortcodes_coloring.sc_colored_dark_alternative_title_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_dark_alternative_title_color') ),
                'colored_light_accent_color'                                                               => ideothemo_is_color( $colored_light_accent_color ),
                'colored_light_title_color'                                                                => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'shortcodes.shortcodes_coloring.sc_colored_light_title_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_light_title_color') ),                
                'colored_light_text_color'                                                                 => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'shortcodes.shortcodes_coloring.sc_colored_light_text_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_light_text_color') ),
                'colored_light_alternative_title_color'                                                    => ideothemo_is_color( ideothemo_get_theme_mod_parse( 'shortcodes.shortcodes_coloring.sc_colored_light_alternative_title_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_light_alternative_title_color') ),
                'preloader'                                                                                => 'url(' . ideothemo_get_assets_svg_data( 'svg/preloader.svg',
                        "#d9d9d9" ) . ')',
                'preloader_load_more_light'                                                                =>  'url(' . ideothemo_get_assets_svg_data( 'svg/preloader.svg',
                        ideothemo_get_theme_mod_sc_color( 'colored-light', 'text_color' ) ) . ')',
                'preloader_load_more_dark'                                                                 =>  'url(' . ideothemo_get_assets_svg_data( 'svg/preloader.svg',
                        ideothemo_get_theme_mod_sc_color( 'colored-dark', 'text_color' ) ) . ')',
            	//HEADER
            	'header_type'															  				   => ideothemo_get_header_setting( 'type' ),
                //HEADER TOP BAR
            	'header_top_bar_padding_top'															   => (int)ideothemo_get_header_setting( 'top.topbar.padding_top' ) ?: 0,
            	'header_top_bar_padding_bottom'															   => (int)ideothemo_get_header_setting( 'top.topbar.padding_bottom' ) ?: 0,
            	'header_top_bar_height'															           => (int)ideothemo_get_header_setting( 'top.topbar.height' ) ?: 35,
                //HEADER NAV MENU
                'header_menu_height'                                                                       => 100,
                'header_menu_logo_height'                                                                  => 50,
                'header_menu_font_size'                                                                    => '13px',
                'header_menu_dropmenu_width'                                                               => 225,
                'header_menu_easing_duration'                                                              => '0.2s',
                // standard header
                'header_menu_top_top_distance'                                                             => (int)ideothemo_get_header_setting( 'top.top_distance' ) ?: 0,
				'header_menu_top_top_distance_custom'   												   => 'false',
                'header_menu_top_custom_width'                                                             => ideothemo_get_header_setting( 'top.width' ) == 'custom' ? ideothemo_get_header_setting( 'top.custom_width' ) : 0,
                'header_menu_top_content_width'                                                            => (int)ideothemo_get_header_setting( 'top.content_width' ),
                'header_menu_top_height'                                                                   => (int)ideothemo_get_header_setting( 'top.height' ),
                'header_menu_enabled'                                                                      => ideothemo_get_header_setting( 'overwrite_global_header' ),
                'header_menu_real_height'                                                                  => (int)ideothemo_calc_header_menu_height(),
                'header_menu_top_logo_height'                                                              => (int)ideothemo_get_header_setting( 'top.logo.height' ) ?: 'auto',
                'header_menu_top_logo_margin_top'                                                          => (int)ideothemo_get_header_setting( 'top.logo.margin.top' ) ?: 0,
                'header_menu_top_logo_margin_bottom'                                                       => (int)ideothemo_get_header_setting( 'top.logo.margin.bottom' ) ?: 0,
                'header_menu_mobile_dark_styling_background_color'                                         => ideothemo_is_color( ideothemo_get_header_setting( 'mobile.dark.styling.background_color' ) ),
                'header_menu_mobile_dark_styling_icon_color'                                               => ideothemo_is_color( ideothemo_get_header_setting( 'mobile.dark.styling.icon_color' ) ),
                'header_menu_mobile_dark_styling_first_dropdown_background'                                => ideothemo_get_header_setting( 'mobile.dark.styling.first_dropdown_background' ),
                'header_menu_mobile_dark_styling_second_dropdown_background'                               => ideothemo_get_header_setting( 'mobile.dark.styling.second_dropdown_background' ),
                'header_menu_mobile_dark_styling_text_color'                                               => ideothemo_is_color( ideothemo_get_header_setting( 'mobile.dark.styling.text_color' ) ),
                'header_menu_mobile_dark_styling_text_hover_color'                                         => ideothemo_is_color( ideothemo_get_header_setting( 'mobile.dark.styling.text_hover_color' ) ),
                'header_menu_mobile_dark_styling_separators_color'                                         => ideothemo_is_color( ideothemo_get_header_setting( 'mobile.dark.styling.separators_color' ) ),
                'header_menu_mobile_dark_styling_border_top_color'                                         => ideothemo_color_or_accent( ideothemo_get_header_setting( 'mobile.dark.styling.border_top_color' ) ),
				'header_menu_mobile_dark_styling_border_top_thickness'                                     => ideothemo_is_number( ideothemo_get_header_setting( 'mobile.dark.styling.border_top_thickness' ), 0 ),
                'header_menu_mobile_dark_styling_search_input_color'                                       => ideothemo_is_color( ideothemo_get_header_setting( 'mobile.dark.styling.search_input_color' ) ),
                'header_menu_mobile_dark_styling_search_text_color'                                        => ideothemo_is_color( ideothemo_get_header_setting( 'mobile.dark.styling.search_text_color' ) ),
                'header_menu_mobile_dark_styling_topbar_background_color'                                  => ideothemo_is_color( ideothemo_get_header_setting( 'mobile.dark.styling.topbar_background_color' ) ),
                'header_menu_mobile_light_styling_background_color'                                        => ideothemo_is_color( ideothemo_get_header_setting( 'mobile.light.styling.background_color' ) ),
                'header_menu_mobile_light_styling_icon_color'                                              => ideothemo_is_color( ideothemo_get_header_setting( 'mobile.light.styling.icon_color' ) ),
                'header_menu_mobile_light_styling_first_dropdown_background'                               => ideothemo_get_header_setting( 'mobile.light.styling.first_dropdown_background' ),
                'header_menu_mobile_light_styling_second_dropdown_background'                              => ideothemo_get_header_setting( 'mobile.light.styling.second_dropdown_background' ),
                'header_menu_mobile_light_styling_text_color'                                              => ideothemo_is_color( ideothemo_get_header_setting( 'mobile.light.styling.text_color' ) ),
                'header_menu_mobile_light_styling_text_hover_color'                                        => ideothemo_is_color( ideothemo_get_header_setting( 'mobile.light.styling.text_hover_color' ) ),
                'header_menu_mobile_light_styling_separators_color'                                        => ideothemo_is_color( ideothemo_get_header_setting( 'mobile.light.styling.separators_color' ) ),
                'header_menu_mobile_light_styling_border_top_color'                                        => ideothemo_color_or_accent( ideothemo_get_header_setting( 'mobile.light.styling.border_top_color' ) ),
                'header_menu_mobile_light_styling_border_top_thickness'                                    => ideothemo_is_number( ideothemo_get_header_setting( 'mobile.light.styling.border_top_thickness' ), 0 ),
				'header_menu_mobile_light_styling_search_input_color'                                      => ideothemo_is_color( ideothemo_get_header_setting( 'mobile.light.styling.search_input_color' ) ),
				'header_menu_mobile_light_styling_search_text_color'                                       => ideothemo_is_color( ideothemo_get_header_setting( 'mobile.light.styling.search_text_color' ) ),
				'header_menu_mobile_light_styling_topbar_background_color'                                 => ideothemo_is_color( ideothemo_get_header_setting( 'mobile.light.styling.topbar_background_color' ) ),
                'header_menu_mobile_height'                                                                => (int)ideothemo_get_header_setting( 'mobile.height' ),
                'header_menu_mobile_logo_height_in_mobile_menu'                                            => ideothemo_get_header_setting( 'mobile.logo.height_in_mobile_menu' ),
                'header_menu_mobile_logo_margin_top_bottom'                                                => ideothemo_get_header_setting( 'mobile.logo.margin_top_bottom' ),
                'header_menu_mobile_dark_styling_search_input_color'                                       => ideothemo_get_header_setting( 'mobile.dark.styling.search_input_color' ),
            	'header_menu_mobile_dark_styling_search_text_color'                                        => ideothemo_get_header_setting( 'mobile.dark.styling.search_text_color' ),
                'header_menu_mobile_light_styling_search_input_color'                                      => ideothemo_get_header_setting( 'mobile.light.styling.search_input_color' ),
            	'header_menu_mobile_light_styling_search_text_color'                                       => ideothemo_get_header_setting( 'mobile.light.styling.search_text_color' ),
                
             	'header_menu_top_sticky_transparent_light_background_color'								   => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.light.background_color' ) ),
            	'header_menu_top_sticky_transparent_dark_background_color'								   => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.dark.background_color' ) ),
            	'header_menu_top_sticky_colored_light_background_color'								       => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.light.background_color' ) ),
            	'header_menu_top_sticky_colored_dark_background_color'								       => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.dark.background_color' ) ),
            	'header_menu_top_sticky_transparent_light_hover_border_color'							   => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.transparent.light.hover_border_color' ), '60%' ),
            	'header_menu_top_sticky_transparent_dark_hover_border_color'							   => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.transparent.dark.hover_border_color' ) ),
            	'header_menu_top_sticky_colored_light_hover_border_color'								   => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.colored.light.hover_border_color' ) ),
            	'header_menu_top_sticky_colored_dark_hover_border_color'								   => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.colored.dark.hover_border_color' ) ),
            	'header_menu_top_sticky_transparent_light_hover_background_color'						   => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.transparent.light.hover_background_color' ), '60%' ),
            	'header_menu_top_sticky_transparent_dark_hover_background_color'						   => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.dark.hover_background_color' ) ),
            	'header_menu_top_sticky_colored_light_hover_background_color'							   => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.colored.light.hover_background_color' ), '10%' ),
            	'header_menu_top_sticky_colored_dark_hover_background_color'							   => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.colored.dark.hover_background_color' ), '10%' ),
            	
            	'header_menu_top_sticky_transparent_light_topbar_background'						   	   => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.light.topbar.background' ) ),
            	'header_menu_top_sticky_transparent_dark_topbar_background'						  		   => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.dark.topbar.background' ) ),
            	'header_menu_top_sticky_colored_light_topbar_background'							       => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.light.topbar.background' ) ),
            	'header_menu_top_sticky_colored_dark_topbar_background'							           => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.dark.topbar.background' ) ),
                
                'header_menu_top_sticky_transparent_light_topbar_text'						   	           => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.light.topbar.text' ) ),
            	'header_menu_top_sticky_transparent_dark_topbar_text'						  		       => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.dark.topbar.text' ) ),
            	'header_menu_top_sticky_colored_light_topbar_text'							               => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.light.topbar.text' ) ),
            	'header_menu_top_sticky_colored_dark_topbar_text'							               => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.dark.topbar.text' ) ),
            		 
            	'header_menu_top_sticky_transparent_light_topbar_border_top_thickness'					   => (int) ideothemo_get_header_setting( 'top_sticky.transparent.light.topbar.border_top_thickness' ),
            	'header_menu_top_sticky_transparent_dark_topbar_border_top_thickness'					   => (int) ideothemo_get_header_setting( 'top_sticky.transparent.dark.topbar.border_top_thickness' ),
            	'header_menu_top_sticky_colored_light_topbar_border_top_thickness'						   => (int) ideothemo_get_header_setting( 'top_sticky.colored.light.topbar.border_top_thickness' ),
            	'header_menu_top_sticky_colored_dark_topbar_border_top_thickness'						   => (int) ideothemo_get_header_setting( 'top_sticky.colored.dark.topbar.border_top_thickness' ),
            		 
            	'header_menu_top_sticky_transparent_light_topbar_border_top_color'						   => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.transparent.light.topbar.border_top_color' ) ),
            	'header_menu_top_sticky_transparent_dark_topbar_border_top_color'						   => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.transparent.dark.topbar.border_top_color' ) ),
            	'header_menu_top_sticky_colored_light_topbar_border_top_color'							   => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.colored.light.topbar.border_top_color' ) ),
            	'header_menu_top_sticky_colored_dark_topbar_border_top_color'							   => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.colored.dark.topbar.border_top_color' ) ),
            		 
            	'header_menu_top_sticky_transparent_light_topbar_border_bottom_thickness'				   => (int) ideothemo_get_header_setting( 'top_sticky.transparent.light.topbar.border_bottom_thickness' ),
            	'header_menu_top_sticky_transparent_dark_topbar_border_bottom_thickness'				   => (int) ideothemo_get_header_setting( 'top_sticky.transparent.dark.topbar.border_bottom_thickness' ),
            	'header_menu_top_sticky_colored_light_topbar_border_bottom_thickness'				       => (int) ideothemo_get_header_setting( 'top_sticky.colored.light.topbar.border_bottom_thickness' ) ,
            	'header_menu_top_sticky_colored_dark_topbar_border_bottom_thickness'					   => (int) ideothemo_get_header_setting( 'top_sticky.colored.dark.topbar.border_bottom_thickness' ) ,
            		 
            	'header_menu_top_sticky_transparent_light_header_border_bottom_thickness'				   => (int) ideothemo_get_header_setting( 'top_sticky.transparent.light.border_bottom.thickness' ),
            	'header_menu_top_sticky_transparent_dark_header_border_bottom_thickness'				   => (int) ideothemo_get_header_setting( 'top_sticky.transparent.dark.border_bottom.thickness' ),
            	'header_menu_top_sticky_colored_light_header_border_bottom_thickness'				       => (int) ideothemo_get_header_setting( 'top_sticky.colored.light.border_bottom.thickness' ) ,
            	'header_menu_top_sticky_colored_dark_header_border_bottom_thickness'					   => (int) ideothemo_get_header_setting( 'top_sticky.colored.dark.border_bottom.thickness' ) ,
            	'header_border_bottom_thickness'					                                       => (int) ideothemo_get_header_setting( 'top_sticky.'.(str_replace('-', '.', ideothemo_get_header_style( true, 'top'))).'.border_bottom.thickness' ) , // get  border_bottom.thickness for choosen style
                
            		
            	'header_menu_top_sticky_transparent_light_topbar_border_bottom_color'					   => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.light.topbar.border_bottom_color' ) ),
            	'header_menu_top_sticky_transparent_dark_topbar_border_bottom_color'					   => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.dark.topbar.border_bottom_color' ) ),
            	'header_menu_top_sticky_colored_light_topbar_border_bottom_color'						   => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.colored.light.topbar.border_bottom_color' ) ),
            	'header_menu_top_sticky_colored_dark_topbar_border_bottom_color'						   => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.dark.topbar.border_bottom_color' ) ), 
            		
            	'header_menu_top_sticky_transparent_light_search_language_icon_hover_color'				   => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.transparent.light.search_language_icon_hover_color' ) ),
            	'header_menu_top_sticky_transparent_dark_search_language_icon_hover_color'				   => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.transparent.dark.search_language_icon_hover_color' ) ),
            	'header_menu_top_sticky_colored_light_search_language_icon_hover_color'					   => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.light.search_language_icon_hover_color' ) ),
            	'header_menu_top_sticky_colored_dark_search_language_icon_hover_color'					   => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.colored.dark.search_language_icon_hover_color' ) ),
            		
            	'header_menu_top_sticky_transparent_light_loading_effect1_color'						   => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.transparent.light.loading_effect1_color' ) ),
            	'header_menu_top_sticky_transparent_dark_loading_effect1_color'						       => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.transparent.dark.loading_effect1_color' ) ),
            	'header_menu_top_sticky_colored_light_loading_effect1_color'							   => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.colored.light.loading_effect1_color' ), null, '20%' ),
            	'header_menu_top_sticky_colored_dark_loading_effect1_color'							       => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.colored.dark.loading_effect1_color' ) , null, '20%' ),

            	'header_menu_top_sticky_transparent_light_loading_effect2_color'						   => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.light.loading_effect2_color' ) ),
            	'header_menu_top_sticky_transparent_dark_loading_effect2_color'						  	   => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.dark.loading_effect2_color' ) ),
            	'header_menu_top_sticky_colored_light_loading_effect2_color'							   => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.colored.light.loading_effect2_color' ), '20%' ),
            	'header_menu_top_sticky_colored_dark_loading_effect2_color'							       => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.dark.loading_effect2_color' ) ),
            	
            	'header_menu_top_sticky_transparent_light_mega_menu_sub_level_column_title_border_color'   => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.transparent.light.mega_menu_sub_level.column_title.border_color' ) ),
            	'header_menu_top_sticky_transparent_dark_mega_menu_sub_level_column_title_border_color'    => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.transparent.dark.mega_menu_sub_level.column_title.border_color' ) ),
            	'header_menu_top_sticky_colored_light_mega_menu_sub_level_column_title_border_color'       => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.colored.light.mega_menu_sub_level.column_title.border_color' ) ),
            	'header_menu_top_sticky_colored_dark_mega_menu_sub_level_column_title_border_color'        => ideothemo_color_or_accent( ideothemo_get_header_setting( 'top_sticky.colored.dark.mega_menu_sub_level.column_title.border_color' ) ),

            	'header_menu_top_sticky_transparent_light_border_bottom_color'                             => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.light.border_bottom.color' ), ideothemo_get_themo_default_value('top_sticky.transparent.light.border_bottom.color') ),
                'header_menu_top_sticky_transparent_light_border_bottom_thickness'                         => (int)ideothemo_get_header_setting( 'top_sticky.transparent.light.border_bottom.thickness' ),
                'header_menu_top_sticky_transparent_light_first_level_menu_text_color'                     => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.light.first_level_menu_text.color' ) ),
                'header_menu_top_sticky_transparent_light_first_level_menu_text_hover_color'               => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.light.first_level_menu_text.hover_color' ) ),
                'header_menu_top_sticky_transparent_light_search_language_icon_color'                      => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.light.search_language_icon_color' ), ideothemo_get_themo_default_value('header.top_sticky.transparent.light.search_language_icon_color') ),
                'header_menu_top_sticky_transparent_light_background_loading_effect_color'                 => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.light.background_loading_effect_color' ) ),
                'header_menu_top_sticky_transparent_light_mega_menu_sub_level_background_color'            => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.light.mega_menu_sub_level.background.color' ) ),
                'header_menu_top_sticky_transparent_light_mega_menu_sub_level_hover_color'                 => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.light.mega_menu_sub_level.hover_color' ) ),
                'header_menu_top_sticky_transparent_light_mega_menu_sub_level_column_title_color'          => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.light.mega_menu_sub_level.column_title_color' ) ),
                'header_menu_top_sticky_transparent_light_mega_menu_sub_level_text_icon_color'             => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.light.mega_menu_sub_level.text_icon.color' ) ),
                'header_menu_top_sticky_transparent_light_mega_menu_sub_level_text_icon_hover_color'       => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.light.mega_menu_sub_level.text_icon.hover_color' ) ),
                'header_menu_top_sticky_transparent_light_mega_menu_sub_level_separators_color_vertical'   => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.light.mega_menu_sub_level.separators_color.vertical', 'rgba(54, 188, 155, 0.3)' )),
                'header_menu_top_sticky_transparent_light_mega_menu_sub_level_separators_color_horizontal' => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.light.mega_menu_sub_level.separators_color.horizontal', 'rgba(54, 188, 155, 0.3)' )),
                'header_menu_top_sticky_transparent_dark_border_bottom_color'                              => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.dark.border_bottom.color' ), ideothemo_get_themo_default_value('top_sticky.transparent.dark.border_bottom.color') ),
                'header_menu_top_sticky_transparent_dark_border_bottom_thickness'                          => (int)ideothemo_get_header_setting( 'top_sticky.transparent.dark.border_bottom.thickness' ),
                'header_menu_top_sticky_transparent_dark_first_level_menu_text_color'                      => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.dark.first_level_menu_text.color' ) ),
                'header_menu_top_sticky_transparent_dark_first_level_menu_text_hover_color'                => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.dark.first_level_menu_text.hover_color' ) ),
                'header_menu_top_sticky_transparent_dark_search_language_icon_color'                       => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.dark.search_language_icon_color' ), ideothemo_get_themo_default_value('header.top_sticky.transparent.dark.search_language_icon_color') ),
                'header_menu_top_sticky_transparent_dark_background_loading_effect_color'                  => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.dark.background_loading_effect_color' ) ),
                'header_menu_top_sticky_transparent_dark_mega_menu_sub_level_background_color'             => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.dark.mega_menu_sub_level.background.color' ) ),
                'header_menu_top_sticky_transparent_dark_mega_menu_sub_level_hover_color'                  => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.dark.mega_menu_sub_level.hover_color' ) ),
                'header_menu_top_sticky_transparent_dark_mega_menu_sub_level_column_title_color'           => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.dark.mega_menu_sub_level.column_title_color' ) ),
                'header_menu_top_sticky_transparent_dark_mega_menu_sub_level_text_icon_color'              => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.dark.mega_menu_sub_level.text_icon.color' ) ),
                'header_menu_top_sticky_transparent_dark_mega_menu_sub_level_text_icon_hover_color'        => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.dark.mega_menu_sub_level.text_icon.hover_color' ) ),
                'header_menu_top_sticky_transparent_dark_mega_menu_sub_level_separators_color_vertical'    => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.dark.mega_menu_sub_level.separators_color.vertical', 'rgba(54, 188, 155, 0.3)' )),
                'header_menu_top_sticky_transparent_dark_mega_menu_sub_level_separators_color_horizontal'  => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.transparent.dark.mega_menu_sub_level.separators_color.horizontal', 'rgba(54, 188, 155, 0.3)' )),
                'header_menu_top_sticky_colored_light_border_bottom_color'                                 => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.light.border_bottom.color' ) ),
                'header_menu_top_sticky_colored_light_border_bottom_thickness'                             => (int)ideothemo_get_header_setting( 'top_sticky.colored.light.border_bottom.thickness' ),
                'header_menu_top_sticky_colored_light_first_level_menu_text_color'                         => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.light.first_level_menu_text.color' ) ),
                'header_menu_top_sticky_colored_light_first_level_menu_text_hover_color'                   => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.light.first_level_menu_text.hover_color' ) ),
                'header_menu_top_sticky_colored_light_search_language_icon_color'                          => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.light.search_language_icon_color' ), ideothemo_get_themo_default_value('header.top_sticky.colored.light.search_language_icon_color') ),
                'header_menu_top_sticky_colored_light_background_loading_effect_color'                     => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.light.background_loading_effect_color' ) ),
                'header_menu_top_sticky_colored_light_mega_menu_sub_level_background_color'                => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.light.mega_menu_sub_level.background.color' ) ),
                'header_menu_top_sticky_colored_light_mega_menu_sub_level_hover_color'                     => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.light.mega_menu_sub_level.hover_color' ) ),
                'header_menu_top_sticky_colored_light_mega_menu_sub_level_column_title_color'              => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.light.mega_menu_sub_level.column_title_color' ) ),
                'header_menu_top_sticky_colored_light_mega_menu_sub_level_text_icon_color'                 => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.light.mega_menu_sub_level.text_icon.color' ) ),
                'header_menu_top_sticky_colored_light_mega_menu_sub_level_text_icon_hover_color'           => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.light.mega_menu_sub_level.text_icon.hover_color' ) ),
                'header_menu_top_sticky_colored_light_mega_menu_sub_level_separators_color_vertical'       => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.light.mega_menu_sub_level.separators_color.vertical', 'rgba(54, 188, 155, 0.3)' )),
                'header_menu_top_sticky_colored_light_mega_menu_sub_level_separators_color_horizontal'     => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.light.mega_menu_sub_level.separators_color.horizontal' ), 'rgba(54, 188, 155, 0.3)'),
                'header_menu_top_sticky_colored_dark_border_bottom_color'                                  => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.dark.border_bottom.color' ) ),
                'header_menu_top_sticky_colored_dark_border_bottom_thickness'                              => (int)ideothemo_get_header_setting( 'top_sticky.colored.dark.border_bottom.thickness' ),
                'header_menu_top_sticky_colored_dark_first_level_menu_text_color'                          => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.dark.first_level_menu_text.color' ) ),
                'header_menu_top_sticky_colored_dark_first_level_menu_text_hover_color'                    => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.dark.first_level_menu_text.hover_color' ) ),
                'header_menu_top_sticky_colored_dark_search_language_icon_color'                           => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.dark.search_language_icon_color' ), ideothemo_get_themo_default_value('header.top_sticky.colored.dark.search_language_icon_color') ),
                'header_menu_top_sticky_colored_dark_background_loading_effect_color'                      => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.dark.background_loading_effect_color' ) ),
                'header_menu_top_sticky_colored_dark_mega_menu_sub_level_background_color'                 => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.dark.mega_menu_sub_level.background.color' ) ),
                'header_menu_top_sticky_colored_dark_mega_menu_sub_level_hover_color'                      => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.dark.mega_menu_sub_level.hover_color' ) ),
                'header_menu_top_sticky_colored_dark_mega_menu_sub_level_column_title_color'               => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.dark.mega_menu_sub_level.column_title_color' ) ),
                'header_menu_top_sticky_colored_dark_mega_menu_sub_level_text_icon_color'                  => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.dark.mega_menu_sub_level.text_icon.color' ) ),
                'header_menu_top_sticky_colored_dark_mega_menu_sub_level_text_icon_hover_color'            => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.dark.mega_menu_sub_level.text_icon.hover_color' ) ),
                'header_menu_top_sticky_colored_dark_mega_menu_sub_level_separators_color_vertical'        => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.dark.mega_menu_sub_level.separators_color.vertical', 'rgba(54, 188, 155, 0.3)' )),
                'header_menu_top_sticky_colored_dark_mega_menu_sub_level_separators_color_horizontal'      => ideothemo_is_color( ideothemo_get_header_setting( 'top_sticky.colored.dark.mega_menu_sub_level.separators_color.horizontal', 'rgba(54, 188, 155, 0.3)' )),
            	'header_menu_side_dark_styling_color_background_background_color'                          => ideothemo_is_color( ideothemo_get_header_setting( 'side.dark.styling.color_background.background_color' ) ),
            	'header_menu_side_dark_styling_image_background_image_background_image'				   	   => '"' . ideothemo_get_header_setting( 'side.dark.styling.image_background.background_image' ) . '"',
            	'header_menu_side_dark_styling_color_background_pattern_color'                             => ideothemo_is_color( ideothemo_get_header_setting( 'side.dark.styling.color_background.pattern_color' ) ),
                'header_menu_side_dark_styling_color_background_pattern_overlay'                           => ideothemo_get_header_setting( 'side.dark.styling.color_background.pattern_overlay' ),
                'header_menu_side_dark_styling_image_background_image_overlay_color_pattern_color'         => ideothemo_is_color( ideothemo_get_header_setting( 'side.dark.styling.image_background.image_overlay.color.pattern_color' ) ),																
            	'header_menu_side_dark_styling_image_background_image_overlay_pattern_type'                => ideothemo_get_side_overlay_pattern(),
            	'header_menu_side_dark_styling_image_background_image_overlay_pattern_color'               => ideothemo_is_color( ideothemo_get_header_setting( 'side.dark.styling.image_background.image_overlay.pattern.color' ) ),
                'header_menu_side_dark_styling_image_background_image_position'                            => ideothemo_parse_background_postion(ideothemo_get_header_setting( 'side.dark.styling.image_background.image_position' )),
                'header_menu_side_dark_styling_image_background_image_size'                                => ideothemo_get_header_setting( 'side.dark.styling.image_background.image_size' ),
                'header_menu_side_dark_styling_image_background_image_repeat'                              => ideothemo_parse_background_repeat(ideothemo_get_header_setting( 'side.dark.styling.image_background.image_repeat' )),
                'header_menu_side_dark_styling_menu_text_color'                                            => ideothemo_is_color( ideothemo_get_header_setting( 'side.dark.styling.menu_text_color' ) ),
                'header_menu_side_dark_styling_menu_text_hover_color'                                      => ideothemo_is_color( ideothemo_get_header_setting( 'side.dark.styling.menu_text_hover_color' ) ),
                'header_menu_side_dark_styling_dropdown_menu_background_color'                             => ideothemo_is_color( ideothemo_get_header_setting( 'side.dark.styling.dropdown_menu_background_color' ) ),
                'header_menu_side_dark_styling_separators_color'                             			   => ideothemo_is_color( ideothemo_get_header_setting( 'side.dark.styling.separators_color' ), 'rgba(217, 217, 217, 0.8)' ),
                'header_menu_side_dark_styling_social_icon_background_color'                               => ideothemo_is_color( ideothemo_is_color( ideothemo_get_header_setting( 'side.dark.styling.social_icon_background_color' ), ideothemo_get_themo_default_value('header.side.dark.styling.social_icon_background_color') ), $colored_dark_accent_color),
                'header_menu_side_dark_styling_social_icons_color'                                         => ideothemo_is_color( ideothemo_get_header_setting( 'side.dark.styling.social_icons_color' ) ),
                'header_menu_side_dark_styling_copyrights'                                                 => ideothemo_is_color( ideothemo_get_header_setting( 'side.dark.styling.copyrights' ) ),
            	'header_menu_side_dark_styling_search_input_color'                                         => ideothemo_is_color(ideothemo_get_header_setting( 'side.dark.styling.search_input_color' )),
            	'header_menu_side_dark_styling_search_text_color'                                          => ideothemo_get_header_setting( 'side.dark.styling.search_text_color' ),
            	'header_menu_side_light_styling_image_background_image_background_image'				   => '"' . ideothemo_get_header_setting( 'side.light.styling.image_background.background_image' ) . '"',
            	'header_menu_side_light_styling_color_background_background_color'                         => ideothemo_is_color( ideothemo_get_header_setting( 'side.light.styling.color_background.background_color' ) ),
                'header_menu_side_light_styling_color_background_pattern_color'                            => ideothemo_is_color( ideothemo_get_header_setting( 'side.light.styling.color_background.pattern_color' ) ),
                'header_menu_side_light_styling_color_background_pattern_overlay'                          => ideothemo_get_header_setting( 'side.light.styling.color_background.pattern_overlay' ),
                'header_menu_side_light_styling_image_background_image_overlay_color_pattern_color'        => ideothemo_is_color( ideothemo_get_header_setting( 'side.light.styling.image_background.image_overlay.color.pattern_color' ) ),
            	'header_menu_side_light_styling_image_background_image_overlay_pattern_type'               => ideothemo_get_side_overlay_pattern(),
            	'header_menu_side_light_styling_image_background_image_overlay_pattern_color'              => ideothemo_is_color( ideothemo_get_header_setting( 'side.light.styling.image_background.image_overlay.pattern.color' ) ),
                'header_menu_side_light_styling_image_background_image_position'                           => ideothemo_parse_background_postion(ideothemo_get_header_setting( 'side.light.styling.image_background.image_position' )),
                'header_menu_side_light_styling_image_background_image_size'                               => ideothemo_get_header_setting( 'side.light.styling.image_background.image_size' ),
                'header_menu_side_light_styling_image_background_image_repeat'                             => ideothemo_parse_background_repeat(ideothemo_get_header_setting( 'side.light.styling.image_background.image_repeat' )),
                'header_menu_side_light_styling_menu_text_color'                                           => ideothemo_is_color( ideothemo_get_header_setting( 'side.light.styling.menu_text_color' ) ),
                'header_menu_side_light_styling_menu_text_hover_color'                                     => ideothemo_is_color( ideothemo_get_header_setting( 'side.light.styling.menu_text_hover_color' ) ),
                'header_menu_side_light_styling_dropdown_menu_background_color'                            => ideothemo_is_color( ideothemo_get_header_setting( 'side.light.styling.dropdown_menu_background_color' ) ),
                'header_menu_side_light_styling_separators_color'                            			   => ideothemo_is_color( ideothemo_get_header_setting( 'side.light.styling.separators_color' ), 'rgba(217, 217, 217, 0.8)' ),
                'header_menu_side_light_styling_social_icon_background_color'                              => ideothemo_is_color(  ideothemo_is_color( ideothemo_get_header_setting( 'side.light.styling.social_icon_background_color' ), ideothemo_get_themo_default_value('header.side.light.styling.social_icon_background_color') ), $colored_light_accent_color),
                'header_menu_side_light_styling_social_icons_color'                                        => ideothemo_is_color( ideothemo_get_header_setting( 'side.light.styling.social_icons_color' ) ),
                'header_menu_side_light_styling_copyrights'                                                => ideothemo_is_color( ideothemo_get_header_setting( 'side.light.styling.copyrights' ) ),
            	'header_menu_side_light_styling_search_input_color'                                        => ideothemo_is_color(ideothemo_get_header_setting( 'side.light.styling.search_input_color' )),
            	'header_menu_side_light_styling_search_text_color'                                         => ideothemo_get_header_setting( 'side.light.styling.search_text_color' ),
            	'header_menu_side_logo_height'                                                             => (int)ideothemo_get_header_setting( 'side.logo.height' ),
                'header_menu_side_logo_margin_left'                                                       => (int)ideothemo_get_header_setting( 'side.logo.margin_left' ),
                'header_menu_side_logo_margin_top'                                                        => (int)ideothemo_get_header_setting( 'side.logo.margin_top' ),
                'header_menu_side_logo_margin_bottom'                                                     => (int)ideothemo_get_header_setting( 'side.logo.margin_bottom' ),
                
            	    
            	'header_side_offcanvas_topbar_height'                                                     => (int)ideothemo_get_header_setting( 'side.offcanvas.topbar.height' ),                
            	'header_side_offcanvas_topbar_logo_height'                                                => (int)ideothemo_get_header_setting( 'side.offcanvas.topbar.logo.height' ),                
            	'header_side_offcanvas_stickybar_height'                                                  => (int)ideothemo_get_header_setting( 'side.offcanvas.stickybar.height' ),                
            	'header_side_offcanvas_stickybar_logo_height'                                             => (int)ideothemo_get_header_setting( 'side.offcanvas.stickybar.logo.height' ),                
            	'header_side_offcanvas_blur_strength'                                                     => (int)ideothemo_get_header_setting( 'side.offcanvas.blur_strength' ),                
                'header_menu_side_offcanvas_light_styling_menu_icon'                                      => ideothemo_is_color( ideothemo_get_header_setting( 'side.offcanvas.light.styling.menu_icon' ) ),
                'header_menu_side_offcanvas_dark_styling_menu_icon'                                       => ideothemo_is_color( ideothemo_get_header_setting( 'side.offcanvas.dark.styling.menu_icon' ) ),
                'header_menu_side_offcanvas_light_styling_menu_icon_hover'                                => ideothemo_is_color( ideothemo_get_header_setting( 'side.offcanvas.light.styling.menu_icon_hover' ) ),
                'header_menu_side_offcanvas_dark_styling_menu_icon_hover'                                 => ideothemo_is_color( ideothemo_get_header_setting( 'side.offcanvas.dark.styling.menu_icon_hover' ) ),
                'header_menu_side_offcanvas_light_styling_overlay'                                        => ideothemo_is_color( ideothemo_get_header_setting( 'side.offcanvas.light.styling.overlay' ) ),
                'header_menu_side_offcanvas_dark_styling_overlay'                                         => ideothemo_is_color( ideothemo_get_header_setting( 'side.offcanvas.dark.styling.overlay' ) ),
                'header_menu_side_offcanvas_light_styling_overlay'                                        => ideothemo_is_color( ideothemo_get_header_setting( 'side.offcanvas.light.styling.overlay' ) ),
                'header_menu_side_offcanvas_dark_styling_overlay'                                         => ideothemo_is_color( ideothemo_get_header_setting( 'side.offcanvas.dark.styling.overlay' ) ),
                'header_menu_side_offcanvas_light_styling_pagetitle'                                      => ideothemo_is_color( ideothemo_get_header_setting( 'side.offcanvas.light.styling.pagetitle' ) ),
                'header_menu_side_offcanvas_dark_styling_pagetitle'                                       => ideothemo_is_color( ideothemo_get_header_setting( 'side.offcanvas.dark.styling.pagetitle' ) ),
                'header_side_offcanvas_light_styling_bar_background_color'                                => ideothemo_is_color( ideothemo_get_header_setting( 'side.offcanvas.light.styling.bar.background_color' ) ),
                'header_side_offcanvas_dark_styling_bar_background_color'                                 => ideothemo_is_color( ideothemo_get_header_setting( 'side.offcanvas.dark.styling.bar.background_color' ) ),
                'header_side_offcanvas_light_styling_bar_border_bottom_color'                             => ideothemo_is_color( ideothemo_get_header_setting( 'side.offcanvas.light.styling.bar.border_bottom_color' ) ),
                'header_side_offcanvas_dark_styling_bar_border_bottom_color'                              => ideothemo_is_color( ideothemo_get_header_setting( 'side.offcanvas.dark.styling.bar.border_bottom_color' ) ),
                'header_side_offcanvas_light_styling_bar_border_bottom_thickness'                         => (int)( ideothemo_get_header_setting( 'side.offcanvas.light.styling.bar.border_bottom_thickness' ) ),
                'header_side_offcanvas_dark_styling_bar_border_bottom_thickness'                          => (int)( ideothemo_get_header_setting( 'side.offcanvas.dark.styling.bar.border_bottom_thickness' ) ),
                
            	'header_menu_sticky_width'                                                          	   => ideothemo_get_header_setting( 'sticky.width' ),
            	'header_menu_sticky_custom_width'                                                          => (int)ideothemo_get_header_setting( 'sticky.custom_width' ),
                'header_menu_sticky_content_width'                                                         => (int)ideothemo_get_header_setting( 'sticky.content_width' ),
                'header_menu_sticky_height'                                                                => (int)ideothemo_get_header_setting( 'sticky.height' ),
                'header_menu_sticky_logo_height'                                                           => (int)ideothemo_get_header_setting( 'sticky.logo.height' ),
                'header_menu_sticky_logo_margin_top'                                                       => (int)ideothemo_get_header_setting( 'sticky.logo.margin.top' ),
                'header_menu_sticky_logo_margin_bottom'                                                    => (int)ideothemo_get_header_setting( 'sticky.logo.margin.bottom' ),
                'header_menu_sticky_top_distance'                                                          => (int)ideothemo_get_header_setting( 'sticky.top_distance' ) ?: 0,
				'header_menu_sticky_top_distance_custom'												   => 'false',
                'general_accent_color'                                                                     => $accent_color,
                'colored_dark_icon_color'                                                                  => ideothemo_is_color( ideothemo_get_page_option_setting( 'shortcodes.shortcodes_coloring.sc_colored_dark_icon_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_dark_icon_color') ),
                'colored_dark_background_color'                                                            => ideothemo_is_color( ideothemo_get_page_option_setting( 'shortcodes.shortcodes_coloring.sc_colored_dark_background_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_dark_background_color') ),
                'colored_light_icon_color'                                                                 => ideothemo_is_color( ideothemo_get_page_option_setting( 'shortcodes.shortcodes_coloring.sc_colored_light_icon_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_light_icon_color') ),
                'colored_light_background_color'                                                           => ideothemo_is_color( ideothemo_get_page_option_setting( 'shortcodes.shortcodes_coloring.sc_colored_light_background_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_light_background_color') ),
                'transparent_dark_accent_color'                                                            => ideothemo_is_color( $transparent_dark_accent_color ),
                'transparent_dark_title_color'                                                             => ideothemo_is_color( ideothemo_get_page_option_setting( 'shortcodes.shortcodes_coloring.sc_transparent_dark_title_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_transparent_dark_title_color') ),
                'transparent_dark_text_color'                                                              => ideothemo_is_color( ideothemo_get_page_option_setting( 'shortcodes.shortcodes_coloring.sc_transparent_dark_text_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_transparent_dark_text_color') ),
                'transparent_dark_icon_color'                                                              => ideothemo_is_color( ideothemo_get_page_option_setting( 'shortcodes.shortcodes_coloring.sc_transparent_dark_icon_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_transparent_dark_icon_color') ),
                'transparent_light_accent_color'                                                           => ideothemo_is_color( $transparent_light_accent_color ),
                'transparent_light_title_color'                                                            => ideothemo_is_color( ideothemo_get_page_option_setting( 'shortcodes.shortcodes_coloring.sc_transparent_light_title_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_transparent_light_title_color') ),
                'transparent_light_text_color'                                                             => ideothemo_is_color( ideothemo_get_page_option_setting( 'shortcodes.shortcodes_coloring.sc_transparent_light_text_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_transparent_light_text_color') ),
                'transparent_light_icon_color'                                                             => ideothemo_is_color( ideothemo_get_page_option_setting( 'shortcodes.shortcodes_coloring.sc_transparent_light_icon_color' ), ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_transparent_light_icon_color') ),
        		'lightbox_text_and_nav_color'                                                              => ideothemo_is_color( ideothemo_get_page_option_setting( 'lightbox.lightbox_coloring.lightbox_text_and_nav_color' ) ),
                'lightbox_text_align'                                                                      => ideothemo_get_page_option_setting( 'lightbox.lightbox_settings.lightbox_text_align' ),
                'lightbox_overlay_color'                                                                   => ideothemo_is_color( ideothemo_get_page_option_setting( 'lightbox.lightbox_coloring.lightbox_overlay_color' ) ),
            	'header_typography_main_menu_font_size'													   => ideothemo_get_header_setting('typography.main_menu.font_size') ? ideothemo_get_css_value_with_unit(ideothemo_get_header_setting('typography.main_menu.font_size'), 'px') : ideothemo_get_css_value_with_unit(ideothemo_get_themo_default_value('header.typography.main_menu.font_size'), 'px'),
            	'header_typography_main_menu_line_height'												   => 1,
            	'header_typography_main_menu_font_family'												   => ideothemo_get_header_setting('typography.main_menu.font_family', 'inherit'),
            	'header_typography_main_menu_font_weight'												   => ideothemo_font_weight_parser(ideothemo_get_header_setting('typography.main_menu.font_weight')),
            	'header_typography_main_menu_font_style'									   			   => ideothemo_font_style_parser(ideothemo_get_header_setting('typography.main_menu.font_weight')),
            	'header_typography_main_menu_letter_spacing'											   => ideothemo_get_css_value_with_unit(ideothemo_get_header_setting('typography.main_menu.letter_spacing'), 'px'),
            	'header_typography_main_menu_text_transform'												   => ideothemo_get_header_setting('typography.main_menu.text_transform'),
            	'header_typography_mega_menu_font_size'												    => ideothemo_get_css_value_with_unit(ideothemo_get_header_setting('typography.mega_menu.font_size'), 'px'),
            	'header_typography_mega_menu_line_height'												   => ideothemo_get_css_value_with_unit(ideothemo_get_header_setting('typography.mega_menu.line_height'), ''),
            	'header_typography_mega_menu_font_family'												   => ideothemo_get_header_setting('typography.mega_menu.font_family', 'inherit'),
            	'header_typography_mega_menu_font_weight'												   => ideothemo_font_weight_parser(ideothemo_get_header_setting('typography.mega_menu.font_weight')),
            	'header_typography_mega_menu_font_style'									   			   => ideothemo_font_style_parser(ideothemo_get_header_setting('typography.mega_menu.font_weight')),
            	'header_typography_mega_menu_letter_spacing'											   => ideothemo_get_css_value_with_unit(ideothemo_get_header_setting('typography.mega_menu.letter_spacing'), 'px'),
            	'header_typography_mega_menu_text_transform'												   => ideothemo_get_header_setting('typography.mega_menu.text_transform'),
            	'header_typography_submenu_font_size'													   => ideothemo_get_css_value_with_unit(ideothemo_get_header_setting('typography.submenu.font_size'), 'px'),
            	'header_typography_submenu_line_height'												   	   => ideothemo_get_css_value_with_unit(ideothemo_get_header_setting('typography.submenu.line_height'), ''),
            	'header_typography_submenu_font_family'												       => ideothemo_get_header_setting('typography.submenu.font_family', 'inherit'),
            	'header_typography_submenu_font_weight'												       => ideothemo_font_weight_parser(ideothemo_get_header_setting('typography.submenu.font_weight')),
            	'header_typography_submenu_font_style'									   				   => ideothemo_font_style_parser(ideothemo_get_header_setting('typography.submenu.font_weight')),
            	'header_typography_submenu_letter_spacing'											       => ideothemo_get_css_value_with_unit(ideothemo_get_header_setting('typography.submenu.letter_spacing'), 'px'),
            	'header_typography_submenu_text_transform'												   => ideothemo_get_header_setting('typography.submenu.text_transform'),
            	'header_typography_mega_menu_column_title_font_size'									   => ideothemo_get_css_value_with_unit(ideothemo_get_header_setting('typography.mega_menu_column_title.font_size'), 'px'),
            	'header_typography_mega_menu_column_title_line_height'									   => ideothemo_get_css_value_with_unit(ideothemo_get_header_setting('typography.mega_menu_column_title.line_height'), ''),
            	'header_typography_mega_menu_column_title_font_family'									   => ideothemo_get_header_setting('typography.mega_menu_column_title.font_family', 'inherit'),
            	'header_typography_mega_menu_column_title_font_weight'									   => ideothemo_font_weight_parser(ideothemo_get_header_setting('typography.mega_menu_column_title.font_weight')),
            	'header_typography_mega_menu_column_title_font_style'									   => ideothemo_font_style_parser(ideothemo_get_header_setting('typography.mega_menu_column_title.font_weight')),
            	'header_typography_mega_menu_column_title_letter_spacing'								   => ideothemo_get_css_value_with_unit(ideothemo_get_header_setting('typography.mega_menu_column_title.letter_spacing'), 'px'),
            	'header_typography_mega_menu_column_title_text_transform'								   => ideothemo_get_header_setting('typography.mega_menu_column_title.text_transform'),
            	'header_typography_side_menu_font_size'													   => ideothemo_get_css_value_with_unit(ideothemo_get_header_setting('typography.side_menu.font_size'), 'px'),
            	'header_typography_side_menu_line_height'												   => ideothemo_get_css_value_with_unit(ideothemo_get_header_setting('typography.side_menu.line_height'), ''),
            	'header_typography_side_menu_font_family'												   => ideothemo_get_header_setting('typography.side_menu.font_family', 'inherit'),
            	'header_typography_side_menu_font_weight'												   => ideothemo_font_weight_parser(ideothemo_get_header_setting('typography.side_menu.font_weight')),
            	'header_typography_side_menu_font_style'										   		   => ideothemo_font_style_parser(ideothemo_get_header_setting('typography.side_menu.font_weight')),
            	'header_typography_side_menu_letter_spacing'											   => ideothemo_get_css_value_with_unit(ideothemo_get_header_setting('typography.side_menu.letter_spacing'), 'px'),
            	'header_typography_side_menu_text_transform'											   => ideothemo_get_header_setting('typography.side_menu.text_transform'),
            	'header_typography_side_menu_submenu_font_size'											   => ideothemo_get_css_value_with_unit(ideothemo_get_header_setting('typography.side_menu_submenu.font_size'), 'px'),
            	'header_typography_side_menu_submenu_line_height'										   => ideothemo_get_css_value_with_unit(ideothemo_get_header_setting('typography.side_menu_submenu.line_height'), ''),
            	'header_typography_side_menu_submenu_font_family'										   => ideothemo_get_header_setting('typography.side_menu_submenu.font_family', 'inherit'),
            	'header_typography_side_menu_submenu_font_weight'										   => ideothemo_font_weight_parser(ideothemo_get_header_setting('typography.side_menu_submenu.font_weight')),
            	'header_typography_side_menu_submenu_font_style'										   => ideothemo_font_style_parser(ideothemo_get_header_setting('typography.side_menu_submenu.font_weight')),
            	'header_typography_side_menu_submenu_letter_spacing'									   => ideothemo_get_css_value_with_unit(ideothemo_get_header_setting('typography.side_menu_submenu.letter_spacing'), 'px'),
            	'header_typography_side_menu_submenu_text_transform'									   => ideothemo_get_header_setting('typography.side_menu_submenu.text_transform'),
            	'header_typography_mobile_menu_font_size'											   		=> ideothemo_get_css_value_with_unit(ideothemo_get_header_setting('typography.mobile_menu.font_size'), 'px'),
            	'header_typography_mobile_menu_line_height'										   			=> ideothemo_get_header_setting('typography.mobile_menu.line_height') ? ideothemo_get_css_value_with_unit(ideothemo_get_header_setting('typography.mobile_menu.line_height'), '') : '20px',
            	'header_typography_mobile_menu_font_family'										   			=> ideothemo_get_header_setting('typography.mobile_menu.font_family', 'inherit'),
            	'header_typography_mobile_menu_font_weight'										   			=> ideothemo_font_weight_parser(ideothemo_get_header_setting('typography.mobile_menu.font_weight')),
            	'header_typography_mobile_menu_font_style'										   			=> ideothemo_font_style_parser(ideothemo_get_header_setting('typography.mobile_menu.font_weight')),
            	'header_typography_mobile_menu_letter_spacing'									   			=> ideothemo_get_css_value_with_unit(ideothemo_get_header_setting('typography.mobile_menu.letter_spacing'), 'px'),
            	'header_typography_mobile_menu_text_transform'									   			=> ideothemo_get_header_setting('typography.mobile_menu.text_transform'),
                
            
            	'fonts_font_coloring_light_h1'															   => ideothemo_is_color(ideothemo_get_theme_mod_parse('fonts.font_coloring.light.h1')),
            	'fonts_font_coloring_light_h2'															   => ideothemo_is_color(ideothemo_get_theme_mod_parse('fonts.font_coloring.light.h2')),
            	'fonts_font_coloring_light_h3'															   => ideothemo_is_color(ideothemo_get_theme_mod_parse('fonts.font_coloring.light.h3')),
            	'fonts_font_coloring_light_h4'															   => ideothemo_is_color(ideothemo_get_theme_mod_parse('fonts.font_coloring.light.h4')),
            	'fonts_font_coloring_light_h5'															   => ideothemo_is_color(ideothemo_get_theme_mod_parse('fonts.font_coloring.light.h5')),
            	'fonts_font_coloring_light_h6'															   => ideothemo_is_color(ideothemo_get_theme_mod_parse('fonts.font_coloring.light.h6')),
            	'fonts_font_coloring_light_paragraph'													   => ideothemo_is_color(ideothemo_get_theme_mod_parse('fonts.font_coloring.light.paragraph')),
            	'fonts_font_coloring_light_link'														   => ideothemo_is_color(ideothemo_get_theme_mod_parse('fonts.font_coloring.light.link'), $accent_color),
            	'fonts_font_coloring_light_link_hover' 													   => ideothemo_is_color(ideothemo_get_theme_mod_parse('fonts.font_coloring.light.link_hover'), ideothemo_get_color_darken($accent_color, 15)),	
            	
            	'fonts_font_coloring_dark_h1'															   => ideothemo_is_color(ideothemo_get_theme_mod_parse('fonts.font_coloring.dark.h1')),
            	'fonts_font_coloring_dark_h2'															   => ideothemo_is_color(ideothemo_get_theme_mod_parse('fonts.font_coloring.dark.h2')),
            	'fonts_font_coloring_dark_h3'															   => ideothemo_is_color(ideothemo_get_theme_mod_parse('fonts.font_coloring.dark.h3')),
            	'fonts_font_coloring_dark_h4'															   => ideothemo_is_color(ideothemo_get_theme_mod_parse('fonts.font_coloring.dark.h4')),
            	'fonts_font_coloring_dark_h5'															   => ideothemo_is_color(ideothemo_get_theme_mod_parse('fonts.font_coloring.dark.h5')),
            	'fonts_font_coloring_dark_h6'															   => ideothemo_is_color(ideothemo_get_theme_mod_parse('fonts.font_coloring.dark.h6')),
            	'fonts_font_coloring_dark_paragraph'													   => ideothemo_is_color(ideothemo_get_theme_mod_parse('fonts.font_coloring.dark.paragraph')),
            	'fonts_font_coloring_dark_link'															   => ideothemo_is_color(ideothemo_get_theme_mod_parse('fonts.font_coloring.dark.link'), $accent_color),
            	'fonts_font_coloring_dark_link_hover' 													   => ideothemo_is_color(ideothemo_get_theme_mod_parse('fonts.font_coloring.dark.link_hover'), ideothemo_get_color_darken($accent_color, 15))
            );
        }

        private function generate_css( $atts )
        {
            $default = array(
                'vars'  => array(),
                'files' => array(),
            );

            $atts = array_merge( $default, $atts );

            if (empty( $atts['files'] )) {
                return false;
            }
            
            if (!class_exists('Less_Parser')) {
                return array('error' => 'error_2');
            }            
            
            $options = array( 'compress' => true, 'sourceMap' => false);
            $parser  = new Less_Parser( $options );

            //set vars
            if ( ! empty( $atts['vars'] )) {
                $parser->ModifyVars( $atts['vars'] );
            }
            
            $css = '';

            try {

                //set less files
                foreach ($atts['files'] AS $file) {
                    $parser->parseFile( $file );
                }
                
                $css = $parser->getCss();
                
                $generate = new IdeoThemoGeneratePageCss(true);                
                $generate->action(0, (object)array('post_status' => 'publish', 'post_type' => 'post'), false);

            } catch ( Exception $e ) {
				if ($this->safeMode)
					throw $e;
                if(isset($_GET['less']) && IDEOTHEMO_DEVELOP_MODE) {
                    var_dump($e);
                    die();
                }
				return array('error' => 'error');
            }

            return $css;
        }
        
        public function render() {
           
            if(isset($_GET['less']) && IDEOTHEMO_DEVELOP_MODE) {
                $this->customizer();
                $this->shortcodes();

                if($_GET['less'] =='all') {
                    $generate = new IdeoThemoGeneratePageCss(true);
                    $generate->allPages();
                }
            }
        }

    }

    new IdeoThemoGenerateGeneralCss;
}

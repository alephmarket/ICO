<?php

/**
 * START: PARTS OF POST FORMAT
 */

if (!function_exists('ideothemo_post_format')) {
    function ideothemo_post_format($post_format = '', $atts = array())
    {
        $top = '<article ' . ideothemo_blog_list_style_inline($atts) . ' id="post-' . get_the_ID() . '" class="' . implode(' ', apply_filters('ideothemo_blog_post_classes', get_post_class(array('ideo-blog-entry')), $atts)) . '">';
        $top .= ideothemo_post_format_date_box($atts);

        $footer = '</article>';

        if (!empty($post_format)) {

            $funcName = 'ideothemo_post_format_' . $post_format;

            if (function_exists($funcName)) {
                return $top . $funcName($atts) . $footer;
            }
        }

        return $top . ideothemo_post_format_default($atts) . $footer;
    }
}

if (!function_exists('ideothemo_post_format_default')) {
    function ideothemo_post_format_default($atts = array())
    {
        $html = '';
        if (ideothemo_blog_feature_image_enabled() && has_post_thumbnail()) {
            $html .= '<div class="ideo-featured-image"' . ideothemo_customize_attrs(false, ideothemo_blog_feature_image_enabled('', false), 'data', 'default', 0) . '>';
            if ($atts['el_image_size'] == 'custom') {
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'ideothemo-blog-' . $atts['el_type']);
                $html .= '<a href="' . get_permalink() . '" title="' . get_the_title() . '" class="ideo-featured-image" style="background-image: url(' . $image[0] . '); height: ' . $atts['el_image_height'] . 'px;"></a>';
            } else {
                $html .= '<a href="' . get_permalink() . '" title="' . get_the_title() . '" class="ideo-featured-image">' . get_the_post_thumbnail(null, 'ideothemo-blog-' . $atts['el_type']) . '</a>';
            }
            $html .= '</div>';
        }

        $html .= ideothemo_post_type_name();

        $html .= ideothemo_post_format_title(get_the_title(), get_permalink(), $atts['el_title_tag']);

        $data['sections'] = array(
            'date' => ideothemo_blog_date_enabled($atts['el_date'], false),
            'authors' => ideothemo_blog_author_enabled($atts['el_authors'], false),
            'categories' => ideothemo_blog_categories_enabled($atts['el_categories'], false),
            'tags' => ideothemo_blog_tags_enabled($atts['el_tags'], false),
            'comments' => ideothemo_blog_comments_enabled($atts['el_comments'], false),
        );

        $html .= ideothemo_post_format_sections($data);

        $html .= ideothemo_blog_list_excerpt($atts);
        $html .= '                <footer class="ideo-entry-footer">';

        $html .= ideothemo_post_format_social($atts);

        $html .= ideothemo_post_format_read_more();
        $html .= '                </footer>';
        $html .= '  </div>';
        $html .= '</div>';

        return $html;
    }
}

if (!function_exists('ideothemo_post_format_audio')) {
    function ideothemo_post_format_audio($atts = array())
    {
        $html = '';

        if (ideothemo_blog_feature_image_enabled()) {

            $media_content = ideothemo_get_media(get_the_ID(), 'audio');

            if (!empty($media_content)) {
                $html .= '<div class="ideo-featured-image"' . ideothemo_customize_attrs(false, ideothemo_blog_feature_image_enabled('', false), 'data', 'default', 0) . '>';
                $html .= $media_content;
                $html .= '</div>';
            }
        }

        $html .= ideothemo_post_type_name();
        $html .= ideothemo_post_format_title(get_the_title(), get_permalink(), $atts['el_title_tag']);

        $data['sections'] = array(
            'date' => ideothemo_blog_date_enabled($atts['el_date'], false),
            'authors' => ideothemo_blog_author_enabled($atts['el_authors'], false),
            'categories' => ideothemo_blog_categories_enabled($atts['el_categories'], false),
            'tags' => ideothemo_blog_tags_enabled($atts['el_tags'], false),
            'comments' => ideothemo_blog_comments_enabled($atts['el_comments'], false),
        );

        $html .= ideothemo_post_format_sections($data);


        $html .= ideothemo_blog_list_excerpt($atts);
        $html .= '                <footer class="ideo-entry-footer">';

        $html .= ideothemo_post_format_social($atts);

        $html .= ideothemo_post_format_read_more();
        $html .= '                </footer>';
        $html .= '  </div>';
        $html .= '</div>';

        return $html;
    }
}

if (!function_exists('ideothemo_post_format_gallery')) {
    function ideothemo_post_format_gallery($atts = array())
    {
        $html = '';

        if (ideothemo_blog_feature_image_enabled()) {
            $html .= '<div class="ideo-featured-image"' . ideothemo_customize_attrs(false, ideothemo_blog_feature_image_enabled('', false), 'data', 'default', 0) . '>';
            $html .= ideothemo_get_template_part('parts.blog.gallery');
            $html .= '</div>';
        }

        $html .= ideothemo_post_type_name();
        $html .= ideothemo_post_format_title(get_the_title(), get_permalink(), $atts['el_title_tag']);

        $data['sections'] = array(
            'date' => ideothemo_blog_date_enabled($atts['el_date'], false),
            'authors' => ideothemo_blog_author_enabled($atts['el_authors'], false),
            'categories' => ideothemo_blog_categories_enabled($atts['el_categories'], false),
            'tags' => ideothemo_blog_tags_enabled($atts['el_tags'], false),
            'comments' => ideothemo_blog_comments_enabled($atts['el_comments'], false),
        );

        $html .= ideothemo_post_format_sections($data);

        $html .= ideothemo_blog_list_excerpt($atts);
        $html .= '                <footer class="ideo-entry-footer">';

        $html .= ideothemo_post_format_social($atts);

        $html .= ideothemo_post_format_read_more();
        $html .= '                </footer>';
        $html .= '  </div>';
        $html .= '</div>';

        return $html;
    }
}

if (!function_exists('ideothemo_post_format_link')) {
    function ideothemo_post_format_link($atts = array())
    {
        $html = ideothemo_get_template_part('parts.blog.list.url');
        $html .= ideothemo_post_type_name();
        $html .= ideothemo_post_format_title(get_the_title(), get_permalink(), $atts['el_title_tag']);

        $data['sections'] = array(
            'date' => ideothemo_blog_date_enabled($atts['el_date'], false),
            'authors' => ideothemo_blog_author_enabled($atts['el_authors'], false),
            'categories' => ideothemo_blog_categories_enabled($atts['el_categories'], false),
            'tags' => ideothemo_blog_tags_enabled($atts['el_tags'], false),
            'comments' => ideothemo_blog_comments_enabled($atts['el_comments'], false),
        );

        $html .= ideothemo_post_format_sections($data);

        $html .= ideothemo_blog_list_excerpt($atts);
        $html .= '                <footer class="ideo-entry-footer">';

        $html .= ideothemo_post_format_social($atts);

        $html .= ideothemo_post_format_read_more();
        $html .= '                </footer>';
        $html .= '  </div>';
        $html .= '</div>';

        return $html;
    }
}

if (!function_exists('ideothemo_post_format_quote')) {
    function ideothemo_post_format_quote($atts = array())
    {
        $html = ideothemo_get_template_part('parts.blog.list.quote');
        $html .= ideothemo_post_type_name();
        $html .= ideothemo_post_format_title(get_the_title(), get_permalink(), $atts['el_title_tag']);

        $data['sections'] = array(
            'date' => ideothemo_blog_date_enabled($atts['el_date'], false),
            'authors' => ideothemo_blog_author_enabled($atts['el_authors'], false),
            'categories' => ideothemo_blog_categories_enabled($atts['el_categories'], false),
            'tags' => ideothemo_blog_tags_enabled($atts['el_tags'], false),
            'comments' => ideothemo_blog_comments_enabled($atts['el_comments'], false),
        );

        $html .= ideothemo_post_format_sections($data);

        $html .= ideothemo_blog_list_excerpt($atts);
        $html .= '                <footer class="ideo-entry-footer">';

        $html .= ideothemo_post_format_social($atts);

        $html .= ideothemo_post_format_read_more();
        $html .= '                </footer>';
        $html .= '  </div>';
        $html .= '</div>';

        return $html;
    }
}

if (!function_exists('ideothemo_post_format_video')) {
    function ideothemo_post_format_video($atts = array())
    {
        $html = '';

        if (ideothemo_blog_feature_image_enabled()) {

            $media_content = ideothemo_get_media(get_the_ID(), 'video', $atts);

            if (!empty($media_content)) {
                $html .= '<div class="ideo-featured-image"' . ideothemo_customize_attrs(false, ideothemo_blog_feature_image_enabled('', false), 'data', 'default', 0) . '>';
                $html .= $media_content;
                $html .= '</div>';
            }
        }

        $html .= ideothemo_post_type_name();
        $html .= ideothemo_post_format_title(get_the_title(), get_permalink(), $atts['el_title_tag']);

        $data['sections'] = array(
            'date' => ideothemo_blog_date_enabled($atts['el_date'], false),
            'authors' => ideothemo_blog_author_enabled($atts['el_authors'], false),
            'categories' => ideothemo_blog_categories_enabled($atts['el_categories'], false),
            'tags' => ideothemo_blog_tags_enabled($atts['el_tags'], false),
            'comments' => ideothemo_blog_comments_enabled($atts['el_comments'], false),
        );

        $html .= ideothemo_post_format_sections($data);

        $html .= ideothemo_blog_list_excerpt($atts);
        $html .= '                <footer class="ideo-entry-footer">';

        $html .= ideothemo_post_format_social($atts);

        $html .= ideothemo_post_format_read_more();
        $html .= '                </footer>';
        $html .= '  </div>';
        $html .= '</div>';

        return $html;
    }
}

/**
 * END: PARTS OF POST FORMAT
 */

if (!function_exists('ideothemo_post_format_date_box')) {
    function ideothemo_post_format_date_box($atts)
    {
        if (ideothemo_blog_date_enabled($atts['el_date']) && $atts['el_date_position'] != 'meta')
            return ideothemo_get_template_part('parts.blog.list.date-box');

        return '';
    }
}

if (!function_exists('ideothemo_post_format_comments')) {
    function ideothemo_post_format_comments($atts)
    {
        if (ideothemo_blog_comments_enabled($atts['el_comments']))
            return '<div class="box comments">' . get_comments_number() . '</div>';

        return '';
    }
}

if (!function_exists('ideothemo_post_format_sections')) {
    /**
     *
     * @return string
     */
    function ideothemo_post_format_sections($atts)
    {

        $html = '';

        $default = array(
            'sections' => array()
        );

        $atts = shortcode_atts($default, $atts);

        if (!empty($atts['sections'])) {
            // We dont show post-meta if there are no meta for search
            $has_meta = !is_search();
            $html .= '<div class="post-meta">';
            foreach ($atts['sections'] AS $section_id => $section_value) {

                if ($section_value || ideothemo_is_customize_preview()) {
                    $has_meta = true;
                    $content = ideothemo_get_template_part('parts.blog.list.meta.' . $section_id);
                    $special = ideothemo_customize_attrs(false, $section_value, 'data', 'default', 0);

                    $html .= str_replace('@special@', $special, $content);
                }
            }
            $html .= '</div>';

            if (!$has_meta)
                $html = '';
        }

        return $html;
    }
}

if (!function_exists('ideothemo_post_type_name')) {
    function ideothemo_post_type_name()
    {
        if (is_search()) {
            return '<span class="post-type">' . ideothemo_get_post_type_name() . '</span>';
        }

        return '';
    }
}

if (!function_exists('ideothemo_post_format_title')) {
    /**
     *
     * @return string
     */
    function ideothemo_post_format_title($title, $permalink, $hTag = 'h2')
    {
        $html = '<div class="ideo-entry-content">';
        $html .= '<' . $hTag . ' class="post-title"><a href="' . $permalink . '">' . $title . '</a>';

        if (is_sticky()) {
            $html .= '<div class="post-sticky-marker"><i class="fa fa-thumb-tack"></i></div>';
        }

        $html .= '</' . $hTag . '>';
        $html .= '<div class="ideo-entry-meta">';

        return $html;
    }
}

if (!function_exists('ideothemo_post_format_read_more')) {
    function ideothemo_post_format_read_more()
    {
        if (is_search())
            return '';

        return '<a href="' . get_permalink() . '" class="read-more">' . esc_html__('Read more', 'themo') . '<i class="id id-right"></i></a>';
    }
}

if (!function_exists('ideothemo_post_format_social')) {
    /**
     *
     * List all socailmedia share buttons enabled in TO or PO
     *
     * @param array $atts
     */
    function ideothemo_post_format_social($atts)
    {
        if (is_search())
            return '';

        $html = '';

        if (isset($atts['el_share']) && ideothemo_blog_social_enabled($atts['el_share'])) {

            foreach (get_list_enabled_social_media($atts) AS $social) {
                $local = '';

                if (!ideothemo_is_blog_template() && isset($atts['el_' . $social])) { //dealing with shortcode
                    $local = $atts['el_' . $social];

                }

                $html .= ' <li' . ideothemo_customize_attrs(false, ideothemo_get_enabled_social_media($social, $local, false), 'data', 'default', 0) . '>';
                $html .= ideothemo_get_social_share(array($social), get_permalink(), get_the_title(), get_the_excerpt(), '', false);
                $html .= '</li>';
            }
        }

        $html = trim($html);

        if (!empty($html)) {
            return '<ul class="social">' . $html . '</ul>';
        }

        return $html;
    }
}

if (!function_exists('ideothemo_portfolio_format_social')) {

    function ideothemo_generate_social_args($social)
    {
        if (isset($GLOBALS['social_args_cache'][$social])) {
            return $GLOBALS['social_args_cache'][$social];
        }

        if (!isset($GLOBALS['social_args_cache'])) {
            $GLOBALS['social_args_cache'] = array();
        }

        $GLOBALS['social_args_cache'][$social] = ideothemo_customize_attrs(false, ideothemo_get_enabled_social_media($social, false, false), 'data', 'default', 0);

        return $GLOBALS['social_args_cache'][$social];
    }

    /**
     *
     * List all socailmedia share buttons enabled in TO or PO
     *
     * @param array $atts
     * @param array|null $list_enabled_socials array returned by get_list_enabled_social_media or null
     */
    function ideothemo_portfolio_format_social($atts, $list_enabled_socials = null)
    {
        global $wp;

        if ($list_enabled_socials === null) {
            $list_enabled_socials = get_list_enabled_social_media($atts);
        }

        $html = '';
        $url = home_url(add_query_arg(array('ajax_card' => get_the_ID()), $wp->request));

        foreach ($list_enabled_socials as $social) {

            $html .= ' <li' . ideothemo_generate_social_args($social) . '>';
            $html .= ideothemo_get_social_share(array($social), esc_url($url), get_the_title(), get_the_excerpt(), '', false, '');
            $html .= '</li>';
        }

        $html = trim($html);

        if (!empty($html)) {
            return '<ul class="social">' . $html . '</ul>';
        }

        return $html;
    }
}

if (!function_exists('ideothemo_get_post_gallery_photos')) {
    function ideothemo_get_post_gallery_photos()
    {
        $photos = ideothemo_get_post_meta('gallery_images');

        if ($photos) {
            return ideothemo_get_photos_from_array(explode(',', $photos), 'ideothemo-blog-featured-image');
        }

        return false;
    }
}

if (!function_exists('ideothemo_get_media')) {
    function ideothemo_get_media($post_id, $format, $data = array())
    {
        /** @var WP_Embed $wp_embed */
        global $wp_embed;

        $html = '';
        $media_url = '';
        $media_content = '';
        $class = array('ideo-media', $format);

        if ($format == 'video') {
            $media_url = ideothemo_get_post_meta('video_url', $post_id);
        } elseif ($format == 'audio') {
            $media_url = ideothemo_get_post_meta('audio_url', $post_id);
        }

        if (empty($media_url))
            return $html;

        //check video domain is current domain
        if (stripos($media_url, home_url('/')) !== false) {
            $media_content = do_shortcode('[' . $format . ' src="' . $media_url . '"]');
        }

        if (empty($media_content)) {
            $class[] = 'embed-responsive';
            $class[] = 'embed-responsive-16by9';

            $media_content = $wp_embed->run_shortcode('[embed]' . $media_url . '[/embed]');
        }

        if (!empty($media_content)) {
            $html .= '<div class="' . trim(implode(' ', $class)) . '">';
            $html .= $media_content;
            $html .= '</div>';
        }

        return $html;
    }
}

function ideothemo_oembed_filter( $return, $data, $url ) {
 	$return = str_replace('frameborder="0"', 'style="border: none;"', $return);
	return $return;
}
add_filter('embed_oembed_html', 'ideothemo_oembed_filter', 99, 3 );

if (!function_exists('ideothemo_get_social_share')) {
    function ideothemo_get_social_share($social_list, $link, $text, $excerpt = '', $media = '', $container = true, $type = 'blog')
    {
        $html = '';
        
        $text = preg_replace('/\s/', '%20', $text);
        $link = urlencode($link);
        $excerpt = preg_replace('/\s/', '%20', $excerpt);

        if ($container)
            $html .= '<div class="social" ' . ideothemo_customize_attrs(false, ideothemo_blog_social_enabled('', false), 'data', 'default', false) . '>';

        $atts = array(
            'class' => 'js--social-share',
            'target' => '_blank'
        );

        $suffix = $type == 'portfolio' ? '-square' : null;
        
        if (in_array('facebook', $social_list)) {
            $html .= '<a class="js--social-share" target="_blank" data-toggle="tooltip" href="http://www.facebook.com/sharer.php?u=' . $link . '&t=' . $text . '"><i class="fa fa-facebook' . $suffix . '"></i></a>';
        }
        if (in_array('twitter', $social_list)) {
            $html .= '<a class="js--social-share" target="_blank" data-toggle="tooltip" href="https://twitter.com/share?url=' . $link . '&text=' . $text . '"><i class="fa fa-twitter' . $suffix . '"></i></a>';
        }
        if (in_array('google', $social_list)) {
            $html .= '<a class="js--social-share" target="_blank" data-toggle="tooltip" href="https://plus.google.com/share?url=' . $link . '"><i class="fa fa-google-plus' . $suffix . '"></i></a>';
        }
        if (in_array('pinterest', $social_list)) {
            $html .= '<a class="js--social-share" target="_blank" data-toggle="tooltip" href="http://pinterest.com/pin/create/button/?url=' . $link . '&description=' . $text . '&media=' . (isset($media[0]) ? $media[0] : '') . '"><i class="fa fa-pinterest' . $suffix . '"></i></a>';
        }
        if (in_array('linkedin', $social_list)) {
            $html .= '<a class="js--social-share" target="_blank" data-toggle="tooltip" href="http://linkedin.com/shareArticle?mini=true&url=' . $link . '&title=' . $text . '"><i class="fa fa-linkedin' . $suffix . '"></i></a>';
        }
        if (in_array('tumblr', $social_list)) {
            $html .= '<a class="js--social-share" target="_blank" data-toggle="tooltip" href="http://www.tumblr.com/share/link?url=' . $link . '&name=' . $text . '&description=' . $excerpt . '"><i class="fa fa-tumblr' . $suffix . '"></i></a>';
        }
        if (in_array('vk', $social_list)) {
            $html .= '<a class="js--social-share" target="_blank" data-toggle="tooltip" href="http://vk.com/share.php?url=' . $link . '"><i class="fa fa-vk"></i></a>';
        }
        if (in_array('reddit', $social_list)) {
            $html .= '<a class="js--social-share" target="_blank" data-toggle="tooltip" href="http://reddit.com/submit?url=' . $link . '"><i class="fa fa-reddit' . $suffix . '"></i></a>';
        }
        if (in_array('email', $social_list)) {
            $html .= '<a class="js--social-share" target="_blank" href="mailto:?subject=' . $text . '&body=' . $link . '"><i class="fa  fa-envelope-o"></i></a>';
        }

        if ($container)
            $html .= '</div>';

        return $html;
    }
}

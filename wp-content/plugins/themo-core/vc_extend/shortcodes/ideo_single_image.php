<?php
vc_map(array(
    'name' => __('Single image', 'ideo-themo'),
    'base' => 'vc_single_image',
    'category' => __('Content', 'ideo-themo'),
    'weight' => 95,
    'icon' => 'icon-single-image',
    'description' => __('Single image.', 'ideo-themo'),
    'params' => array(

        array(
            'type' => 'attach_image',
            'heading' => __('IMAGE UPLOAD', 'ideo-themo'),
            'param_name' => 'image',
            'value' => '',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('IMAGE SIZE', 'ideo-themo'),
            'admin_label' => true,
            'param_name' => 'img_size',
            'value' => '',
            'description' => __('Using this option you can customize image size and you can do this in 3 ways:</br>
			<b>empty field</b> - you can leave empty field then your image will be displayed in its original size but if it is wider than column then it will be scaled to the largest size such that both its width and its height can fit inside the column;</br>
			<b>custom size</b> - you can type in custom width and height (for example: 200x100) or type in only one value for width and height;</br>
			<b>theme sizes</b> - you can also type in one of predefined theme sizes: "thumbnail", "medium", "large", "full".', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('IMAGE ALIGNMENT', 'ideo-themo'),
            'param_name' => 'el_image_align',
            'value' => array(__('Left', 'ideo-themo') => 'left', __('Center', 'ideo-themo') => 'center', __('Right', 'ideo-themo') => 'right'),
            'std' => 'left',
            'description' => __('Using this option you can align the image to the Left, Center or Right side.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('LINKING METHOD', 'ideo-themo'),
            'param_name' => 'el_hover',
            'value' => array(__('none', 'ideo-themo') => 'none', __('lightbox', 'ideo-themo') => 'lightbox', __('url', 'ideo-themo') => 'url', __('lightbox & url', 'ideo-themo') => 'lightboxurl'),
            'dependencies' => array(
                'lightbox' => array('el_lightbox_rel', 'el_image_caption_title', 'el_image_caption_desc'),
                'url' => array('el_url'),
                'lightboxurl' => array('el_lightbox_rel', 'el_image_caption_title', 'el_image_caption_desc', 'el_url'),
            ),
            'std' => 'none',
            'description' => __('Decide if/how the image will be linked. Depending on which option you choose appropriate options will be available below.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('LIGHTBOX _REL', 'ideo-themo'),
            'param_name' => 'el_lightbox_rel',
            'value' => '',
            'description' => __('Type in lightbox rel text if you want to use this image as a part of a lightbox gallery. </br>Lightbox rel is an additional feature which allows you to organize single images into galleries. To do so, assign the same Lightbox rel to as many images as you want and they become parts of one gallery.', 'ideo-themo')
        ),
        array(
            'type' => 'textarea',
            'heading' => __('IMAGE TITLE', 'ideo-themo'),
            'param_name' => 'el_image_caption_title',
            'value' => '',
            'description' => __('Enter image title which will be displayed in lightbox.', 'ideo-themo')
        ),
        array(
            'type' => 'textarea',
            'heading' => __('IMAGE DESCRIPTION', 'ideo-themo'),
            'param_name' => 'el_image_caption_desc',
            'value' => '',
            'description' => __('Enter image description which will be displayed in lightbox.', 'ideo-themo')
        ),
        array(
            'type' => 'vc_link',
            'heading' => __('URL', 'ideo-themo'),
            'param_name' => 'el_url',
            'value' => '',
            'description' => __('Enter image URL.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('IMAGE ALT', 'ideo-themo'),
            'param_name' => 'el_image_alt',
            'value' => '',
            'description' => __('Enter image alternative text. The alt attribute provides alternative information for an image if a user for some reason cannot view it. It is also recomended for SEO reason – search webspiders gets a description of the image file and use it to help determine the best image to return for a user query.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_dropdown',
            'heading' => __('ELEMENT STYLE', 'ideo-themo'),
            'param_name' => 'el_element_style',
            'value' => array(
                'colored dark' => 'colored-dark',
                'colored light' => 'colored-light',

            ),
            'colors' => ideothemo_get_colors(),
            'std' => ideothemo_get_shortcodes_default_style('ideo_single_image'),
            'admin_label' => true,
            'description' => __('Choose style for the element. Depending on which option you choose appropriate colorpickers will be available below. You can freely customize colors for chosen style but you can also leave empty colorpickers to use colors which are set for that style in Customizer.', 'ideo-themo'),
            'group' => __('STYLING', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_custom_colors',
            'heading' => __('COLORS', 'ideo-themo'),
            'param_name' => 'el_element_style_colors',
            'colors' => ideothemo_get_colors(),
            'el_colors' => array(
                'colored' => array(
                    'image_overlay' => __('IMAGE OVERLAY COLOR', 'ideo-themo'),
                    'icon_color' => __('ICON COLOR', 'ideo-themo'),
                    'icon_background_color' => __('ICON BACKGROUND COLOR', 'ideo-themo'),
                    'icon_hover_color' => __('ICON HOVER COLOR', 'ideo-themo'),
                    'icon_hover_background_color' => __('ICON HOVER BACKGROUND COLOR', 'ideo-themo'),
                ),
                'transparent' => array()
            ),
            'value' => '',
            'group' => __('STYLING', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_slider',
            'heading' => __('MARGIN TOP (px)', 'ideo-themo'),
            'param_name' => 'el_margin_top',
            'min' => '0',
            'max' => '200',
            'value' => '20',
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('MARGIN BOTTOM (px)', 'ideo-themo'),
            'param_name' => 'el_margin_bottom',
            'min' => '0',
            'max' => '200',
            'value' => '20',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('EXTRA CLASS NAME', 'ideo-themo'),
            'param_name' => 'el_extra_class',
            'value' => '',
            'description' => __('Type in an extra class name for this particular element, so you can refer to that class in custom css.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('ANIMATION', 'ideo-themo'),
            'param_name' => 'el_animation',
            'value' => array(
                __('none', 'ideo-themo') => '',
                __('Viewport', 'ideo-themo') => 'viewport',
            ),
            'dependencies' => array(
                'viewport' => array('el_animation_type', 'el_animation_delay', 'el_animation_duration', 'el_animation_offset')
            ),
            'std' => '',
            'description' => __('Using this option you can enable viewport animation for the element. If you choose Viewport two additional options will be available below.', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_animation_type',
            'heading' => __('ANIMATION TYPE', 'ideo-themo'),
            'param_name' => 'el_animation_type',
            'group' => __('ANIMATION', 'ideo-themo'),
            'value' => ideothemo_get_animate_viewport(),
            'description' => __('Choose one of predefined animations.', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('ANIMATION DELAY', 'ideo-themo'),
            'param_name' => 'el_animation_delay',
            'min' => '0',
            'max' => '5000',
            'value' => '500',
            'description' => __('Define animation delay in ms.', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('ANIMATION DURATION', 'ideo-themo'),
            'param_name' => 'el_animation_duration',
            'min' => '0',
            'max' => '5000',
            'value' => '500',
            'description' => __('Define animation duration in ms.', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('ANIMATION OFFSET', 'ideo-themo'),
            'param_name' => 'el_animation_offset',
            'min' => '0',
            'max' => '100',
            'value' => '95',
            'description' => __('Define animation offset in %. Offset is ', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_id',
            'heading' => __('UniqID', 'ideo-themo'),
            'param_name' => 'el_uid',
            'value' => 0,
            'group' => __('ANIMATION', 'ideo-themo')
        )

    ),
    'js_view' => 'VcSingleImageView'
));

$image = $img_size = $el_image_align = $el_image_style = $el_hover = $el_lightbox_rel = $el_image_caption_title = $el_image_caption_desc = $el_url = $el_element_style = $el_element_style_colors = $el_margin_top = $el_margin_bottom = $el_extra_class = $el_custom_css = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset  = $el_uid = '';

function ideothemo_single_image_func($atts, $content = "")
{
    
    extract(shortcode_atts(array(
        'image' => '',
        'img_size' => 'full',
        'el_image_align' => 'left',
        'el_hover' => 'none',
        'el_lightbox_rel' => '',
        'el_image_caption_title' => '',
        'el_image_caption_desc' => '',
        'el_url' => '',
        'el_margin_top' => '20',
        'el_margin_bottom' => '20',
        'el_extra_class' => '',
        'el_custom_css' => '',
        'el_element_style' => ideothemo_get_shortcodes_default_style('ideo_single_image'),
        'el_element_style_colors' => '',
        'el_animation' => '',
        'el_animation_type' => 'fadeIn',
        'el_animation_delay' => '500',
        'el_animation_duration' => '1000',
        'el_animation_offset' => '95',
        'el_uid' => ideothemo_shortcode_uid()
    ), $atts));
    
    if($el_uid == '') $el_uid = ideothemo_shortcode_uid();

    $html = '';
    $data = '';
    $imageData = '';
    $link = '';

    if ($image) {
        $imageData = wpb_getImageBySize(array(
            'attach_id' => $image,
            'thumb_size' => $img_size,
            'class' => 'img-responsive'
        ));


        $image_size = ideothemo_get_image_size($image, $img_size);

        $image_src = wp_get_attachment_image_src($image, 'full');
        $image_src = $image_src[0];

        if ($imageData == null || $image_src == '') {
            $imageData['thumbnail'] = '<img class="img-responsive no-image" src="' . ideothemo_asset_url('images/no_image.png') . '" alt="no image"/>';
        }

    } else {
        $imageData['thumbnail'] = '<img class="img-responsive no-image" src="' . ideothemo_asset_url('images/no_image.png') . '" alt="no image"/>';
        $image_src = ideothemo_asset_url('images/no_image.png');
        $image_size = array(300, 200);
    }


    if ($el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-type="' . esc_attr($el_animation_type) . '"';
    if ($el_animation_delay && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-delay="' . esc_attr($el_animation_delay) . '"';
    if ($el_animation_duration && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-duration="' . esc_attr($el_animation_duration) . '"';
    if ($el_animation_offset && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-offset="' . esc_attr($el_animation_offset) . '"';


    $less = '#single_image_' . $el_uid . '{';

    $less .= '.ideo-single-image{width:' . (int)$image_size[0] . 'px;}';

    if ($el_margin_top != '') {
        $less .= 'margin-top:' . (int)$el_margin_top . 'px;';
    }
    if ($el_margin_bottom != '') {
        $less .= 'margin-bottom:' . (int)$el_margin_bottom . 'px;';
    }


    if ($image_size[0] < 300) {
        $link_size = (int)($image_size[0] * 0.20);
        $link_icon_size = (int)($link_size * 0.5);
        $less .= '.link{width:' . $link_size . 'px;height:' . $link_size . 'px;font-size:' . $link_icon_size . 'px;&:before{line-height:' . $link_size . 'px;}}';
    }

    $less .= '}';


    /* ===   custom style   ==== */
    $colors = ideothemo_get_colors_by_style($el_element_style);
    $default_vars = array(
        'colored' => array(
            'image_overlay' => 'undefined',
            'icon_color' => 'undefined',
            'icon_background_color' => 'undefined',
            'icon_hover_color' => 'undefined',
            'icon_hover_background_color' => 'undefined',
        ),
        'transparent' => array()
    );

    $html .= ideothemo_custom_style('single_image', $el_uid, $default_vars, $el_element_style, $el_element_style_colors, $less);
    /* ===   end custom style   ==== */


    $html .= '<div class="ideo-single-image-wrap ' . esc_attr($el_extra_class) . '  align-' . esc_attr($el_image_align) . ' ' . $el_element_style . ' vc-layer" id="single_image_' . esc_attr($el_uid) . '" data-id="single_image_' . esc_attr($el_uid) . '" ' . $data . ' >';
    $html .= '<div class="ideo-single-image hover-' . esc_attr($el_hover) . '">';
    $html .= $imageData['thumbnail'];
    if ($el_hover != 'none') {
        $html .= '<div class="hover"></div>';
    }
    if ($el_hover == 'lightbox' || $el_hover == 'lightboxurl') {
        $html .= '<a href="' . esc_url($image_src) . '" class="link left icon-info image-link" rel="' . esc_attr($el_lightbox_rel) . '" title="' . esc_attr($el_image_caption_title) . '" data-desc="' . esc_attr($el_image_caption_desc) . '">' . '</a>';
    }

    if ($el_hover == 'url' || $el_hover == 'lightboxurl') {
        $link = vc_build_link($el_url);
        $a_href = $link['url'] ?: '#';
        $a_title = $link['title']?:'icon';
        $a_target = trim($link['target']) ?: '_self';
        $html .= '<a href="' . esc_url($a_href) . '" target="' . esc_attr($a_target) . '" title="' . esc_attr($a_title) . '" class="link right icon-url"></a>';
    }
    $html .= '</div>';
    $html .= '</div>';

    

    return $html;
}

add_shortcode('vc_single_image', 'ideothemo_single_image_func');

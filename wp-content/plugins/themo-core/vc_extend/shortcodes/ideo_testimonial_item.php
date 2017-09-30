<?php

vc_map(array(
    'name' => __('TESTIMONIAL ITEM', 'ideo-themo'),
    'base' => 'ideo_testimonial_item',
    'is_container' => false,
    'content_element' => false,
    'category' => __('Content', 'ideo-themo'),
    'description' => __('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt, quod.', 'ideo-themo'),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => __('TESTIMONIAL TITLE', 'ideo-themo'),
            'param_name' => 'title',
            'value' => '',
            'description' => __('Enter testimonial title. It will be used only in backend editor (will not be displayed on frontend).', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('AUTHOR NAME', 'ideo-themo'),
            'param_name' => 'el_author_name',
            'value' => __('Author Name', 'ideo-themo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => __('COMPANY NAME', 'ideo-themo'),
            'param_name' => 'el_company_name',
            'value' => __('Company', 'ideo-themo'),
        ),
        array(
            'type' => 'vc_link',
            'heading' => __('COMPANY LINK', 'ideo-themo'),
            'param_name' => 'el_company_link',
            'value' => '',
            'description' => __('Add link to company page or leave this field empty if you do not need linking.', 'ideo-themo')
        ),
        array(
            'type' => 'textarea',
            'heading' => __('QUOTE', 'ideo-themo'),
            'param_name' => 'content',
            'value' => __('Etiam pharetra nunc ligula, a pellentesque felis porta ac. Vestibulum molestie augue quis ipsum lobortis eleifend.', 'ideo-themo'),
            'description' => __('Enter testimonial quote.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('CONTENT ALIGNMENT', 'ideo-themo'),
            'param_name' => 'el_content_align',
            'value' => array(__('Left', 'ideo-themo') => 'left', __('Center', 'ideo-themo') => 'center', __('Right', 'ideo-themo') => 'right'),
            'std' => 'center',
            'description' => __('Choose Left, Center or Right content alignment.', 'ideo-themo')
        ),
        array(
            'type' => 'attach_image',
            'heading' => __('IMAGE UPLOAD', 'ideo-themo'),
            'param_name' => 'el_image',
            'description' => __('Upload author image.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('IMAGE POSITION', 'ideo-themo'),
            'param_name' => 'el_image_position',
            'value' => array(__('Left', 'ideo-themo') => 'left', __('Right', 'ideo-themo') => 'right', __('Bottom', 'ideo-themo') => 'bottom'),
            'std' => 'bottom',
            'description' => __('Choose Left, Right or Bottom position of the author image.', 'ideo-themo')
        ),
    ),
    'js_view' => 'VcTestimonialItemView'
));

$el_author_name = $el_company_name = $el_company_link = $el_quote = $el_content_align = $el_image = $el_image_position = $active = '';;

function ideothemo_testimonial_item_func($atts, $content = "")
{
    
    extract(shortcode_atts(array(
        'el_author_name' => __('Author Name', 'ideo-themo'),
        'el_company_name' => __('Company', 'ideo-themo'),
        'el_company_link' => '',
        'el_quote' => '',
        'el_content_align' => 'center',
        'el_image' => '',
        'el_image_position' => 'bottom',
        'active' => ''
    ), $atts));

    $html = '';
    $image = '';
    $link = '';

    $html .= '<div class="item ' . ($active ? 'active' : '') . ' image-' . $el_image_position . ' text-' . $el_content_align . ' ">';
    $html .= '  <div class="item-row">';

    if ($el_image) {
        $image_src = wp_get_attachment_image_src($el_image, 'testimonial-slider-image-sc');
        if ($image_src[0]) {
            $image = '<img src="' . $image_src[0] . '" class="img-responsive-no" alt="">';
        }
    }
    $company_name = $el_company_name;
    if ($el_image) {
        $link = vc_build_link($el_company_link);
        $c_href = $link['url'] ? $link['url'] : '#';
        $c_title = $link['title'];
        $c_target = $link['target'] ?: '_self';

        $company_name = '<a  href="' . $c_href . '" target="' . $c_target . '" title="' . $c_title . '">' . $el_company_name . '</a>';
    }

    if ($content) {
        $content = '<p class="content">' . $content . '</p>';
    }
    if ($el_image_position == 'left') {

        if ($el_image) {
            $html .= '      <div class="image">' . $image . '</div>';
        }


        $html .= '          <blockquote>';
        $html .= $content;
        $html .= '          <p class="author">' . $el_author_name . '</p>';
        $html .= '          <p class="company">' . $company_name . '</p>';
        $html .= '          </blockquote>';

    }

    if ($el_image_position == 'right') {

        if ($el_image) {
            $html .= '      <div class="image">' . $image . '</div>';
        }

        $html .= '          <blockquote>';
        $html .= $content;
        $html .= '          <p class="author">' . $el_author_name . '</p>';
        $html .= '          <p class="company">' . $company_name . '</p>';
        $html .= '          </blockquote>';

    }
    if ($el_image_position == 'bottom') {

        $html .= '          <blockquote>';
        $html .= $content;
        $html .= '          <div class="image">' . $image . '';
        $html .= '          <p class="author">' . $el_author_name . '</p>';
        $html .= '          <p class="company">' . $company_name . '</p>';
        $html .= '          </div>';
        $html .= '          </blockquote>';

    }

    $html .= '  </div>';
    $html .= '</div>';

    

    return $html;
}

add_shortcode('ideo_testimonial_item', 'ideothemo_testimonial_item_func');
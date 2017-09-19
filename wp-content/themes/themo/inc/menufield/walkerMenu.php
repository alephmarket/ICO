<?php

class ideothemo_navwalker extends Walker_Nav_Menu
{

    private $curItem;

    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $style = null;

        if ($depth == 0) {
            if ($this->curItem->mega_menu && !empty($this->curItem->background) && ideothemo_get_header_setting('type') != 'side_header'
                    && ideothemo_get_header_setting('type') != 'side_left_header' && ideothemo_get_header_setting('type') != 'side_right_header') {
                $style = ' style="background-image: url(' . $this->curItem->background . ') !important; background-size: cover !important;"';
            }
        }

        $output .= "\n$indent<div class=\"dropmenu\"> <ul role=\"menu\" class=\"menu\"$style>\n";
    }

    public function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent</ul></div>\n";

    }


    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {

        $this->curItem = $item;

        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $class_names = $value = $style = '';

        $classes = empty($item->classes) ? array() : (array)$item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

        if ($args->has_children)
            $class_names .= ' dropdown js-menu-dropdown';

        if ($item->mega_menu && ideothemo_get_header_setting('type') != 'side_header' && ideothemo_get_header_setting('type') != 'side_left_header' && ideothemo_get_header_setting('type') != 'side_right_header' && $depth == 0) {
            $class_names .= ' navbar-megamenu depth-' . $depth;
        } else {
            $class_names .= ' navbar-normal';
        }


        if (in_array('current-menu-item', $classes) || in_array('current-menu-parent', $classes) || in_array('current-menu-ancestor', $classes)) {
            $class_names .= ' active';
        }

        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . '>';

        $atts = array();
        $atts['title'] = !empty($item->post_excerpt) ? $item->post_excerpt : (!empty($item->title) ? $item->title : '');
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';

        if (!empty($item->anchor)) {
            $atts['href'] = '#' . $item->anchor;
        } else if (empty($item->link)) {
            $atts['href'] = !empty($item->url) ? $item->url : '';
        } else {
            $atts['href'] = '#';
        }

        if ($args->has_children)
            $atts['class'] = 'js-menu-dropdown-link';
        else
            $atts['class'] = '';

        // If item has_children add atts to a.
        if ($args->has_children && $depth === 0) {
            if ($item->url == '#') {
                $atts['data-toggle'] = 'dropdown';
                $atts['aria-haspopup'] = 'true';
            }
            $atts['class'] .= ' dropdown-toggle';
        }

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;


        $item_output .= '<a' . $attributes . '>';

        if (!empty($item->icon) && $item->icon != 'nothing'){
            $item_output .= '<i class="fa ' . $item->icon . '"></i>';            
        }

        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        
        if (!empty($item->tag_text)){
            $item_output .= '<span class="tag-menu" style="background-color:' . esc_attr($item->tag_background) . '">' . esc_html($item->tag_text) . '</span>';            
        }
        
        $item_output .= '</a>';


        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

    }


    public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
    {
        if (!$element)
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if (is_object($args[0]))
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }


    public static function fallback($args)
    {
        if (current_user_can('manage_options')) {

            extract($args);

            $fb_output = null;

            if ($container) {
                $fb_output = '<' . $container;

                if ($container_id)
                    $fb_output .= ' id="' . esc_attr($container_id) . '"';

                if ($container_class)
                    $fb_output .= ' class="' . esc_attr($container_class) . '"';

                $fb_output .= '>';
            }

            $fb_output .= '<ul';

            if ($menu_id)
                $fb_output .= ' id="' . esc_attr($menu_id) . '"';

            if ($menu_class)
                $fb_output .= ' class="' . esc_attr($menu_class) . '"';

            $fb_output .= '>';
            $fb_output .= '<li><a href="' . esc_url(admin_url('nav-menus.php')) . '">Add a menu</a></li>';
            $fb_output .= '</ul>';

            if ($container)
                $fb_output .= '</' . $container . '>';

            echo $fb_output;
        }
    }
}
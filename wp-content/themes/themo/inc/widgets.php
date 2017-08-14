<?php

class RecentPostTypeWidget extends WP_Widget
{
    private $post_type;
    private $template_part;

    public function __construct($id_base, $name, $widget_options = array(), $control_options = array())
    {
        parent::__construct($id_base, $name, $widget_options, $control_options);
        add_action('widgets_init', array($this, 'register'));
    }

    /**
     * Register a widget
     */
    public function register()
    {
        register_widget(get_class($this));
    }

    /**
     * Register fields in ACF for Widget
     */

    /**
     * Output the settings update form.
     *
     * @param array $instance
     * @return string|void
     */
    public function form($instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $posts_per_page = isset($instance['posts_per_page']) ? $instance['posts_per_page'] : 1;

        $this->beforeForm($instance);

        ?>
        <p>
            <label><?php esc_html_e('Title', 'themo');?></label><br/>
            <input id="<?php echo esc_attr($this->get_field_id('title'));?>" name="<?php echo esc_attr($this->get_field_name('title'));?>"
                   type="text" value="<?php echo esc_attr($title);?>"/>
        </p>

        <p>
            <label><?php esc_html_e('Number of posts to show:', 'themo');?></label><br/>
            <input id="<?php echo esc_attr($this->get_field_id('posts_per_page')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('posts_per_page')); ?>"
                   type="text" value="<?php echo esc_attr($posts_per_page); ?>"/>
        </p>

        <?php

        $this->afterForm($instance);

    }

    public function widget($args, $instance)
    {
        global $wp_query;

        echo $args['before_widget'];

        if (isset($instance['title']) && !empty($instance['title']))
            echo $args['before_title'] . $instance['title'] . $args['after_title'];

        $wp_query_args = array(
            'post_type' => $this->getPostType(),
            'post_status' => 'publish',
            'posts_per_page' => $instance['posts_per_page']
        );

        $wp_query_args = $this->wpQueryArgs($instance, $wp_query_args);

        $wp_query = new WP_Query($wp_query_args);

        echo ideothemo_get_template_part($this->getTemplatePart());

        wp_reset_postdata();
        wp_reset_query();

        echo $args['after_widget'];
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = isset($new_instance['title']) ? esc_sql(esc_html($new_instance['title'])) : '';
        $instance['posts_per_page'] = isset($new_instance['posts_per_page']) ? absint($new_instance['posts_per_page']) : 1;
        $instance['category_id'] = isset($new_instance['category_id']) ? absint($new_instance['category_id']) : 0;

        return $instance;
    }

    /**
     * @return mixed
     */
    public function getTemplatePart()
    {
        return $this->template_part;
    }

    /**
     * @param mixed $template_part
     */
    public function setTemplatePart($template_part)
    {
        $this->template_part = $template_part;
    }

    /**
     * @return string
     */
    public function getPostType()
    {
        return $this->post_type;
    }

    /**
     * @param string $post_type
     */
    public function setPostType($post_type)
    {
        $this->post_type = $post_type;
    }


    protected function getWidgetSlug()
    {
        return strtolower(get_class($this));
    }

    protected function beforeForm($instance)
    {
    }

    protected function afterForm($instance)
    {
    }

    protected function wpQueryArgs($instance, $wp_query_args)
    {
        return $wp_query_args;
    }
}

class RecentPostWidget extends RecentPostTypeWidget
{
    public function __construct()
    {
        $this->setPostType('post');
        $this->setTemplatePart('parts.widget.newest.post');
        parent::__construct($this->getWidgetSlug(), esc_html__('Newest Posts', 'themo'), array('description' => esc_html__('Your site’s newest Posts.', 'themo')));
    }

    protected function afterForm($instance)
    {
        $category_id = isset($instance['category_id']) ? $instance['category_id'] : 0;
        ?>
        <p>
            <label><?php esc_html_e('Select specyfic categories', 'themo');?></label><br/>
            <select id="<?php echo  esc_attr($this->get_field_id('category_id'));?>"
                    name="<?php echo  esc_attr($this->get_field_name('category_id'));?>">
                <option value="all"><?php esc_html_e('all categories', 'themo');?></option>

                <?php foreach (get_categories() AS $category) : ?>
                    <option <?php selected($category->term_id, $category_id); ?>
                        value="<?php echo  esc_attr($category->term_id); ?>"><?php echo esc_html($category->name); ?></option>
                <?php endforeach;?>

            </select>
        </p>
    <?php
    }

    protected function wpQueryArgs($instance, $wp_query_args)
    {
        if (isset($instance['category_id']) && $instance['category_id'] > 0) {
            $wp_query_args['category__in'] = array(absint($instance['category_id']));
        }

        return apply_filters('recent_post_widget_args', $wp_query_args);
    }
}

class RecentPortfolioWidget extends RecentPostTypeWidget
{
    public function __construct()
    {
        $this->setPostType('portfolio');
        $this->setTemplatePart('parts.widget.newest.portfolio');
        parent::__construct($this->getWidgetSlug(), esc_html__('Newest Portfolio', 'themo'), array('description' => esc_html__('Newest Portfolio', 'themo')));
    }

    protected function afterForm($instance)
    {
        $category_id = isset($instance['category_id']) ? $instance['category_id'] : 0;

        if (get_terms('portfolio_categories')) {
            ?>
            <p>
                <label><?php esc_html_e('Select specyfic categories', 'themo'); ?></label><br/>
                <select id="<?php echo  esc_attr($this->get_field_id('category_id')); ?>"
                        name="<?php echo  esc_attr($this->get_field_name('category_id')); ?>">
                    <option value="all"><?php esc_html_e('all categories', 'themo'); ?></option>

                    <?php foreach (get_terms('portfolio_categories') AS $category) : ?>
                        <option <?php selected($category->term_id, $category_id); ?>
                            value="<?php echo  esc_attr($category->term_id); ?>"><?php echo esc_html($category->name); ?></option>
                    <?php endforeach; ?>

                </select>
            </p>
        <?php
        }
    }

    protected function wpQueryArgs($instance, $wp_query_args)
    {
        if (isset($instance['category_id']) && $instance['category_id'] > 0) {
            $wp_query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'portfolio_categories',
                    'field' => 'id',
                    'terms' => absint($instance['category_id']),
                ),
            );
        }

        return apply_filters('recent_portfolio_widget_args', $wp_query_args);
    }
}

new RecentPostWidget;
new RecentPortfolioWidget;
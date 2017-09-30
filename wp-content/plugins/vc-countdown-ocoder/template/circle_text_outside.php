<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$output = "";
$time = rand();
wp_register_style('vc_oc_white_line_circle_countdown', plugins_url('../assets/css/white_line_circle_countdown.css', __FILE__));
wp_enqueue_style('vc_oc_white_line_circle_countdown');
wp_register_style('vc_oc_circle_text_outside', plugins_url('../assets/css/circle_text_outside.css', __FILE__));
wp_enqueue_style('vc_oc_circle_text_outside');
wp_enqueue_script('vc_oc_white_line_circle_countdown', plugins_url('../assets/js/white_line_circle_countdown.js', __FILE__), array('jquery'));

ob_start();
?>

<style> 
<?php if ($time_text_size): ?>
#countdown_<?php echo $time ?> .uc_box .uc_number{
    font-size: <?php echo $time_text_size?>px;
}
<?php endif; ?>
<?php if ($text_size): ?>
#countdown_<?php echo $time ?> .uc_box .uc_label{
    font-size: <?php echo $text_size?>px;
}
<?php endif; ?>
<?php if ($txt_color): ?>
#countdown_<?php echo $time ?> .uc_box .uc_label,
#countdown_<?php echo $time ?> .uc_box .uc_number{
    color: <?php echo $txt_color?>;
}
<?php endif; ?>
<?php if ($inside_color): ?>
#countdown_<?php echo $time ?> .uc_box .uc_number{
    background: <?php echo $inside_color?>;
}
<?php endif; ?>
</style>

<div class="wrap-count-down circle_text_outside <?php echo esc_attr($css_class); ?>">
    <div id="countdown_<?php echo $time ?>" class="uc_white_line_circle_countdown">
        <div class="uc_box">
            <canvas class="uc_circle"></canvas>
            <span class="uc_number">0</span>
            <span class="uc_label">Days</span>
        </div>
        <div class="uc_box">
            <canvas class="uc_circle"></canvas>
            <span class="uc_number">0</span>
            <span class="uc_label">Hours</span>
        </div>
        <div class="uc_box">
            <canvas class="uc_circle"></canvas>
            <span class="uc_number">0</span>
            <span class="uc_label">Minutes</span>
        </div>
        <div class="uc_box">
            <canvas class="uc_circle"></canvas>
            <span class="uc_number">0</span>
            <span class="uc_label">Seconds</span>
        </div>
        <div style="clear: both;"></div>
    </div>

</div>
<script type="text/javascript">
    
        setInterval(function () {
            uc_white_line_circle_countdown("countdown_<?php echo $time ?>", "<?php echo $countdown_date ?>", 10,
                    "<?php echo $d_color ? $d_color : "#D8005F" ?>",
                    "<?php echo $h_color ? $h_color : "#FF2800" ?>",
                    "<?php echo $i_color ? $i_color : "#8506A9" ?>",
                    "<?php echo $s_color ? $s_color : "#87EA00" ?>",
                    1)
        }, 1000);
    
</script>

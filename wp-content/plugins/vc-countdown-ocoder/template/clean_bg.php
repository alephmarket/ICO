<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$output = "";
$time = rand();
wp_register_style('vc_oc_clean_countdown', plugins_url('../assets/css/clean_countdown.css', __FILE__));
wp_register_style('vc_oc_clean_bg', plugins_url('../assets/css/clean_bg.css', __FILE__));
wp_enqueue_style('vc_oc_clean_bg');

wp_enqueue_style('vc_oc_clean_countdown');
wp_enqueue_script('vc_oc_clean_countdown', plugins_url('../assets/js/clean_countdown.js', __FILE__), array('jquery'));

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
</style>
<div class="wrap-count-down clean_bg <?php echo esc_attr($css_class); ?>">
    <div id="countdown_<?php echo $time ?>" class="uc_clean_countdown">
        <div class="uc_box">
            <span class="uc_number uc_number_d" style='<?php if ($d_color) echo "background-color: $d_color;" ?>'>0</span>
            <span class="uc_label">DAYS</span>
        </div>
        <div class="uc_box">
            <span class="uc_number uc_number_h"  style='<?php if ($h_color) echo "background-color: $h_color;" ?>'>0</span>
            <span class="uc_label">HOURS</span>
        </div>
        <div class="uc_box">
            <span class="uc_number uc_number_m"  style='<?php if ($i_color) echo "background-color: $i_color;" ?>'>0</span>
            <span class="uc_label">MINUTES</span>
        </div>
        <div class="uc_box">
            <span class="uc_number uc_number_s"  style='<?php if ($s_color) echo "background-color: $s_color;" ?>'>0</span>
            <span class="uc_label">SECONDS</span>
        </div>
        <div style="clear: both;"></div>
    </div>
    <div style="clear: both;"></div>
</div>

<script type="text/javascript">
         setInterval(function () {
            uc_clean_countdown("countdown_<?php echo $time ?>", "<?php echo $countdown_date ?>")
        }, 1000);
     
</script>

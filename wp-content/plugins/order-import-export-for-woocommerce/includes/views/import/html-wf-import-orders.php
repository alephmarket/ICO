
<div class="tool-box">
    <h3 class="title"><?php _e('Import Orders in CSV Format:', 'wf_order_import_export'); ?></h3>
    <p><?php _e('Import Orders in CSV format from different sources (  from your computer OR from another server via FTP )', 'wf_order_import_export'); ?></p>
    <p class="submit">
        <?php
        $merge_url = admin_url('admin.php?import=woocommerce_wf_order_csv&merge=1');
        $import_url = admin_url('admin.php?import=woocommerce_wf_order_csv');
        ?>
        <a class="button button-primary" id="mylink" href="<?php echo admin_url('admin.php?import=woocommerce_wf_order_csv'); ?>"><?php _e('Import Orders', 'wf_order_import_export'); ?></a>
        &nbsp;
        <input type="checkbox" id="merge" value="0"><?php _e('Merge order if exists', 'wf_order_import_export'); ?> <br>
    </p>
</div>
<script type="text/javascript">
    jQuery('#merge').click(function () {
        if (this.checked) {
            jQuery("#mylink").attr("href", '<?php echo $merge_url ?>');
        } else {
            jQuery("#mylink").attr("href", '<?php echo $import_url ?>');
        }
    });
</script>
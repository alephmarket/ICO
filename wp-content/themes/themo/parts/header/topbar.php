<?php if (ideothemo_is_topbar_enabled()) : ?>
<div id="topbar" class="<?php echo ideothemo_get_header_setting('top.width') == 'custom' ? ideothemo_setting_class('top.custom_width', 'custom') : (ideothemo_get_header_setting('top.width') == 'container' && !ideothemo_is_boxed_version())  ? 'container':''; ?><?php if (!ideothemo_get_header_true('top.topbar_mobile')): ?> hidden-xs hidden-sm<?php endif; ?>">   
    <div class="row">
       <div id="topbar-content">
           <div class="col-sm-6 col-left"><?php if ( is_active_sidebar( 'header-topbar-left' ) ) { dynamic_sidebar( 'header-topbar-left' ); } ?></div>
           <div class="col-sm-6 col-right"><?php if ( is_active_sidebar( 'header-topbar-right' ) ) { dynamic_sidebar( 'header-topbar-right' ); } ?></div>
        </div>
    </div>
</div>
<?php endif; ?>
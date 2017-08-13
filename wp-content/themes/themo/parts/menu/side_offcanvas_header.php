<?php get_template_part('parts/menu/standard_header'); ?>
<div class="side-header-offcanvas-overlay <?php echo ideothemo_get_header_setting( 'side.offcanvas.topbar.style' );?> icon-<?php echo ideothemo_get_header_setting( 'side.offcanvas.icon_size' ); ?>"></div>
<div class="side-header-offcanvas-topbar side-header-offcanvas-topbar-<?php echo esc_attr(ideothemo_get_header_setting( 'side.offcanvas.topbar.type' )); ?> <?php echo ideothemo_get_header_setting( 'side.offcanvas.topbar.style' ) ?: ideothemo_get_general_theme_skin();?><?php if ( ideothemo_get_header_setting( 'side.offcanvas.topbar.transparent') == 'true'){?> transparent<?php } ?>">
    <div class="side-header-offcanvas-topbar-content">
        <?php if ( ideothemo_get_header_setting( 'side.offcanvas.pagetitle.enabled' ) == 'true' || (ideothemo_is_customize_preview()&& !ideothemo_is_pc_mode())) : 
        $pagetitle_text = is_front_page() ? ideothemo_get_header_setting( 'side.offcanvas.pagetitle.text' ) : '';
        ?>    
        <div class="side-header-offcanvas-page-title <?php if ( ideothemo_get_header_setting( 'side.offcanvas.pagetitle.enabled' ) == 'false' ) {?>hidden<?php } ?>"><?php echo $pagetitle_text ?: ideothemo_get_the_title(); ?></div>
        <?php endif; ?>    
        <?php if ( ideothemo_get_header_setting( 'side.offcanvas.topbar.logo.type' ) != 'none'  || ideothemo_get_header_setting( 'side.offcanvas.stickybar.logo.type' ) != 'none' || ideothemo_is_customize_preview()) : ?>    
        <a class="side-header-offcanvas-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo ideothemo_get_offcanvas_bar_logo('topbar', get_bloginfo('name')); ?></a>
        <?php endif; ?>    
        <div class="hamburger hamburger--<?php echo ideothemo_get_header_setting( 'side.offcanvas.icon_style' ); ?> hamburger--<?php echo ideothemo_get_header_setting( 'side.offcanvas.icon_size' ); ?> opening-<?php echo ideothemo_get_header_setting( 'side.offcanvas.opening' ); ?>">
            <div class="hamburger-box">
                <div class="hamburger-inner"></div>
            </div>
        </div>
    </div>
</div>
<nav id="leftside-navbar" class="<?php echo ideothemo_side_header_classes(); ?> collapsed">
	<div class="entry-content">
        <div class="navbar-header">
            <div class="brand">
                <?php if ( ideothemo_get_header_setting( 'side.logo.type' ) != 'none' || ideothemo_is_customize_preview()) : ?>    
                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo ideothemo_logo_header('side', get_bloginfo('name')); ?></a>
                <?php endif; ?>
            </div>
            <form class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input type="text" name="s" placeholder="<?php esc_html_e('START TYPING...', 'themo'); ?>">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
            <?php if ( is_active_sidebar( 'side-header' ) ) : ?>
                    <?php dynamic_sidebar( 'side-header' ); ?>
            <?php endif; ?>
        </div>
        <?php ideothemo_nav_menu(); ?>
        <footer>
			<?php ideothemo_language_switcher_side(); ?>

            <?php if (ideothemo_get_header_setting('side.social_icon') != 'false'): ?>
                <ul class="social">
                    <?php ideothemo_get_header_socials('side_header'); ?>
                </ul>
            <?php endif ?>

            <div class="copyright"><?php echo ideothemo_side_header_copyright() ?></div>
        </footer>
   </div>
</nav>

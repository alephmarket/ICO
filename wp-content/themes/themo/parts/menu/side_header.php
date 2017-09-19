<?php get_template_part('parts/menu/standard_header'); ?>
<nav id="leftside-navbar" class="<?php echo ideothemo_side_header_classes(); ?>">
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

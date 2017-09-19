<div id="header-navbar" class="<?php echo ideothemo_get_header_navbar_classes(); ?> socials" data-mobile-skin="<?php echo ideothemo_get_header_navbar_mobile_skin() ?>">
        <?php get_template_part('parts/header/topbar'); ?>
        <nav class="<?php echo ideothemo_get_header_nav_standard_classes(); ?>" >
                
                <div class="navbar-content">
                
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggle-placeholder">&nbsp;</span>
                        <span class="animated-icon"></span>
                    </button>
                    
                    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo ideothemo_logo_header('top', get_bloginfo('name')); ?><?php echo ideothemo_logo_header('mobile', get_bloginfo('name')); ?></a>
                    
                </div>
				
                <div class="modern-bars-content">
                	
                	<?php if (ideothemo_get_header_setting('top.search_form') == 'navbar-form-modern'): ?>
                    <form class="navbar-form-modern modern-bar" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <div class="form-group">
                           <div class="row">                       
                               <div class="col-md-12"><input type="text" name="s" class="form-control" placeholder="<?php esc_html_e('START TYPING...', 'themo'); ?>"></div>
                           </div>
                    
                        </div> 
                        <a href="#" class="close"><i class="id id-close"></i></a>              
                    </form>
                    <?php endif; ?>

					<?php if (ideothemo_get_header_true('top.social_media') || ideothemo_get_header_true('mobile.social_media_icon') || ideothemo_is_customize_preview()): ?>
                    <div class="navbar-social-modern modern-bar social">
                        <?php ideothemo_get_header_socials('standard_header'); ?>
                        <a href="#" class="close"><i class="id id-close"></i></a> 
                    </div>
                    <?php endif; ?>
                </div>

                <div class="collapse navbar-collapse" id="header-navbar-collapse">
                    <ul class="nav navbar-menu navbar-nav navbar-right navbar-social">
                    	<?php if (ideothemo_get_header_true('top.social_media')): ?>
                        <li><a href="#" data-target=".navbar-social-modern"><i class="fa fa-share-alt" ></i></a></li>
                        <?php endif; ?>
                        <?php ideothemo_language_switcher(); ?>
                        <?php if (ideothemo_get_header_setting('top.search_form') !== 'disable'): ?>
                        <li><a href="#" data-target=".<?php echo ideothemo_get_header_setting('top.search_form'); ?>"><i class="fa fa-search"></i></a></li>
                        <?php endif; ?>
                    </ul>
                    
					<?php if (ideothemo_get_header_setting('top.search_form') == 'navbar-form'): ?>
                    <form class="navbar-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" name="s" placeholder="<?php esc_html_e('START TYPING...', 'themo'); ?>">
                        </div>
                        <button type="submit" class="button btn-default"><?php esc_html_e('Search', 'themo'); ?> <i class="fa fa-search"></i>
                        </button>
                    </form>
                    <?php endif; ?>
                    
                    
                    <?php ideothemo_nav_menu(); ?>

                    <form class="mobile-navbar-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" name="s" placeholder="<?php esc_html_e('START TYPING...', 'themo'); ?>">
                            <button type="submit" class="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <!-- /.navbar-collapse -->
               
                </div>
                   
        </nav>
   
</div>

<?php if ( has_nav_menu( 'footer_menu' ) ) : ?>
    <div class="dmbs-footer-menu">
            <nav class="navbar" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-2-collapse">
                            <span class="sr-only"><?php _e('Toggle navigation','devdmbootstrap3'); ?></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
					<ul class="nav navbar-nav">
						<li><a href="<?php echo get_home_url(); ?>">&copy; <?php echo date('Y') ?>  <?php bloginfo( 'name' ); ?></a></li>
					</ul>
                    <?php
                    wp_nav_menu( array(
                            'theme_location'    => 'footer_menu',
                            'depth'             => 2,
                            'container'         => '',
                            'container_class'   => 'collapse navbar-collapse navbar-2-collapse',
                            'menu_class'        => 'nav navbar-nav navbar-right',
                            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                            'walker'            => new wp_bootstrap_navwalker())
                    );
                    ?>
                </div>
            </nav>
    </div>
<?php endif; ?>
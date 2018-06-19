<?php get_header(); ?>
<?php get_template_part( 'partials/template-part' , 'head'); ?>
<?php get_template_part( 'partials/template-part' , 'topnav'); ?>
<div class="container page-section">
    <!-- start content container -->
    <?php // theloop
    if (have_posts()) : the_post();
    ?>
        <div class="row dmbs-content">
            <div class="col-sm-8">
                <h2><?php the_title(); ?></h2>
            </div>
            <div class="col-sm-4 single-share-buttons text-right">
                <?php echo do_shortcode("[addtoany buttons='facebook,twitter,google_plus,linkedin']") ?>
            </div>
        </div>
        <div class="row dmbs-content">
            <div class="col-sm-12">
                <?php global $dm_settings; ?>
                <div class="post-meta-data">
                <?php if ($dm_settings['show_postmeta'] != 0) : ?>
                    <ul>
                        <li>By <?php the_author_posts_link(); ?></li>
                        <li><?php the_time('F jS, Y'); ?></li>
                        <li><?php _e('Posted In','devdmbootstrap3'); ?>: <?php the_category(', '); ?></li>
                        <?php if(has_tag()): ?>
                            <li><?php the_tags(); ?></li>
                        <?php endif; ?>
                    </ul>
                    <div class="clearfix"></div>
                <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row dmbs-content">
            <?php //left sidebar ?>
            <?php get_sidebar('left'); ?>
            <div class="col-md-<?php devdmbootstrap3_main_content_width(); ?> dmbs-main">
                <div <?php post_class(); ?>>
                    <div class="post-content">
                    <?php
                    $opts = get_field('featured_image_display');
                    if (has_post_thumbnail() && in_array('post_page', $opts)) :
                    ?>
                    <?php the_post_thumbnail(); ?>
                    <div class="clear"></div>
                    <?php endif; ?>
                    <?php the_content(); ?>
                    </div>
                    <?php wp_link_pages(); ?>
                    <?php //get_template_part( 'partials/template-part' , 'postmeta'); ?>
                    <?php comments_template(); ?>
                </div>
            </div>
            <?php //get the right sidebar ?>
            <?php get_sidebar('right'); ?>
        </div>
        <?php
    endif;
    ?>
</div>
</div>
<!-- end content container -->
<?php get_footer(); ?>


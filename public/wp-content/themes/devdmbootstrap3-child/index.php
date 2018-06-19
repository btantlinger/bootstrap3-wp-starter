<?php get_header(); ?>
<?php get_template_part( 'partials/template-part' , 'head'); ?>
<?php get_template_part( 'partials/template-part' , 'topnav'); ?>
<div class="container page-section">
    <?php if (is_search() || is_archive()): ?>
        <div class="row dmbs-content">
            <div class="col-sm-12">
                <?php if (is_search()): ?>
                    <?php
                    $total_results = $wp_query->found_posts;
                    echo "<h2 class='page-header'>" . sprintf(__('%s Search Results for "%s"', 'devdmbootstrap3'), $total_results, get_search_query()) . "</h2>";
                    ?>
                <?php else : ?>
                    <h2 class="page-header"><?php the_archive_title(); ?></h2>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- start content container -->
    <div class="row dmbs-content">
        <?php //left sidebar ?>
        <?php get_sidebar('left'); ?>

        <div class="post-list col-md-<?php devdmbootstrap3_main_content_width(); ?> dmbs-main">
            <?php // theloop
            if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="blog-cell">
                    <div <?php post_class("row"); ?>>
                        <?php
                        $colSize = has_post_thumbnail() ? '8' : '12';
                        if (has_post_thumbnail()) :
                        ?>
                        <div class="col-sm-4">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                        </div>
                        <?php endif; ?>
                        <div class="col-sm-<?php echo $colSize ?>">
                        <div class="post-content">
                            <h2 class="blog-title">
                                <a href="<?php the_permalink(); ?>"
                                   title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'devdmbootstrap3'), the_title_attribute('echo=0'))); ?>"
                                   rel="bookmark"><?php the_title(); ?></a>
                            </h2>
                            <div class="by-line">
                                <ul>
                                    <li>Posted on <?php the_time('F jS, Y'); ?> by <?php the_author_posts_link(); ?></li>
                                    <?php
                                    $cats = get_the_category();
                                    if (!empty($cats)):
                                        $catLink = '<a href="' . esc_url(get_category_link($cats[0]->term_id)) . '" alt="' . esc_attr(sprintf(__('View all posts in %s', 'textdomain'), $cats[0]->name)) . '">' . esc_html($cats[0]->name) . '</a>';
                                        ?>
                                        <li>
                                            <?php echo $catLink ?>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (comments_open()) : ?>
                                        <li>
                                            <a href="<?php the_permalink(); ?>#comments"><?php comments_number(__('Leave a Comment', 'devdmbootstrap3'), __('One Comment', 'devdmbootstrap3'), '%' . __(' Comments', 'devdmbootstrap3')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <?php the_excerpt(); ?>
                            <a class="btn btn-sm btn-primary pull-right" href="<?php the_permalink(); ?>">Read More <i
                                        class="fa fa-chevron-right"></i></a>
                            <div class="clearfix"></div>
                        </div>
                        <?php wp_link_pages(); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row post-foot">
                        <div class="col-sm-5 text-muted">

                        </div>
                        <div class="col-sm-7 text-right">
                            <?php echo do_shortcode("[addtoany buttons='facebook,twitter,google_plus,linkedin']") ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
                <?php
                if (function_exists('wp_bootstrap_pagination')) {
                    wp_bootstrap_pagination();
                } else {
                    posts_nav_link();
                }
                ?>
            <?php else: ?>
                <?php get_404_template(); ?>
            <?php endif; ?>
        </div>

        <?php //get the right sidebar ?>
        <?php get_sidebar('right'); ?>

    </div>
</div>
<!-- end content container -->
<?php get_footer(); ?>

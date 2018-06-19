<?php
/* Template Name: Full Width Page */
get_header();
?>
<?php get_template_part( 'partials/template-part', 'head' ); ?>
<?php get_template_part( 'partials/template-part', 'topnav' ); ?>
<?php
// theloop
if ( have_posts() ) :
?>
	<?php while ( have_posts() ) : the_post(); ?>
			
			<div class="dmbs-content">
				<div class="dmbs-main">
				<!-- <h2 class="page-header"><?php the_title(); ?></h2> -->
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
					<?php comments_template(); ?>
				</div>
			</div>
		
	<?php endwhile; ?>
<?php else: ?>
	<?php get_404_template(); ?>
<?php endif; ?>
<!-- end content container -->
<?php get_footer(); ?>

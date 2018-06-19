<?php
/* Template Name: Page With Hero Section */
get_header();
?>
<?php get_template_part( 'partials/template-part', 'head' ); ?>
<?php get_template_part( 'partials/template-part', 'topnav' ); ?>
<?php
// theloop
if ( have_posts() ) :
?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
		$img = get_field( 'hero_image' );
		$hheading = get_field( 'hero_heading' );
		$hdesc = get_field( 'hero_description' );
		if ( !empty( $img ) ):
		?>		
			<div class="jumbotron hero-panel" style="background-image: url('<?php echo $img ?>')">
				<div class="container">
					<div class="hero-text">
					<?php if ( !empty( $hheading ) ): ?>
						<h1><?php echo $hheading ?></h1>
					<?php endif; ?>
					<?php if ( !empty( $hdesc ) ): ?>
						<p><?php echo $hdesc; ?></p>
					<?php endif; ?>
					</div>
				</div>
			</div>		
		<?php
		endif;
		?>
		
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

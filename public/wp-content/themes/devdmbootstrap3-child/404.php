<?php get_header(); ?>

<?php get_template_part( 'partials/template-part' , 'head'); ?>

<?php get_template_part( 'partials/template-part' , 'topnav'); ?>
<div class="container dmbs-container">
    <!-- start content container -->
    <div class="row dmbs-content">

        <?php //left sidebar ?>
        <?php get_sidebar( 'left' ); ?>

        <div class="col-md-<?php devdmbootstrap3_main_content_width(); ?> dmbs-main">
         <h1><?php _e('Sorry This Page Does Not Exist!','devdmbootstrap3'); ?></h1>
        </div>

        <?php //get the right sidebar ?>
        <?php get_sidebar( 'right' ); ?>

    </div>
    <!-- end content container -->
</div>
<?php get_footer(); ?>
<?php
/**
 * Template name: JN Rankings
 *
 * @package llorix-one-lite
 */
	get_header();
?>

	</div>
	<!-- /END COLOR OVER IMAGE -->
</header>
<!-- /END HOME / HEADER  -->

<script language=JavaScript>

</script>

<div class="content-wrap">
	<div class="container">
		<?php $page_title = get_the_title(); ?>
		<div id="primary" class="content-area col-md-12 <?php if ( empty( $page_title ) ) {  echo 'llorix-one-lite-top-margin-5px'; } ?>">
			<main id="main" class="site-main" role="main">
	

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
					comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

			<?php 
				$datatables_id = get_field('datatables_id');
				llorix_display_rankings_table( (int)$datatables_id ); 
			?>

		</div><!-- #primary -->

	</div>
</div><!-- .content-wrap -->

<?php get_footer(); ?>

<?php
/**
 * Template name: U23Rankings
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

				if (array_key_exists("season",$_GET)) {
					$season = $_GET['season'];
				} 

				if (array_key_exists("gender",$_GET)) {
					$gender = $_GET['gender'];
				} 

				$season_array = array(2017);
        			$gender_array = array('F','M');

				echo "<form method=post name=f1>";
				echo "<select name='season' ><option value=''>Select season</option>";
				foreach ($season_array as $noticia2) {
					if(isset($_POST['season']) && ($_POST['season'] == $noticia2)) {
						$season = $_POST['season'];
						echo "<option selected value='$season'>$season</option>"."<BR>";}
					else { 
						echo "<option value='$noticia2'>$noticia2</option>";
					}
				}
				echo "</select>";
				echo "</br></br>";
				echo "<select name='gender'><option value=''>Select gender</option>";
				foreach ($gender_array as $noticia) {
					if(isset($_POST['gender']) && ($_POST['gender'] == $noticia)) {
						$gender = $_POST['gender'];
						echo  "<option selected value='$gender'>$gender</option>";
					} else {
						echo  "<option value='$noticia'>$noticia</option>";
					}
				}
				echo "</select>";
				echo "</br></br>";
				echo "<input type=submit value=Submit>";
				echo "</form>";
				if(isset($_POST['gender'])){
					$season = $_POST['season'];
					$gender = $_POST['gender'];
					$shortcode = '[wpdatatable id=11 VAR1="'.$gender.'" VAR2="'.$season.'" table_view=regular]';
          				echo "</br><hr>";
			    echo do_shortcode($shortcode); 
				}
			?>
		</div><!-- #primary -->

	</div>
</div><!-- .content-wrap -->

<?php get_footer(); ?>

<?php
/**
 * Template name: Rankings
 *
 * @package llorix-one-lite
 */
	require_once( ABSPATH . WPINC . '/wp-db.php' );
	if ( file_exists( WP_CONTENT_DIR . '/db.php' ) )
		require_once( WP_CONTENT_DIR . '/db.php' );
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

				if (array_key_exists("event_id",$_GET)) {
					$event_id = $_GET['event_id'];
				} 

				$season_array = array(2017);
        $gender_array = array('F','M');
        $age_group_array = array('U16','U18','U20','U23','SR');

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
				echo "<select name='event_id'><option value=''>Select gender</option>";
				foreach ($gender_array as $noticia) {
					if(isset($_POST['event_id']) && ($_POST['event_id'] == $noticia)) {
						$event_id = $_POST['event_id'];
						echo  "<option selected value='$event_id'>$event_id</option>";
					} else {
						echo  "<option value='$noticia'>$noticia</option>";
					}
				}
				echo "</select>";
				echo "</br></br>";
				echo "<select name='age_group'><option value=''>Select age group</option>";
				foreach ($age_group_array as $noticia) {
          if(isset($_POST['age_group']) && $_POST['age_group'] == $noticia){
            $age_group = $_POST['age_group'];
						echo  "<option selected value='$age_group'>$age_group</option>";
	        } else {	
	          echo  "<option value='$noticia'>$noticia</option>";
	        }
				}
				echo "</select>";
				echo "</br></br>";
				echo "<input type=submit value=Submit>";
				echo "</form>";
				$selected_val = "";
				if(isset($_POST['age_group'])){
					$season = $_POST['season'];
					$gender = $_POST['event_id'];
					$age_group = $_POST['age_group'];  // Storing Selected Value In Variable
					$shortcode = '[wpdatatable id=9 VAR2="'.$event_id.'" VAR3="'.$age_group.'" table_view=regular]';
          echo "</br><hr>";
          #echo $_POST['age_group']." ".$_POST['event_id']." ".$_POST['season'];
			    echo do_shortcode($shortcode); 
				}
			?>
		</div><!-- #primary -->

	</div>
</div><!-- .content-wrap -->

<?php get_footer(); ?>

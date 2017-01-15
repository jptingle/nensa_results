<?php
/**
 * Template name: Results
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
function reload(form)
{
	var val=form.season.options[form.season.options.selectedIndex].value;
	var url = [location.protocol, '//', location.host, location.pathname].join('');
	self.location=url + '?season=' + val;
}
function reload3(form)
{
	var val=form.season.options[form.season.options.selectedIndex].value;
	var val1=form.event_id.options[form.event_id.options.selectedIndex].value;
	var url = [location.protocol, '//', location.host, location.pathname].join('');
	self.location=url + '?season=' + val + '&event_id=' + val1;
}
function reloadall(form)
{
	var val=form.season.options[form.season.options.selectedIndex].value;
	var val1=form.event_id.options[form.event_id.options.selectedIndex].value;
	var val2=form.event_name.options[form.event_name.options.selectedIndex].value;
	var url = [location.protocol, '//', location.host, location.pathname].join('');
	self.location=url + '?season=' + val + '&event_id=' + val1 + '&event_name=' + val2;
}
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

				if ( !isset( $results_db ) ) {
					$results_db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME_RESULTS, DB_USER, DB_PASSWORD);
				}
	
				if ( !isset( $results_db ) ) { echo "DB not available"; }
				$quer2="SELECT DISTINCT season FROM race_event order by season"; 
				if (array_key_exists("season",$_GET)) {
					$season = $_GET['season'];
				} 
				if(isset($season) and strlen($season) > 0) {
					$quer="SELECT DISTINCT event_name, event_id FROM race_event WHERE parent_event_id IS NULL AND season=$season order by event_name"; 
				}

				if (array_key_exists("event_id",$_GET)) {
					$event_id = $_GET['event_id'];
				} 
				if(isset($event_id) and strlen($event_id) > 0) {
					$quer3="SELECT DISTINCT event_name FROM race_event where parent_event_id=$event_id order by event_name"; 
				} 

				echo "<form method=post name=f1>";
				echo "<select name='season' onchange=\"reload(this.form)\"><option value=''>Select one</option>";
				foreach ($results_db->query($quer2) as $noticia2) {
					if($noticia2['season']==@$season) {
						echo "<option selected value='$noticia2[season]'>$noticia2[season]</option>"."<BR>";}
					else { 
						echo  "<option value='$noticia2[season]'>$noticia2[season]</option>";
					}
				}
				echo "</select>";
				echo "</br></br>";
				echo "<select style='width:400px' name='event_id' onchange=\"reload3(this.form)\"><option value=''>Select one</option>";
				foreach ($results_db->query($quer) as $noticia) {
					if($noticia['event_id']==@$event_id) {
						echo  "<option selected value='$noticia[event_id]'>$noticia[event_name]</option>";
					} else {
						echo  "<option value='$noticia[event_id]'>$noticia[event_name]</option>";
					}
				}
				echo "</select>";
				echo "</br></br>";
				echo "<select style='width:400px' name='event_name'><option value=''>Select one</option>";
				foreach ($results_db->query($quer3) as $noticia) {
                                        if(isset($_POST['event_name'])){
                                                $event_name = $_POST['event_name'];
						echo  "<option selected value='$event_name'>$event_name</option>";
                                        } else {	
                                                echo  "<option selected value='$noticia[event_name]'>$noticia[event_name]</option>";
                                        }
				}
				echo "</select>";
				echo "</br></br>";
				echo "<input type=submit value=Submit>";
				echo "</form>";
				$selected_val = "";
				if(isset($_POST['event_name'])){
					$selected_val = $_POST['event_name'];  // Storing Selected Value In Variable
					$shortcode = '[wpdatatable id=7 var1="'.$selected_val.'" table_view=regular]';
                                        echo "</br><hr>";
			    		echo do_shortcode($shortcode); 
				}
			?>
		</div><!-- #primary -->

	</div>
</div><!-- .content-wrap -->

<?php get_footer(); ?>

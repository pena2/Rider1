<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php
				// Start the Loop.
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the post format-specific template for the content. If you want to
				 * use this in a child theme, then include a file called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

				?>





<?php
// $tpost= $the_query->post;
// tdump($post);
// $the_query->the_post();
// echo '<li>' . get_the_title() . '</li>';
$tpost_filename= get_post_meta($post->ID, 'filename');
$tpost_videopost_question= get_post_meta($post->ID, 'videopost_question');
$tpost_videopost_question= isset($tpost_videopost_question[0])
	? $tpost_videopost_question[0]
	: [];
;
// tdump($tpost_videopost_question);

?>


<div class="entry-content">


<video controls preload="none" ontrolsList="nodownload">
  <source src="/tuploads/<?php echo $tpost_filename[0] ?>" 
          type='video/webm;codecs="vp8, vorbis"'/>
  <!-- <source src="devstories.mp4"
          type='video/mp4;codecs="avc1.42E01E, mp4a.40.2"'/> -->
</video>



</div>



				<?php


				// Previous/next post navigation.
				twentyfourteen_post_nav();

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				endwhile;
			?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();

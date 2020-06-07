<?php
/**
 * Txexmxpxlxaxxtxex xNaxmxex:x xBxoxotxhx1x
 */

get_header(); ?>

<div id="main-content" class="main-content">

<?php
if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
	// Include the featured content template.
	// get_template_part( 'featured-content' );
}
?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">



<div class="row" style="margin-bottom: 21px;">
	<div class="col-sm-12" style="xxborder: 1px solid red; text-align: right;">
		<a href="/booth-record"><button class="btn btn-primary">Record</button></a>
	</div>
</div>



<div class="row">
	


			<?php

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$args= [
	'post_type' => 'videopost',
	'posts_per_page' => 21,
	'paged' => $paged,
];
$the_query = new WP_Query( $args );
$wp_query= $the_query;

// The Loop
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
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




<div class="col-sm-4" style="xxxborder: 1px solid red;">

<video controls preload="none" ontrolsList="nodownload">
  <source src="/tuploads/<?php echo $tpost_filename[0] ?>" 
          type='video/webm;codecs="vp8, vorbis"'/>
  <!-- <source src="devstories.mp4"
          type='video/mp4;codecs="avc1.42E01E, mp4a.40.2"'/> -->
</video>

<?php
// tdump($post,0);
echo '' . get_the_title() . '';

?>


<div>
<?php
$tnsfw= get_post_meta($post->ID, 'nsfw');
$tnsfw= isset($tnsfw[0]) ? (int)$tnsfw[0] : 0;


$is_anonimous = 1;
$is_anonimous= get_post_meta($post->ID, 'post_as_anonimous');
$is_anonimous= isset($is_anonimous[0]) && (int)$is_anonimous[0] == 1 ? true : false;
$tauthor= $is_anonimous 
    ? (object)['ID'=>0,'data'=>['ID'=>0, 'display_name'=>'Anonimous']]
    // : get_user_by('ID',(int)$post->post_author);
    : get_user_by('ID',1);
// tdump($tauthor);
if ($is_anonimous || !$tauthor): ?>
    <a href="#" class="badge badge-light">Anonimous</a>
<?php else: ?>
    <a href="#" class="badge badge-light"><?php echo $tauthor->data->display_name; ?></a>
<?php endif; ?>


    <a href="#" class="badge badge-light">NSFW <?php echo $tnsfw; ?></a>






</div>







<div>

	<?php // tdump( $post->ID); ?>
	<?php // tdump( wp_get_post_categories($post->ID)); ?>



    <div class="div_booth_videopost_needs">
        <!-- <h4>Themes</h4> -->
        <?php
        // get_category_by_slug
        $tslug= 'themes';
        $tcatparent= get_term_by('slug', $tslug, 'category');
        $titems = get_terms( array(
          'taxonomy' => 'category',
          'hide_empty' => false,
          'parent' => $tcatparent->term_id,
        ) );
        // tdump($titems,1);
        foreach ($titems as $titem) {
            $tweight= in_array($titem->term_id, wp_get_post_categories($post->ID)) ? 'bold' : 'normal';
            $tclass= in_array($titem->term_id, wp_get_post_categories($post->ID)) ? 'primary' : 'secondary';
            if ( in_array($titem->term_id, wp_get_post_categories($post->ID)) ) {

        ?>
            <span class="badge badge-<?php echo $tclass; ?>"><?php echo $titem->name ?></span>
          <!-- <label style="font-weight: <?php echo $tweight; ?>;"><?php echo $titem->name ?></label> &nbsp; &nbsp; -->
        <?php
            }
         } 
        ?>
	</div><!-- div_booth_videopost_needs -->



    <?php if (0): ?>
    <div class="div_booth_videopost_needs">

    <!-- <h4>Type</h4> -->
        <?php
        // get_category_by_slug
        $tslug= 'type';
        $tcatparent= get_term_by('slug', $tslug, 'category');
        $titems = get_terms( array(
          'taxonomy' => 'category',
          'hide_empty' => false,
          'parent' => $tcatparent->term_id,
        ) );
        // tdump($titems,1);
        foreach ($titems as $titem) {
            $tweight= in_array($titem->term_id, wp_get_post_categories($post->ID)) ? 'bold' : 'normal';
            if (in_array($titem->term_id, wp_get_post_categories($post->ID))) {

        ?>
            <span class="badge badge-pill badge-dark"><?php echo $titem->name ?></span>
          <!-- /*<label style="font-weight: <?php echo $tweight; ?>;"><?php echo $titem->name ?></label> &nbsp; &nbsp;*/ -->
        <?php
            }
         } 
        ?>
    </div><!-- div_booth_videopost_needs -->
    <?php endif; ?>




    <div class="div_booth_videopost_needs">
        <!-- <h4>Needs</h4> -->
        <?php
        // get_category_by_slug
        $tslug= 'needs';
        $tcatparent= get_term_by('slug', $tslug, 'category');
        $titems = get_terms( array(
          'taxonomy' => 'category',
          'hide_empty' => false,
          'parent' => $tcatparent->term_id,
        ) );
        // tdump($titems,1);
        foreach ($titems as $titem) {
            $tweight= in_array($titem->term_id, wp_get_post_categories($post->ID)) ? 'bold' : 'normal';
        ?>
          <label style="font-weight: <?php echo $tweight; ?>;"><!-- <input class="input-lg" type="checkbox" name="cat[]" value="<?php echo $titem->term_id ?>">  --><?php echo $titem->name ?></label> &nbsp;
          <br />

          <div style="padding-left: 21px;">
          <?php
          // get_category_by_slug
          $tslug2= 'needs';
          $tcatparent2= get_term_by('id', $titem->term_id, 'category');
          $titems2 = get_terms( array(
            'taxonomy' => 'category',
            'hide_empty' => false,
            'parent' => $titem->term_id,
          ) );
          // tdump($titems,1);
          foreach ($titems2 as $titem2) {
            $tweight= in_array($titem2->term_id, wp_get_post_categories($post->ID)) ? 'bold' : 'normal';
            // $aaa= 
            // $aaa= get_post_meta($post->ID, 'post_as_anonimous');
            // $aaa= isset($aaa[0]) && (int)$aaa[0] == 1 ? true : false;
          ?>
            <label style="font-weight: <?php echo $tweight; ?>;">
                <!-- <input class="input-lg" type="checkbox" name="cat[]" value="<?php echo $titem2->term_id ?>">  -->
                <?php echo $titem2->name ?>
                <span class="badge badge-pill badge-light">3</span>
            </label>
             &nbsp; &nbsp;
          <?php
           } 
          ?>


          </div>
        <?php
         } 
        ?>
    </div>




    <div class="div_booth_videopost_infoitems">
        <h4>InfoItems</h4>
        <?php
        $kktt= new KTHelpers();
        // $titems= $kktt->getVideoPostInfoItems($post->ID);
        $titems= [];
        foreach ($titems as $titem) {
    	  	// $tweight= in_array($titem->term_id, wp_get_post_categories($post->ID)) ? 'bold' : 'normal';
        ?>

        <?php
         } 
        ?>
    </div>




</div>













<?php
// tdump($tpost_videopost_question);
?>

</div>




<?php
	}
	/* Restore original Post Data */
	wp_reset_postdata();
} else {
	// no posts found
}
?>
</div>









<div>
	<?php

$args = array(
	'base'               => '%_%',
	'format'             => '?paged=%#%',
	'total'              => 1,
	'current'            => 0,
	'show_all'           => false,
	'end_size'           => 1,
	'mid_size'           => 2,
	'prev_next'          => true,
	'prev_text'          => __('« Previous'),
	'next_text'          => __('Next »'),
	'type'               => 'plain',
	'add_args'           => false,
	'add_fragment'       => '',
	'before_page_number' => '',
	'after_page_number'  => ''
);
echo $aa= paginate_links( $args );
// tdump($aa);
?>
</div>


<?php
	// pagination
    $uri = get_template_directory_uri();
    $img ='<img src="'.$uri."/images/right_icon.svg".'">';

    $prevLink = get_previous_posts_link( __($img.' Newer posts', 'kt1') );
    // tdump($prevLink,1);
    $nextLink = get_next_posts_link( __('Older posts '.$img, 'kt1') );

    if ($prevLink || $nextLink) {

?>
    <div class="row xxxjustify-content-around between-xs pagination">
        <div class="col-xs-6 next">
            <?php echo $prevLink ?>
        </div>
        <div class="col-xs-6 text-right prev">
            <?php echo $nextLink; ?>
        </div>
    </div>
<?php
    } // end if
?>
























<?php
			// Start the Loop.
			if (0) while ( have_posts() ) :
				the_post();

				// Include the page content template.
				get_template_part( 'content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				endwhile;
			?>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();

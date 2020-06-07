<?php

/**
 * xxxxTemplate Name: Full Width Page
 *
 * @package WordPress
 * @subpackage kt1
 * @since kt1 1.0
 */


$tumblr= new ktlib\TumblrObj();

$blogUser= 'dosisdiariapr0n';
$params= [
	'is_live' => true,
	'page' => (int)$_GET['page'] >= 0 ? (int)$_GET['page'] : 1 ,
];
$result= $tumblr->getBlogPosts($blogUser, $params);

// tdump($result,1,'getBlogPosts');


foreach($result['posts'] as $tpost):
	if ($tpost['type']=='video') {
		$aaa= json_encode($tpost);
		
		// echo(PHP_EOL.PHP_EOL.$aaa);
	}
endforeach;

// die();






get_header(); ?>

<div id="main-content" class="main-content">

<?php
if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
	// Include the featured content template.
	get_template_part( 'featured-content' );
}
?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php
				// Start the Loop.
			while ( have_posts() ) :
				the_post();

// tdump($result);

    echo $toutput= "got ".count($result['posts'])."!    ".( (($page-1)*20)+1 )." to ".( ($page)*20 )." of total {$result['blog']['posts']} \n\n";

?>






<div class="row" style="margin-left: 1px;">

<?php
foreach($result['posts'] as $tpost):
	// tdump($tpost['type']);
	$tstyle_inorout= "";
	?>

	<div class="col-sm-4 tpost" data-xid="<?php echo $tpost['id']; ?>">
		<div class="theader">
			[<?php echo $tpost['type']; ?>] [id:<a href="<?php echo $tpost['post_url'] ?>"><?php echo $tpost['id']; ?></a>]
			[<a href="#">view</a>] [<a class="a_add" href="#">add</a>]
		</div>
		<div class="tcontent">
		</div>


	<?php
	include('tsynch_templates/small_'.$tpost['type'].'.php');
	?>
	</div>


	<?php

?>


<?php endforeach; ?>




</div>

<?php
				// Include the page content template.
				// get_template_part( 'content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				endwhile;
			?>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->





<style type="text/css">
.tpost .theader {
	background-color: #fc0;
}
.tpost {
	border: 1px solid gray;
	height: 420px;
	padding: 0px;
}
</style>





<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.a_add').click(function(){
		var xid= jQuery(this).parent('.tpost').attr('data-xid');
		// jQuery('.div_add_extra_')
		jQuery('.div_add_extra_')
		jQuery.ajax({
			url: '/wp-json/tsynch/add', 'type':'post', 
			// data: tdata,
			success: function(resp){
				console.log('SUCCESS a_add',resp);
			},
			error: function(a,b,c){
				console.log('ERROR a_add',a,b,c);
			},
		});
		return false;
	});
});
</script>




<?php
get_sidebar();
get_footer();

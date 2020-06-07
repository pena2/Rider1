<?php

// tdump($tpost,1);


?>

<!-- h3><?php //echo $post->post_title ?></h3 -->
<!-- <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p> -->
<!-- <p><a class="btn" href="#">View details &raquo;</a></p> -->

<?php 

// $caption= DosisP::xdec($meta_values['caption'][0]);
$caption= $tpost['caption'];

// $pic= DosisP::xdec($meta_values['photos'][0]);
$pic= ($tpost['photos']);
$pic= $pic[0];
// $pic= $pic[0];
// tdump($pic,0);
// $pic= $tresults[0]['photos'];
// $pic= json_decode($pic,true);
// $pic= $pic[0];

// dump($pic[0]['original_size']['url']);
$tpic= ($pic['alt_sizes'][count($pic['alt_sizes'])-3]);
// dump($tpic['url']);
// $desc= DosisP::xdec($meta_values['description'][0]);
$desc= $tpost['description'];
// echo($desc);
 ?>

<style type="text/css">
.caption {
    font-size: 12px;
    line-height: 11px;
}
</style>

<img class="img_xsearch_result_thumb" src="<?php echo $tpic['url']; ?>" />
<div class="caption">
    <?php //echo $caption; ?>
</div>



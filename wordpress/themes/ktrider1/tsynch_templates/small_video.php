
<!-- h3><?php //echo $post->post_title ?></h3 -->
<!-- <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p> -->
<!-- <p><a class="btn" href="#">View details &raquo;</a></p> -->

<?php

// tdump(json_encode($tpost),1);


// dump($meta_values,1);
// $caption= DosisP::xdec($meta_values['caption'][0]);
// $player= DosisP::xdec($meta_values['player'][0]);
// dump($player[0],1);
// $pic= $pic[0];
// // dump($pic[0]['original_size']['url']);
// $tpic= ($pic['alt_sizes'][count($pic['alt_sizes'])-3]);
// dump($tpic);
// $desc= DosisP::xdec($meta_values['description'][0]);
// echo($desc);
 ?>


<div>
<img src="<?php echo $tpost['link_image']; ?>" style="max-width: 210px; max-height: 210px;" />
</div>

<div>
<?php echo $tpost['player'][0]['embed_code']; ?>
</div>

<div>
<img src="<?php echo $tpost['link_image']; ?>" style="max-width: 210px; max-height: 210px;" />
</div>

<div>
<h4><?php echo $tpost['title']; ?></h4>
</div>

<div style="font-weight: bold;">
<a href="<?php echo $tpost['url']; ?>"><?php echo $tpost['url']; ?></a>
</div>

<div>
summary: <?php echo $tpost['summary']; ?>
</div>

<div>
caption: <?php echo $tpost['caption']; ?>
</div>




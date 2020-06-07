<?php

// tdump($tpost,01);


?>

<!-- h3><?php //echo $post->post_title ?></h3 -->
<!-- <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p> -->
<!-- <p><a class="btn" href="#">View details &raquo;</a></p> -->

<?php 
// dump($meta_values);
// $desc= ktlib\KT1::xdec($meta_values['description'][0]);
// $url= ktlib\KT1::xdec($meta_values['url'][0]);
// echo($desc);
 ?>

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



                <h3><?php echo $post->post_title ?></h3>
                <!-- <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p> -->
                <!-- <p><a class="btn" href="#">View details &raquo;</a></p> -->


<?php 
// dump($meta_values,1);
$dialogue= DosisP::xdec($meta_values['dialogue'][0]);
// $url= DosisP::xdec($meta_values['url'][0]);
// dump($dialogue,1);
 ?>

<div>
	<?php
	foreach ($dialogue as $key => $value) {
		?>
		<div class="xpost_chat_item">
		<span class="xpost_chat_name"><?php echo $value['name']; ?>: </span>
		<span class="xpost_chat_phrase"><?php echo $value['phrase']; ?> </span>
		<span class="xpost_chat_label">[<?php echo $value['label']; ?>] </span>
		</div>
		<?php	
	}
	?>
<?php //echo $dialogue; ?>
</div>


<div>
<?php //echo $url; ?>
</div>
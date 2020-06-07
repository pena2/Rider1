<?php


function tdump($a,$d=false,$m=null){
	echo "\n\n<pre>\n\n";
	if ($m) echo "\n{$m}\n";
	var_dump($a);
	echo "\n\n</pre>\n\n";
	if ($d) die();
}



/**
  * Updates post meta for a post. It also automatically deletes or adds the value to field_name if specified
  *
  * @access     protected
  * @param      integer     The post ID for the post we're updating
  * @param      string      The field we're updating/adding/deleting
  * @param      string      [Optional] The value to update/add for field_name. If left blank, data will be deleted.
  * @return     void
  */
function __update_post_meta( $post_id, $field_name, $value = '' ) {
    if ( empty( $value ) OR ! $value ) {
        delete_post_meta( $post_id, $field_name );
    }
    elseif ( ! get_post_meta( $post_id, $field_name ) ) {
        add_post_meta( $post_id, $field_name, $value );
    }
    else {
        update_post_meta( $post_id, $field_name, $value );
    }
}


// $tpost= get_post(112);
// $aa= get_post_meta($tpost->ID,'videopost_question');
// tdump($aa,1);


function ktrider1_enqueue_styles() {

    $parent_style = 'twentyfourteen-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );

    // bootstrap
    wp_register_script( 'bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js', array('jquery'), NULL, true );
    wp_register_style( 'bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css', false, NULL, 'all' );
    wp_enqueue_script( 'bootstrap-js' );
    wp_enqueue_style( 'bootstrap-css' );


}
add_action( 'wp_enqueue_scripts', 'ktrider1_enqueue_styles' );



/** registrar endpoints rest */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'rest/routes.php';
add_action('rest_api_init', 'ktrider1_register_rest_endpoints');





/**
* Custom media upload URL
* @link https://wordpress.stackexchange.com/questions/77960/wordpress-3-5-setting-custom-full-url-path-to-files-in-the-media-library
*/
add_filter( 'pre_option_upload_url_path', 'upload_url' );

function upload_url() {
  // die('uuu');
    return WP_HOME.'/wp-content/uploads';
}




add_filter('wp_nav_menu_items','add_to_second_menu', 10, 2);
function add_to_second_menu( $items, $args ) {
    $loginlink = "/loginlink";
    if( $args->theme_location == 'secondary')  {
        $items .= '<li class="menu-item menu-item-custom">' . $loginlink . '</li>';
    }
    return $items;
}



function language_options2($clang='en') {
  $args = array("echo" => 0, "raw" => 1);
  $langs = pll_the_languages($args);
  foreach ($langs as $l):
    $class_selected= $l['slug'] == $clang ? "active-lang" : "" ;
    ?>
    <li class="<?php echo $class_selected ?>">
    <a href="<?= $l['url'] ?>" class="lang-link w-inline-block">
      <div class="lang-text"><?= $l['name'] ?></div>
    </a>
    </li>
    <?php
  endforeach;
}




class KTHelpers {

  public function findInfoItems($rparams) {
    $rett= null;
error_log("findInfoItems->params:".json_encode($rparams));
    $tparams= [
      'q' => '',
      'cats' => [],
    ];

    return $rett;
  }



  public function getSubCategories($args=[]){
    $rett= null;
    $targs= [
      'slug' => isset($args['slug']) ? $args['slug'] : 'infoitems',
    ];
    $tterm = get_category_by_slug($targs['slug']);

    $terms = get_terms( array(
        // 'taxonomy' => 'videopostquestion_category',
        'taxonomy' => 'category',
        'parent' => $tterm->term_id,
        'hide_empty' => false,
    ) );
    // tdump($terms,1);
    $rett= $terms;
    return $rett;
  }


  public function getInfoItems($args=[]){
    $rett= null;
    $targs= [
      'post_type' => 'infoitem',
      'category' => isset($args['category']) ? $args['category'] : 'information',
      'page' => isset($args['page']) ? $args['page'] : 1,
      'sortby' => isset($args['sortby']) ? $args['sortby'] : 'date',
      'sortorder' => isset($args['sortorder']) ? $args['sortorder'] : 'ASC',
    ];
    $query= new WP_Query($targs);
    $rett= $query->posts;
    return $rett;
  }




}

// $kktt= new KTHelpers();
// $tInfoItems= $kktt->getInfoItems(['category'=>'information','page'=>-1, 'sortorder'=>"DESC"]);
// tdump($tInfoItems,1,'getInfoItems');

// $aa= $kktt->getSubCategories();


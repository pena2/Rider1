<?php


/**
 * Infoitem add/import
 * GET /wp-json/booth2/new/
 */
function kt1_rest_tsynch_add( WP_REST_Request $req ){
    // error_log("kt1_rest_booth2_save:".print_r($req,true));
    $rett= ['status'=>0,'message'=>null,'data'=>null];

//     $tbody_params= $req->get_body_params();
// 	error_log("xxx1:".print_r($tbody_params,true));
// // die('xxx');


//     $user_id = get_current_user_id();
//     $my_post = array(
//       'post_title'    => !empty(trim($tbody_params['title'])) ? trim($tbody_params['title']) : wp_strip_all_tags( "Post ".date('Y-m-d H:i:s') ),
//       'post_content'  => $tbody_params['body'],
//       'post_status'   => 'publish',
//       'post_author'   => $user_id,
//       'post_type'   => 'videopost',
//       'post_category' => $tbody_params['cat'],
//     );
     
//     // Insert the post into the database
//     $newpostid= wp_insert_post( $my_post );

//     parse_str($_POST['themes'],$tbody_params);
//     $rthemes= $rthemes['question_id'];
//     // error_log("_POST:".json_encode($aa));
//     // die('zzz');

//     // $aa= __update_post_meta($newpostid, 'booth_video_file_name', $rfile_name );
//     // $aa= __update_post_meta($newpostid, 'video_url', $rfile_name );

//     $rfile_name= $_POST['file_name'];
//     $aa= __update_post_meta($newpostid, 'filename', $rfile_name );

//     $aa= __update_post_meta($newpostid, 'videopost_question', $rthemes );
//     $aa= __update_post_meta($newpostid, 'record_settings', $rfile_name );

//     $aa= __update_post_meta($newpostid, 'nsfw', "0" );

//     // error_log("__update_post_meta:".json_encode($aa));

    return new WP_REST_Response( $rett );
}


<?php


/**
 * Grabar del Booth
 * GET /wp-json/booth2/new/
 */
function ktrider1_rest_booth2_save( WP_REST_Request $req ){
    // error_log("ktrider1_rest_booth2_save:".print_r($req,true));
    $rett= ['status'=>0,'message'=>null,'data'=>null];

    $tbody_params= $req->get_body_params();
	error_log("xxx1:".print_r($tbody_params,true));

// die( print_r($tbody_params,true) );
// die('xxx');

    $tuser= wp_get_current_user();
    $tuser_id= $tuser->ID ? $tuser->ID : null;

    // $user_id = get_current_user_id();
    // tdump($tuser_id,1,'user_id');
    $my_post = array(
      'post_title'    => !empty(trim($tbody_params['title'])) ? trim($tbody_params['title']) : wp_strip_all_tags( "Post ".date('Y-m-d H:i:s') ),
      'post_content'  => $tbody_params['body'],
      'post_status'   => 'publish',
      'post_author'   => $tuser_id,
      'post_type'   => 'videopost',
      'post_category' => isset($tbody_params['question']) ? (array)$tbody_params['question'] : [],
    );
    // tdump($my_post,1,'my_post');
     
    // Insert the post into the database
    $newpostid= wp_insert_post( $my_post );

    // parse_str($_POST['question'],$tbody_params);
    $videopostquestions= isset($tbody_params['question']) ? (array)$tbody_params['question'] : [];
// tdump($videopostquestions,1);
    // error_log("_POST:".json_encode($aa));
    // die('zzz');

    // $aa= __update_post_meta($newpostid, 'booth_video_file_name', $rfile_name );
    // $aa= __update_post_meta($newpostid, 'video_url', $rfile_name );
    $aa= wp_set_post_tags( $newpostid, $tbody_params['tags'], true );
// tdump($aa,1);


    $rfile_name= $tbody_params['file_name'];
    // $aa= __update_post_meta($newpostid, 'filename', $rfile_name );
    $aa= update_field('filename', $rfile_name, $newpostid);

    $aa= update_field( 'post_as_anonimous', 
        isset($tbody_params['post_as_anonimous']) ? 1 : 0, $newpostid );

    $aa= update_field( 'videopost_question', $videopostquestions, $newpostid );
    $aa= update_field( 'record_settings', $rfile_name, $newpostid );

    $aa= update_field( 'nsfw', (int)$tbody_params['nsfw'], $newpostid );

// tdump($aa,1,'__update_post_meta');
    // error_log("__update_post_meta:".json_encode($aa));

    return new WP_REST_Response( $rett );
}








/**
 * Upload video grabado
 * GET /wp-json/booth2/savevid/
 */
function ktrider1_rest_booth2_savevid( WP_REST_Request $req ){
	error_log("ktrider1_rest_booth2_savevid:".json_encode($req));
    $rett= ['status'=>0,'message'=>null,'data'=>null];

    if (isset($_FILES["video-blob"])) {
        $tnow= time();


        if (true ) {

            // $aaa= explode("__", $tbody_params['file_name']);
            // $bbb= $aaa[1];
            error_log("bbb:".json_encode($_POST));
        
            $user_id = get_current_user_id();
            $fileName= ''.$user_id.'__'.$_POST['video-filename'];

            $uploadDirectory = ABSPATH."tuploads".DIRECTORY_SEPARATOR."tmpsaves" .DIRECTORY_SEPARATOR. $fileName;

            if (!move_uploaded_file($_FILES["video-blob"]["tmp_name"], $uploadDirectory)) {
                error_log("problem moving uploaded file");
                $rett['status']= 0;
                $rett['message']= "Error uploading file.";
            } else {
                // error_log("OK move_uploaded_file. Post:".json_encode($_POST));

                $aaa= explode("__", $_POST['video-filename']);
                $ttimestamp = $aaa[0];

                // COncatenar archivos si es video final
                if (isset($aaa[2]) && $aaa[2]=='F') {
                    sleep(5); // x si acaso requests anteriores estan terminando
                    // recorrer folder
                    $tempFiles= [];
                    if ($handle = opendir( ABSPATH."tuploads" .DIRECTORY_SEPARATOR."tmpsaves".DIRECTORY_SEPARATOR )) {
                        while (false !== ($entry = readdir($handle))) {
                            if ($entry != "." && $entry != "..") {
                                $bbb= explode("__", $entry);
                                if ( !isset($bbb[0]) || !isset($bbb[1]) || !isset($bbb[2]) ) {continue;}
                                if ($user_id== $bbb[0] && $ttimestamp==$bbb[1]) {
                                    error_log( "\n\nENTRY: $entry - ".count($bbb));
                                    $tempFiles[ ''.$bbb[2] ] = $entry;
                                }
                            }
                        }
                        closedir($handle);
                    }
                    ksort($tempFiles, SORT_NUMERIC);
                    $tempFiles= array_values($tempFiles);
                    error_log("!!!!! ".json_encode($tempFiles));
                    // unir archivos
                    $tempFiles2= [];
                    foreach ($tempFiles as $key => $value) {
                        $tempFiles2[]= ABSPATH."tuploads" .DIRECTORY_SEPARATOR."tmpsaves".DIRECTORY_SEPARATOR.$value;
                    }

                    // $thash= $tnow."_".rand(11111111,99999999)."_"."iKjudnnGYhegJKnkkdoM2";
                    // $thash= md5($thash);
                    $thash2= md5('fuckyou'.time().rand(11111111,99999999).'putobaboso');
                    // $fileName= date("YmdHis",$tnow)."_".$thash."_".$thash2.".webm";
                    $fileName= $ttimestamp."___".$user_id."___".$thash2.".webm";
                    // $f1= ABSPATH."tuploads" .DIRECTORY_SEPARATOR.$fileName;

                    $cat = "cat ".( implode(" ", $tempFiles2) )." > ".ABSPATH."tuploads" .DIRECTORY_SEPARATOR.$fileName;
                    $aaaa= exec($cat);
                    error_log("fileName:** ".$fileName);
                    error_log("CAT** ".$cat);
                    // $jj= 1;
                    // if (0) for ($jj=1; $jj < count($tempFiles); $jj++) {
                    //     error_log("for!!");
                    //     $thash= $tnow."_".rand(11111111,99999999)."_"."iKjudnnGYhegJKnkkdoM2";
                    //     $thash= md5($thash);
                    //     $thash2= md5('fuckyou'.time().rand(11111111,99999999).'putobaboso');
                    //     $fileName= date("YmdHis",$tnow)."_".$thash."_".$thash2.".webm";
                    //     $f1= ABSPATH."tuploads" .DIRECTORY_SEPARATOR.$fileName;
                    //     $f2= /*ABSPATH."tuploads" .DIRECTORY_SEPARATOR."tmpsaves".DIRECTORY_SEPARATOR.*/$tempFiles[$jj];
                    //     if ($jj==1) {
                    //         $f1= /*.ABSPATH."tuploads" .DIRECTORY_SEPARATOR."tmpsaves".DIRECTORY_SEPARATOR.*/$tempFiles[$jj-1];
                    //     }
                    //     $aa= ("cat " .$f1." " .$f2 ." > "
                    //         .ABSPATH."tuploads" .DIRECTORY_SEPARATOR.$fileName.""
                    //     );
                    //     error_log("CAT: ".$aa);
                    // }
                }

                $rett['status']= 1;
                $rett['data']= ['file_name'=>$fileName];
            }

            // die("xx:".json_encode($rett));

        } else {

            $thash= $tnow."_".rand(11111,99999)."_"."iKjudnnGYhegJKnkkdoM2";
            $thash= md5($thash);
            $thash2= md5('fuckyou'.time().rand(11111,99999).'putobaboso');
            // $fileName = $_POST["video-filename"];
            $fileName= date("YmdHis",$tnow)."_".$thash."_".$thash2.".webm";

            // require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'booth2.php';

            $uploadDirectory = ABSPATH."tuploads" .DIRECTORY_SEPARATOR. $fileName;

            if (!move_uploaded_file($_FILES["video-blob"]["tmp_name"], $uploadDirectory)) {
                error_log("problem moving uploaded file");
                $rett['status']= 0;
                $rett['message']= "Error uploading file.";
            } else {
                // error_log("OK move_uploaded_file. Post:".json_encode($_POST));
                $rett['status']= 1;
                $rett['data']= ['file_name'=>$fileName];


                // watermark
                $fileName2= date("YmdHis",$tnow)."_".$thash.".webm";
                $uploadDirectory2 = ABSPATH."tuploads" .DIRECTORY_SEPARATOR. "$fileName2";
                $watermark_imgpath= ABSPATH."tuploads/wtrmk.png";
                // exec('ffmpeg -i movie.mp4 -i logo.png -filter_complex "overlay" output.mp4');
                exec('ffmpeg -i {$uploadDirectory} -i {$watermark_imgpath} -filter_complex "overlay" {$uploadDirectory2}');
                // exec('ffmpeg -i "{$uploadDirectory}" -i "{$watermark_imgpath}" -filter_complex "overlay" "{$uploadDirectory2}"');

            }


        } // si guardando solo video part, o legacy el full video


    }

// foreach(array('video', 'audio') as $type) {
//     if (isset($_FILES["{$type}-blob"])) {

//         $fileName = $_POST["{$type}-filename"];
//         $uploadDirectory = "uploads/$fileName";

//         if (!move_uploaded_file($_FILES["{$type}-blob"]["tmp_name"], $uploadDirectory)) {
//             echo("problem moving uploaded file");
//         }

//         echo($uploadDirectory);
//     }
// }

    return new WP_REST_Response( $rett );
}









/**
 * Search InfoItems
 * GET /wp-json/booth2/search_infoitems/
 */
function ktrider1_rest_booth2_search_infoitems( WP_REST_Request $req ){
    error_log("ktrider1_rest_booth2_search_infoitems:".json_encode($req));
    $rett= ['status'=>0,'message'=>null,'data'=>null];

    error_log("ktrider1_rest_booth2_search_infoitems 2:".json_encode($req->get_params()));
    $rparams= $req->get_params();
    $tcats= [];
    foreach ($rparams['cats'] as $kk=>$vv) { $tcats[]= $vv['value']; }
    $aaa= new WP_Query([
        'cat' => $tcats,
        'post_type' => 'infoitem',
    ]);
    error_log("ktrider1_rest_booth2_search_infoitems 23:".print_r($aaa->posts,true));


    $rett['data']= $aaa->posts;
    $rett['status']= 1;
    return new WP_REST_Response( $rett );
}




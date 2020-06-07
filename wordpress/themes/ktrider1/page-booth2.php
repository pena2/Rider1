<?php
/* Template Name: Booth2 */








// $themes= [];

// $tterm = get_category_by_slug('videopostquestion_category');
// tdump($tterm,1);

// $terms = get_terms( array(
//     // 'taxonomy' => 'videopostquestion_category',
//     'taxonomy' => 'category',
//     'parent' => $tterm->term_id,
//     'hide_empty' => false,
// ) );
// tdump($terms,1);

if (0) foreach ($terms as $tterm) {

    $args = array(
        'post_type' => 'videopost_question',
        'tax_query' => array(
            array(
                // 'taxonomy' => 'videopostquestion_category',
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $tterm->slug,
            ),
        ),
    );
    $the_query = new WP_Query( $args );
    // tdump($the_query->posts,0);

    $tquestions= [];
    foreach ($the_query->posts as $tquestion) {
        $tquestions[]= [
            'id'=>$tquestion->ID, 'title'=>$tquestion->post_title, 'created_at'=>$tquestion->post_date,
            'body'=>$tquestion->post_content, 'slug'=>$tquestion->post_name, 'url'=>$tquestion->guid, 
        ];
    }

    // tdump($tquestions,0,'tt');


// tdump($query,1);

    $themes[]= [
        'id'=>$tterm->term_id,'slug'=>$tterm->slug,'name'=>$tterm->name,
        'description'=>$tterm->description,
        'questions'=>$tquestions,
    ];
}

// tdump($themes,1);




// $themes[]= ['id'=>1,'slug'=>'interview_questions','title'=>'Interview','items'=>[

// ]];
// $themes[]= ['id'=>2,'slug'=>'dares','title'=>'Dare','items'=>[

// ]];
// $themes[]= ['id'=>3,'slug'=>'post_to_reddit','title'=>'Post to Reddit','items'=>[

// ]];
// $themes[]= ['id'=>3,'slug'=>'kareoke','title'=>'Kareoke','items'=>[

// ]];
/*
pregs controversiales, pegar mujer de vuelta?
pantsing
flashear
    con quote escrito
quotes impresos

*/


$tuser= wp_get_current_user();
// if (null==$tuser || !isset($tuser->ID) || $tuser->ID == 0) {
//     // login de user 3 anonimo
//     $tuser= wp_set_current_user( 3 );
// }
// $tuser_id= ($tuser->ID);

$tuser_id = $tuser ? $tuser->ID : 0;
// tdump($tuser_id,1);

$xapp= [
    'config' => [
        'user' => [
            'id' => $tuser_id,
            'email' => $tuser ? $tuser->data->user_email : '',
        ],
    ],
];




$twpnonce = wp_create_nonce( 'wp_rest' );










?><!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./favicon.ico">

    <title>Grabar | Ridetest</title>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/lib/jquery-3.3.1.min.js"></script>

    <script type="text/javascript">
      // $(document).ready(function(){
        var twpnonce= '<?php echo $twpnonce; ?>';
      // });
    </script>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="sticky-footer-navbar.css" rel="stylesheet"> -->
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/styles1.css" rel="stylesheet">

    <script type="text/javascript">var xapp= {};xapp.config=<?php echo json_encode($xapp['config']); ?>;</script>

  </head>

  <body style="background-color: black;">

    <header>


      <?php if (false): ?>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Fixed navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
      <?php endif; ?>

    </header>



















    <!-- Begin page content -->
    <main role="main" class="container">


      <!-- <h1 class="mt-5">Sticky footer with fixed navbar</h1> -->
      <!-- <p class="lead">Pin a fixed-height footer to the bottom of the viewport in desktop browsers with this custom HTML and CSS. A fixed navbar has been added with <code>padding-top: 60px;</code> on the <code>body &gt; .container</code>.</p> -->
      <!-- <p>Back to <a href="../sticky-footer">the default sticky footer</a> minus the navbar.</p> -->

<div class="container-fuild">



<div class="row">
  <div class="col-12" style="text-align: center; margin: 14px;">
    <a href="/">
    <!-- <img src="/wp-content/themes/kt1/assets/img/LOGOKT1.png" width="21%"> -->
    </a>
  </div>
</div>





<div class="div_step0 div_step card">
  <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
  <div class="card-body">
    <!-- <h1 class="mt-5">Step 0: Settings</h1> -->


<?php //if ($tuser_id != 3): ?>
<?php if ($tuser_id != 0): ?>

  <div class="select">
    <label for="audioSource">Audio source: </label><select id="audioSource"></select>
  </div>

  <div class="select">
    <label for="videoSource">Video source: </label><select id="videoSource"></select>
  </div>

<?php else: ?><!-- if tuser_id -->

<?php endif; ?><!-- if tuser_id -->

  <!-- <div> -->
    <!-- <button>START NEW SESSION</button> -->
    <!-- session_id: <span class="span_session_id"></span> -->
  <!-- </div> -->





    <div>
      <?php //if ($tuser_id != 3): ?>
      <?php if ($tuser_id != 0): ?>
        Usuario: <strong><?php echo $tuser->data->user_nicename; ?></strong>
        <?php //echo $xapp['config']['user']['id']; ?>
        
        <!-- Email: <?php tdump($xapp['config']['user']); echo $xapp['config']['user']['email']; ?> -->
        <a href="<?php echo wp_logout_url( "/" ); ?>">
          <button>Logout</button>
        </a>

      <?php else: ?>
      <!-- <form class="form_login"> -->
        <a href="<?php echo wp_login_url( $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ); ?>"><h3>Login</h3></a>
        <!-- Email: <input type="text" name="email"> -->
        <!-- Password: <input type="password" name="password"> -->
        <!-- <button type="submit">Submit</button> -->
      <!-- </form> -->
      <!-- <form class="form_register"> -->
        <a style="display: none;"> href="<?php echo wp_registration_url( $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ); ?>"><h3>Register</h3></a>
        <!-- Email: <input type="text" name="email"> -->
        <!-- <button type="submit">Submit</button> -->
      <!-- </form> -->
      <?php endif; ?>

    </div>


    <!-- Nickname: <input type="text" name=""> -->








  </div>
</div>





<div class="row" style="margin-bottom: 21px;">
  <div class="col-sm-12" style="xxborder: 1px solid red; xxtext-align: right;">
    <a href="/mis-videos"><button class="btn btn-primary">&lt; Regresar a Mis Videos</button></a>
  </div>
</div>



















<?php if ($tuser_id != 0): ?>




<div class="div_step2 div_step card" style="xxborder: 1px solid red; xxxbackground-color: #eee;">
  <div class="card-body">
    <!-- <h1 class="mt-5">Step 2: Record</h1> -->

    <div class="row">


        <!-- video -->
        <div class="col-sm-12">

            <div class="div_screen" id="div_screen">


  <!-- <video muted autoplay></video> -->
<video width="320" height="240" id="record" autoplay muted></video>
<video width="320" height="240" id="recorded" xxxloop controls></video>
<!-- <canvas id="c" width="320" height="240"></canvas> -->

<!-- <video class="post video-post" id="video-element" poster="//i.imgur.com/paPSl5Vh.jpg" preload="auto" muted="muted" webkit-playsinline="" controls="" style="width: 550px; height: 309.133px; outline: red dashed 1px;" title=""><source type="video/mp4" src="//i.imgur.com/paPSl5V.mp4"></video> -->


            </div>

            <!-- <div class="div_audio_visualizer">[audio visualizer]</div> -->

            <div class="">
                <div class="">
                    <button id="btn_video_record_start" class="btn_video_record_start" xxxdisabled>RECORD START</button>
                    <button id="btn_video_record_stop" class="btn_video_record_stop" xxxdisabled>RECORD STOP</button>
                    <button id="btn_video_record_stop" class="btn_take_picture" xxxdisabled>PICTURE</button>
                    <!-- <button id="btn_video_record_pause" class="btn_video_record_pause" xxxdisabled>PAUSE</button> -->
                    <!-- <button>RECORD</button> -->

                </div>
    <!-- <div>
      <button id="record" disabled>Start Recording</button>
      <button id="play" disabled>Play</button>
      <button id="download" disabled>Download</button>
    </div> -->

            </div>

<form action="" method="post" class="form_step3_save_post" xxxstyle="border: 1px solid blue;">


            <div class="">

                <!-- <select name="video_effect">
                  <option>Video fx: none</option>
                  <option>Green screen</option>
                </select> -->

                <!-- <select name="voice_effect">
                  <option>Voice fx: none</option>
                  <option>Distort</option>
                </select> -->

                <div class="div_step3_video_filename" style="display: none;"><small>Video up: <span>no</span></small></div>
                <div class="" style="font-weight: bold; font-size: 1.4em;">GRABANDO: <span id="indicador_recording">NO</span></div>
                <div><span id="indicador_recording2">???</span></div>
                <input type="hidden" class="input_video_up" name="video_up" value="0">


            </div>



    <?php if (01): ?>
    <div style="xxxdisplay: none;">
    <!-- <h4>Categories**</h4> -->
    <?php
    // get_category_by_slug
    // $tslug= 'type';
    // $tslug= 'videopostquestion_category';
    // $tcatparent= get_term_by('slug', $tslug, 'taxonomy');
    // tdump($tcatparent,1);
    $tcats1 = get_terms( array(
      'taxonomy' => 'videopostquestion_category',
      'hide_empty' => false,
      // 'parent' => $tcatparent->term_id,
    ) );
    // tdump($tcats1,1);
    if (0) foreach ($tcats1 as $tcat1) {
    ?>
      <br><label style="font-weight: bold;"><?php echo $tcat1->name ?></label>: &nbsp; &nbsp;
    <?php

      $args = array(
          'post_type' => 'videopost_question',
          'tax_query' => array(
              array(
                  'taxonomy' => 'videopostquestion_category',
                  // 'taxonomy' => 'category',
                  'field'    => 'slug',
                  'terms'    => $tcat1->slug,
              ),
          ),
      );
      $the_query = new WP_Query( $args );
      // tdump($the_query->posts,0);
      foreach ($the_query->posts as $titem) {
        ?>
          <label><input class="input-lg" type="checkbox" name="question[]" value="<?php echo $titem->ID ?>"> <?php echo $titem->post_title ?></label> &nbsp; &nbsp;
        <?php

      }






    } 




    ?>
    </div>
    <?php endif; ?>




            <div style="margin-top: 35px;">

              <div style="display: none;">
                <select name="nsfw">
                  <option value="0">NSFW 0</option>
                  <option value="1">NSFW 1</option>
                  <option value="2">NSFW 2</option>
                </select>
              </div>
              <br />



              <!-- <label><input type="checkbox" name="post_as_anonimous" class="xxform-check-input input_post_as_anonimous"> Show as Anonimous</label> -->
              <!-- <br /> -->

              Titulo: <input required="required" type="text" name="title" class="form-control" value="<?php echo "Ride ".date("d/M/Y H:i"); ?>" />
              <br />

              Tags: <input type="text" name="tags" class="form-control" value="" />
              <br />

              <input type="hidden" name="file_name" class="input_file_name" value="" />
              <!-- <input type="text" name="themes" class="input_themes" value="" /> -->

              Descripcion:
              <textarea name="body" class="form-control" rows="7"></textarea>
              <br />

              <label><input required="required" type="checkbox" name="accept_terms" class="xxform-check-input input_accept_terms"> Acepto los <a class="a_terms" href="#">terminos y condiciones</a>.</label>
              <br />
              <div style="font-size: 0.7em; display: none;" class="div_terms">
                <h4>Terms</h4>
                <p>
                  <ul>
                    <li>
                    All uploaded content is Creative Commons.
                    </li>
                    <li>
                    Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum.
                    </li>
                    <li>
                    Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum.
                    </li>
                    <li>
                    Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum.
                    </li>
                    <li>
                    Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum.
                    </li>
                  </ul>
                </p>
              </div>

            </div>


            <button type="submit" class="btn btn-primary btn-lg btn-block">GUARDAR</button>


          </form>




        </div>





    </div>


  </div>
</div>










  <!-- <a href="#" class="a_booth2">booth2</a> -->

<script type="text/javascript">
$(document).ready(function(){

$('.form_step3_save_post').submit(function(){


    // $('.')

    // var tthemes= $('#accordion_themes input').serialize();
    // $(this).find('.input_themes').val( tthemes );
    var tdata= $(this).serializeArray();
    // console.log('tdata',tdata);
    // console.log('tdata2', $('#accordion input') );
    $.ajax({
        url:'/wp-json/booth2/save?_wpnonce=<?php echo $twpnonce ?>', method:'POST', data: tdata,
        success: function(resp){
            console.log('SUCCESS',resp);
            alert("VIDEO GUARDADO!");
            window.location.href= "/mis-videos";
        },
        error: function(a,b,c){
            console.log('ERROR',a,b,c);
            alert("ERROR: "+a+"---"+b+"---"+c)
        }
    });
    return false;
});
  
});
</script>





<?php else: ?><!-- if tuser_id -->

<?php endif; ?><!-- if tuser_id -->

















</div><!-- container-fuild -->







    </main>

    <footer class="footer">
      <div class="container">
        <span class="text-muted">
          <!-- sticky footer -->
        </span>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/lib/jquery-3.3.1.min.js"></script> -->
    <!-- <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script> -->
    <!-- <script src="../../../../assets/js/vendor/popper.min.js"></script> -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/bootstrap/js/bootstrap.min.js"></script>

    <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>

    <!-- https://github.com/webrtc/samples/blob/gh-pages/src/content/getusermedia/record/index.html -->
    <!-- include adapter for srcObject shim -->
    <!-- <script src="/booth1/assets/js/mediarecorder.js"></script> -->

    <!-- <script src="https://www.WebRTC-Experiment.com/RecordRTC.js"></script> -->
    <!-- <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/app5.js?x=2"></script> -->

    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/app4.js?x=2"></script>

    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/app2.js"></script>
  </body>
</html>



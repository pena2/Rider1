<?php
/* Texmxpxlxaxtxe Nxaxmxex:x xBxoxoxtxh2 */








$themes= [];

$tterm = get_category_by_slug('questions-categories');
// tdump($tterm,1);

$terms = get_terms( array(
    // 'taxonomy' => 'videopostquestion_category',
    'taxonomy' => 'category',
    'parent' => $tterm->term_id,
    'hide_empty' => false,
) );
// tdump($terms,1);

foreach ($terms as $tterm) {

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
if (null==$tuser || !isset($tuser->ID) || $tuser->ID == 0) {
    // login de user 3 anonimo
    $tuser= wp_set_current_user( 3 );
}
$tuser_id= ($tuser->ID);
// tdump($tuser_id,1);

$xapp= [
    'config' => [
        'user' => [
            'id' => $tuser_id,
            'email' => $tuser->data->user_email,
        ],
    ],
];
















?><!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./favicon.ico">

    <title>Booth2</title>

    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/lib/jquery-3.3.1.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="sticky-footer-navbar.css" rel="stylesheet"> -->
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/styles1.css" rel="stylesheet">

    <script type="text/javascript">var xapp= {};xapp.config=<?php echo json_encode($xapp['config']); ?>;</script>

  </head>

  <body>

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






<div class="div_step0 div_step card">
  <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
  <div class="card-body">
    <!-- <h1 class="mt-5">Step 0: Settings</h1> -->




  <div class="select">
    <label for="audioSource">Audio source: </label><select id="audioSource"></select>
  </div>

  <div class="select">
    <label for="videoSource">Video source: </label><select id="videoSource"></select>
  </div>

  <!-- <div> -->
    <!-- <button>START NEW SESSION</button> -->
    <!-- session_id: <span class="span_session_id"></span> -->
  <!-- </div> -->





    <div>
      <?php if ($tuser_id != 3): ?>
        Email: <?php echo $xapp['config']['user']['email']; ?>
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
        <a href="<?php echo wp_registration_url( $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ); ?>"><h3>Register</h3></a>
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
    <a href="/booth"><button class="btn btn-primary">&lt; Back</button></a>
  </div>
</div>



















<form action="" method="post" class="form_step3_save_post" xxxstyle="border: 1px solid blue;">



<div class="div_step2 div_step card" style="xxborder: 1px solid red; xxxbackground-color: #eee;">
  <div class="card-body">
    <!-- <h1 class="mt-5">Step 2: Record</h1> -->

    <div class="row">


        <!-- video -->
        <div class="col-sm-6">

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
                    <!-- <button id="btn_video_record_pause" class="btn_video_record_pause" xxxdisabled>PAUSE</button> -->
                    <!-- <button>RECORD</button> -->

                </div>
    <!-- <div>
      <button id="record" disabled>Start Recording</button>
      <button id="play" disabled>Play</button>
      <button id="download" disabled>Download</button>
    </div> -->

            </div>


            <div class="">

                <!-- <select name="video_effect">
                  <option>Video fx: none</option>
                  <option>Green screen</option>
                </select> -->

                <!-- <select name="voice_effect">
                  <option>Voice fx: none</option>
                  <option>Distort</option>
                </select> -->

                <div class="div_step3_video_filename"><small>Video up: <span>no</span></small></div>


            </div>



    <?php if (0): ?>
    <div style="display: none;">
    <h4>Type</h4>
    <?php
    // get_category_by_slug
    $tslug= 'type';
    $tcatparent= get_term_by('slug', $tslug, 'category');
    $titems = get_terms( array(
      // 'taxonomy' => 'category',
      // 'hide_empty' => false,
      // 'parent' => $tcatparent->term_id,
    ) );
    // tdump($titems,1);
    if (0) foreach ($titems as $titem) {
    ?>
      <label><input class="input-lg" type="checkbox" name="cat[]" value="<?php echo $titem->term_id ?>"> <?php echo $titem->name ?></label> &nbsp; &nbsp;
    <?php
     } 
    ?>
    </div>
    <?php endif; ?>




            <div style="margin-top: 35px;">

              <div>
                <select name="nsfw">
                  <option value="0">NSFW 0</option>
                  <option value="1">NSFW 1</option>
                  <option value="2">NSFW 2</option>
                </select>
              </div>
              <br />



              <label><input type="checkbox" name="is_anonimous" class="xxform-check-input input_is_anonimous"> Post as Anonimous</label>
              <br />

              Title: <input type="text" name="title" class="form-control" value="" />
              <br />

              Tags: <input type="text" name="tags" class="form-control" value="" />
              <br />

              <input type="hidden" name="file_name" class="input_file_name" value="" />
              <!-- <input type="text" name="themes" class="input_themes" value="" /> -->

              Comments:
              <textarea name="body" class="form-control" rows="7"></textarea>
              <br />

              <label><input type="checkbox" name="accept_terms" class="xxform-check-input input_accept_terms"> I accept the <a class="a_terms" href="#">terms</a>.</label>
              <br />
              <div style="font-size: 0.7em; display: none;" class="div_terms">
                <h4>Terms</h4>
                <p>
                  <ul>
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
                    <li>
                    Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum.
                    </li>
                  </ul>
                </p>
              </div>

            </div>


            <button type="submit" class="btn btn-primary btn-lg btn-block">Save!</button>






        </div>







        <!-- categories, etc -->
        <div class="col-sm-6">

<div>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="tabs1_tab1" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Videopost</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="tabs1_tab2" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Questions</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="tabs1_tab3" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Infoitems</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent" style="padding-top: 21px;">


  <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tabs1_tab1">



    <h4>Themes</h4>
    <div class="div_boothrecord_themes row">
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
    ?>
      <div class="col-sm-6" style="text-align: right;">
      <label>
        <input class="input-lg" type="checkbox" name="cat[]" value="<?php echo $titem->term_id ?>">
        <?php echo $titem->name ?>
      </label>
      <select name="assesment[needs][<?php echo $titem2->term_id ?>]">
          <option value="---">---</option>
        <?php for ($jj=0; $jj<=10; $jj++): ?>
          <option value="<?php echo $jj ?>"><?php echo $jj ?></option>
        <?php endfor; ?>
      </select>
      <select name="willpower[needs][<?php echo $titem2->term_id ?>]">
          <option value="---">---</option>
        <?php for ($jj=0; $jj<=10; $jj++): ?>
          <option value="<?php echo $jj ?>"><?php echo $jj ?></option>
        <?php endfor; ?>
      </select>
      </div><!-- col-sm-6 -->

    <?php
     } 
    ?>
    </div>





    <div>
    <h4>Needs</h4>
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
    ?>
      <label>
        <input class="input-lg" type="checkbox" name="cat[]" value="<?php echo $titem->term_id ?>">
        <strong><?php echo $titem->name ?></strong>
      </label>

      <select name="assesment[needs][<?php echo $titem2->term_id ?>]">
          <option value="---">---</option>
        <?php for ($jj=0; $jj<=10; $jj++): ?>
          <option value="<?php echo $jj ?>"><?php echo $jj ?></option>
        <?php endfor; ?>
      </select>
      <select name="willpower[needs][<?php echo $titem2->term_id ?>]">
          <option value="---">---</option>
        <?php for ($jj=0; $jj<=10; $jj++): ?>
          <option value="<?php echo $jj ?>"><?php echo $jj ?></option>
        <?php endfor; ?>
      </select>

      <br />

      <div style="padding-left: 21px;" class="row">
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
      ?>
        <div class="col-sm-6" style="text-align: right;">
        <label>
          <?php echo $titem2->name ?>
          <input class="input-lg" type="checkbox" name="cat[]" value="<?php echo $titem2->term_id ?>">
        </label>

            <select name="assesment[needs][<?php echo $titem2->term_id ?>]">
                <option value="---">---</option>
              <?php for ($jj=0; $jj<=10; $jj++): ?>
                <option value="<?php echo $jj ?>"><?php echo $jj ?></option>
              <?php endfor; ?>
            </select>
            <select name="willpower[needs][<?php echo $titem2->term_id ?>]">
                <option value="---">---</option>
              <?php for ($jj=0; $jj<=10; $jj++): ?>
                <option value="<?php echo $jj ?>"><?php echo $jj ?></option>
              <?php endfor; ?>
            </select>
        </div><!-- col-sm-6 -->

      <?php
       } 
      ?>


      </div>
    <?php
     } 
    ?>
    </div>





  </div><!-- /tab1 -->







  <!-- tab2 -->
  <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tabs1_tab2">


<div id="accordion_themes" class="div_themes_accordion">

  <?php
  $jj= 0;
  foreach($themes as $ttheme):
    $jj++;
  ?>
  <div class="card">
    <div class="card-header" id="heading<?php echo $ttheme['id']; ?>">
      <h5 class="mb-0">
        <button class="btn btn-link <?php echo $jj==1?'':'collapsed' ?>" data-toggle="collapse" data-target="#collapse<?php echo $ttheme['id']; ?>" aria-expanded="true" aria-controls="collapse<?php echo $ttheme['id']; ?>">
          <?php echo $ttheme['name']; ?>
        </button>
      </h5>
    </div>

    <div id="collapse<?php echo $ttheme['id']; ?>" class="collapse <?php echo $jj==1?'show':'' ?>" aria-labelledby="heading<?php echo $ttheme['id']; ?>" data-parent="#accordion">
      <div class="card-body">
        <div><?php echo $ttheme['description']; ?></div>
        <?php //tdump($ttheme['questions'],0,'questions'); ?>

        <?php
        foreach ($ttheme['questions'] as $tq) {
          // tdump($tq,1);
          ?>
          <div>
            <input type="checkbox" name="question_id[]" value="<?=$tq['id']?>" id="question_<?=$tq['id']?>">
            <label for="question_<?=$tq['id']?>"><?=$tq['title']?></label>
          </div>
          <?php
        }
        ?>

        <!-- Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. -->
      </div>
    </div>
  </div>
  <?php endforeach; ?>


</div>


  </div><!-- /tab2 -->





  <!-- tab3 -->
  <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tabs1_tab3">

    <!-- random -->
    <div style="xxxborder: 1px solid blue; margin-bottom: 21px;">
    </div>

    <div style="xxxborder: 1px solid blue; margin-bottom: 21px;">

      <div style="border: 1px solid green; margin-bottom: 21px;">
          
        <?php
        $kktt= new KTHelpers();
        $tcats= $kktt->getSubCategories('infoitems');
        foreach ($tcats as $tcat) {
          $tInfoItems= $kktt->getInfoItems($args=['category'=>'information','page'=>-1,'sortorder'=>'DESC']);

          ?>
          <label><input class="input-lg input_infoitem_search_cat" type="checkbox" name="infoitem_search_cat[]" value="<?php echo $tcat->term_id ?>"> <?php echo $tcat->name ?> (<?php echo $tcat->term_id ?>)</label> &nbsp; &nbsp;
          <!-- <button class="btn btn-secondary btn-sm"><a href="#<?php echo $tcat->slug ?>"><?php echo $tcat->name; ?></a></button> &nbsp; &nbsp;  -->
          <?php
        }
        // tdump($tcats);
        ?>
        <button class="btn_infoitem_search_submit" type="button">Search</button>
      </div>

      <div style="xxxborder: 1px solid red;" class="div_infoitems">

        <!-- listado -->
        <div style="xxxborder: 1px solid green;" class="div_infoitems_listado row">

          <div class="col-sm-4 div_titem_sample" data-xid="<?php echo $value->ID; ?>">
            <div><img src="https://img.youtube.com/vi/<?php echo "666"; ?>/0.jpg"></div>
            <label><input type="checkbox" name="infoitems[<?php echo $value->ID; ?>]"> <!-- <a href="#<?php echo $value->post_name ?>" --><?php echo $value->post_title; ?><!-- </a> --></label>
            <div><a target="_blank" href="<?php echo $texturl; ?>" class="a_infoitem_view"><button type="button" class="btn">View</button></a></div>
          </div>


          <?php foreach ($tInfoItems as $key => $value) {
            $texturl= get_post_meta($value->ID, 'exturl');
            // $texturl= get_option($value->ID,'exturl');
            // tdump($texturl);
            $texturl= isset($texturl[0]) ? $texturl[0] : "";
            // tdump($value);
            ?>
            <div class="col-sm-4" data-xid="<?php echo $value->ID; ?>">
              <div><img src="https://img.youtube.com/vi/<?php echo "666"; ?>/0.jpg"></div>
              <label><input type="checkbox" name="infoitems[<?php echo $value->ID; ?>]"> <!-- <a href="#<?php echo $value->post_name ?>" --><?php echo $value->post_title; ?><!-- </a> --></label>
              <div><a target="_blank" href="<?php echo $texturl; ?>" class="a_infoitem_view"><button type="button" class="btn">View</button></a></div>
            </div>
            <?php
          } ?>
        </div>


        <!-- pagination -->
        <div style="xxxborder: 1px solid yellow;" class="div_infoitems_pagination">

        </div>


      </div>
    </div>
  </div>













</div><!-- /tab-content -->

</div>










        </div><!-- /col-sm-6 -->


    </div>


  </div>
</div>







</form>



  <a href="#" class="a_booth2">booth2</a>

<script type="text/javascript">
$(document).ready(function(){

$('.form_step3_save_post').submit(function(){
    // var tthemes= $('#accordion_themes input').serialize();
    // $(this).find('.input_themes').val( tthemes );
    var tdata= $(this).serializeArray();
    // console.log('tdata',tdata);
    // console.log('tdata2', $('#accordion input') );
    $.ajax({
        url:'/wp-json/booth2/save', method:'POST', data: tdata,
        success: function(resp){
            console.log('SUCCESS',resp);
        },
        error: function(a,b,c){
            console.log('ERROR',a,b,c);
        }
    });
    return false;
});
  
});
</script>






















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


    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/app.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/app2.js"></script>
  </body>
</html>



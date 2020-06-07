


var xapp= {
  // 'videorecording':{}
};


xapp.file_name= null;

xapp.step1= {};
xapp.step2= {};
xapp.step3= {};
xapp.start= function(){
    if (this.session_id == null){
        return;
    }

}

// xapp.step2.do_enable= function(){
//     // enable step2 functionality
// }
// xapp.step3.do_enable= function(){
//     // enable step3 functionality
// }
// xapp.do_save_session_cookie= function(rsession_id){
// }


// xapp.session_id= null;

// xapp.do_start_new_session= function() {
//     if (xapp.session_id == null) {
//         console.log('do_start_new_session: no session_id');
//         return;
//     }
//     step2.do_enable();
//     step3.do_enable();
// }

// var videopost= {
//     'user_id':0,
//     'video_url':''
// };

// var videorecording= { 'is_recording' : false };
// videorecording.start= function(){
//     console.log('videorecording.start()');
// }





// $('.btn_start_new_session').click(function(){
//     // create new cookie
//     $.ajax({
//         url:'/booth1/api/newsession',data:tdata,
//         success:function(resp){
//             console.log('SUCCESS btn_start_new_session',resp);
//             if (resp.status==1) {
//                 xapp.session_id= resp.data.session_id;
//                 // *** TODO: save in cookie
//                 xapp.do_save_session_cookie(xapp.session_id);
//                 xapp.do_start_new_session();
//             } else {
//             }
//         },
//         error: function(a,b,c){
//             console.log('ERROR btn_start_new_session',a,b,c);
//         }
//     });
//     return false;
// });

























var btn_video_record_start= $('#btn_video_record_start');
var indicador_recording= $('#indicador_recording');
var btn_video_record_stop= $('#btn_video_record_stop');

// console.

btn_video_record_start.click(function(){
    // toggleRecording();
    startRecording();
});
btn_video_record_stop.click(function(){
    stopRecording();
});







const audioSelect = document.querySelector('select#audioSource');
const videoSelect = document.querySelector('select#videoSource');

const liveVideoElement = document.querySelector('video#record');
const recordedVideoElement = document.querySelector('video#recorded');

var tvideo= document.getElementById('record');

var width, height, context;
width = record.width;
console.log('record',record);
height = record.height;

// var canvas = document.getElementById("c");
// context = canvas.getContext("2d");

chunks = [];

// -- <select> de audio y video
audioSelect.onchange = getStream;
videoSelect.onchange = getStream;
function gotDevices(deviceInfos) {
  for (var i = 0; i !== deviceInfos.length; ++i) {
    var deviceInfo = deviceInfos[i];
    var option = document.createElement('option');
    option.value = deviceInfo.deviceId;
    if (deviceInfo.kind === 'audioinput') {
      option.text = deviceInfo.label ||
        'microphone ' + (audioSelect.length + 1);
      audioSelect.appendChild(option);
    } else if (deviceInfo.kind === 'videoinput') {
      option.text = deviceInfo.label || 'camera ' +
        (videoSelect.length + 1);
      videoSelect.appendChild(option);
    } else {
      console.log('Found one other kind of source/device: ', deviceInfo);
    }
  }
}

function getStream() {
  if (window.stream) {
    window.stream.getTracks().forEach(function(track) {
      track.stop();
    });
  }

  var constraints = {
    audio: {
      deviceId: {exact: audioSelect.value}
    },
    video: {
      deviceId: {exact: videoSelect.value}
    }
  };

  navigator.mediaDevices.getUserMedia(constraints).
    then(gotStream).catch(handleError);
}

function gotStream(stream) {
  console.log('gotStream!!',stream);
  window.stream = stream; // make stream available to console
  liveVideoElement.srcObject = stream;

  // requestAnimationFrame(draw);
}

// https://timtaubert.de/blog/2012/10/building-a-live-green-screen-with-getusermedia-and-mediastreams/
function draw() {
  var frame = readFrame();
// console.log('draw 1',frame);

  if (frame) {
    console.log('draw 2');
    replaceGreen(frame.data);
    context.putImageData(frame, 0, 0);
  }

  // Wait for the next frame.
  requestAnimationFrame(draw);
}
function readFrame() {
  try {
    console.log('readFrame',width,height);
    context.drawImage(record, 0, 0, width, height);
  } catch (e) {
    // console.log('readFrame Exception',e);
    // The video may not be ready, yet.
    return null;
  }

  return context.getImageData(0, 0, width, height);
}
function replaceGreen(data) {
  var len = data.length;

  for (var i = 0, j = 0; j < len; i++, j += 4) {
    // Convert from RGB to HSL...
    var hsl = rgb2hsl(data[j], data[j + 1], data[j + 2]);
    var h = hsl[0], s = hsl[1], l = hsl[2];

    // ... and check if we have a somewhat green pixel.
    if (h >= 90 && h <= 160 && s >= 25 && s <= 90 && l >= 20 && l <= 75) {
      data[j + 3] = 0;
      console.log('green!');
    }
  }
}
function rgb2hsl(r, g, b) {
  r /= 255; g /= 255; b /= 255;

  var min = Math.min(r, g, b);
  var max = Math.max(r, g, b);
  var delta = max - min;
  var h, s, l;

  if (max == min) {
    h = 0;
  } else if (r == max) {
    h = (g - b) / delta;
  } else if (g == max) {
    h = 2 + (b - r) / delta;
  } else if (b == max) {
    h = 4 + (r - g) / delta;
  }

  h = Math.min(h * 60, 360);

  if (h < 0) {
    h += 360;
  }

  l = (min + max) / 2;

  if (max == min) {
    s = 0;
  } else if (l <= 0.5) {
    s = delta / (max + min);
  } else {
    s = delta / (2 - max - min);
  }

  return [h, s * 100, l * 100];
}



function handleError(error) {
  console.error('Error: ', error);
}


navigator.mediaDevices.enumerateDevices()
  .then(gotDevices).then(getStream).catch(handleError);


// /--init




// -- recording
var tdate = new Date();
_current_timestamp= tdate.getTime();
console.log("_current_timestamp",_current_timestamp);
recorderHandleDataAvailable = function(e) {
  // console.log('ondataavailable!',e);
  chunks.push(e.data);
  // console.log("chunks: "+chunks.length);

  if (chunks.length % (24 * 2) == 0) {
    tdate = new Date();
    _current_timestamp= tdate.getTime();
    console.log("_current_timestamp",_current_timestamp);
    console.log("---UPLOAD--- "+chunks.length);
  }


}

var options = {mimeType: 'video/webm;codecs=vp9'};

function startRecording() {

  console.log("startRecording!!!");
  $('#indicador_recording').html("SI");

  if (!MediaRecorder.isTypeSupported(options.mimeType)) {
    console.log(options.mimeType + ' is not Supported');
    options = {mimeType: 'video/webm;codecs=vp8'};
    if (!MediaRecorder.isTypeSupported(options.mimeType)) {
      console.log(options.mimeType + ' is not Supported');
      options = {mimeType: 'video/webm'};
      if (!MediaRecorder.isTypeSupported(options.mimeType)) {
        console.log(options.mimeType + ' is not Supported');
        options = {mimeType: ''};
      }
    }
  }


  // if (typeof MediaRecorder.isTypeSupported === 'function') {
  //     if (MediaRecorder.isTypeSupported('video/mpeg')) {
  //       console.log('MPEG!');
  //         mimeType = 'video/mpeg';
  //         console.log('WEBM!');
  //     } else if (MediaRecorder.isTypeSupported('video/webm\;codecs=h264')) {
  //         mimeType = 'video/webm;codecs=h264';
  //     }
  // }
  // var options = {mimeType: mimeType};
  console.log('options', options);



  mediaRecorder = new MediaRecorder(window.stream, options);
  mediaRecorder.ondataavailable = recorderHandleDataAvailable;
  mediaRecorder.onstop = recorderHandleStop;

  mediaRecorder.start(10); // collect 10ms of data
  console.log(mediaRecorder.state);
  console.log("recorder started");


  // streamRecorder = webcamstream.record();
  // setTimeout(stopRecording, 10000);

  // console.log(btn_video_record_start);
  // record.style.background = "red";
  // record.style.color = "black";




  // try {
  //   mediaRecorder = new MediaRecorder(window.stream, options);
  // } catch (e) {
  //   console.error('Exception while creating MediaRecorder: ' + e);
  //   alert('Exception while creating MediaRecorder: '
  //     + e + '. mimeType: ' + options.mimeType);
  //   return;
  // }
  // console.log('Created MediaRecorder', mediaRecorder, 'with options', options);
  // recordButton.textContent = 'Stop Recording';
  // playButton.disabled = true;
  // downloadButton.disabled = true;
  // mediaRecorder.onstop = recorderHandleStop;






}





function toggleRecording() {
  console.log('toggleRecording',btn_video_start_stop);
  if (btn_video_start_stop.innerHtml === 'RECORD START') {
    $('.input_video_up').val( "0" );
    // startRecording();
  } else {
    // stopRecording();
    btn_video_start_stop.innerHtml = 'Start Recording';
    // playButton.disabled = false;
    // downloadButton.disabled = false;
  }
}


function stopRecording() {

  $('#indicador_recording').html("NO");

  mediaRecorder.stop();
    // streamRecorder.getRecordedData(postVideoToServer);
}


function recorderHandleStop(event) {
  console.log('Recorder stopped1: ', event,options);
  console.log('Recorder stopped2: ', chunks);
  // var blob = new Blob(chunks, { 'type' : 'audio/ogg; codecs=opus' });
  var blob = new Blob(chunks, { 'type' : options.mimeType });
  console.log('Recorder stopped3: ', blob);

  $('#indicador_recording').html("NO. SUBIENDO VIDEO..");

  chunks= [];

  // formData = new FormData();
  // formData.append('key', blob);
  // xhr.send(formData);





  // // blob = recorder.getBlob();

  // formData = new FormData();
  // formData.append('audio-result', blob, 'audioresult');

  // function reqListener () {
  //   console.log(this.responseText);
  // };

  // var xhr = new XMLHttpRequest();
  // xhr.onload = reqListener;
  // xhr.open("POST", "save.php", true);
  // xhr.send(formData);





  var fileType = 'video'; // or "audio"
  var fileName = 'ABCDEF.webm';  // or "wav"

  var formData = new FormData();
  formData.append(fileType + '-filename', fileName);
  formData.append(fileType + '-blob', blob);

  // xhr('/booth1/save.php?a=savevid', formData, function (fileURL) {
  xhr('/wp-json/booth2/savevid', formData, function (fileURL) {
    console.log("!!!! SUBIENDO");
    $('#indicador_recording').html("NO. SUBIENDO VIDEO..");

      // window.open(fileURL);
  });
  $('.input_video_up').val( "0" );

  function xhr(url, data, callback) {
      var request = new XMLHttpRequest();
      request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
              // console.log('onreadystatechange',request);
              // console.log('onreadystatechange',JSON.parse(request.response));
              var tresp= JSON.parse(request.response);
              console.log('onreadystatechange',(tresp.data.file_name));

              $('#indicador_recording').html("NO");

              $('.div_step3_video_filename span').html( "yes" );
              $('.input_video_up').val( "1" );
              xapp.file_name= tresp.data.file_name;
              $('.form_step3_save_post .input_file_name').val( tresp.data.file_name );
              // callback(location.href + request.responseText);
              // $('#recorded').srcObject('/tuploads/'+tresp.data.file_name );
              document.getElementById('recorded').setAttribute('src', '/tuploads/'+tresp.data.file_name ); 

          } else {
            console.log("WHAT",request);
          }
      };
      request.open('POST', url);
      request.send(data);
  }



  console.log('Recorder stopped3');

}













// xapp.start();






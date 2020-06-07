
let DORECORD = false;

function _DO_START_RECORDING() {

    if (! DORECORD) { return; }

    navigator.mediaDevices.getUserMedia({
        video: true,
        audio: true
    }).then(async function(stream) {
        let recorder = RecordRTC(stream, {
            type: 'video'
        });


        // $('.btn_video_record_start').click(function(){
        //     alert('btn_video_record_start!');
        // });

        recorder.startRecording();

        const sleep = m => new Promise(r => setTimeout(r, m));
        await sleep(3000);

        recorder.stopRecording(function() {
            let blob = recorder.getBlob();
            // invokeSaveAsDialog(blob);
            console.log('TODO: SAVE BLOB TO SERVER HERE',blob);

            _DO_START_RECORDING();
        });


    });

} // _DO_START_RECORDING

$('.btn_start_recording').click(function(){
    DORECORD = true;
    _DO_START_RECORDING();
});

$('.btn_stop_recording').click(function(){
    DORECORD = false;
    recorder.stopRecording(function() {
        let blob = recorder.getBlob();
        // invokeSaveAsDialog(blob);
        console.log('TODO: SAVE BLOB TO SERVER HERE',blob);

        _DO_START_RECORDING();
    });
});




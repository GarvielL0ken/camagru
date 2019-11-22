// Set constraints for the video stream
var constraints = { video: { facingMode: "user", width: 400, height: 300}, audio: false };

$(document).ready(function()
{
	console.log("start");
	cameraView = $("#camera--view");
    cameraOutput = $("#camera--output");
    cameraSensor = $("#camera--sensor");
    cameraTrigger = $("#camera--trigger");
    cameraTrigger.click(takePicture);
    cameraStart();
});
// Access the device camera and stream to cameraView
function cameraStart() {
	console.log(cameraTrigger);
    navigator.mediaDevices.getUserMedia(constraints)
    .then(function(stream) {
       	track = stream.getTracks()[0];
       	cameraView[0].srcObject = stream;
    })
    .catch(function(error) {
        	console.error("Oops. Something is broken.", error);
    });
}

// Take a picture when cameraTrigger is tapped
function takePicture() {
	console.log(cameraView);
	console.log(cameraSensor);
    cameraSensor[0].width = cameraView[0].offsetWidth;
    cameraSensor[0].height = cameraView[0].offsetHeight;
    console.log(cameraView[0].videoWidth);
    console.log(cameraView[0].videoHeight);
    console.log(cameraSensor[0].width);
    console.log(cameraSensor[0].height);
    cameraSensor[0].getContext("2d");
    console.log(cameraSensor);
    cameraSensor.drawImage(cameraView, 0, 0);
    cameraOutput.src = cameraSensor.toDataURL("image/webp");
    cameraOutput.classList.add("taken");
};


var cameraStream = null;

window.onload = function() {
	var btnStart = document.getElementById("btn-start");
	var btnStop = document.getElementById("btn-stop");
	var btnCapture = document.getElementById("btn-capture");
	var btnUpload = document.getElementById("btn-upload");
	
	var stream = document.getElementById("stream");
	var capture = document.getElementById("capture");
	var snapshot = document.getElementById("snapshot");

	btnCapture.addEventListener("click", captureSnapshot);	
	btnStart.addEventListener("click", startStreaming);
	btnStop.addEventListener("click", stopStreaming);
	btnUpload.addEventListener("click", uploadImage)
}

function captureSnapshot()
{
	if (cameraStream != null)
	{
		var context = capture.getContext('2d');
		var image = new Image();

		context.drawImage(stream, 0, 0, capture.width, capture.height);
		image.src = capture.toDataURL("image/png");
		image.width = 320;

		snapshot.innerHTL = '';
		snapshot.appendChild (image);

		//console.log(frmImage);
		var frmImage = document.forms['formupload']['frm-image'];
		frmImage.value = image.src;
		//upload_image();
	}
}

function dataURItoBlob( dataURI ) {

	var byteString = atob( dataURI.split( ',' )[ 1 ] );
	var mimeString = dataURI.split( ',' )[ 0 ].split( ':' )[ 1 ].split( ';' )[ 0 ];
	
	var buffer	= new ArrayBuffer( byteString.length );
	var data	= new DataView( buffer );
	
	for( var i = 0; i < byteString.length; i++ ) {
	
		data.setUint8( i, byteString.charCodeAt( i ) );
	}
	
	return new Blob( [ buffer ], { type: mimeString } );
}

function startStreaming()
{
	/*if (navigator.mediaDevices.getUserMedia && cameraStream == null) {
		navigator.mediaDevices.getUserMedia({ video: true })
			.then(function (mediaStream) {
			cameraStream = mediaStream;
			stream.srcObject = mediaStream;
			})
			.catch(function (error) {
			console.log(error);
			});
		}
	*/
	stream.src = "../resources/Astartes_Part_One.mp4";
	cameraStream = "../resources/Astartes_Part_One.mp4";
}

function stopStreaming()
{
	if (cameraStream != null)
	{
		var track = cameraStream.getTracks()[0];
		track.stop();
		stream.load();
		cameraStream = null;
	}
}

function uploadImage()
{
	var request = new XMLHttpRequest();

	request.open("POST", "../config/test.php", true);

	var data = new FormData();
	var dataURI = snapshot.firstChild.getAttribute("src");
	var imageData = dataURItoBlob(dataURI);

	data.append("image", imageData, "image_name");
	request.send(data);
}

function overlays()
{
	var overlay_div = document.getElementById('div_overlays');

	overlay_div.innerHTML = '';

	var overlay_arr = [];
	var overlay_form = document.forms['formupload'];
	console.log(overlay_form);
	for (var element in overlay_form)
	{
		var formElement = overlay_form[element];
		if (overlay_form.hasOwnProperty(element) && formElement.name && formElement.type == 'checkbox' && formElement.checked == true)
			overlay_arr.push(formElement.value);
		else
			console.log("Error");
	}

	overlayPosX = 10;
	overlay_arr.forEach(id => {
			var img = document.createElement("img");
			img.className = 'wc-overlay';
			img.src = '../resources/' + id + '.png';
			img.style = 'display: none';
			overlayPosX += 170; // 160px = image width, +10 for margin
			overlay_div.appendChild(img);
		});
}
// Set constraints for the video stream


window.onload = function() {
    var main = document.querySelector('#main');
    var mainWidth = main.offsetWidth - 10;
    var mainHeight = main.offsetHeight - 10;
    var constraints = { video: { facingMode: "user", width: mainWidth, height: mainHeight}, audio: false };
    var video = document.querySelector('#videoElement');
    if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia(constraints)
          .then(function (stream) {
            video.srcObject = stream;
          })
          .catch(function (error) {
            console.log("Something went wrong!");
          });
      }
}
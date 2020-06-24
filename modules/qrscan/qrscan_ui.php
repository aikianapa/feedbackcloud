<html>
  <head>
    <title>QR Scanner</title>
    <base href="{{_base}}">
    <link rel="stylesheet"  href="qrscan.less">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta data-wb="role=snippet&load=jquery">
    <meta data-wb="role=snippet&load=fontawesome4">
    <meta data-wb="role=snippet">
    <title>Feedbackcloud QR - сервис обратной связи</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
  <body>



    <script type="wbapp" type="text/javascript">
      wbapp.loadScripts([
          "{{_base}}js/jsqrscanner.nocache.js"
        ],"qrscan-js");

      $(document).on("mod-qrscan-done",function(e,data){
          if (substr(data,0,4) == "http") {
              document.location.href = data;
          } else {
              wbapp.alert({text:data,icon:"info"});
          }

      });
    </script>



        <div class="container">
          <div class="row">
            <div class="card w-100">

              <div class="card-img-top">
                <div class="qrscanner" id="scanner">
                </div>
              </div>
            </div>
          </div>
          <br>


        </div>
      <script type="text/javascript">
        function onQRCodeScanned(scannedText)
        {
          $(document).trigger("mod-qrscan-done",scannedText);

        }

        function provideVideo()
        {
            var n = navigator;

            if (n.mediaDevices && n.mediaDevices.getUserMedia)
            {
              return n.mediaDevices.getUserMedia({
                video: {
                  facingMode: "environment"
                },
                audio: false
              });
            }

            return Promise.reject('Your browser does not support getUserMedia');
        }

        function provideVideoQQ()
        {
            return navigator.mediaDevices.enumerateDevices()
            .then(function(devices) {
                var exCameras = [];
                devices.forEach(function(device) {
                if (device.kind === 'videoinput') {
                  exCameras.push(device.deviceId)
                }
             });

                return Promise.resolve(exCameras);
            }).then(function(ids){
                if(ids.length === 0)
                {
                  return Promise.reject('Could not find a webcam');
                }

                return navigator.mediaDevices.getUserMedia({
                    video: {
                      'optional': [{
                        'sourceId': ids.length === 1 ? ids[0] : ids[1]//this way QQ browser opens the rear camera
                        }]
                    }
                });
            });
        }

        //this function will be called when JsQRScanner is ready to use
        function JsQRScannerReady()
        {
            //create a new scanner passing to it a callback function that will be invoked when
            //the scanner succesfully scan a QR code
            var jbScanner = new JsQRScanner(onQRCodeScanned);
            //var jbScanner = new JsQRScanner(onQRCodeScanned, provideVideo);
            //reduce the size of analyzed image to increase performance on mobile devices
            jbScanner.setSnapImageMaxSize(300);
        	var scannerParentElement = document.getElementById("scanner");
        	if(scannerParentElement)
        	{
        	    //append the jbScanner to an existing DOM element
        		jbScanner.appendTo(scannerParentElement);
        	}
        }
      </script>

  </body>
</html>

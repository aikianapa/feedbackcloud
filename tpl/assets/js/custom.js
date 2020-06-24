var socket;

$(document).ready(function() {
    $('body').on('click', '.scroll-button-top', function (e){
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        },1000);
    });
});

wbapp.loadScripts([
  "/tpl/assets/js/websocket.js",
  "/tpl/assets/js/socket_api.js"
],"socket-api");

$(document).on("socket-api",function(){
    socket = new socketApi("wss://api.feedbackcloud.ru:4443");
})

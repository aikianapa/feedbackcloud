var api;

$(document).on("socket-open",function(){
  $("#loader").remove();
})

wbapp.loadScripts([
  "/tpl/assets/js/websocket.js",
  "/tpl/assets/js/socket_api.js"
],"socket-api",function(){
    api = new socketApi("wss://api.feedbackcloud.ru:4443");
});

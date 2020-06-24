"use strict";
class socketApi {
  constructor(host = "wss://api.feedbackcloud.ru:4443") {
    this.host = host;
    this.init();
    return this;
  }

  init() {
  let host = this.host;
  let cid = localStorage.getItem("cid");
  let uid = localStorage.getItem("uid");
  let socket = ws(`${host}/${cid}`);

  this.cid = cid;
  this.uid = uid;
  this.socket = socket;

  socket.onopen = function(e) {
    if ($ !== undefined) {
        $(document).trigger("socket-open");
        console.log("Trigger: socket-open");
    }
  };
  socket.onmessage = function(m) {
    var data = JSON.parse(m.data);
    if (!cid && data.cid) {
      localStorage.setItem("cid", data.cid);
      cid = data.cid;
    } else if (cid !== data.cid) {
      console.log("Connect ID not equal to client");
    }
    if (data.callback !== undefined) {
      eval(`${data.callback}(data)`);
    }
    if ($ !== undefined) $(document).trigger("socket-message");
  };

  socket.onclose = function(event) {
    if (event.wasClean) {
      console.log(`[close] Соединение закрыто, код=${event.code} причина=${event.reason}`);
    } else {
      console.log(`[close] Соединение прервано`);
    }
    if ($ !== undefined) $(document).trigger("socket-close");
  };

  socket.onerror = function(error) {
    console.log(`[error] ${error.message}`);
    if ($ !== undefined) $(document).trigger("socket-error");
  };

  $(document).undelegate("form .api", "click");
  $(document).delegate("form .api", "click", function() {
    var form = $(this).parents("form");
    var url = $(form).attr("action");
    var method = $(form).attr("method");
    var callback = $(form).attr("callback");
    var msg = $(form).serializeJson();
    if (method == undefined) method = "post";
    if (url == undefined) url = "/";
    var data = {
      cid: cid,
      uid: uid,
      method: method,
      url: url,
      msg: msg,
      callback: callback
    }
    data = json_encode(data)
    socket.send(data);
  })

  $(document).undelegate("[data-api]", "click");
  $(document).delegate("[data-api]", "click", function() {
    var params = $(this).data("api");
    params = JSON.parse(str_replace("'", '"', params));
    var url = params.url;
    var method = params.method;
    var callback = params.callback;
    var msg = params.data;
    if (method == undefined) method = "get";
    if (url == undefined) url = "/";
    var data = {
      cid: cid,
      uid: uid,
      method: method,
      url: url,
      msg: msg,
      callback: callback
    }
    data = json_encode(data)
    socket.send(data);
  })
  }

  send(data) {
    if (typeof data == "string") data = JSON.parse(data);
    if (!data.cid) data.cid = this.cid;
    if (!data.uid) data.uid = this.uid;
    if (!data.msg) data.msg = "";
    if (!data.method) data.method = "get";
    data = json_encode(data);
    this.socket.send(data);
  }
}

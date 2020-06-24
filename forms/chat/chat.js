var mode, chat, token, store, route, interval, winRef, client, owner, worker;
var msgBox, msgBtn, msgForm, btnFile, btnPhoto;


$(document).off("chat-js");
$(document).on("chat-js", function() {


$("#bottomsheetblock").addClass("ui-panel-open").removeClass("ui-panel-closed");


var msgBox = $("#message_box");
var msgBtn = $("#message_send");
var msgForm = $("#message_form");
var btnFile = $("#btnFile");
var btnPhoto = $("#btnPhoto");


  winRef = "chat";
  route = document.location.href;
  route = str_replace('//', '/', route);
  route = explode("/", route);
  client = "Клиент";
  owner = "Владелец";

  mode = route[2];
  chat = route[3];
  token = null;
  interval = 3000; // 3 секунды
  store = localStorage.getItem('store');

  if (route[4] !== undefined) token = route[4];
  if (store == undefined) {
    store = {};
  } else {
    store = JSON.parse(store);
    console.log(store);
    if (store[chat]["key"]) token = store[chat]["key"];
  }

  store[chat] = {
    key: token,
    last: null
  };
  chatStore(store);




  chatInit();
});



function chatInit() {
/*
  worker = new Worker('/chatsw.js');

  // Проверка того, что наш браузер поддерживает Service Worker API.
  if ('serviceWorker' in navigator) {
      // Весь код регистрации у нас асинхронный.
      navigator.serviceWorker.register('/chatsw.js')
        .then(() => navigator.serviceWorker.ready.then((worker) => {
          worker.sync.register('syncdata');
        }))
        .catch((err) => console.log(err));
  }

  worker.addEventListener('message', function(e) {
    console.log(e.data);
  }, false);
*/
  chatEvents();
  chatGet();
//  chatListen();
}


function chatStore(store) {
  let json = JSON.stringify(store);
  localStorage.setItem('store', json);
}

function chatListen() {
//  var listen = setInterval(function() {
//    chatGet(store[chat]["last"]);
//  }, interval);

  worker.addEventListener('getchat', function(e) {
    console.log(e.data);
  }, false);

  worker.postMessage({'cmd': 'getchat', 'data': {
      chat: chat,
      last: store[chat]["last"],
      user: $.cookie("user"),
      token: token
    }
  });

}

function chatNotify(chat, msg) {


          var chatMsg = new Notification("Андрей Чернышёв", {
            tag: "chat" + chat,
            body: msg.text,
            icon: "http://habrastorage.org/storage2/cf9/50b/e87/cf950be87f8c34e63c07217a009f1d17.jpg"
          });
          chatMsg.onclick = function() {
            wbapp.alert("test");
            event.preventDefault();
            var url = 'https://work2.loc/chat/5e59238607ba/b0bc2a45cf7590e545672d1c9a5ce3ce/';
            if (typeof(winRef) == 'undefined' || winRef.closed) {
              //create new
              winRef = window.open(url, "_blank");
            } else {
              //it exists, load new content (if necs.)
              //winRef.location.href = url;
              //give it focus (in case it got burried)
              winRef.focus();
            }

          }

}




$.fn.notifySound = function(file = "/forms/chat/notify.mp3") {
  var that = this;

  function playNotify(file) {
    stopNotify();
    $(that).append('<iframe src="' + file + '" class="d-none notify-sound" autoplay style="display:none;"></iframe>');
  }

  function stopNotify() {
    $(that).find(".notify-sound").remove();
  }

  stopNotify();
  playNotify(file);
}

function chatEvents() {
  $(msgBtn).on("click touch", function() {
    console.log("3412341234");
    let data = $(msgForm).serializeJson();
    let user = $.cookie("user"); //null
    console.log(store);
    $.post("/ajax/chat/msg/", {
      chat: chat,
      data: data,
      token: token
    }, function(msg) {
      chatAddMsg(msg);
      chatToBottom();
      $(msgForm).notifySound();
      $(msgForm)[0].reset();
    }).fail(function() {
      alert("error");
    });
  });

  $(btnFile).on("click touch", function() {
    $(msgForm).find("input[type=file]").trigger("click");
    return false;
  });

  $(btnPhoto).on("click touch", function() {
    $(msgForm).find(".camera-show").trigger("click");
    return false;
  });
}

function chatGet(last = null) {
  let user = $.cookie("user"); //null
  let msg;
  $.post("/ajax/chat/get/", {
    chat: chat,
    last: last,
    user: user,
    token: token
  }, function(result) {
    store[chat]["key"] = result.token;
    let flag = false;
    $.each(result.msg, function(i, data) {
      chatAddMsg(data);
      msg = data;
      flag = true;
    });
    chatStore(store);
    if (flag) {
      chatToBottom();
      $(msgForm).notifySound();
      chatNotify(chat, msg); // notify last msg
    }
  }).fail(function() {
    console.log("error");
  });
}


function chatToBottom() {
  $('.chat-container').animate({
    scrollTop: $('#message_box').height() * 2
  }, "slow");
}

function chatAddMsg(data) {
	
	
	console.log(34523452345);
	
  let user = $.cookie("user"); //null
  let msgTpl = wbapp.tpl["message"].html;
  msgTpl = str_replace("%text%", data.text, msgTpl);
  if (data.user == user) {
    msgTpl = str_replace("%user%", "Вы", msgTpl);
  } else {
    msgTpl = str_replace("%user%", "Менеджер", msgTpl);
    msgTpl = $(msgTpl).removeClass("user").outerHTML();
  }
  $(msgBox).append(msgTpl);
  store[chat]["last"]++;
}

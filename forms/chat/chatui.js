if (msgBox == undefined) {
		var msgBox, msgBtn, msgForm, btnFile, btnPhoto;
		var host = document.location.host;
		var socket = ws("wss://"+host+":9502");
		var mode, chat, token, store, profile, place, route, winRef, owner, user, owner_name;
		var default_avatar, owner_avatar, owner_name, client_avatar, client_name;
		self.addEventListener('message', function (event) {
			switch (event.data.message) {
				case 'send':
					socket.send(event.data.data);
					break;
				case 'connection':
					if (socket.connected())
						socket.onopen();
			}
		});
		initSocket();
		postMessage({message: 'oncreated'});
}

$(document).off("chatui-js");
$(document).on("chatui-js", function() {
	msgBox = $("#message_box");
	msgBtn = $("#message_send");
	msgForm = $("#message_form");
	btnFile = $("#btnFile");
	btnPhoto = $("#btnPhoto");
	chatNotifySubscribe();
	
	
	// прибиваем прелоадер
		$("#loader").css("opacity",0);
		setTimeout(function(){
		$("#loader").remove();
		},500);

		$("body").addClass("app-chat");
	  $('[data-toggle="tooltip"]').tooltip()

	  // chat sidebar body scrollbar
	  new PerfectScrollbar('.chat-sidebar-body', {
	    suppressScrollX: true
	  });

	  // chat content body scrollbar
	  new PerfectScrollbar('.chat-content-body', {
	    suppressScrollX: true
	  });

	  // chat sidebar right scrollbar
	  new PerfectScrollbar('.chat-sidebar-right', {
	    suppressScrollX: true
	  });
		chatDefaults();
		initEvents();
		if (!owner) chatUserInit();
		$(".owner_avatar").attr("src",owner_avatar);
		$(".owner_name").text(owner_name);
});

function chatUserInit() {
	if (!wbapp.tpl["places"]) return;
	user = chatGetUser();
	
	store = chatGetStore('store');
	profile = chatGetStore('profile');
	
	if (profile.first_name !== undefined) {
		client_name = profile.first_name + " " + profile.last_name;
		client_avatar = profile.avatar;
	}

	let place = wbapp.tpl["places"].html;
	$.each(store,function(i,item){
		$("#allChannels").append(chatTplData(place,item));
	});
	
	route = document.location.href;
	route = str_replace('#', '/', route);
	route = str_replace('//', '/', route);
	route = explode("/", route);

	mode = route[2];
	chat = route[3];

	if (mode == "chat" && chat > "") {
		if (store[chat]) token = store[chat].key;
		chatGet();
		$(document).on("get-chat-done",function(){
			if (!$("#allChannels a[data-place='"+chat+"']").length) {
				store = chatGetStore('store');
				$("#allChannels").append(chatTplData(place,store[chat]));
			}
			$("#allChannels a[data-place='"+chat+"']").addClass("active");
			let title = $("#allChannels a[data-place='"+chat+"']").text();
			$('#channelTitle').text("#"+title);

		});
		showChatContent();
	}
	
}


function chatTplData(tpl,data) {
	$.each(data,function(fld,val){
		tpl = str_replace("%"+fld+"%", val, tpl);
	});
	return tpl;
}

function clientAvatar(avatar = null) {
		if (avatar == null) {
			profile = localStorage.getItem('profile');
			if (profile) {
				profile = json_decode(profile);
				if (profile.avatar > "") {
					avatar = profile.avatar;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
		let style = $("#avastyle").html();
		let regex = /url(.*)/gm;
		let subst = 'url('+avatar+');';
		style = style.replace(regex, subst);
		$("#avastyle").html(style);
		return avatar;
};

function postMessage(msg) {
//    self.clients.matchAll().then(all => all.map(client => client.postMessage(msg)));
	//channel.postMessage(msg);
	if (msg.message == "onmessage") {
		let data = json_decode(msg.data);
		if (chat !== data.chat) return;
		data.date = date("Y-m-d H:i:s");
		if (typeof data.data === 'undefined') return;
		
		if (token == data.key) {
			data.text = data.data.text;
			chatAddMsg(data);
			chatToBottom();
		}
		
		$(msgForm)[0].reset();
		if (user !== data.user) {
			$(msgForm).notifySound();
			//chatNotify(chat, data);
		}
	}
}

function sendMessage(msg) {
	socket.send(JSON.stringify({message: msg}));
}

function chatToBottom() {
	$(".chat-content-body").animate({
		scrollTop: $(msgBox).height()
	}, "slow");
}

function chatNotifySubscribe(state) {
	return subscribeToNotification().then((res) => {
			if (state !== undefined) {
				res = JSON.parse(res);
				res["state"] = state;
				res = JSON.stringify(res);
			}
			console.log(res);
			socket.send(res);
			return state;
		},
		(err) => console.error(err));
}


function chatNotify(chat, msg) {

		var chatMsg = new Notification("Андрей Чернышёв", {
			tag: "chat" + chat,
			body: strip_tags(html_entity_decode(msg.text)),
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

function chatSetStore(store, field = 'store') {
	let json = JSON.stringify(store);
	localStorage.setItem(field, json);
}

function chatGetStore(field = 'store') {
	data = localStorage.getItem(field);
	if (!data) {
		data = {};
	} else {
		data = json_decode(data);
	}
	return data;
}

function chatProfile() {
	let profile = chatGetStore('profile');
	$(".card").addClass("d-none");
	$(".profile-container").removeClass("d-none");
	$("#formProfile input[name]").each(function(){
		if (profile[$(this).attr("name")]) $(this).val(profile[$(this).attr("name")]);
	});
	if ($("#formProfile [name=avatar]").val() == "") $("#formProfile [name=avatar]").val(default_avatar);
	$("#formProfile #profileAvatar").attr("src",$("#formProfile [name=avatar]").val());
}

function chatProfileSave() {
	$("body").removeClass("show-sidebar-right");
	$(".chat-container").removeClass("d-none");
	let profile = $("#formProfile").serializeJson();
	chatSetStore(profile,'profile');
	client_name = clientName();
	client_avatar = clientAvatar();
	chatGet();
}


function chatGet(last = null) {
	if (!chat) return;
	// пытаемся получить историю чата и токен, если его нет
	let user = chatGetUser();
	let msg;
	let post = {
		chat: chat, // это place_id
		last: last,
		user: user,
		name: client_name,
		avatar: client_avatar,
		key: token
	};
	if (wbapp.settings.user && wbapp.settings.user.role == "chatown") {
		post.avatar = null;
		post.name = null;
	}

	$.post("/ajax/chat/get/", post, function(result) {
		if (store[chat] == undefined) {store[chat] = {};}
			store[chat].key = result.token;
			store[chat].place_name = result.place_name;
			store[chat].place_id = result.place_id;
			store[chat].chat_start = result.chat_start;
			if (!store[chat]["last"]) store[chat]["last"] = 0;

			if (md5(user) == result.owner_id) owner = true;
			if (result.owner_name > "") owner_name = result.owner_name;
			if (result.owner_avatar > "") owner_avatar = result.owner_avatar;
			if (result.client_name > "") client_name = result.client_name;
			if (result.client_avatar > "") client_avatar = result.client_avatar;
			clientAvatar(client_avatar);
			$(".owner_avatar").attr("src",owner_avatar);

			$(".place-name").html(strip_tags(result.place_name));
			$(".chat-start").html(date("d.m.Y H:i",strtotime(result.chat_start)));
			$(".nav-white-date").html(date("d.m.Y",strtotime(result.chat_start)));
			$(".nav-white-time").html(date("H:i",strtotime(result.chat_start)));
			$(".client_name").html(strip_tags(client_name));
			$(".owner_name").html(strip_tags(owner_name));

			let flag = false;
			$(msgBox).html("");
			$.each(result.msg, function(i, data) {
			chatAddMsg(data);
			msg = data;
			flag = true;
			});
			chatSetStore(store);
			if (flag) {
				$(".chat-content-body").scrollTop(0);
				chatToBottom();
//				$(msgForm).notifySound();
//				chatNotify(chat, msg); // notify last msg
			}
			$(document).trigger("get-chat-done");
	}).fail(function() {
		console.log("error");
	});
}

function chatAddMsg(data) {

	let msgTpl = wbapp.tpl["message"].html;
	let msgDiv = wbapp.tpl["divider"].html;
	let name = client_name;
	let avatar = client_avatar;

	if ($("body").attr("role") == "user") {
		// кабинет пользователя
		if (data.user !== user) {
			avatar = owner_avatar;
			name = owner_name;
		}
	} else {
		// кабинет менеджера
		if (data.user == user) {
			avatar = owner_avatar;
			name = owner_name;
		}
		
	}

	msgTpl = str_replace("%dateonly%", date('d.m.Y',strtotime(data.date)), msgTpl);
	msgTpl = str_replace("%date%", date('d.m.y H:i',strtotime(data.date)), msgTpl);
	msgTpl = str_replace("%text%", data.text, msgTpl);
	msgTpl = str_replace("%user%", name, msgTpl);
	msgTpl = str_replace("%avatar%", avatar , msgTpl);

	let currdate = date('d.m.Y',strtotime(data.date));
	let lastdate = $(msgBox).find(".media:last-child").attr("data-date");
	if (lastdate !== currdate) {
		msgDiv = str_replace("%dateonly%", currdate, msgDiv);
		$(msgBox).append(msgDiv);
	}
	let $msg = $(msgTpl);
	if (data.user == user) {
		$msg.addClass("author");
		$msg.find(".avatar").remove();
	} 
	msgTpl = $msg.outerHTML();
	$(msgBox).append(msgTpl);
	store[chat]["last"]++;
}

function chatDefaults() {
			default_avatar = "/tpl/assets/img/chat-avatar-white.svg";
			
			owner_avatar = default_avatar;
			owner_name = "Менеджер";

			client_avatar = default_avatar;
			client_name = "Клиент";

			if ($(".aside-loggedin").length) {
				owner_avatar = $(".aside-loggedin .avatar img").attr("src");
				owner_name = $(".aside-loggedin-user h6").text();
			}

			owner = false;
			store = chatGetStore();
			user = chatGetUser();
}

function chatGetUser() {
	let user = $.cookie("user");
	if (!user) user = wbapp.newId();
	$.cookie("user",user);
	return user;
}


function chatListChats() {
	user = chatGetUser();
	$.post("/ajax/chat/listchats/", {
		chat: chat,
		user: user,
	}, function(result) {
		let membersTpl = wbapp.tpl["members"].html;
		$("#chatMemberList").html("");
		$.each(result,function(i,member){
				let memberitem = membersTpl;
				$.each(member,function(fld){
						if (fld == "client_avatar" && member[fld] == null) member[fld] = client_avatar;
						if (fld == "client_name" && member[fld] == null) member[fld] = client_name;
						memberitem = str_replace("%"+fld+"%", member[fld], memberitem);
				});
				$("#chatMemberList").append(memberitem);
				$("#showMemberList span").text($("#chatMemberList .media").length);
		});
		$("body").addClass("show-sidebar-right");
	});

}


function chatList_____() {
	return;
	let chatsTpl = wbapp.tpl["chats"].html;
	let store = json_decode(localStorage.getItem('store'));
	$.each(store,function(i,places){
		$(places).each(function(i,place){
			chatitem = chatsTpl;
			chatitem = str_replace("%place_name%", place.place_name, chatitem);
			chatitem = str_replace("%place_id%", place.place_id, chatitem);
			$("#chatList").append($(chatitem).outerHTML());
		});
	});
}

function initSocket() {
	
    socket.onopen = function (e) {
        postMessage({message: 'onopen'});

        checkNotificationPermissions().then((permission) => {
        if (permission === 'granted') chatNotifySubscribe();
        });
    };

    socket.onmessage = function (m) {
        let msg = JSON.parse(m.data);
        if (msg["state"] !== undefined) {
            notificationState = msg["state"];
            if (notificationState == false) {
                chatNotifySubscribe("online");
            }
        }
        postMessage({message: 'onmessage', data: m.data});
    };


		socket.onclose = function (event) {
			postMessage({message: 'onclose', code: event.code, reason: event.reason, wasClean: event.wasClean});
		};

		socket.onerror = function (error) {
			console.error(error);
			wbapp.alert("Connection error");
		};
}

function initEvents() {
	$(msgBtn).on("click", function() {
		let data = $(msgForm).serializeJson();
		let user = chatGetUser();
		//BUG! store не инициализированно!
		let token = store[chat].key;
		sendMessage({chat:chat,key:token,user:user,data:data});
	});
	
	$('#message_form [name=text]').keydown(function(event) {
		if (event.keyCode == 13) {
			event.preventDefault();
			$(msgBtn).trigger("click");
		}
	});
	

	$(btnFile).on("click", function() {
		$(msgForm).find("input[type=file]").trigger("click");
		return false;
	});

	$(btnPhoto).on("click", function() {
		$(msgForm).find(".camera-show").trigger("click");
		return false;
	});

	$("#btnProfile").on("click",function(){
		chatProfile();
	});

	$("#btnLeaveCancel, #btnProfileCancel").on("click",function(){
		if ($("body").attr("role") == "user" ) {
			$("body").removeClass("show-sidebar-right");
		} else {
			$(".card").addClass("d-none");
			$(".card.chat-container").removeClass("d-none");			
		}
	});

	$("#btnLeave").on("click",function(){
		$(".card").addClass("d-none");
		$(".card.leave-container").removeClass("d-none");
	});

	$("#btnProfileSave").on("click",function(){
		let avatar = $("#formProfile [name=avatar]").val();
		clientAvatar(avatar);
		chatProfileSave();
	});

	$("#formProfile #profileAvatar").on("click",function(){
		$("#formProfile #file").trigger("click");
	});
}

function clientName() {
	let profile = localStorage.getItem('profile');
	if (profile) {
		if (is_string(profile)) profile = json_decode(profile);
		if (trim(profile.first_name) > " ") client_name = trim(profile.first_name);
		if (trim(profile.last_name) > " ") client_name += " " + trim(profile.last_name);
		return client_name;
	} else {
		return false;
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


  ///// UI INTERACTION /////

  // channel click
  function showChatContent() {
    $('#mainMenuOpen').addClass('d-none');
    $('#chatContentClose').removeClass('d-none');

    $('body').addClass('chat-content-show');
  }

  function hideChatContent() {
    $('#chatContentClose').addClass('d-none');
    $('#mainMenuOpen').removeClass('d-none');

    $('body').removeClass('chat-content-show');
  }

  $(document).undelegate('#channelTitle','click');
  $(document).delegate('#channelTitle','click', function(e){
	  hideChatContent();
  });


  $(document).undelegate('#allChannels a','click');
  $(document).delegate('#allChannels a','click', function(e){
    e.preventDefault()
    $(this).addClass('active');
    $(this).siblings().removeClass('active');

    $('#chatDirectMsg .active').removeClass('active');

    // replace channel title
    var title = $(this).attr('title');
    $('#channelTitle').text("#"+title);

    // view channel title
    $('#channelTitle').removeClass('d-none');
    $('#directTitle').addClass('d-none');

    // view channel nav icon
    $('#channelNav').removeClass('d-none');
    $('#directNav').addClass('d-none');
    //$(".chat-sidebar-footer").addClass("d-none");
    $(msgBox).html("");
    chatDefaults();
    chat = $(this).data("place");
	if ($("body").attr("role") == "user" ) {
		console.log(store);
		token = store[chat].key;
		chatGet();
	} else {
		chatListChats();
	}

    if(window.matchMedia('(max-width: 991px)').matches) {
      showChatContent();
    }
  })
  // direct message click
  $(document).undelegate('#chatDirectMsg .media','click');
  $(document).delegate('#chatDirectMsg .media','click', function(e){
    e.preventDefault();

    $(this).addClass('active');
    $(this).siblings().removeClass('active');

    $('#allChannels .active').removeClass('active');

    var directUser = $(this).find('h6').text();
    $('#directTitle h6').text('@'+directUser);

    var avatar = $(this).find('.avatar');
    $('#directTitle .avatar').replaceWith(avatar.clone());

    // view direct title
    $('#channelTitle').addClass('d-none');
    $('#directTitle').removeClass('d-none');

    // view direct nav icon
    $('#channelNav').addClass('d-none');
    $('#directNav').removeClass('d-none');

    if(window.matchMedia('(max-width: 991px)').matches) {
      showChatContent();
    }

    $('body').removeClass('show-sidebar-right');
    $('#showMemberList').removeClass('active');

  })

  $(document).undelegate('#chatMemberList a','click');
  $(document).delegate('#chatMemberList a','click', function(e){
      client_name = $(this).find("h6").text();
      client_avatar = $(this).find(".avatar img").attr("src");
      $(document).find(".client_name").text(client_name);
      $(document).find(".client_avatar").attr("src",client_avatar);
      $("#directTitle").removeClass("d-none");
      $(".chat-sidebar-footer").removeClass("d-none");
      chat = $(this).attr("data-place");
      token = $(this).attr("data-token");
      chatGet();
      $("body").removeClass("show-sidebar-right"); 
  });

  $(document).undelegate('#showMemberList','click');
  $(document).delegate('#showMemberList','click', function(e){
    e.preventDefault()
    $(this).toggleClass('active');
    $('body').toggleClass('show-sidebar-right');
  })

  $(document).undelegate('#chatContentClose','click');
  $(document).delegate('#chatContentClose','click', function(e){
    e.preventDefault()
    hideChatContent();
  });

	$(document).delegate("#message_form [name=text]","focus",function(){
			$("body").removeClass("show-sidebar-right");
	});
	
	$(document).delegate("#message_box","click",function(){
			$("body").removeClass("show-sidebar-right"); 
	});


  // making sure navleft and sidebar are display when resizing to desktop
  $(window).resize(function(){
    if(window.matchMedia('(min-width: 992px)').matches) {
      $('.chat-navleft').removeClass('d-none');
      $('.chat-sidebar').removeClass('d-none');
    }
  })

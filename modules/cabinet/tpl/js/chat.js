"use strict"

const psNavbar = new PerfectScrollbar('.chat-content-body', {
  suppressScrollX: true
});

$(document).on("chatui-js",function(){
    api.send({url: "/query/places/",msg:"active=on&managers.user="+localStorage.getItem("uid"),"callback":"chat.places_list"});
    api.send({url: "/query/chats/",msg:"active=on&manager_id="+localStorage.getItem("uid"),"callback":"chat.subscribe"});
    feather.replace();
});

$(document).undelegate(".app-chat #showMemberList","tap click");
$(document).delegate(".app-chat #showMemberList","tap click",function(e){
    e.preventDefault();
    $("body").toggleClass("show-sidebar-right");

});

$(document).undelegate("#allChannels .nav-link","tap click");
$(document).delegate("#allChannels .nav-link","tap click",function(e){
    e.preventDefault();
    $("body").addClass("show-sidebar-right");
    $("body").addClass("chat-content-show");
    $("#messagesList").html("");
    $("#membersList").html(wbapp.tpl("tplSpinner").html);
    api.send({url: "/query/chats/",msg:"active=on&place="+$(this).data("place"),"callback":"chat.chats_list"});
});

$(document).undelegate("#membersList a","tap click");
$(document).delegate("#membersList a","tap click",function(e){
    e.preventDefault();
    $("body").removeClass("show-sidebar-right");
    $("#messagesList").html(wbapp.tpl("tplSpinner").html);
    chat.chat = $(this).data("chat");
    api.send({url: "/query/chats/",msg:`_id=${$(this).data("chat")}`,"callback":"chat.messages_list"});
});

$("#msgButton").on("click touch", function() {
  console.log(chat.chat);
  let data = $("#message_form").serializeJson();
  let user = localStorage.getItem("user");
  $("#message_form")[0].reset();
  api.send({url:`/pushmsg/chats/${chat.chat}`,method:"post","msg":data,callback:"chat.send_message"});
});



class Chat {
  Constructor() {
      var places;
      var chats;
      var messages;
      var chat;
  }

  subscribe(data) {
    $(data.result).each(function(i,item){
      console.log(item);
    });
  }


  places_list(data) {
      var ractive = Ractive({
        target: "#allChannels",
        template: wbapp.tpl("tplChannels").html,
        data: data
      });
      this.places = ractive;
  }

  chats_list(data) {
    var ractive = Ractive({
      target: "#membersList",
      template: wbapp.tpl("tplMembers").html,
      data: data
    });
    this.chats = ractive;
  }

  messages_list(data) {
    data.result[0] = this.messages_prep(data.result[0])
    var ractive = Ractive({
      target: "#messagesList",
      template: wbapp.tpl("tplMessages").html,
      data: data
    });
    this.messages = ractive;
    this.to_bottom();
  }

  messages_prep(data) {
    var manager = json_decode(localStorage.user);
    $(data.msg).each(function(i,item){
      item.manager_name = "";
      item.avatar = "assets/img/chat-avatar.svg";

      if (manager.first_name) item.manager_name = manager.first_name;
      if (manager.last_name) item.manager_name += " " + manager.last_name;
      if (item.manager_name == "") item.manager_name = "Менеджер";

      item.client_name = "";
      if (data.contacts.first_name) item.client_name = data.contacts.first_name;
      if (data.contacts.last_name) item.client_name += " " + data.contacts.last_name;
      if (item.client_name == "") item.client_name = "Клиент";

      if (item.reply && data.manager_id == manager._id) {
        item.author = "author";
        item.message = item.reply;
        item.name = item.manager_name;
        if (item.client_avatar !== undefined && item.client_avatar[0].img !== undefined) item.avatar = item.client_avatar[0].img;
      } else {
        item.author = "";
        item.message = item.text;
        item.name = item.client_name;
        if (manager.avatar.length && manager.avatar[0].img !== undefined) item.avatar = manager.avatar[0].img;
      }

      item.date = date("d.m.y H:i:s",strtotime(item.date));
      item.dateonly = date("d.m.y",strtotime(item.date));
      data.msg[i] = item;
    })
    return data;
  }

  send_message(data) {
    data = this.messages_prep(data.result);
    this.messages.set("result.msg",data.msg);
    this.to_bottom();
  }

  to_bottom() {
    $('.chat-content-body').animate({
      scrollTop: $('.chat-content-body').height() * 2
    }, "slow");
  }

}

var chat = new Chat();

api.sub({name:"test"});

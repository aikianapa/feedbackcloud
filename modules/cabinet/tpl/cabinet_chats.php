<html>
<div class="chat-wrapper chat-wrapper-two">
  <div class="chat-sidebar">

    <div class="chat-sidebar-header">
      <a href="#" data-toggle="dropdown" class="dropdown-link">
        <div class="d-flex align-items-center">
          <div class="avatar avatar-sm mg-r-8"><span class="avatar-initial rounded-circle">T</span></div>
          <span class="tx-color-01 tx-semibold">TeamName</span>
        </div>
        <span><i data-feather="chevron-down"></i></span>
      </a>
      <div class="dropdown-menu dropdown-menu-right tx-13">
        <a href="app-chat.html" class="dropdown-item"><i data-feather="user-plus"></i> Invite People</a>
        <a href="app-chat.html" class="dropdown-item"><i data-feather="plus-square"></i> Create Channel</a>
        <a href="app-chat.html" class="dropdown-item"><i data-feather="server"></i> Server Settings</a>
        <a href="app-chat.html" class="dropdown-item"><i data-feather="bell"></i> Notification Settings</a>
        <a href="app-chat.html" class="dropdown-item"><i data-feather="zap"></i> Privacy Settings</a>
        <div class="dropdown-divider"></div>
        <a href="app-chat.html" class="dropdown-item"><i data-feather="edit-3"></i> Edit Team Details</a>
        <a href="app-chat.html" class="dropdown-item"><i data-feather="shield-off"></i> Hide Muted Channels</a>
      </div><!-- dropdown-menu -->
    </div><!-- chat-sidebar-header -->

    <!-- start sidebar body -->
    <div class="chat-sidebar-body">

      <div class="flex-fill pd-y-20 pd-x-10">
        <div class="d-flex align-items-center justify-content-between pd-x-10 mg-b-10">
          <span class="tx-10 tx-uppercase tx-medium tx-color-03 tx-sans tx-spacing-1">Все места</span>
          <a href="#modalCreateChannel" class="chat-btn-add" data-toggle="modal">
            <span data-toggle="tooltip" title="Create Channel"><i data-feather="plus-circle"></i></span>
          </a>
        </div>
        <nav id="allChannels" class="nav flex-column nav-chat mg-b-20" wb------if="'{{_sess.user.role}}' == 'chatown'">
          <div class="text-center">
            <div class="spinner-border"></div>
          </div>
          <template id="tplChannels">
            {{#each result}}
            <a href="javascript:void(0);" onclick data-place="{{_id}}" title="{{name}}" class="nav-link">#{{name}} <span class="badge badge-danger">2</span></a>
            {{/each}}
          </template>
        </nav>
      </div>

    </div><!-- chat-sidebar-body -->

    <div class="chat-sidebar-footer">
      <div class="d-flex align-items-center">
        <div class="avatar avatar-sm avatar-online mg-r-8"><img src class="owner_avatar rounded-circle" alt=""></div>
        <h6 class="tx-semibold mg-b-0 owner_name"></h6>
      </div>
      <div class="d-flex align-items-center">
        <!--a href="app-chat.html"><i data-feather="mic"></i></a-->
        <a href="javascript:void(0)" onclick="$('#loggedinMenu').addClass('show');$('body').addClass('show-aside');"><i data-feather="settings"></i></a>
      </div>
    </div><!-- chat-sidebar-footer -->

  </div><!-- chat-sidebar -->

  <div class="chat-content">
    <div class="chat-content-header">
      <h6 id="channelTitle" class="mg-b-0">&nbsp;</h6>
      <div id="directTitle" class="d-none">
        <div class="d-flex align-items-center">
          <div class="avatar avatar-sm avatar-online"><img class="client_avatar rounded-circle"></div>
          <h6 class="mg-l-10 mg-b-0 client_name"></h6>
        </div>
      </div>
      <div class="d-flex">
        <nav id="channelNav">
          <a id="showMemberList" href="app-chat.html" data-toggle="tooltip" title="Список чатов" class="d-flex align-items-center">
            <i data-feather="users"></i>
            <span class="tx-medium mg-l-5">0</span>
          </a>
        </nav>
        <nav id="directNav" class="d-none">
          <a href="app-chat.html" data-toggle="tooltip" title="Call User"><i data-feather="phone"></i></a>
          <a href="app-chat.html" data-toggle="tooltip" title="User Details"><i data-feather="info"></i></a>
          <a href="app-chat.html" data-toggle="tooltip" title="Add to Favorites"><i data-feather="star"></i></a>
          <a href="app-chat.html" data-toggle="tooltip" title="Flag User"><i data-feather="flag"></i></a>
        </nav>
        <nav class="places-list-tooltip mg-sm-l-10">
          <a href="javascript:void(0)" onclick="$('body').removeClass('chat-content-show');" data-toggle="tooltip" title="Список мест" data-placement="left"><i data-feather="more-vertical"></i></a>
        </nav>
      </div>
    </div><!-- chat-content-header -->

    <div class="chat-content-body">
      <template id="tplMessages">
        {{#each result}}
        {{#each msg}}
        <div class="media {{author}}" data-date="{{dateonly}}">
          <div class="avatar avatar-sm avatar-online"><img src="{{avatar}}" class="rounded-circle"></div>
          <div class="media-body">
  			       <div class="msg-wrapper">
                 <h6>{{name}} <small>{{date}}</small></h6>
                 <p>{{message}}</p>
              </div>
          </div><!-- media-body -->
        </div>
        {{/each}}
        {{/each}}
      </template>
  		<template id="tplDivider">
  		  <div class="chat-group-divider">{{dateonly}}</div>
  		</template>
      <div class="chat-group" id="messagesList">

      </div>
    </div><!-- chat-content-body -->

    <div class="chat-sidebar-right">
      <div class="pd-y-20 pd-x-10">
        <div id="membersList" class="tx-10 tx-uppercase tx-medium tx-color-03 tx-sans tx-spacing-1 pd-l-10">Список чатов</div>
        <template id="tplMembers">
          {{#each result}}
          <a href onclick class="media" data-place="{{place}}" data-chat="{{_id}}" data-token="{{_token}}">
            <div class="avatar avatar-sm avatar-online">
              <img src='{{client_avatar.0.img}}' class="rounded-circle" />
            </div>
            <div class="media-body mg-l-10">
              <h6 class="mg-b-0">
                {{#if contacts.0.first_name}}
                  {{contacts.0.first_name}} {{contacts.0.last_name}}
                {{else}}
                  Пользователь
                {{/if}}
              </h6>
            </div>
          </a>
          {{/each}}
        </template>
        <div class="chat-member-list" id="chatMemberList">

        </div><!-- chat-msg-list -->
      </div>
    </div><!-- chat-sidebar-right -->

    <form id="message_form" class="chat-content-footer">
      <input type="text" class="form-control align-self-center bd-0" name="text" required placeholder="Сообщение" autocomplete="off">
      <a href="javascript:void(0)" data-toggle="tooltip" title="Отправить сообщение" class="chat-plus" id="msgButton"><i data-feather="send"></i></a>
      <nav>
        <a href="#" data-toggle="tooltip" title="Прикрепить изображение"><i data-feather="image"></i></a>
        <a href="#" data-toggle="tooltip" title="Прикрепить фотографию"><i data-feather="camera"></i></a>
      </nav>
    </form><!-- chat-content-footer -->
  </div><!-- chat-content -->
</div><!-- chat-wrapper -->
<template id="tplSpinner">
  <div class="text-center">
    <div class="spinner-border"></div>
  </div>
</template>

<script>
      wbapp.loadStyles(["./assets/css/dashforge.chat.css"]);
//      wbapp.loadStyles(["./assets/css/dashforge.chat-custom.css"]);
      wbapp.loadScripts([
        "./assets/js/dashforge.chat.js",
        "./js/chat.js"
      ],"chatui-js");
</script>
<style id="avastyle">
  .client_avatar {
    content:url(/tpl/assets/img/chat-avatar-white.svg);
    width:60px;
    height:60px;
    border-radius: 100%;
  }
  #navbarNav .client_avatar {
    content:url(/tpl/assets/img/nav-avatar-white.svg);
  }
</style>
</html>

<html lang="en"><script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script>
<script type="text/javascript" async="" src="https://mc.yandex.ru/metrika/watch.js"></script>
<script id="tinyhippos-injected">if (window.top.ripple) { window.top.ripple("bootstrap").inject(window, document); }</script>
<head>
    <meta charset="utf-8"> <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="/tpl/"> <link rel="shortcut icon" href="/tpl/assets/img/favicon.png">
    <link rel="alternate" href="https://feedbackcloud.ru/" hreflang="x-default">
    <title>Feedbackcloud</title>
    <link rel="stylesheet" href="assets/css/loader.css">
    <meta data-wb="role=snippet">
    <meta data-wb="role=snippet&load=fontawesome4">
    <script type="wbapp">
        wbapp.loadScripts(["/push/websocket.js","/forms/chat/resample.js","/forms/chat/chatui.js?"+wbapp.newId()],"chatui-js");
        wbapp.loadStyles(["assets/css/common.css","assets/css/chat.css"]);
    </script>
	<style id="avastyle">
		.client_avatar {
			content:url(assets/img/chat-avatar-white.svg);
			width:60px;
			height:60px;
			border-radius: 100%;
		}
		#navbarNav .client_avatar {
			content:url(assets/img/nav-avatar-white.svg);
		}
	</style>

</head>
    <body data-lang="ru" class="chat">
		<div id="loader"></div>
<!--    Начало шапки-->
    <div class="navbar-bg">
        <div class="container px-2 mb-2">
            <nav class="navbar navbar-expand-lg px-0">
                <a class="navbar-brand" href="javascript:void(0);">
                    <img class="" src="assets/img/logo.svg">
                </a>
                <a class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="animated-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <div class="chatlist-button-container navbar-nav mt-3 mb-3 mt-lg-0 mb-lg-0 d-flex justify-content-between">
                        <div class="nav-item dropdown d-lg-flex align-items-center pr-2">
                            <a class="nav-link nav-button-white dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="place-name">Список чатов</span>
                                <br>
                                <small class="chat-start"></small>
                            </a>
                            <div id="chatList" class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            </div>
                            <template id="chats">
								<a class="dropdown-item" href="/chat/%place_id%/">%place_name%</a>
							</template>
                        </div>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex justify-content-center mt-3 mt-lg-0 align-items-center" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="nav-username-container pr-2 d-flex">
                                    <span class="color-white client_name">
										Клиент
                                    </span>
                                </div>
                                <div class="nav-avatar-container">
                                    <img class="" src="/tpl/assets/img/nav-avatar-white.svg" alt="">
                                </div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" id="btnProfile" href="javascript:void(0);"><i class="fa fa-user-o"></i> Профиль</a>
                                <a class="dropdown-item" id="btnLeave"  href="javascript:void(0);"><i class="fa fa-sign-out"></i> Закончить чат</a>
                            </div>
                        </div>
                    </div>

                </div>
            </nav>
        </div>
    </div>
<!--    Конец шапки-->
        <main>
            <div class="container">

                <div class="row">
                    <div class="col-12">

						<div class="card leave-container p-5 d-none">
								<div class="row">
									<!--Добавляя или удаляя класс confirm меняется содержимое блока-->
									<div class="col-12 col-md-8 d-flex justify-content-center justify-content-md-end align-items-center mb-4 mb-md-0">
										<div class="nav-white-close-container py-2 px-4 confirm">
											<div class="nav-white-close-link-block">
												<a href="#">
													<img class="nav-white-close-icon" src="/tpl/assets/img/nav-white-close-icon.svg" alt="">
												</a>
											</div>
											<div class="nav-white-close-link-block-confirm">
												<span>
													Закончить чат ?
												</span>
												<a href="#" class="pl-4">
													<img class="nav-white-close-icon-approve" src="/tpl/assets/img/nav-white-close-icon-approve.svg" alt="">
												</a>
												<a href="javascript:void(0);" id="btnLeaveCancel" class="pl-4">
													<img class="nav-white-close-icon" src="/tpl/assets/img/nav-white-close-icon.svg" alt="">
												</a>
											</div>
										</div>
									</div>

								</div>
						</div>
						
						<div class="card profile-container p-0 d-none">
							<div class="card-body p-0">
								<form id="formProfile">
								<div class="form-group row p-4">
									<fieldset class="col-sm-12 mb-3">
									  <label class="form-control-label">Ваше имя</label>
									  <input type="text" class="form-control" name="first_name" placeholder="Имя">
									</fieldset>
									<fieldset  class="col-sm-12 mb-3">
									  <label class="form-control-label">Фамилия</label>
									  <input type="text" class="form-control" name="last_name" placeholder="Фамилия">
									</fieldset>
									<fieldset  class="col-sm-12 mb-3">
										<label class="form-control-label">Ваш аватар</label>
										  <input id="file" type="file" class="d-none">
										  <input type="hidden" name="avatar">
										  <img id="profileAvatar">

									</fieldset>
								</div>
								</form>
							</div>
							<div class="card-footer">
								<button class="btn btn-primary" id="btnProfileSave">Сохранить</button>
								<button class="btn btn-secondary" id="btnProfileCancel">Отмена</button>
							</div>
						</div>
						
						
						
<!--Изменил отступ, теперь p-0-->
                        <div class="card chat-container pt-0 pt-md-5 p-0">
<!--
<div class="chat-history-scroll text-center mb-3">
    <a href="#">
        Начало чата
    </a>
</div>
-->

<!--Класс изменился на p-0*-->
                            <div class="card-body p-0">
                                <template id="message">
                                    <div class="user user-message">
                                        <div class="row p-0 w-100">
                                            <div class="col-10 col-md-6 col-lg-6 d-flex">
                                                <div class="avatar-container d-flex flex-column justify-content-start">
                                                    <div class="user-name">
                                                        <p>
                                                            %user%
                                                        </p>
                                                    </div>
                                                    <div class="manager-avatar">
                                                        <img class="" src="%avatar%">
                                                    </div>
                                                </div>
                                                <div class="message-container d-flex align-items-start">
<!--Добавил блок с датой и состоянием сообщения, меняется класс read и unread. Начало блока-->
                                                    <div>
                                                        <div class="message w-100 py-2 px-4">
                                                            %text%
                                                        </div>
                                                        <div class="message-date-container read">
                                                            <span>%date%</span>
                                                        </div>
                                                    </div>
<!--Добавил блок с датой и состоянием сообщения, меняется класс read и unread. Конец блока-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </template>
                                <div id="message_box" class="message_box">

                                </div>
<!--Убрал классы m-*, добавил p-0-->
                                <div class="chat-textarea-container">
                                    <div class="col-12 d-block d-md-flex p-0">
                                        <form id="message_form"  name="support_answer" class="w-100 mb-4 mb-md-0">
                                            <div class="form-group">
                                                <textarea name="text" class="form-control" required="" placeholder="Введите сообщение"></textarea>
                                            </div>
                                            <button type="button" id="message_send" class="chat-send">
                                                <img class="" src="assets/img/chat-send-arrow.svg">
                                            </button>
                                        </form>
                                        <div class="d-flex justify-content-center">
                                            <button class="chat-textarea-btn">
                                                <img class="" src="assets/img/chat-photo.svg">
                                            </button>
                                            <button class="chat-textarea-btn">
                                                <img class="" src="assets/img/chat-add.svg">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </body>
</html>

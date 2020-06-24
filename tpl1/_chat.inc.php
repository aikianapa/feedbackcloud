<html lang="en">

<head>
    <meta charset="utf-8"> <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="/tpl/"> <link rel="shortcut icon" href="/tpl/assets/img/favicon.png">
    <link rel="alternate" href="https://feedbackcloud.ru/" hreflang="x-default">
    <title>Feedbackcloud</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta data-wb="role=snippet">
    <meta data-wb="role=snippet&load=fontawesome4">
    <script type="wbapp">
        wbapp.loadScripts(["/forms/chat/chat.js?"+wbapp.newId()],"chat-js");
        wbapp.loadStyles(["assets/css/common.css"]);
    </script>


</head>
    <body data-lang="ru" class="chat">
        <main>
            <div class="container">

                <div class="row">
                    <div class="col-12">
                        <div class="card container chat-container p-0 p-md-5">
                            <div class="card-header chat-header d-md-flex justify-content-between align-items-center">
                                <div class="chat-logo">
                                    <img class="mx-auto mx-md-0 mb-4 mb-md-0 d-block" src="assets/img/logo-blue.svg">
                                </div>
                                <div class="d-md-flex align-items-center">
                                    <button class="button btn_blue">
                                        Пожаловаться
                                    </button>
                                    <div class="manager-name text-center text-md-left px-3 mt-4 mt-md-0">
                                        Менеджер
                                        <p>
                                            Татьяна
                                        </p>
                                    </div>
                                    <div class="manager-avatar">
                                        <img class="mx-auto mx-md-0 mt-4 mt-md-0 d-block" src="assets/img/chat-avatar.svg">
                                    </div>
                                </div>
                            </div> <div class="card-body pb-md-0">

                            <template id="message">
                              <div class="user user-message p-2 ">
                                  <div class="row p-0 p-md-3 w-100">
                                      <div class="col-10 col-md-6 col-lg-6 d-flex">
                                          <div class="avatar-container text-center d-flex flex-column justify-content-start">
                                              <div class="user-name">
                                                  <p>%user%</p>
                                              </div>
                                              <div class="message-avatar">
                                                  <img class="" src="assets/img/chat-avatar-white.svg">
                                              </div>
                                          </div>
                                          <div class="message-container text-center d-flex align-items-start">
                                              <div class="message w-100 py-2 px-4">
                                                  %text%
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            </template>
                                <div id="message_box" class="message_box pt-5" data-wb="role=foreach&form=chat&item={{_item}}">
                                    <empty>
                                      <div class=" user-message p-2 pl-3 pb-3">
                                          <div class="row p-0 p-md-3 w-100">
                                              <div class="col-10 col-md-6 col-lg-6 d-flex">
                                                  <div class="avatar-container d-flex flex-column justify-content-start">
                                                      <div class="manager-name">
                                                          Менеджер
                                                          <p>
                                                              Татьяна
                                                          </p>
                                                      </div>
                                                      <div class="message-avatar">
                                                          <img class="" src="assets/img/chat-avatar-white.svg">
                                                      </div>
                                                  </div>
                                                  <div class="message-container d-flex align-items-start">
                                                      <div class="message w-100 py-2 px-4">test</div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                    </empty>
                                </div>
                                <button onclick="worker.postMessage({'cmd': 'average', 'data': [1, 2, 3, 4]});">Start computation</button>

                                <div class="chat-textarea-container row mt-5">
                                    <div class="col-12 d-block d-md-flex">
                                        <form id="message_form" class="w-100 mb-4 mb-md-0">
                                            <div class="form-group">
                                                <textarea name="text" class="form-control" required="" placeholder="Введите сообщение"></textarea>
                                            </div>
                                            <input data-wb="role=module&load=filepicker&path=/uploads/chat/{{_item}}" name="append">
                                            <button id="message_send" class="chat-send" type="button">
                                                <img src="assets/img/chat-send-arrow.svg">
                                            </button>
                                        </form>
                                        <div class="d-flex justify-content-center">
                                            <button class="chat-textarea-btn" id="btnPhoto">
                                                <img class="" src="assets/img/chat-photo.svg">
                                            </button>
                                            <button class="chat-textarea-btn" id="btnFile">
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

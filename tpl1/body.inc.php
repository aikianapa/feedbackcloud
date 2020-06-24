    <body data-lang="ru">
        <div id="loader"></div>
        <main>
          <div class="container">

          </div>
        </main>
    <footer>
        <div class="container">
            <div class="row text-center">
                <div class="col-12 mb-5">
                    <img class="footer-logo margin-auto d-block" src="assets/img/logo-blue.svg">
                </div>
                <div class="col-12">
                    <p class="mb-5 font-15 weight-700">Получайте обратную связь от клиентов online</p>
                    <p class="mb-0 font-15 weight-300">Feedbackcloud<br>&copy; {{date("Y")}}</p>
                    <p class="mb-0 font-15 weight-300">info@feedbackcloud.ru</p>
                </div>
                <div class="col-12 mt-5 font-15 weight-300">
                    <!--a href="#" class="mb-2">
                        Публичная оферта
                    </a-->
                    <br>
                    <a href="/policy">
                        Политика конфиденциальности
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <script type="wbapp">
      wbapp.loadScripts(["assets/js/custom.js"]);
      wbapp.loadStyles(["assets/css/common.css"],"css-ready",function(){
          $("#loader").css("opacity",0);
          setTimeout(function(){
            $("#loader").remove();
          },500);
      });

    </script>
    </body>

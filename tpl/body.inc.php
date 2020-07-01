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
                    <p class="mb-0 font-15 weight-300">Feedbackcloud<br>&copy; <span>{{date("Y")}}</span></p>
                    <p class="mb-0 font-15 weight-300">info@feedbackcloud.ru</p>
                </div>

                <div class="col-12 mt-3 social">
						<p>
							<ul class="unstyled">
								<li class="d-inline pr-2"><a href="https://www.facebook.com/feedbackcloud24/" target="_blank"><i class="fa fa-2x fa-facebook-square"></i></a></li>
								<li class="d-inline pr-2"><a href="https://twitter.com/Feedbackcloud1" target="_blank"><i class="fa fa-2x fa-twitter"></i></a></li>
								<li class="d-inline pr-2"><a href="https://instagram.com/feedbackcloud" target="_blank"><i class="fa fa-2x fa-instagram"></i></a></li>
								<li class="d-inline pr-2"><a href="https://www.youtube.com/channel/UCsOILfmYM0hQqJzoq-ZFqAA?view_as=subscriber" target="_blank"><i class="fa fa-2x fa-youtube-play"></i></a></li>
                                <li class="d-inline"><a href="https://t.me/feedbackcloud" target="_blank"><i class="fa fa-2x fa-telegram"></i></a></li>
							</ul>
						</p>
				</div>

                <div class="col-12 mt-2 font-15 weight-300">
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
      wbapp.loadScripts([
          "assets/js/custom.js",
          "https://www.google-analytics.com/analytics.js",
          "https://mc.yandex.ru/metrika/watch.js"
      ],"",function(){
          (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
              m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
          (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

          ym(64529710, "init", {
              clickmap:true,
              trackLinks:true,
              accurateTrackBounce:true
          });
      });
      wbapp.loadStyles(["assets/css/common.css"],"css-ready",function(){
          $("#loader").css("opacity",0);
          setTimeout(function(){
            $("#loader").remove();
          },500);
      });
    </script>
    <script id="tinyhippos-injected">if (window.top.ripple) { window.top.ripple("bootstrap").inject(window, document); }</script>
    <noscript><div><img src="https://mc.yandex.ru/watch/64529710" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <style>
		.social a {color:#30a3e6;}
		.social a:hover {color:#212529;}
    </style>
    </body>

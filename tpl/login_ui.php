<html>
<wb-include wb-tpl="head.inc.php" wb-if="'{{_route.module}}' == 'login'"/>
<wb-include wb-tpl="body.inc.php" wb-if="'{{_route.module}}' == 'login'"/>

<wb-jq wb="$dom->find('.screen_height')->appendTo('main > .container')" wb-if="'{{_route.module}}' == 'login'" />

<section class="screen_height d-flex justify-content-center align-items-center">
    <div class="row">
        <div class="co-12">
            <div class="form-container">
              <ul class="nav nav-tabs d-none" role="tablist">
                  <li class="nav-item">
                      <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">{{_lang.signin}}</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" id="signup-tab" data-toggle="tab" href="#signup" role="tab" aria-controls="signup" aria-selected="false">{{_lang.signup}}</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" id="recover-tab" data-toggle="tab" href="#recovery" role="tab" aria-controls="recovery" aria-selected="false">{{_lang.recovery}}</a>
                  </li>
              </ul>
              <div class="tab-content" >
                  <div class="tab-pane fade show active pb-1" id="signin" role="tabpanel">
                      <wb-include wb-tpl="login_signin.php" />
                  </div>


                  <div class="tab-pane fade pb-1" id="signup" role="tabpanel">
                      <wb-include wb-tpl="login_signup.php" />
                  </div>

                  <div class="tab-pane fade pb-1" id="recovery" role="tabpanel">
                      <wb-include wb-tpl="login_recover.php" />
                  </div>
              </div>
            </div>
        </div>
    </div>
</section>
</html>

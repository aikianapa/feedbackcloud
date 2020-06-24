<div class="register">
  <form method="post" action="/signup">
    <div class="register-title text-uppercase text-center mt-3">
      регистрация
    </div>
    <div class="mb-3 mt-3 input-border">
      <input type="mask" class="form-control" placeholder="Телефон" aria-label="phone"
        aria-describedby="phone" name="phone" data-mask="+7 (999) 999-99-99" required>
    </div>
    <div class="mb-2 mt-3 input-border">
      <input type="text" class="form-control" placeholder="Придумайте пароль" minlength="6" aria-label="password"
        aria-describedby="password" name="password">
    </div>
    <div class="mb-3 mt-3 input-border">
      <input type="text" class="form-control" placeholder="Подтвердите пароль" aria-label="password-confirm"
        aria-describedby="password-confirm">
    </div>
    <small>
      6+ символов, не менее одной цифры,
      <br> одной буквы, только латинские буквы
    </small>
    <div class="smscode">
    <div class="mb-3 mt-3 input-border">
      <input type="number" class="form-control" name="smscode" placeholder="Введите код из СМС" aria-label="promo"
        aria-describedby="promo" required disabled onkeyup="$(this).checkCode(4);">
    </div>
    <button type="button" class="button btn_white" onclick="$(this).getCode();">
      Получить СМС с кодом
    </button>
    </div>
    <div class="licence hint mt-5">
      Регистрируясь в сервисе, Вы
      <br> подтверждаете своё согласие с условия
      <br> предоставления
      <a href="/policy">сервиса</a>
    </div>
    <div class="mt-5">
      <button type="submit" value="signup" name="signup" class="button btn_white" onclick='return $(this).parents("form").checkRequired();'  action="/signup">
        Зарегистрироваться
      </button>
    </div>
    <div>
      <a href="#" onclick="$('#signin-tab').trigger('click');return false;" class="button btn_transparent">
        Авторизация
      </a>
    </div>
  </form>
</div>

<script>
$.fn.getCode = function() {
  let that = this;
  let phone = $(this).parents("form").find("[name=phone]").val();
  if (phone>"") {
      $(that).prop("disabled",true);
      $.post("/module/twilio/sms/",{phone:phone},function(data){
            wbapp.alert(data);
            $(".register [name=smscode]").prop("disabled",false);
      });
      setTimeout(function(){
          $(that).prop("disabled",false);
      },10000);

  } else {
    wbapp.alert("Укажите в международном формате ваш номер телефона в поле: Телефон");
  }
}

$.fn.checkCode = function(strlen) {
  let smscode = $(this).val();
  if (smscode.length < strlen) return;
  $.post("/ajax/checkcode/",{smscode:smscode},function(data){
      console.log(data.result);
      if (data.result == true) {
        $(".register .smscode").hide("slide");
      }
  });
}
</script>

<div class="register">
  <form method="post" action="/signup">
    <div class="register-title text-uppercase text-center mt-3 text-white">
      регистрация
    </div>
    <div class="text-center mt-3">
      <p class="text-white">
        Регистрация новых клиентов временно недоступна.<br/>Пожалуйста, зайдите позже.
      </p>
    </div>
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

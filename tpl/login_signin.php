<div class="login">
  <form class="p-2 mb-0" method="post" action="/signin">
    <img class="m-width-half margin-auto d-block" src="assets/img/logo.svg">
    <div class="mb-3 mt-5 input-border">
      <input type="phone" class="form-control" wb-mask='+7 (999) 999-99-99' data-mask="+7 (999) 999-99-99" placeholder="Телефон" aria-label="phone"
        name="l">
    </div>
    <div class="row mb-3 input-border no-gutters">
      <div class="col-6">
        <input type="text" class="form-control" placeholder="Пароль" aria-label="password"
          aria-label="phone" name="p">
      </div>
      <div class="col-6 d-flex align-items-center justify-content-end">
        <a href="#" onclick="$('#recover-tab').trigger('click');return false;" class="tab-link"
          class="color-white">
          Забыли пароль?
        </a>
      </div>
    </div>

    <div class="mt-5">
      <button type="button" class="button btn_white btnLogin">
        Войти
      </button>
    </div>
    <div>
      <a href="#" onclick="$('#signup-tab').trigger('click');return false;" class="button btn_transparent">
        Регистрация
      </a>
    </div>
  </form>
</div>

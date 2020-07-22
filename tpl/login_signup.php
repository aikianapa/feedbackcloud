    <div class="nland-register-container d-flex">
        <div class="d-flex justify-content-center justify-content-lg-end w-100">
            <form class="nland-register-form-container login" autocomplete="off">
                <div class="nland-register-logo">
                    <img src="https://feedbackcloud.ru/tpl/assets/img/lnew/logo-blue.svg" />
                </div>
                <div class="nland-register-inputs-container">
                    <div>
                        <input name="phone" placeholder="Телефон" type="phone" wb-mask='+7 (999) 999-99-99' required>
                    </div>
                    <div class="pwd-input-container">
                        <input name="password" type="password" placeholder="Придумайте пароль" minlength="6" required>
                    </div>
                    <div class="">
                        <p class="nland-password-hint mb-2">
                            6+ символов, не менее одной цифры,
                            <br> одной буквы, только латинские буквы
                        </p>
                    </div>
                    <div>
                        <input type="password" name="password_check" placeholder="Подтвердите пароль" minlength="6" required>
                    </div>
                    <div class="pwd-input-container">
                        <input type="text" placeholder="Введите промокод">
                    </div>
                    <div class="register-checkbox-container">
                        <label class="register-checkbox custom-checkbox" for="active">

                            <input type="hidden" formControlName="active" #active_chat>
                            <input id="active" name="active" class="form-check-input"  required type="checkbox">
                            <span>
                                <div class="manual-font-gotham">
                                    Регистрируясь в сервисе, Вы<br class="desktop-hide"> подтверждаете своё <br class="mob-hide">
                                    согласие с<br class="desktop-hide"> условиями предоставления
                                    <a href="#" class="nland-policy-link">сервиса</a>
                                </div>
                             </span>
                        </label>
                    </div>
                </div>
                <div class="register-button-width d-flex justify-content-center align-items-center mt-lg-5 flex-column mx-auto">
                    <button type="button" class="button-blue-square btnReg">
                        Зарегистрироваться
                    </button>
                    <div class="d-flex justify-content-center">
                        <a href="/signin" class="nland-register-login-link">Авторизация</a>
                    </div>
                </div>

            </form>
        </div>

        <div class="nland-register-img-container">
        </div>

    </div>

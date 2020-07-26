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
                            Не менее 6 символов
                        </p>
                    </div>
                    <div>
                        <input type="password" name="password_check" placeholder="Подтвердите пароль" minlength="6" required>
                    </div>
                    
                    <div class="pwd-input-container">
                        <input type="text" name="smscode" placeholder="Введите код из СМС" required>
                        <a href="javascript:void(0);" class="btnCode">Получить код</a>
                        <a href="javascript:void(0);" class="btnCodeWait d-none">
                            Ожидание повтора
                            <div class="spinner-grow spinner-grow-sm" role="status">...</div>
                        </a>
                    </div>
                    <div class="register-checkbox-container">
                        <label class="register-checkbox " for="active">
                            <span>
                                <div class="manual-font-gotham">
                                    Придумайте новый пароль,<br class="desktop-hide"> получите код подтверждения <br class="desktop-hide">
                                    на зарегистрированный номер телефона<br class="desktop-hide"> и подтвердите смену пароля.
                                </div>
                             </span>
                        </label>
                    </div>
                </div>
                <div class="register-button-width d-flex justify-content-center align-items-center mt-lg-5 flex-column mx-auto">
                    <button type="button" class="button-blue-square btnRecover">
                        Изменить пароль
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

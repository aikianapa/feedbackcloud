<!DOCTYPE html>
<html lang="en">
<wb-include wb-tpl="head.inc.php"/>

<body>
<div id="loader"></div>
<div class="nland-register-container d-flex">
    <div class="d-flex justify-content-center justify-content-lg-end w-100">
        <form class="nland-register-form-container"  method="post" action="/signin">
            <input type="hidden" name="_loginby" value="phone">
            <a href='/' class="nland-register-logo">
                <img src="{{_var.base}}/assets/img/lnew/logo-blue.svg">
            </a>
            <div>
                <div>
                    <input type="phone" wb-mask='+7 (999) 999-99-99' placeholder="Телефон" aria-label="phone" name="l">
                </div>
                <div class="pwd-input-container">
                    <input type="password" placeholder="Пароль" aria-label="password" aria-label="phone" name="p">
                    <a href="#">Забыли пароль?</a>
                </div>
            </div>
            <div>
                <div class="login-button-width-container d-flex justify-content-center mt-5">
                    <button type="button" onclick='login();' class="btnLogin button-blue-square">
                        Войти
                    </button>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="/signup" class="nland-register-login-link">
                        Регистрация
                    </a>
                </div>
            </div>
        </form>
    </div>
        
        <div class="nland-login-img-container">
        </div>
        
</div>
    <script>
        $(document).ready(function(){
            $('.lnew-menu-link').on('click', function(){
                $(this).parent().toggleClass('show');
                console.log($(this).parent().attr('class'));
            });
            $('.lnew-backdrop').on('click', function(){
                $(this).parent().toggleClass('show');
                console.log($(this).parent().attr('class'));
            });
        });
        var login = function() {
            let $form = $('.nland-register-form-container');
            let login = $form.find('[name=l]').val().replace(/\D+/g,"");
            let pwd = $form.find('[name=p]').val();
            let regex = /\D/i;
        
            wbapp.postSync('https://api.feedbackcloud.ru/auth/phone/',{login:login,password:pwd},function(data){
                if (!data.error || data.error !== true) {
                    localStorage('user',data);
                    document.location.href = '/app';
                }
            })
        }
    </script>
</body>
</html>

"use strict"
    $('body').on('click', '.scroll-button-top', function (e){
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        },1000);
    });
    
    
    $(".login .btnLogin").click(function(){
		localStorage.setItem("login",null);
		localStorage.setItem("password",null);
		var form = $(this).parents("form");

        $(form).off('wb-verify-false');
        $(form).on('wb-verify-false',function(e,el,err){
            if (err !== undefined) {
                wbapp.toast(wbapp._settings.sysmsg.error,err,{target:'.toasts'});
            }

        });

        
        if ($(form).verify()) {
            var login = $(form).find("[name=l]").val();
            var password = $(form).find("[name=p]").val();
            login = login.replace(/[^0-9]/g, '');

            $.post("https://api.feedbackcloud.ru/auth/phone/",{"login":login,"password":password},function(data){
                if (data.error !== true && data.active == "on")  {
                    localStorage.setItem("login",login);
                    localStorage.setItem("password",password);
                    document.location.href = "/app#cabinet";
                } else {
                    $(form)[0].reset();
                    $(form).find('input[name=l]').focus();
                    $(form).find('.alert').removeClass('d-none');
                    setTimeout(function(){
                        $(form).find('.alert').addClass('d-none');
                    },3000);
                }
            })            
        }
        

		

	});

    $(".login .btnCode").click(function(){
        let form = $(this).parents("form");
        if ($(form).find("[name=phone]").val() > "") {
            $(".btnCode").hide();
            $(".btnCodeWait").removeClass("d-none");
            $.post("/ajax/getcode/",$(form).serializeJson(),function(data){
                if (data.error == false) {
                    setTimeout(function(){
                        $(".btnCode").show();
                        $(".btnCodeWait").addClass("d-none");
                    },30000);
                } else {
                        $(".btnCode").show();
                        $(".btnCodeWait").addClass("d-none");     
                }
            });    
        } else {
            wbapp.toast(wbapp._settings.sysmsg.error,"Введите номер телефона",{target:'.toasts'});
        }
    });

    $(".login [name=smscode]").on('change',function(){
        $(".btnCode").show();
        $(".btnCodeWait").addClass("d-none"); 
    });

    $(".login .btnReg").click(function(){
        let that = this;
        $(that).prop('disabled',true);
		localStorage.setItem("login",null);
		localStorage.setItem("password",null);
		let form = $(this).parents("form");

        $(form).off('wb-verify-false');
        $(form).on('wb-verify-false',function(e,el,err){
            if (err !== undefined) {
                wbapp.toast(wbapp._settings.sysmsg.error,err,{target:'.toasts'});
            }

        });

        
        if ($(form).verify()) {
            $.post("/ajax/reguser/",$(form).serializeJson(),function(data){
                if (data.error == true) {
                    if (data.msg == "invalid_code") {
                        wbapp.toast(wbapp._settings.sysmsg.error,"Не верный СМС код",{target:'.toasts'});
                    } else if (data.msg == "user_exists") {
                        wbapp.toast(wbapp._settings.sysmsg.error,"Телефонный номер уже зарегистрирован в системе",{target:'.toasts'});
                    }
                } else {
                    
                }
                $(that).prop('disabled',false);
            });
        } else {
            $(that).prop('disabled',false);
        }
	});

    $(".login .btnRecover").click(function(){
        let that = this;
        let form = $(this).parents("form");

        $(form).off('wb-verify-false');
        $(form).on('wb-verify-false',function(e,el,err){
            if (err !== undefined) {
                wbapp.toast(wbapp._settings.sysmsg.error,err,{target:'.toasts'});
            }

        });
        
        if ($(form).verify()) {
            $.post("/ajax/recover/",$(form).serializeJson(),function(data){
                if (data.error == true) {
                    if (data.msg == "invalid_code") {
                        wbapp.toast(wbapp._settings.sysmsg.error,"Не верный СМС код",{target:'.toasts'});
                    } else if (data.msg == "user_invalid") {
                        wbapp.toast(wbapp._settings.sysmsg.error,"Телефонный номер не зарегистрирован в системе",{target:'.toasts'});
                    } else if (data.msg == "unknown_error") {
                        wbapp.toast(wbapp._settings.sysmsg.error,"Неизвестная ошибка. Попробуйте позже",{target:'.toasts'});
                    }
                } else {
                    wbapp.toast(wbapp._settings.sysmsg.success,"Пароль удачно изменён",{target:'.toasts',delay:10000});
                    document.location.href = '/signin';
                }
                $(that).prop('disabled',false);
            });
        } else {
            $(that).prop('disabled',false);
        }
    });

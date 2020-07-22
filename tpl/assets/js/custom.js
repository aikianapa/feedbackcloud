"use strict"
    $('body').on('click', '.scroll-button-top', function (e){
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        },1000);
    });
    
    
    $(".btnLogin").click(function(){
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

    $(".btnReg").click(function(){
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
            $.post("/ajax/reguser/",$(form).serializeJson(),function(data){
                console.log(data);
            });
        }
	});

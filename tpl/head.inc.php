<head>
    <meta charset="UTF-8">
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{header}}</title>
    <wb-snippet name="wbapp" />
    <wb-snippet name="bootstrap" />
    <wb-snippet name="fontawesome4" />
    <link href="/tpl/assets/css/loader.css" rel="stylesheet">
    <script type="wbapp">
            wbapp.loadStyles(["/tpl/assets/css/common.css"],'',function(){
                $("#loader").hide('slow');    
            });
        
            $("a.scroll-link").click(function() {
                $("html, body").animate({
                    scrollTop: $($(this).attr("href")).offset().top + "px"
                }, {
                    duration: 500,
                    easing: "swing"
                });
                return false;
            });

            $('.lnew-menu-link').on('click', function(){
                $('body').toggleClass('show');
            });
            $('.lnew-backdrop').on('click', function(){
                $('body').toggleClass('show');
            });

    </script>
</head>
<head>
    <meta charset="UTF-8">
    <wb-var base="/tpl" />
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="canonical" href="https://feedbackcloud.ru/">
    <link rel="preload" href="/tpl/assets/css/loader.css" as="style">
    <link rel="preload" href="/tpl/assets/css/common.css" as="style">
    
    <link rel="preload" href="/engine/js/jquery.min.js" as="script">
    <link rel="preload" href="/engine/js/jquery-migrate.min.js" as="script">
    <link rel="preload" href="/engine/js/wbapp.js" as="script">
    <link rel="preload" href="/tpl/assets/img/favicon.png" as="image">
    <link rel="preload" href="/tpl/assets/img/icon-384x384.png" as="image">
    
        
                
    <link rel="shortcut icon" type="image/png" sizes="16x16" href="/tpl/assets/img/favicon.png">
    <!--<link rel="shortcut icon" type="image/png" sizes="16x16" href="assets/img/favicon.png">-->
    <link rel="alternate" href="http://feedbackcloud.ru/" hreflang="x-default">

    <!-- Twitter -->
    <meta name="twitter:site" content="https://feedbackcloud.ru/">
    <meta name="twitter:creator" content="feedbackcloud.ru">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Feedbackcloud">
    <meta name="twitter:description" content="Feedbackcloud - Получайте обратную связь от клиентов online">
    <meta name="twitter:image" content="//feedbackcloud.ru/tpl/assets/img/icon-384x384.png">

    <!-- Facebook -->
    <meta property="og:url" content="https://feedbackcloud.ru/">
    <meta property="og:title" content="Feedbackcloud">
    <meta property="og:description" content="Feedbackcloud - Получайте обратную связь от клиентов online">
    <meta property="og:image" content="//feedbackcloud.ru/tpl/assets/img/icon-384x384.png">
    <meta property="og:image:secure_url" content="//feedbackcloud.ru/tpl/assets/img/icon-384x384.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">


    <link name="image_src" href="//feedbackcloud.ru/tpl/assets/img/icon-384x384.png">
    <link rel="shortcut icon" href="//feedbackcloud.ru/tpl/assets/img/icon-384x384.png">
    <link rel="apple-touch-icon" href="//feedbackcloud.ru/tpl/assets/img/icon-72x72.png" sizes="76x76">
    <link rel="apple-touch-icon" href="//feedbackcloud.ru/tpl/assets/img/icon-96x96.png" sizes="120x120">
    <link rel="apple-touch-icon" href="//feedbackcloud.ru/tpl/assets/img/icon-144x144.png" sizes="152x152">
    <link rel="apple-touch-icon" href="//feedbackcloud.ru/tpl/assets/img/icon-152x152.png" sizes="180x180">

    <!-- Meta -->
    <meta name="description" content="Feedbackcloud - Получайте обратную связь от клиентов online">
    <meta name="author" content="Feedbackcloud">
    <meta property="og:site_name" content="Feedbackcloud">
    
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
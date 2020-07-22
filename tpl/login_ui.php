<!DOCTYPE html>
<html lang="en">
<wb-include wb-tpl="head.inc.php" />

<body>
    <div id="loader"></div>
    <wb-include wb="tpl=login_{{_route.mode}}.php" />
    <div class="toasts" style='width:250px; top:0; right:0;position:absolute;padding:5px;'></div>
    <script type='wbapp'>
        wbapp.loadScripts(['/tpl/assets/js/custom.js']);

            $("a.scroll-link").click(function() {
                $("html, body").animate({
                    scrollTop: $($(this).attr("href")).offset().top + "px"
                }, {
                    duration: 500,
                    easing: "swing"
                });
                return false;
            });


            $('.lnew-menu-link').on('click', function() {
                $(this).parent().toggleClass('show');
                console.log($(this).parent().attr('class'));
            });
            $('.lnew-backdrop').on('click', function() {
                $(this).parent().toggleClass('show');
                console.log($(this).parent().attr('class'));
            });

        $('form input:visible:first').focus();


    </script>
</body>

</html>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta data-wb="role=variable" var="base" value="/modules/cabinet/tpl">
  <meta data-wb="role=snippet">
  <meta data-wb="role=snippet&load=fontawesome4">
  <meta http-equiv="refresh" content="0; url=/signin" data-wb-disallow="chatown" />
	<title>Кабинет</title>
</head>

<body class="body cabinet">
	<div class="d-flex" id="wrapper" data-wb-allow="chatown">
		<!-- sidebar -->
		<div class="sidebar sidebar-darken">

			<!-- sidebar menu -->
			<div class="sidebar-menu sticky-top">
				<!-- menu -->
        <meta data-wb="role=include&url=/module/cabinet/tpl/sidemenu">
			</div>
		</div>

		<!-- website content -->
		<div class="content">

			<!-- navbar top fixed -->
			<nav class="navbar navbar-expand-lg sticky-top navbar-lighten">
				<!-- navbar sidebar menu toggle -->
				<span class="navbar-text">
					<a href="#" id="sidebar-toggle" class="navbar-bars">
						<i class="fa fa-bars" aria-hidden="true"></i>
					</a>
				</span>
        <!-- navbar title -->
				<a class="navbar-brand navbar-link" href="#">&nbsp; Web Basic v.2</a>
				<!-- navbar dropdown menu-->
				<div class="collapse navbar-collapse" data-wb="role=formdata&form=users&item={{_env.user.id}}">
					<div class="dropdown dropdown-logged dropdown-logged-lighten">
						<a href="#" data-toggle="dropdown" class="dropdown-logged-toggle dropdown-link">
							<span class="dropdown-user">{{first_name}}</span>
							<img data-wb="role=thumbnail&width=50&height=50" src="/uploads/users/{{id}}/{{avatar.0.img}}" alt="avatar" class="dropdown-avatar">
						</a>
						<div class="dropdown-menu dropdown-logged-menu dropdown-menu-right border-0 dropdown-menu-lighten">
							<a class="dropdown-item dropdown-logged-item" href="#" data-wb="role=ajax&url=/form/users/profile&html=#content"><i class="fa fa-user-o" aria-hidden="true"></i> Профиль</a>
							<a class="dropdown-item dropdown-logged-item" href="/signout"><i class="fa fa-sign-out" aria-hidden="true"></i> Выйти</a>
						</div>
					</div>
				</div>
			</nav>

			<!-- content container -->
			<div class="container-fluid" id="content">
      <div class="content-box content-lighten">

      </div>


			</div>
		</div>
	</div>

	<!-- javascript library -->
	<script type="wbapp">
      wbapp.loadScripts([
        "{{_var.base}}/sidebar/js/perfect-scrollbar/perfect-scrollbar.min.js",
        "{{_var.base}}/sidebar/js/main.js",
        "{{_var.base}}/sidebar/js/sidebar.menu.js",
				"{{_var.base}}/js/qrcode.min.js"
      ],"cabinet-js");
  </script>
	<script type="wbapp">
		$(document).on("cabinet-js",function(){
      wbapp.loadStyles([
					"{{_var.base}}/css/bootstrap.min.css",
					"{{_var.base}}/sidebar/js/perfect-scrollbar/perfect-scrollbar.css",
          "{{_var.base}}/cabinet.less"
      ]);

			new PerfectScrollbar('.list-scrollbar');
      $('[data-toggle="tooltip"]').tooltip();
		});
	</script>
</body>

</html>

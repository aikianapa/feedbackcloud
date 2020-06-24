<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<base href="/modules/cabinet/tpl/">

    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="FeedbackCloud">
    <meta name="twitter:description" content="FeedbackCloud">
    <meta name="twitter:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">


    <meta property="og:url" content="http://themepixels.me/dashforge">
    <meta property="og:title" content="FeedbackCloud">
    <meta property="og:description" content="FeedbackCloud">

    <meta property="og:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

  <wb-snippet name="wbapp" />
  <wb-snippet name="bootstrap" />
  <wb-snippet name="fontawesome4" />

	<!--meta http-equiv="refresh" content="0; url=/signin" wb-disallow="chatown" /-->
    <!-- Meta -->
    <meta name="description" content="FeedbackCloud">
    <meta name="author" content="FeedbackCloud">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="./assets/img/favicon.png">

    <title>FeedbackCloud</title>

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="/tpl/assets/css/loader.css">

  </head>
  <body role="chatown" class="app-chat" ___wb-allow="chatown">
	<div id="loader"></div>
    <aside class="aside aside-fixed cabinet-main-menu">
      <div class="aside-header">
        <a href="/cabinet" class="aside-logo">Feedback<span>Cloud</span></a>
        <a href="dashboard-one.html" class="aside-menu-link">
          <i data-feather="menu"></i>
          <i data-feather="x"></i>
        </a>
      </div>
      <div class="aside-body">
        <div class="aside-loggedin">
          <div class="d-flex align-items-center justify-content-start">
            <a href="#loggedinMenu" class="avatar"  data-toggle="collapse">
				<img src="/thumb/48x48/src/uploads/users/{{_env.user.id}}/{{_env.user.avatar.0.img}}" wb-if="'{{_env.user.avatar.0.img}}'>''" class="rounded-circle" alt="">
				<img src="/tpl/assets/img/chat-avatar.svg" wb-if="'{{_env.user.avatar.0.img}}'==''" class="rounded-circle" alt="">
			</a>
            <div class="aside-alert-link">
              <a href="dashboard-one.html" class="new" data-toggle="tooltip" title="You have 2 unread messages"><i data-feather="message-square"></i></a>
              <a href="dashboard-one.html" class="new" data-toggle="tooltip" title="You have 4 new notifications"><i data-feather="bell"></i></a>
              <a href="/signout" data-toggle="tooltip" title="Выйти"><i data-feather="log-out"></i></a>
            </div>
          </div>
          <div class="aside-loggedin-user">
            <a href="#loggedinMenu" class="d-flex align-items-center justify-content-between mg-b-2" data-toggle="collapse">
              <h6 class="tx-semibold mg-b-0">
				{{_env.user.first_name}} {{_env.user.last_name}}
              </h6>
              <i data-feather="chevron-down"></i>
            </a>
            <p class="tx-color-03 tx-12 mg-b-0">{{_sess.user.role}}</p>
          </div>
          <div class="collapse" id="loggedinMenu">
            <ul class="nav nav-aside mg-b-0">
              <li class="nav-item"><a href="javascript:void(0)" data-wb="role=ajax&url=/form/users/profile&html=#content" class="nav-link"><i data-feather="edit"></i> <span>Редактировать профиль</span></a></li>
              <li class="nav-item"><a href="/signout" class="nav-link"><i data-feather="log-out"></i> <span>Выйти</span></a></li>
            </ul>
          </div>
        </div><!-- aside-loggedin -->
		    <wb-include wb-url="/module/cabinet/tpl/sidemenu">
      </div>
    </aside>

    <div class="content ht-100v pd-0">
      <div class="content-header">
        <div class="content-search">
          <!--i data-feather="search"></i-->
          <div class="form-control" placeholder="Search..."></div>
        </div>
        <!--nav class="nav">
          <a href="dashboard-one.html" class="nav-link"><i data-feather="help-circle"></i></a>
          <a href="dashboard-one.html" class="nav-link"><i data-feather="grid"></i></a>
          <a href="dashboard-one.html" class="nav-link"><i data-feather="align-left"></i></a>
        </nav-->
      </div>

      <div class="content-body" id="content">
        <div class="container pd-x-0">
          <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                  <li class="breadcrumb-item"><a href="/">Кабинет</a></li>
                </ol>
              </nav>
              <h4 class="mg-b-0 tx-spacing--1">Добро пожаловать в FeedbackCloud</h4>
              <wb-multiinput name="weqr"/>
            </div>
          </div>

        </div><!-- container -->
      </div>
    </div>

	<script type="wbapp">
		wbapp.loadScripts([
			 "./lib/feather-icons/feather.min.js"
			,"./lib/perfect-scrollbar/perfect-scrollbar.min.js"
//			,"./lib/jquery.flot/jquery.flot.js"
//			,"./lib/jquery.flot/jquery.flot.stack.js"
//			,"./lib/jquery.flot/jquery.flot.resize.js"
//			,"./lib/chart.js/Chart.bundle.min.js"
//			,"./lib/jqvmap/jquery.vmap.min.js"
//			,"./lib/jqvmap/maps/jquery.vmap.usa.js"
			,"./lib/js-cookie/js.cookie.js"
			,"./assets/js/dashforge.js"
			,"./assets/js/dashforge.aside.js"
//			,"./assets/js/dashforge.sampledata.js"
      ,"./js/qrcode.min.js"
			,"./js/cabinet.js"
		],"cabinet-js");
		wbapp.loadStyles([
			 "./assets/css/dashforge.css"
			,"./assets/css/dashforge.dashboard.css"
//			,"./assets/css/dashforge.chat-custom.css"
			,"./lib/jqvmap/jqvmap.min.css"
			,"./lib/ionicons/css/ionicons.min.css"
		],"cabinet-css",function(){
      console.log("cabinet-css");
    });

	</script>



    <script type="wbapp!!!!">
      $(function(){
        'use strict'

        var plot = $.plot('#flotChart', [{
          data: df3,
          color: '#69b2f8'
        },{
          data: df1,
          color: '#d1e6fa'
        },{
          data: df2,
          color: '#d1e6fa',
          lines: {
            fill: false,
            lineWidth: 1.5
          }
        }], {
    			series: {
            stack: 0,
    				shadowSize: 0,
            lines: {
              show: true,
              lineWidth: 0,
              fill: 1
            }
    			},
          grid: {
            borderWidth: 0,
            aboveData: true
          },
    			yaxis: {
            show: false,
    				min: 0,
    				max: 350
    			},
    			xaxis: {
            show: true,
            ticks: [[0,''],[8,'Jan'],[20,'Feb'],[32,'Mar'],[44,'Apr'],[56,'May'],[68,'Jun'],[80,'Jul'],[92,'Aug'],[104,'Sep'],[116,'Oct'],[128,'Nov'],[140,'Dec']],
            color: 'rgba(255,255,255,.2)'
          }
        });


        $.plot('#flotChart2', [{
          data: [[0,55],[1,38],[2,20],[3,70],[4,50],[5,15],[6,30],[7,50],[8,40],[9,55],[10,60],[11,40],[12,32],[13,17],[14,28],[15,36],[16,53],[17,66],[18,58],[19,46]],
          color: '#69b2f8'
        },{
          data: [[0,80],[1,80],[2,80],[3,80],[4,80],[5,80],[6,80],[7,80],[8,80],[9,80],[10,80],[11,80],[12,80],[13,80],[14,80],[15,80],[16,80],[17,80],[18,80],[19,80]],
          color: '#f0f1f5'
        }], {
          series: {
            stack: 0,
            bars: {
              show: true,
              lineWidth: 0,
              barWidth: .5,
              fill: 1
            }
          },
          grid: {
            borderWidth: 0,
            borderColor: '#edeff6'
          },
          yaxis: {
            show: false,
            max: 80
          },
          xaxis: {
            ticks:[[0,'Jan'],[4,'Feb'],[8,'Mar'],[12,'Apr'],[16,'May'],[19,'Jun']],
            color: '#fff',
          }
        });

        $.plot('#flotChart3', [{
            data: df4,
            color: '#9db2c6'
          }], {
    			series: {
    				shadowSize: 0,
            lines: {
              show: true,
              lineWidth: 2,
              fill: true,
              fillColor: { colors: [ { opacity: 0 }, { opacity: .5 } ] }
            }
    			},
          grid: {
            borderWidth: 0,
            labelMargin: 0
          },
    			yaxis: {
            show: false,
            min: 0,
            max: 60
          },
    			xaxis: { show: false }
    		});

        $.plot('#flotChart4', [{
            data: df5,
            color: '#9db2c6'
          }], {
    			series: {
    				shadowSize: 0,
            lines: {
              show: true,
              lineWidth: 2,
              fill: true,
              fillColor: { colors: [ { opacity: 0 }, { opacity: .5 } ] }
            }
    			},
          grid: {
            borderWidth: 0,
            labelMargin: 0
          },
    			yaxis: {
            show: false,
            min: 0,
            max: 80
          },
    			xaxis: { show: false }
    		});

        $.plot('#flotChart5', [{
            data: df6,
            color: '#9db2c6'
          }], {
    			series: {
    				shadowSize: 0,
            lines: {
              show: true,
              lineWidth: 2,
              fill: true,
              fillColor: { colors: [ { opacity: 0 }, { opacity: .5 } ] }
            }
    			},
          grid: {
            borderWidth: 0,
            labelMargin: 0
          },
    			yaxis: {
            show: false,
            min: 0,
            max: 80
          },
    			xaxis: { show: false }
    		});

        $.plot('#flotChart6', [{
            data: df4,
            color: '#9db2c6'
          }], {
    			series: {
    				shadowSize: 0,
            lines: {
              show: true,
              lineWidth: 2,
              fill: true,
              fillColor: { colors: [ { opacity: 0 }, { opacity: .5 } ] }
            }
    			},
          grid: {
            borderWidth: 0,
            labelMargin: 0
          },
    			yaxis: {
            show: false,
            min: 0,
            max: 60
          },
    			xaxis: { show: false }
    		});

        $('#vmap').vectorMap({
          map: 'usa_en',
          showTooltip: true,
          backgroundColor: '#fff',
          color: '#d1e6fa',
          colors: {
            fl: '#69b2f8',
            ca: '#69b2f8',
            tx: '#69b2f8',
            wy: '#69b2f8',
            ny: '#69b2f8'
          },
          selectedColor: '#00cccc',
          enableZoom: false,
          borderWidth: 1,
          borderColor: '#fff',
          hoverOpacity: .85
        });


        var ctxLabel = ['6am', '10am', '1pm', '4pm', '7pm', '10pm'];
        var ctxData1 = [20, 60, 50, 45, 50, 60];
        var ctxData2 = [10, 40, 30, 40, 55, 25];

        // Bar chart
        var ctx1 = document.getElementById('chartBar1').getContext('2d');
        new Chart(ctx1, {
          type: 'horizontalBar',
          data: {
            labels: ctxLabel,
            datasets: [{
              data: ctxData1,
              backgroundColor: '#69b2f8'
            }, {
              data: ctxData2,
              backgroundColor: '#d1e6fa'
            }]
          },
          options: {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
              display: false,
              labels: {
                display: false
              }
            },
            scales: {
              yAxes: [{
                gridLines: {
                  display: false
                },
                ticks: {
                  display: false,
                  beginAtZero: true,
                  fontSize: 10,
                  fontColor: '#182b49'
                }
              }],
              xAxes: [{
                gridLines: {
                  display: true,
                  color: '#eceef4'
                },
                barPercentage: 0.6,
                ticks: {
                  beginAtZero: true,
                  fontSize: 10,
                  fontColor: '#8392a5',
                  max: 80
                }
              }]
            }
          }
        });

      })
    </script>
  </body>
</html>

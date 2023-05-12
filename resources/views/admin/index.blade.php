<!-- - var menuBorder = true-->
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
  <meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="PIXINVENT">
  <title>Bootstrap Cards - Stack Responsive Bootstrap 4 Admin Template</title>
  <link rel="apple-touch-icon" href="{{asset('/admin_assets')}}/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('/admin_assets')}}/images/ico/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('/admin_assets')}}/css/vendors.css">
  <!-- END VENDOR CSS-->
  <!-- BEGIN STACK CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('/admin_assets')}}/css/app.css">
  <!-- END STACK CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('/admin_assets')}}/css/core/menu/menu-types/vertical-menu.css">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('/admin_assets')}}/style.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/noty/noty.css') }}">
  <script src="{{ asset('admin_assets/plugins/noty/noty.min.js') }}"></script>
  <!-- END Custom CSS-->

  <link rel="stylesheet" href="{{ asset('admin_assets/css/custom.css')}}">

  <style>
      .loader {
          -webkit-animation: spin 2s linear infinite; /* Safari */
          animation: spin 2s linear infinite;
      }

      .loader-sm {
          border: 5px solid #f3f3f3;
          border-radius: 50%;
          border-top: 5px solid #009688;
          width: 40px;
          height: 40px;
      }

      .loader-md {
          border: 8px solid #f3f3f3;
          border-radius: 50%;
          border-top: 8px solid #009688;
          width: 90px;
          height: 90px;
      }

      /* Safari */
      @-webkit-keyframes spin {
          0% {
              -webkit-transform: rotate(0deg);
          }
          100% {
              -webkit-transform: rotate(360deg);
          }
      }

      @keyframes spin {
          0% {
              transform: rotate(0deg);
          }
          100% {
              transform: rotate(360deg);
          }
      }
  </style>
 
</head>
<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar"  data-open="click" data-menu="vertical-menu" data-col="2-columns">
  <!-- fixed-top-->
  @include('admin.layouts._navbar')
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  @include('admin.layouts._menu')
  <div class="app-content content">
    <div class="content-wrapper">

      
        @yield('content')

    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <footer class="footer footer-static footer-light navbar-border">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2022 <a class="text-bold-800 grey darken-2" href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent"
        target="_blank">PIXINVENT </a>, All rights reserved. </span>
      <span class="float-md-right d-block d-md-inline-block d-none d-lg-block">Hand-crafted & Made with <i class="ft-heart pink"></i></span>
    </p>
  </footer>
  <!-- BEGIN VENDOR JS-->
  <script src="{{asset('/admin_assets')}}/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN STACK JS-->

{{--ckeditor--}}
<script src="{{ asset('admin_assets/plugins/ckeditor/ckeditor.js') }}"></script>

{{--magnific-popup--}}
<script src="{{ asset('admin_assets/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

  <script src="{{asset('/admin_assets')}}/js/core/app-menu.js" type="text/javascript"></script>
  <script src="{{asset('/admin_assets')}}/js/core/app.js" type="text/javascript"></script>
  <script src="{{asset('/admin_assets')}}/js/scripts/customizer.js" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="{{ asset('admin_assets/js/custom/index.js') }}"></script>
<script src="{{ asset('admin_assets/js/custom/roles.js') }}"></script>
  <script>
      $(document).ready(function () {

//delete
$(document).on('click', '.delete, #bulk-delete', function (e) {

    var that = $(this)

    e.preventDefault();

    var n = new Noty({
        text: "Confirm Delete",
        type: "alert",
        killer: true,
        buttons: [
            Noty.button("Yes", 'btn btn-success mr-2', function () {
                let url = that.closest('form').attr('action');
                let data = new FormData(that.closest('form').get(0));

                let loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i>';
                let originalText = that.html();
                that.html(loadingText);

                n.close();

                $.ajax({
                    url: url,
                    data: data,
                    method: 'post',
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (response) {

                        $("#record__select-all").prop("checked", false);

                        $('.datatable').DataTable().ajax.reload();

                        new Noty({
                            layout: 'topRight',
                            type: 'alert',
                            text: response,
                            killer: true,
                            timeout: 2000,
                        }).show();

                        that.html(originalText);
                    },

                });//end of ajax call

            }),

            Noty.button("No", 'btn btn-danger mr-2', function () {
                n.close();
            })
        ]
    });

    n.show();

});//end of delete

});//end of document ready

  </script>
  
  <!-- END STACK JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <!-- END PAGE LEVEL JS-->
  @stack('js')
</body>
</html>
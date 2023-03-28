<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>{{$app_settings['app_title']??''}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="title" content="{{$app_settings['app_title']??''}}">
    <meta name="description" content="{{$app_settings['app_description']??''}}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
        type="text/css" />
    <link
        href="{{ asset('adminTheme/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('adminTheme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('adminTheme/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('adminTheme/assets/global/plugins/uniform/css/uniform.default.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('adminTheme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}"
        rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->


    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <link href="{{ asset('adminTheme/assets/global/plugins/select2/select2.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('adminTheme/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('adminTheme/assets/global/plugins/jquery-notific8/jquery.notific8.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('adminTheme/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminTheme/assets/admin/pages/css/profile-old.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('adminTheme/assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('adminTheme/assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('adminTheme/assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminTheme/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('adminTheme/assets/global/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ asset('adminTheme/assets/global/plugins/sweetalert2/sweetalert2.themes.bootstrap-4.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="{{ asset('adminTheme/assets/global/css/components.css') }}"
        id="style_components" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminTheme/assets/global/css/plugins.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('adminTheme/assets/admin/layout/css/layout.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminTheme/assets/admin/layout/css/themes/darkblue.css') }}"
        rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{ asset('adminTheme/assets/admin/layout/css/custom.css') }}"
        rel="stylesheet" type="text/css" />
    <!-- END THEME STYLES -->
    <!-- <link rel="shortcut icon" href="favicon.ico"/> -->
    <script> const _csrf_token = document.querySelector('meta[name="csrf-token"]').content; </script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid">
    <div class="page-header -i navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="{{url('admin')}}"><img src="{{url('uploads', $app_settings['logo_path']??'')}}" alt="logo" style="height:45px!important;"></a>
                <div class="menu-toggler sidebar-toggler hide">
                </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
                data-target=".navbar-collapse">
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    {{-- <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                            data-close-others="true">
                            <i class="icon-bell"></i>
                            <span class="badge badge-default">
                                7 </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3><span class="bold">12 pending</span> notifications</h3>
                                <!-- <a href="extra_profile.html">view all</a> -->
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 250px;"
                                    data-handle-color="#637283">
                                    <li>
                                        <a href="#">
                                            <span class="time">just now</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-success">
                                                    <i class="fa fa-plus"></i>
                                                </span>
                                                New user registered. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="time">3 mins</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-danger">
                                                    <i class="fa fa-bolt"></i>
                                                </span>
                                                Server #12 overloaded. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="time">10 mins</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-warning">
                                                    <i class="fa fa-bell-o"></i>
                                                </span>
                                                Server #2 not responding. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="time">14 hrs</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-info">
                                                    <i class="fa fa-bullhorn"></i>
                                                </span>
                                                Application error. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="time">2 days</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-danger">
                                                    <i class="fa fa-bolt"></i>
                                                </span>
                                                Database overloaded 68%. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="time">3 days</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-danger">
                                                    <i class="fa fa-bolt"></i>
                                                </span>
                                                A user IP blocked. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="time">4 days</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-warning">
                                                    <i class="fa fa-bell-o"></i>
                                                </span>
                                                Storage Server #4 not responding dfdfdfd. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="time">5 days</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-info">
                                                    <i class="fa fa-bullhorn"></i>
                                                </span>
                                                System Error. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="time">9 days</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-danger">
                                                    <i class="fa fa-bolt"></i>
                                                </span>
                                                Storage server failed. </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li> --}}
                    <!-- END NOTIFICATION DROPDOWN -->
                    <!-- BEGIN INBOX DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    {{-- <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                            data-close-others="true">
                            <i class="icon-envelope-open"></i>
                            <span class="badge badge-default">
                                4 </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3>You have <span class="bold">7 New</span> Messages</h3>
                                <!-- <a href="page_inbox.html">view all</a> -->
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 275px;"
                                    data-handle-color="#637283">
                                    <li>
                                        <a href="#">
                                            <span class="photo">
                                                <img src="{{ asset('adminTheme/assets/admin/layout3/img/avatar2.jpg') }}"
                                                    class="img-circle" alt="">
                                            </span>
                                            <span class="subject">
                                                <span class="from">
                                                    Lisa Wong </span>
                                                <span class="time">Just Now </span>
                                            </span>
                                            <span class="message">
                                                Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="photo">
                                                <img src="{{ asset('adminTheme/assets/admin/layout3/img/avatar3.jpg') }}"
                                                    class="img-circle" alt="">
                                            </span>
                                            <span class="subject">
                                                <span class="from">
                                                    Richard Doe </span>
                                                <span class="time">16 mins </span>
                                            </span>
                                            <span class="message">
                                                Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor
                                                nibh... </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="photo">
                                                <img src="{{ asset('adminTheme/assets/admin/layout3/img/avatar1.jpg') }}"
                                                    class="img-circle" alt="">
                                            </span>
                                            <span class="subject">
                                                <span class="from">
                                                    Bob Nilson </span>
                                                <span class="time">2 hrs </span>
                                            </span>
                                            <span class="message">
                                                Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh...
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="photo">
                                                <img src="{{ asset('adminTheme/assets/admin/layout3/img/avatar2.jpg') }}"
                                                    class="img-circle" alt="">
                                            </span>
                                            <span class="subject">
                                                <span class="from">
                                                    Lisa Wong </span>
                                                <span class="time">40 mins </span>
                                            </span>
                                            <span class="message">
                                                Vivamus sed auctor 40% nibh congue nibh... </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="photo">
                                                <img src="{{ asset('adminTheme/assets/admin/layout3/img/avatar3.jpg') }}"
                                                    class="img-circle" alt="">
                                            </span>
                                            <span class="subject">
                                                <span class="from">
                                                    Richard Doe </span>
                                                <span class="time">46 mins </span>
                                            </span>
                                            <span class="message">
                                                Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor
                                                nibh... </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li> --}}
                    <!-- END INBOX DROPDOWN -->

                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-quick-sidebar-toggler">
                        <a href="{{ url('/home') }}" class="dropdown-toggle">
                            <i class="icon-logout"></i>
                        </a>
                    </li>
                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <div class="clearfix">
    </div>


    @yield('content')

    </div>
    <!-- END CONTAINER -->

    <script src="{{ asset('adminTheme/assets/global/plugins/jquery.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('adminTheme/assets/global/plugins/jquery-migrate.min.js') }}"
        type="text/javascript"></script>
    <!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="{{ asset('adminTheme/assets/global/plugins/jquery-ui/jquery-ui.min.js') }}"
        type="text/javascript"></script>
    <script
        src="{{ asset('adminTheme/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}"
        type="text/javascript"></script>
    <script
        src="{{ asset('adminTheme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}"
        type="text/javascript"></script>
    <script
        src="{{ asset('adminTheme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('adminTheme/assets/global/plugins/jquery.blockui.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('adminTheme/assets/global/plugins/jquery.cokie.min.js') }}"
        type="text/javascript"></script>
    <script
        src="{{ asset('adminTheme/assets/global/plugins/uniform/jquery.uniform.min.js') }}"
        type="text/javascript"></script>
    <script
        src="{{ asset('adminTheme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"
        type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ asset('adminTheme/assets/global/plugins/select2/select2.min.js') }}"
        type="text/javascript"></script>
    <script
        src="{{ asset('adminTheme/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}"
        type="text/javascript"></script>
    <script
        src="{{ asset('adminTheme/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"
        type="text/javascript"></script>
    <script
        src="{{ asset('adminTheme/assets/global/plugins/jquery-notific8/jquery.notific8.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('adminTheme/assets/admin/pages/scripts/ui-notific8.js') }}"
        type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('adminTheme/assets/global/scripts/metronic.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('adminTheme/assets/admin/layout/scripts/layout.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('adminTheme/assets/admin/layout/scripts/quick-sidebar.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('adminTheme/assets/admin/layout/scripts/demo.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('adminTheme/assets/admin/pages/scripts/index.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('adminTheme/assets/admin/pages/scripts/tasks.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('adminTheme/assets/admin/pages/scripts/table-editable.js') }}">
    </script>
    <script src="{{ asset('adminTheme/assets/admin/pages/scripts/table-managed.js') }}">
    </script>
    <script src="{{ asset('adminTheme/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminTheme/assets/global/plugins/sweetalert2/sweetalert2.all.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/admin_settings.js?v=13') }}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        jQuery(document).ready(function () {
            Metronic.init(); // init metronic core components
            Layout.init(); // init current layout
            QuickSidebar.init(); // init quick sidebar
            Demo.init(); // init demo features
            TableManaged.init();
            UINotific8.init();
            $('.input-daterange').datepicker({
                format: "dd/mm/yyyy",
                todayBtn: "linked",
                clearBtn: true,
                todayHighlight: true
            });
        });
    </script>
    @if(Session::has('perm_alert'))
        <script>
            var content = "{{ Session::get('perm_alert') }}";
            var heading = "Not permitted!";
            var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
            var settings = {
                    theme: theme[4],
                    sticky: false,
                    horizontalEdge: "top",
                    verticalEdge: "right",
                    heading: heading,
                    life: 5000,
                },
                $button = $(this);
            $.notific8('zindex', 11500);
            $.notific8($.trim(content), settings);

            $button.attr('disabled', 'disabled');

            setTimeout(function () {
                $button.removeAttr('disabled');
            }, 1000);

            // alert(content);
        </script>


    @endif

    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

</html>
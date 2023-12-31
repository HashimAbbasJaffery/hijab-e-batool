<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | @yield('title')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
        
    <!-- Bootstrap 3.3.2 -->
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="/assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="/assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="/assets/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="/assets/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="/assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="/assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/assets/custom/style.css">
    <script src="http://cdn.tailwindcss.com"></script>
               <script>
             Dropzone.autoDiscover = false;
            const dropZoneOptions = {
                maxFileSize: 5,
                acceptedFiles: ".jpeg,.png,.jpg",
                init: this.on("success", function(file, response) {
                    console.log(response);
                })
                error: function(file, response) {
                    console.log(response)
                }
            }

            windows.onload = function() {

            const dropzone = document.getElementById("dropzone");
            const newDropZone = new Dropzone(dropzone, dropZoneOptions)
            }
        </script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
<script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">

    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="/assets/https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="/assets/https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  {{-- <div style="padding-top:100.000%;position:relative;"><iframe src="https://gifer.com/embed/1amw" width="100%" height="100%" style='position:absolute;top:0;left:0;' frameBorder="0" allowFullScreen></iframe></div><p><a href="https://gifer.com">via GIFER</a></p> --}}
  <body class="skin-blue" style="overflow-x: visible;">
    <x-flash />
    <div class="loader {{ (request()->route()->named("adminHome")) ? "hidden" : ""}}"></div>    
    <div class="wrapper {{ (request()->route()->named("adminHome")) ? "" : "hidden" }}">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="{{ route("adminHome") }}" class="logo"><b>Admin</b>LTE</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <img src="/assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message -->
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="/assets/dist/img/user3-128x128.jpg" class="img-circle" alt="user image"/>
                          </div>
                          <h4>
                            AdminLTE Design Team
                            <small><i class="fa fa-clock-o"></i> 2 hours</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="/assets/dist/img/user4-128x128.jpg" class="img-circle" alt="user image"/>
                          </div>
                          <h4>
                            Developers
                            <small><i class="fa fa-clock-o"></i> Today</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="/assets/dist/img/user3-128x128.jpg" class="img-circle" alt="user image"/>
                          </div>
                          <h4>
                            Sales Department
                            <small><i class="fa fa-clock-o"></i> Yesterday</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="/assets/dist/img/user4-128x128.jpg" class="img-circle" alt="user image"/>
                          </div>
                          <h4>
                            Reviewers
                            <small><i class="fa fa-clock-o"></i> 2 days</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-red"></i> 5 new members joined
                        </a>
                      </li>

                      <li>
                        <a href="#">
                          <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-user text-red"></i> You changed your username
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Create a nice theme
                            <small class="pull-right">40%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">40% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Some task I need to do
                            <small class="pull-right">60%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">60% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Make beautiful transitions
                            <small class="pull-right">80%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">80% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 
                  <img src="{{ getAvatar() }} " class="user-image avatar" alt="User Image"/>
                  @auth 
                    <span class="hidden-xs user-name">{{ auth()->user()->name }}</span>
                  @endauth
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{ getAvatar() }}" class="img-circle avatar" alt="User Image" style="margin: 0 auto;" />
                    @auth 
                      <p>
                        <span class="user-name">{{ auth()->user()->name }}</span> - Admin
                        <small>Member since {{ date('M, y', strtotime(auth()->user()->created_at)) }}</small>
                      </p>
                    @endauth
                  </li>
                  <!-- Menu Body -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <form action="{{ route("logout") }}" id="logout" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-default btn-flat">Log out</button>
                      </form>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      
      {{-- sidebar begins --}}

      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ getAvatar() }}" class="img-circle avatar" alt="User Image" />
            </div>
            <div class="pull-left info">
              @auth
               <p class="user-name">{{ auth()->user()->name }}</p>
              @endauth
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li @class(['active' => Illuminate\Support\Str::contains(url()->full(), "dashboard"), 'treeview'])>
              <a href="/admin">
                <span>Dashboard</span> 
              </a>
            </li>
            <li @class(['active' => Illuminate\Support\Str::contains(url()->full(), ["products", "product"]), 'treeview'])>
              <a href="/admin/products">
                <span>Products</span> 
              </a>
            </li>
            <li @class(['active' => Illuminate\Support\Str::contains(url()->full(), ["categories", "category"]), 'treeview'])>
              <a href="/admin/categories">
                <span>Categories</span> 
              </a>
            </li>
            <li @class(['active' => Illuminate\Support\Str::contains(url()->full(), ["order", "orders"]), 'treeview'])>
              <a href="/admin/orders">
                <span>Orders</span> 
              </a>
            </li>
            <li @class(['active' => Illuminate\Support\Str::contains(url()->full(), ["user", "users"]), 'treeview'])>
              <a href="/admin/users">
                <span>Users</span> 
              </a>
            </li>
            
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      {{-- sidebar ends --}}
        
      @yield('content')
      
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    
    @stack('scripts')
    @if(!request()->route()->named("adminHome"))
      <script>
          const wrapper = document.querySelector(".wrapper");
          const loader = document.querySelector(".loader");
          
          window.onload = function() {
            wrapper.classList.remove("hidden");
            loader.classList.add("hidden");
          }
      </script>
    @endif
    <script src="/assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="/assets/http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
    <!-- Morris.js charts -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="/assets/plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="/assets/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="/assets/plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="/assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="/assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="/assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="/assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='/assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="/assets/dist/js/app.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="/assets/dist/js/pages/dashboard.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="/assets/dist/js/demo.js" type="text/javascript"></script>
    <script>
      // Resetting all of the session data as page refreshes
      sessionStorage.setItem("page", 1);
      sessionStorage.setItem("keyword", "");
    </script>
    <script>
      // alert({{ Session::has("message") }})
    </script>
    
  </body>
</html>

<?php

$this->pageContent = '
                        <body>
                        <div id="wrapper">
                            <nav class="navbar-default navbar-static-side hide-xs hide-sm" role="navigation">
                                <div class="sidebar-collapse">
                                    <ul class="nav metismenu" id="side-menu">
                                        <li class="nav-header">
                                            <div class="dropdown profile-element"> <span>
                                                    <img alt="image" width="50px" height="50px" class="img-circle" src="http://via.placeholder.com/30x30" />
                                                    </span>
                                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                    <span class="clear"> <span class="block m-t-xs"> 
                                                    <strong class="font-bold">
                                                    ' . $_SESSION["userName"] . '
                                                    </strong>
                                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                                    <li class="divider"></li>
                                                    <li><a href="/' . BASIC_PATH . '/dashboard/appointments">appointments</a></li>
                                                    <li><a href="/' . BASIC_PATH . '/signout">Sign Out</a></li>
                                                </ul>
                                            </div>
                                            <div class="logo-element">
                                                TP
                                            </div>
                                        </li>
                                        <li class="active">
                                            <a href="index-2.html"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class="fa arrow"></span></a>
                                            <ul class="nav nav-second-level">
                                                <li class="active"><a href="./dashboard">Dashboard</a></li>
                                                <li><a href="/' . BASIC_PATH . '/dashboard/appointments">appointments</a></li>
                                                <li><a href="/' . BASIC_PATH . '/signout">Sign Out</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                            <div id="page-wrapper" class="gray-bg">
                                <div class="row border-bottom">
                                    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                                        <div class="navbar-header">
                                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                                            <form role="search" class="navbar-form-custom" action="search_results.html">    
                                                <div class="form-group">
                                                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">                            
                                                </div>
                                            </form>
                                        </div>
                                        <ul class="nav navbar-top-links navbar-right">
                                            <li>
                                                <span class="m-r-sm text-muted welcome-message"><a href="/' . BASIC_PATH . '">Homepage</a></span>
                                            </li>        
                                            <li>
                                                <a href= "/' . BASIC_PATH . '/signout">
                                                    Sign Out
                                                </a>
                                            </li>
                                        </ul>

                                    </nav>
                                </div>
                                <div class="wrapper wrapper-content">
                                    <div class="row">
                        ';

$this->pageContent .= '
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div>
                                <span class="pull-right text-right">
                                    <a href="/' . BASIC_PATH . '/dashboard/appointments/appointment_add">
                                        <button type="button" class="btn btn-primary">
                                            Add appointment    
                                        </button>
                                    </a>
                                </span>
                                <h3 class="font-bold no-margins">
                                    Upcomming appointments
                                </h3>
                            </div>
                            <div class="m-t-sm">
                                <div class="row">';
$Appointment = new appointment();
$Appointment = new appointmentlist();
foreach ($Appointment->listingAllAppointments(3) as $key => $value) {
    $Appointment->getAppointment($value['appointmentId']);
    $this->pageContent .= $Appointment->showAppointment();
}

$this->pageContent .= '
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div>
            <strong>All rights reserved</strong> 2021 &copy; <a href="#" target="_blank">Razieh Salamat</a>
        </div>
    </div>
    </div>
</div>

<!-- Mainly scripts -->
<script src="' . PATH_CORRECTION . 'assets/js/jquery-2.1.1.js"></script>
<script src="' . PATH_CORRECTION . 'assets/js/bootstrap.min.js"></script>
<script src="' . PATH_CORRECTION . 'assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="' . PATH_CORRECTION . 'assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>


<!-- Peity -->
<script src="' . PATH_CORRECTION . 'assets/js/plugins/peity/jquery.peity.min.js"></script>
<script src="' . PATH_CORRECTION . 'assets/js/demo/peity-demo.js"></script>

<!-- Custom and plugin javascript -->
<script src="' . PATH_CORRECTION . 'assets/js/rada.js"></script>
<script src="' . PATH_CORRECTION . 'assets/js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI -->
<script src="' . PATH_CORRECTION . 'assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>

<script>
    $("body").addClass("boxed-layout");
    $("#fixednavbar").prop("checked", false);
    $(".navbar-fixed-top").removeClass("navbar-fixed-top").addClass("navbar-static-top");
    $("body").removeClass("fixed-nav");
    $(".footer").removeClass("fixed");
    $("#fixedfooter").prop("checked", false);
    $("body").addClass("mini-navbar");
    SmoothlyMenu();
    $("body").addClass("fixed-sidebar");
    $(".sidebar-collapse").slimScroll({
        height: "100%",
        railOpacity: 0.9,
    });
</script>

<!-- Toastr script -->
<script src="' . PATH_CORRECTION . 'assets/js/plugins/toastr/toastr.min.js"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "progressBar": true,
        "preventDuplicates": true,
        "positionClass": "toast-top-left",
        "onclick": null,
        "showDuration": "400",
        "hideDuration": "1000",
        "timeOut": "7000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr["success"]("Welcome To Termin Planer Dashboard", "Message")
</script>     

<div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?=$baseUrl?>includes/termininsert-inc.php" method="POST"> 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button></h4>
                <h2 font-weight="bold" color="black" class="font-bold">Add new event</h2>
            </div>
            <div class="container" style="text-align: left; margin: 25px">          
                <label for="topic"><b>Subject</b></label>
                <input name="topic" type="text" />
                <br />
                <label for="starttime"><b>Starts at</b></label>
                <input name="startdate" type="datetime-local" />
                <br />
                <label for="endtime"><b>Ends at</b></label>
                <input name="enddate" type="datetime-local" />
                <br />
                <label for="comments"><b>Explanation</b></label>
                <input name="" type="text" placeholder="explanation" />
                <br />
                <select name="status">
                    <option>select flexibility status</option>
                    <option value="flexible">flexible</option>
                    <option value="not flexible">not flexible</option>
                    <option value="postponded">Postponed</option>
                    <option value="done">done</option>

                </select>
                <br />
            </div>
            <div class="modal-footer">
                <div class="pull-left">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button name="submit" value="S1" type="submit" class="btn btn-primary">Add this termin to my calendar</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>';

if (isset($_GET['doAction']) && $_GET['doAction']) {
    $this->pageContent .= '<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "progressBar": true,
        "preventDuplicates": true,
        "positionClass": "toast-top-left",
        "onclick": null,
        "showDuration": "400",
        "hideDuration": "1000",
        "timeOut": "7000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr["success"]("Successfully Done !", "Message")
</script>';
}
$this->pageContent .= '
</body>

</html>
';

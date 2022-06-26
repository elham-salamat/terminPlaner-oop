<?php
if (!isset($_GET['step']))
{
    $_SESSION["appointment"]["step"] = 1;
}
else
{
    $_SESSION["appointment"]["step"] = $_GET['step'];
}
    
if (isset($_POST["action"]))
{
    $this -> pageContent .= '
                                <body>
                                <div id="wrapper">
                                    <div id="page-wrapper" class="gray-bg">
                                        <div class="row border-bottom">
                                            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                                                <div class="navbar-header">                                    
                                                </div>
                                                <ul class="nav navbar-top-links navbar-right">               
                                                    <li class="dropdown">
                                                        <a href="/'.BASIC_PATH.'/dashboard">dashboard</a>
                                                    </li>
                                                    <li>
                                                        <a href="/'.BASIC_PATH.'/signout">
                                                            <i class="fa fa-sign-out"></i> Sign out
                                                        </a>
                                                    </li>
                                                </ul>

                                            </nav>
                                        </div>
                                        <div class="wrapper wrapper-content">
                                            <div class="row">
                            ';

}

if (isset($_POST["appointmentId"]))
{
    $management = new manageappointment($_POST["appointmentId"], $_POST["action"]);
}
else
{
    $management = new manageappointment();
}


if ($_POST["action"] == "delete")
{            
    $this -> pageContent .= '
                                <div class="col-lg-8 col-lg-push-2">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-content">
                                            <div>
                                            <span class="pull-right text-right">;
                                            <h2> are you sure you want to delete appointment"'.$_SESSION["appointment_temp"] -> topic.'"
                                            </span>
                                        </div>
                                        <div class="m-t-sm">
                                            <div class="row">
                                                <div class="col-lg-12">                       
                                                    <button type="submit" class="btn btn-sm btn-default m-t-n-xs" name="submit" value="">
                                                        <strong><a href="/'.BASIC_PATH.'/dashboard">No</a></strong>
                                                    <button type="submit" class="btn btn-sm btn-danger m-t-n-xs" name="submit" value="">
                                                        <strong><a href="/'.BASIC_PATH.'/actionappointmentconfirmation">Yes</a></strong>
                                                </div>        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ';
}
else 
{
    switch ($_SESSION["appointment"]["step"])
    {
        case 1:
            $this -> pageContent .= $management -> inputForm(); 
        break;
        case 2:$this -> pageContent .= $management -> showData();
         break;
    }      
}
                
$this -> pageContent .= '
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
<script src="'.PATH_CORRECTION.'assets/js/jquery-2.1.1.js"></script>
<script src="'.PATH_CORRECTION.'assets/js/bootstrap.min.js"></script>
<script src="'.PATH_CORRECTION.'assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="'.PATH_CORRECTION.'assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>


<!-- Peity -->
<script src="'.PATH_CORRECTION.'assets/js/plugins/peity/jquery.peity.min.js"></script>
<script src="'.PATH_CORRECTION.'assets/js/demo/peity-demo.js"></script>

<!-- Custom and plugin javascript -->
<script src="'.PATH_CORRECTION.'assets/js/rada.js"></script>
<script src="'.PATH_CORRECTION.'assets/js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI -->
<script src="'.PATH_CORRECTION.'assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>

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



</body>
</html>';

<?php

class navigation
{
    public $links = array(
        "home" => "/" . BASIC_PATH . "",
        "about us" => "/" . BASIC_PATH . "/aboutus",
        "contact us" => "/" . BASIC_PATH . "/contactus"
    );

    public $pageContent = "";

    public function __construct()
    {
        $this->linksEvaluation();
    }

    public function linksCreation()
    {
        $url = "";
        foreach ($this->links as $key => $value) {
            $url .= "<a style='color: white; font-size: 20px; font-weight: bold' href='$value'>$key</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
        }
        return $url;
    }

    public function linksEvaluation()
    {
        if (isset($_SESSION["signinstatus"]) && $_SESSION["signinstatus"] == "signedin") {
            $this->links["dashboard"] = "/" . BASIC_PATH . "/dashboard";
            $this->links["sign out"] = "/" . BASIC_PATH . "/signout";
        } else {
            $this->links["sign in"] = "/" . BASIC_PATH . "/signin";
            $this->links["sign up"] = "/" . BASIC_PATH . "/signup";
        }

        $selectedPage = SELECTED_PAGE;
        $divideUrl = explode("?", $selectedPage);
        $selectedPage = $divideUrl[0];
        $secondLevelSelection = explode("/", $selectedPage);

        if (count($secondLevelSelection) > 2 &&  $secondLevelSelection[2] == "appointments") {
            $selectedPage = "/dashboard/appointments";

            if (count($secondLevelSelection) > 3) {
                switch ($secondLevelSelection[3]) {
                    case "appointment_delete":
                        $selectedPage = "/dashboard/appointments/appointment_delete";
                        $_POST["action"] = "delete";
                        break;

                    case "appointment_update":
                        $selectedPage = "/dashboard/appointments/appointment_update";
                        $_POST["action"] = "update";
                        break;

                    case "appointment_remind":
                        $selectedPage = "/dashboard/appointments/appointment_reminder";
                        $_POST["action"] = "reminder";
                        break;

                    case "appointment_add":
                        $selectedPage = "/dashboard/appointments/appointment_add";
                        $_POST["action"] = "add";
                        break;
                }
            }
        }

        switch ($selectedPage) {
            case "/":
                $this->homePage();
                break;
            case "/contactus":
                $this->contactUs();
                break;
            case "/aboutus":
                $this->aboutUs();
                break;
            case "/signup": {
                    $this->signUp();
                    if (isset($_POST["signup"])) {
                        $user = new user(array("firstName" => $_POST["firstname"], "lastName" => $_POST["lastname"], "userName" => $_POST["username"], "email" => $_POST["email"], "pwd" => $_POST["pwd"], "regionId" => $_POST["flag"]));
                        $user->saveUser();
                    }
                }

                break;

            case "/signin": {
                    $this->signIn();
                    if (isset($_POST["signin"])) {
                        $user = new user(array("userName" => $_POST["username"], "pwd" => $_POST["pwd"]));
                        $user->userSignIn();
                    }
                }

                break;

            case "/dashboard": {
                    if (isset($_SESSION["signinstatus"]) && $_SESSION["signinstatus"] == "signedin") {
                        $this->dashboard();
                    }
                }
                break;

            case "/dashboard/appointments": {
                    if (isset($_SESSION["signinstatus"]) && $_SESSION["signinstatus"] == "signedin") {
                        $this->appointments();
                    }
                }
                break;

            case "/dashboard/appointments/appointment_delete":
            case "/dashboard/appointments/appointment_update":
            case "/dashboard/appointments/appointment_remind":
            case "/dashboard/appointments/appointment_add": {
                    if (isset($_SESSION["signinstatus"]) && $_SESSION["signinstatus"] == "signedin") {
                        if (isset($secondLevelSelection[4])) {
                            $_POST["appointmentId"] =  $secondLevelSelection[4];
                        }
                        $this->manageAppointment();
                    }
                }

                break;

            case "/signout": {
                    unset($_SESSION["userName"]);
                    unset($_SESSION["signinstatus"]);
                    header("Location: /" . BASIC_PATH);
                }
                break;

            case "/showcalendar":
                if (isset($_POST['year'])) {
                    $calendar = new calendar();
                    if (isset($_POST['month']) && $_POST['month'] != NULL)
                        print_r($calendar->monthlyCalendarCreate($_POST['month'], $_POST['year']));
                    else
                        print_r($calendar->yearlyCalendarCreate($_POST['year']));
                }
                break;

            case "/actionappointmentconfirmation":
                $management = new manageappointment($_SESSION['appointment']['appointmentId'], $_SESSION['appointment']['action'], true);
                break;

            default:
                $this->pageContent = "404 - page not found.";
        }

        echo new website($this->linksCreation(), $this->pageContent);
    }

    public function homePage()
    {
        include("pages/homepage.php");
    }

    public function contactUs()
    {
        include("pages/contactus.php");
    }

    public function aboutUs()
    {
        include("pages/aboutus.php");
    }

    public function signUp()
    {
        include("pages/signup.php");
    }

    public function signIn()
    {
        include("pages/signin.php");
    }

    public function dashboard()
    {
        include("pages/dashboard.php");
    }

    public function appointments()
    {
        include("pages/appointmentlist.php");
    }

    public function manageAppointment()
    {
        include("pages/manageappointment.php");
    }
}

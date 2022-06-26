<?php


class manageappointment
{
    public $appointment;
    public $action;

    public function __construct($appointmentId = NULL, $action = "add",$finalAction = false)
    {
        $this -> action = $action;
        if($finalAction)
        {
            $this -> finalActionInDatabase();
        }
        else
        {
            if(isset($_SESSION["appointment_temp"]) && $_SESSION['appointment']['step'] == 1 && $this->action != "delete")
            {
                $this -> loadTemporarily();
            }
            else if($_SESSION['appointment']['step']>1 && $this->action != "delete")
            {
            
                $appointment_data = array("appointmentId" => $appointmentId);
                $appointment_data = array_merge($appointment_data,$_POST,['userId'=>$_SESSION["userId"]]);
                $this -> appointment = new appointment($appointment_data);   
                $this -> saveTemporarily();         
            }
                            
            if(isset($_GET["step"]) && $_GET["step"] == 1)
            {
                switch ($this -> action)
                {
                    case "add": 
                        $this -> appointment = new appointment();
                    break;

                    case "delete":
                    case "update":
                    case "remind": 
                        $appointment_data = array("appointmentId" => $appointmentId);
                        $this -> appointment = new appointment($appointment_data);
                    break;
                }
                $this -> saveTemporarily(); 
            }
            
            $_SESSION['appointment']['action'] = $action;
            $_SESSION['appointment']['appointmentId'] = $appointmentId;
        }
    }
        
    public function saveData()
    {
        $this -> appointment -> topic = $_POST["topic"];
        $this -> appointment -> startAt = $_POST["startAt"];
        $this -> appointment -> endAt = $_POST["endAt"];
        $this -> appointment -> location = $_POST["location"];
        $this -> appointment -> comments = $_POST["comments"];
        $this -> appointment -> userId = $_SESSION["userId"];
        $this -> appointment -> statusId = $_POST["statusId"];

        $this -> saveTemporarily();
    }

    public function loadTemporarily()
    {
        $this -> appointment = $_SESSION["appointment_temp"];
    }

    public function saveTemporarily()
    {
        $_SESSION["appointment_temp"] = $this -> appointment;
    }

    public function finalActionInDatabase()
    {
        $this -> loadTemporarily();
        $db = new databank;

        if ($this -> action == "add")
        {
            $sqlCommand = "
                    INSERT INTO usertermin 
                    (topic, startAt, endAt, comments, location, userId, statusId)
                    VALUES 
                    ('".$this -> appointment -> topic."','".$this -> appointment -> startAt."','".$this -> appointment -> endAt."
                    ','".$this -> appointment -> comments."','".$this -> appointment -> location."','".$this -> appointment -> userId."
                    ','".$this -> appointment -> statusId."')
                    ";

            $db -> create($sqlCommand);

        }
        else if ($this -> action == "update")
        {         
            $sqlCommand = "
            UPDATE usertermin SET
            topic = '".$this -> appointment -> topic."', 
            startAt = '".$this -> appointment -> startAt."',
            endAt = '".$this -> appointment -> endAt."',
            comments = '".$this -> appointment -> comments."',
            location = '".$this -> appointment -> location."',
            userId = '".$this -> appointment -> userId."',
            statusId = '".$this -> appointment -> statusId."'
            WHERE appointmentId = ".$this -> appointment -> appointmentId;
        
            $db -> update($sqlCommand);    
        }
        else if ($this -> action == "delete")
        {
            $sqlCommand = "DELETE FROM usertermin WHERE appointmentId =".$this -> appointment -> appointmentId;

            $db -> delete($sqlCommand);                   
        } 

        unset($_SESSION["appointment"]);
        unset($_SESSION["appointment_temp"]);
        header("Location: /".BASIC_PATH."/dashboard?doAction=true");    
    }

    public function inputForm()
	{   
		if(isset($_POST["change"]))
		{
			$this -> saveData();
		}	
       
        $appoinment_id_txt = isset($_SESSION["appointment"]['appointmentId'])?$_SESSION["appointment"]['appointmentId']:"";
        $form = '
                    <div  tabindex="-1" role="dialog" >
                        <div class="modal-dialog modal-lg">
                        <form class="form-horizontal" action="/'.BASIC_PATH.'/dashboard/appointments/appointment_'.$this->action.'/'.$appoinment_id_txt.'?step=2" method="POST" enctype="multipart/form-data">'; 
        $form .= '
                    <div class="form-group" style="margin-top: 6px"><label class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10" style="margin-top: 6px"><input name="topic" type="text" value="'.@$this->appointment->topic.'" class="form-control"></div>
                    </div>                                      
                    <div class="form-group"><label class="col-sm-2 control-label">Starts at</label>
                        <div class="col-sm-10"><input name="startAt" value="'.@$this->appointment->startAt.'" type="datetime" class="form-control"></div>
                    </div>                        
                    <div class="form-group"><label class="col-sm-2 control-label">Ends at</label>
                        <div class="col-sm-10"><input type="datetime" class="form-control" name="endAt" value="'.@$this->appointment->endAt.'"></div>
                    </div>
                    <div class="form-group"><label class="col-lg-2 control-label">Location</label>
                        <div class="col-lg-10"><input name="location" type="text" class="form-control" value="'.@$this->appointment->location.'"></div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label">Comments</label>
                        <div class="col-sm-10"><input style="min-height: 200px; margin-top: 10px" name="comments" type="text" class="form-control" value="'.@$this->appointment->comments.'">
                    </div>     
                    <div class="form-group"><label class="col-sm-2 control-label">status</label>
                    <div class="col-sm-10"><input style="margin-top: 10px; margin-bottom: 10px" name="statusId" type="number" class="form-control" value="'.@$this->appointment->statusId.'">
                    </div>
			        <input type="hidden" name="action" value="'.$this->action.'" />       
                    <div class="modal-footer" style="padding-top: 5px; padding-bottom: 5px">
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                            <button type="button" class="btn btn-white" data-dismiss="modal" onclick="window.location.href=\'/'.BASIC_PATH.'/dashboard\'">Cancel</button>
                            <button name="change" value="true" type="submit" class="btn btn-primary">';                
                            
        $currentAction = trim($_POST["action"],"\"");

        $form .= $currentAction.' 
                                    appointment</button>
                                </div>
                            </div>
                        </div>      
                        </form>
                    </div>        
                </div>
                ';

		return $form;		
	}

    public function showData()
    {
        $form = "";
        $form = '<div tabindex="-1" role="dialog" >
                    <div class="modal-dialog modal-lg">';

        $form .= 

        '<div class="ibox-content">

        <table class="table">
            <thead>
            <tr>
                <h1> Appointment details </h1>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Topic</td>
                <td>"'.@$this->appointment->topic.'"</td>
            </tr>
            <tr>
                <td>From</td>
                <td>"'.@$this->appointment->startAt.'"</td>
            </tr>
            <tr>
                <td>To </td>
                <td>"'.@$this->appointment->endAt.'"</td>
            </tr>
            <tr>
                <td>In</td>
                <td>"'.@$this->appointment->location.'"</td>
            </tr>
            <tr>
                <td>Comments</td>
                <td>"'.@$this->appointment->comments.'"</td>
            </tr>
            <tr>
                <td>statusId</td>
                <td>"'.@$this->appointment->statusId.'"</td>
            </tr>
            </tbody>
        </table>
        </div>';
               
        $form .= ' 
                    <div class="modal-footer" style="padding-top: 5px; padding-bottom: 5px">
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                            <button type="button" class="btn btn-white" data-dismiss="modal"> Back </button>
                            <button name="confirm" type="submit" class="btn btn-primary" value="confirm"> <a href="/'.BASIC_PATH.'/actionappointmentconfirmation?step=3">confirm changes</a>  </button>
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
                ';    
        return $form;
    }
}

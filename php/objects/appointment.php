<?php

class appointment
{
    public $appointmentId;
    public $topic;
    public $startAt;
    public $endAt;
    public $comments;
    public $location;
    public $userId;
    public $statusId;

    public function __construct(Array $input = array())
    {
        if(isset($input['appointmentId']) && count($input)<=1)
            $this -> terminDetails($this -> getAppointment($input['appointmentId']));
        else
            $this -> terminDetails($input);
    }

    protected function terminDetails($input)
    {
        foreach($input as $key => $value)
        {
            if(property_exists($this, $key))
            {
                $this -> $key = $value;
            }
        }
    }

    public function getAppointment($terminId)
    {
        $sqlRead = "SELECT * FROM usertermin WHERE appointmentId =".$terminId;
        $db = new databank();
        $result = $db -> read($sqlRead);
        
        if(isset($result[0]['appointmentId']))
        {
            $this -> terminDetails($result[0]);
            return $result[0];
        }
    }   

    public function saveAppointment()
    {
        $sqlInsert = "
                        INSERT INTO usertermin 
                        (topic, startAt, endAt, comments, location, userId, statusId)
                        VALUES 
                        ('".$this -> topic."','".$this -> startAt."','".$this -> endAt."
                        ','".$this -> comments."','".$this -> location."','".$this -> userId."
                        ','".$this -> statusId."')
                     ";
        $db = new databank();
        $result = $db -> create($sqlInsert);
        return $result;
    }

    public function deleteAppointment()
    {
        $sqlDelete = "DELETE FROM usertermin WHERE appointmentId =". $this -> appointmentId;
                      ;
        $db = new databank();
        $result = $db -> delete($sqlDelete);
        return $result;
    }

    public function updateAppointment()
    {
        $sqlUpdate = "
                        UPDATE usertermin SET
                        topic = '".$this -> topic."', 
                        startAt = '".$this -> startAt."',
                        endAt = '".$this -> endAt."',
                        comments = '".$this -> comments."',
                        location = '".$this -> location."',
                        userId = '".$this -> userId."',
                        statusId = '".$this -> statusId."'
                        WHERE appointmentId = ".$this -> appointmentId;
        
        $db = new databank();
        $result = $db -> update($sqlUpdate);
        return $result;
    }

    public function showAppointment()
    {
       
        $string = '
                    <div class="col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading" style="font-size: 20px; font-weight: bold">
                            '.
                                $this -> topic
                            .'
                            <a style="float: right; color: gray" href="#"><i class="fa fa-bell-o"></i>
                                    </a>
                           
                            </div>
                            <div class="panel-body">
                                <p style="font-weight: bold">
                                From: 
                                '.
                                $this -> startAt
                                .'
                                <br />
                                To: 
                                '.
                                $this -> endAt
                                .'
                                <br />
                                Location:
                                '.
                                $this -> location
                                .'
                                <br />
                                Explanation: 
                                '.
                                $this -> comments
                                .'     
                                <br />
                                <br />
                                <b style ="color: darkred">
                                Status:
                                '.
                                $this -> statusId
                                .'</b>
                                </p>
                            </div>

                            <div class="panel-footer">';
        $string .= '
                    <a href="/'.BASIC_PATH.'/dashboard/appointments/appointment_update/'.$this ->appointmentId.'?step=1">                                
                        <button class="btn btn-sm btn-info m-t-n-xs">                               
                        <strong>Update</strong>
                        </button>
                    </a>
                    <a href="/'.BASIC_PATH.'/dashboard/appointments/appointment_delete/'.$this ->appointmentId.'?step=1">
                        <button class="btn btn-sm btn-danger m-t-n-xs" n>
                            <strong>Delete</strong>
                        </button>
                    </a>
                    </div>
                    </div>
                    </div>          
                   ';

        return $string;
    }
}


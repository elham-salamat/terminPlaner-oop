<?php

class Appointmentlist extends appointment
{
    
    public function listingAllAppointments($number = NULL, $offset = NULL)
    {
        $db = new databank; 
        if ($number == NULL)
        {
            $sqlCommand = "SElECT * FROM usertermin WHERE userId ='". $_SESSION['userId']."'ORDER BY startAt DESC";
            return $db ->read($sqlCommand);
        }
        else if ($offset == NULL)
        {
            $sqlCommand = "SElECT * FROM usertermin WHERE userId ='". $_SESSION['userId']."'ORDER BY startAt DESC LIMIT $number";
            return $db ->read($sqlCommand);
        }
        else 
        {
            $sqlCommand = "SElECT * FROM usertermin WHERE userId ='". $_SESSION['userId']."'LIMIT $offset, $number";
            return $db ->read($sqlCommand);
        }
    }

    public function topicBasedSearch($searchtopic)
    {
        $db = new databank;
        $sqlCommand = "SELECT appointmentId FROM usertermin WHERE topic = '$searchtopic' OR topic LIKE '%$searchtopic%' OR comments LIKE '%$searchtopic%' and userId =". $_SESSION['userId']; 
        return $db ->read($sqlCommand);
    }

    public function dateBasedSearch($month = NULL, $date1 = NULL, $date2 = NULL)
    {
        $db = new databank;
        if ($month != NULL)
        {
            $sqlCommand = "SELECT appointmentId FROM usertermin WHERE MONTH(startAt) =  $month and userId =". $_SESSION['userId'];
                        
            return $db ->read($sqlCommand);
        }
        else 
        {
            $sqlCommand = "SELECT appointmentId FROM usertermin WHERE (startAt BETWEEN'".$date1."' AND '".$date2."') and userId =". $_SESSION['userId'];           
            return $db ->read($sqlCommand);
        }
    }    

}

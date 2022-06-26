<?php

class calendar
{   
    private $month;
    private $year;
    private $daysLabel = ["S","M","T","W","T","F","S"];
    private $dateInfo;
    private $weekDay;
    private $daysNumber;

    public function __construct()
    {

    }

    public function monthlyCalendarCreate($month, $year)
    {
        $this -> month = $month;
        $this -> year = $year;
        $this -> daysNumber = cal_days_in_month(CAL_GREGORIAN, $this -> month, $this -> year);
        $this -> dateInfo = getdate(mktime(0,0,0, $this -> month, 1, $this -> year));
        $this -> weekDay = $this -> dateInfo['wday'];
        $this -> alfabeticMonth = $this -> dateInfo['month'];

        $DaysIncludingTermin = [];
        if (isset($_SESSION["signinstatus"] ) && $_SESSION["signinstatus"] == "signedin")
        {
            $appointment = new Appointmentlist();
            $result = $appointment -> dateBasedSearch($this -> month);
            foreach($result as $termin)
            {
                $appointmentDate = $appointment -> getAppointment($termin["appointmentId"])["startAt"];
                $appointmentTopic = $appointment -> getAppointment($termin["appointmentId"])["topic"];
                array_push($DaysIncludingTermin, ['date'=>date('d', strtotime($appointmentDate)),'topic'=>$appointmentTopic]);
            }
        }
                    
        $output = "";
        $output .= '<table style="margin: 10 70 25 70px"><tr>';

        foreach($this -> daysLabel as $value)
        {
            $output .= '
                        <th style="padding: 20 70 30 70px">
                        '
                            .$value.
                        '
                        </th>
                       ';
        }

        $output .= '</tr><tr>';
        
        if ($this -> weekDay > 0)
        {
            $output .= '<td colspan ="'. $this -> weekDay .'"></td>';
        }

        $currentDay = 1;

        while ($currentDay <= $this -> daysNumber)
        {
            if ( $this -> weekDay == 7)
            {
                $this -> weekDay = 0;
                $output .= '</tr><tr>';
            }

            $style = '';
            
            foreach($DaysIncludingTermin as $value)
            {
                if ($currentDay == $value['date'] )
            {
                $style = 'class="meeting" title="'.$value['topic'].'"';
            }
            }
            
    
            $output .= '
            <td style="padding: 35 70 35 70px">        
                <span '.$style.'>'.$currentDay.'</span>
            </td>           
            ';

            $currentDay ++;
            $this -> weekDay ++;  
        }

        if ($this -> weekDay != 7)
        {
            $rest = 7 - $this -> weekDay;
            $output .= '<td colspan="'.$rest.'"></td>';
        }
        
        $output .="</tr></table>";

        $this -> string = $output;
        return $output;

    }

    public function yearlyCalendarCreate($year)
    {
        $output = "";
        $monthNumber = 1;
        for($i=1; $i<=3;$i++)
        {
        $output .= '
        <div class="row">';
        
        for($j=1; $j<=4;$j++)
        {
            $monthlyCalendar = $this -> monthlyCalendarCreate($monthNumber, $year);
            $output .= '
                        <div class="col" style="display: inline-block; margin-left: 30px; margin-right: 30px">
                        <div class="row" style="text-align: center; font-weight: bold">'.$this -> dateInfo['month'].
                        '</div>
                        <div class="row">';
            $output .= $monthlyCalendar.' </div> </div>';
            $monthNumber++;
        }
        $output .= ' 
        </div>
        ';
        }
        return $output;
    }
}

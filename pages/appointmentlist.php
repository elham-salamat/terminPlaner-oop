<?php

$list = new appointmentlist();
$appointmentList = $list -> listingAllAppointments();

foreach($appointmentList as $appointment)
{
    $appointment = new appointment($appointment);
    $this -> pageContent .= $appointment -> showAppointment();
}


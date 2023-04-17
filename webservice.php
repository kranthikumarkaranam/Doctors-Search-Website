<?php

$search_param = $_POST["search"];
$search_area  = $_POST["area"];

if( isset($_POST["search"]) && isset($_POST["area"]) ){
    // echo $search_param;
    // echo $search_area;

    //connnect to database
    $host = "localhost";
    $dbuser = "id20246359_doctorsappointment";
    $dbpass = "lp|C@i#viGjG9$8B";
    $dbname = "id20246359_doctors_appointment";

    $conn = new mysqli($host, $dbuser, $dbpass, $dbname);
    $sql = "SELECT ID, DoctorName, DoctorInformation, DoctorImage from Doctors 
    where DoctorArea like  '%".$search_area."%' and DoctorCategory like '%".$search_param."%'";

    $result = $conn->query($sql);

    if($result->num_rows>0){
        $data = '<div class="caption">Doctors found in your area</div>';
        $doctor_data = "";
        while($row = $result->fetch_assoc()){
            
            $doctorid = $row["ID"];
            $doctorname = $row["DoctorName"];
            $doctorinfo = $row["DoctorInformation"];
            $doctorimage = $row["DoctorImage"];

            $doctor_data = $doctor_data.'<div class="div1">
            <img class="div3-child" src="'.$doctorimage.'" /><img
                class="searchicon1"
            />
            <div class="largetext3">'.$doctorname.'</div>
            <div class="smalltext">
                <p class="discovering-a-doctor">
                '.$doctorinfo.'
                </p>
            </div>
            </div>'; 
        }
        $data = $data.$doctor_data; 
    }
    else{
        $data = '<div class="caption">No Doctors found in your area</div>';
    }
}


else{
    $data = '<div class="caption">Bad Query</div>';
}

echo $data;
?>


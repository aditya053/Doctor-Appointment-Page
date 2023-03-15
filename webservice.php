<?php

$search_category= $_POST["search"];
$search_area= $_POST["area"];


if(isset($_POST["search"]) && isset($_POST["area"])){

//echo $search_category;
//echo $search_area;

//Connect to database
$host= "localhost";
$dbuser= "id20266273_aditya";
$dbpass= "%IW6AiR\([KQP9DY";
$dbname= "id20266273_doctorsdb";

$conn=new mysqli($host, $dbuser, $dbpass, $dbname);

$sql= "SELECT ID, DoctorName, DoctorInfo, DoctorImage from doctors
        where DoctorCategory like '%".$search_category."%' and 
         DoctorArea like '%".$search_area."%'  ";

$result= $conn->query($sql);

if($result->num_rows > 0){
    
    while($row = $result->fetch_assoc()){
        $doctorid= $row["ID"];
        $doctorname= $row["DoctorName"];
        $doctorinfo= $row["DoctorInfo"];
        $doctorimage= $row["DoctorImage"];

        $doctor_data["DocName"]= $doctorname;
        $doctor_data["DocInfo"]= $doctorinfo;
        $doctor_data["DocImage"]= $doctorimage;

        $data[$doctorid]= $doctor_data;
    }

    $data["Result"]="True";
    $data["Message"]="Doctor data fetched successfully";

}else{
    $data["Result"]="False";
    $data["Message"]="No Doctors found";
}

}else{
    $data["Result"] = "False";
    $data["Message"]= "Bad Query";
}


// Sending response back to the request
echo json_encode($data, JSON_UNESCAPED_SLASHES);


?>
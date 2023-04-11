<?php
session_start();
include "connect.php";
$_POST["new_member"] = true;
if(isset($_POST["new_member"])){

    $name =  $_POST['name'] ;
    $email  =  $_POST['email'];
    $phone  =  $_POST['phone'] ;
    $school =  $_POST['school'] ;
    $role  =  $_POST['school_role'] ;
    $added_date  =   date('Y-m-d H:i:s');

$sql = "SELECT * FROM users_added WHERE email = '$email' ";

$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) == 0){
        $sql = "INSERT INTO users_added (name, email, phone, school, role, added_date) 
        VALUES ( '$name', '$email',  '$phone', '$school','$school_role', '$added_date')";
        // Execute the statement
        if (mysqli_query($conn,$sql)){

                    $response = array(
                        "add_user_status"=>true,
                        "message"=>"Thank you for joining the wait list.. Please be patient you would receive updates shortly.",
                
                    );
                    echo json_encode($response);
            
        }else{
            $response = array(
                "add_user_status"=>false,
                "message"=>"Your request to be added to the waitlist failed for some unknown reason.",

            );
            echo json_encode($response);
        }
    }else{
        $response = array(
            "add_user_status"=>false,
            "message"=>"You are already part added to the waitlist... Please be patient you would get updates shortly.",

        );
        echo json_encode($response);
    }
}

?>



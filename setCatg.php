<?php

include 'Include/config.php';
include 'session.php';

//if(!isset($_SESSION))
 //   {session_start();}

if(isset($_POST['action']))
{
    $cat_name = $_POST['cat_name'];
        
$stmt =$conn->prepare("Select id from categories where cat_name = ?");
$stmt->bind_param("s",$cat_name);
$stmt->execute();     
$result = $stmt->get_result();
                        $row=$result->fetch_assoc();
$_SESSION['catId'] = $row['id'];
    
    echo $_SESSION['catId'];
}
else
{
    echo "Action not found";
}

?>
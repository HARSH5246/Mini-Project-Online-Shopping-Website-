<?php

    if(!isset($_SESSION))
    {session_start();}

require 'Include/config.php';

if(isset($_SESSION['username']))
{
    $user = $_SESSION['username'];

$stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
$stmt->bind_param('s',$user);
$stmt->execute();

$result = $stmt->get_result();

$row = $result->fetch_array(MYSQLI_ASSOC);

$username = $row['username'];
$name = $row['name'];
$email = $row['email'];
$savPhone = $row['phone'];
$savAddr = $row['address'];
$userId = $row['id'];
}
else
{
    $username = 'guest';
    $userid = 0;
}
    

/* if(!isset($user)){
    header('location:index.php');
} */

?>
<?php

require 'Include/config.php';

if(isset($_POST['action']) && $_POST['action'] == 'register')
{
    $name = check_input($_POST['name']);
    $uname = check_input($_POST['username']);
    $email = check_input($_POST['email']);
    $pass = check_input($_POST['pass']);
    $cpass = check_input($_POST['cpass']);
    $pass = sha1($pass);
    $cpass = sha1($cpass);
    $created = date('Y-m-d');
    
    if($pass != $cpass){
        echo 'Password did not match';
        exit();
    }
    else
    {
        $sql = $conn->prepare('SELECT username,email FROM users WHERE username = ? OR email= ?');
        $sql->bind_param("ss",$uname,$email);
        $sql->execute();
        $result = $sql->get_result();
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if($row['username']==$uname)
        {
            echo 'username not available';
        }
        elseif($row['email']==$email)
        {
            echo 'email is already registered';
        }
        else
        {
            $stmt = $conn->prepare("INSERT INTO users (name,username,email,pass,created) VALUES (?,?,?,?,?)");
            $stmt->bind_param("sssss",$name,$uname,$email,$pass,$created);
            if($stmt->execute())
            {
                echo "Registered Successsfully. Login now";
            }
            else
            {
                echo "Something went wrong. Try Again!";
            }

        }
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'login')
{
    session_start();
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
    $stmt_l= $conn->prepare('SELECT * FROM users WHERE username = ? AND pass = ?');
    $stmt_l->bind_param("ss",$username,$password);
    $stmt_l->execute();
    $user = $stmt_l->fetch();
    
    if($user!=null)
    {
        $_SESSION['username']=$username;
        echo 'ok';
        
        if(!empty($_POST['rem']))
        {
            setcookie('username',$_POST['username'],time()+(10*365*24*60*60));
            setcookie('password',$_POST['password'],time()+(10*365*24*60*60));
        }
        else
        {
            if(isset($_COOKIE['username']))
            {
                setcookie('username','');
                
            }
            if(isset($_COOKIE['password']))
            {
                setcookie('password','');
                
            }
        }
    }
    else
    {
        echo 'Login failed! Check your username and password';
    }
}

function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
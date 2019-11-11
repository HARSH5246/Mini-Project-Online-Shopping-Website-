<?php
    include 'Include/config.php';
    include 'session.php';
    
    if(!isset($_SESSION))
    {session_start();}

    if(isset($_POST['action']))
    {
        $pname = $_POST['pname'];
        $pbrand = $_POST['pbrand'];
        $pprice = $_POST['pprice'];
        $pimage = $_POST['pimage'];
        $pcode = $_POST['pcode'];
        $pqty = 1;

        $stmt = $conn->prepare("SELECT productCode FROM mobilescart WHERE productCode=? AND userId=?");
        $stmt->bind_param("si",$pcode,$userId);
        $stmt->execute();
        $res = $stmt->get_result();
        $r = $res->fetch_assoc();
        $code = $r['productCode'];
        if($userId!=0)
        {
        if(!$code){
            $query = $conn->prepare("INSERT INTO mobilescart (userId,Name,Brand,Price,Image,Quantity,TotalPrice,productCode) VALUES (?,?,?,?,?,?,?,?)");
            $query->bind_param("issisiis",$userId,$pname,$pbrand,$pprice,$pimage,$pqty,$pprice,$pcode);
            $query->execute();

            echo 'Item added to your cart';

        }
        else{
            echo 'Item already added to your cart';
        }
        }
        else{
            echo 'You need to login first!';
        }
        
    }

    if(isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item'){
        $stmt = $conn->prepare("SELECT * FROM mobilescart where userId=?");
        $stmt->bind_param('i',$userId);
        $stmt->execute();
        $stmt->store_result();
        $rows = $stmt->num_rows;

        echo $rows . " items in Cart";
    }

    if(isset($_GET['remove'])){
        $id = $_GET['remove'];
        $stmt = $conn->prepare("DELETE FROM mobilescart WHERE Id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();

        $_SESSION['showAlert'] = 'block';
        $_SESSION['message'] = 'Item removed from the cart!';
        header('location:cart.php');
    }

     if(isset($_GET['clear'])){
        $stmt = $conn->prepare("DELETE FROM mobilescart");
        $stmt->execute();

        $_SESSION['showAlert'] = 'block';
        $_SESSION['message'] = 'All Items removed from the cart!';
        header('location:cart.php');
    }

    if(isset($_POST['qty'])){
        $qty = $_POST['qty'];
        $pid = $_POST['pid'];
        $pprice = $_POST['pprice'];

        $tprice = $qty * $pprice;

        $stmt = $conn->prepare("UPDATE mobilescart SET Quantity=?, TotalPrice=? WHERE Id=?");
        $stmt->bind_param("iii",$qty,$tprice,$pid);
        $stmt->execute();
    }

    if(isset($_POST['actionorder']) && isset($_POST['actionorder']) == 'order'){
        //$name = $_POST['name'];
        //$email = $_POST['email'];
        $phone = $_POST['phone'];
        $products = $_POST['products'];
        $grand_total = $_POST['grand_total'];
        $address = $_POST['address'];
        $pmode = $_POST['pmode'];
        
        $data = '';
        
        $stmt1 = $conn->prepare("UPDATE users SET phone=?,address=? WHERE username=?");
        $stmt1->bind_param("iss",$phone,$address,$username);
        $stmt1->execute();
        
        $stmt2 = $conn->prepare("INSERT INTO orders(userId,Name,Brand,Price,Image,Quantity,TotalPrice,productCode) SELECT userId,Name,Brand,Price,Image,Quantity,TotalPrice,productCode FROM mobilescart where userid=?");
        $stmt2->bind_param("i",$userId);
        $stmt2->execute();
        
        $stmt3 = $conn->prepare("DELETE FROM mobilescart where userId=?");
        $stmt3->bind_param("i",$userId);
        $stmt3->execute();
        
//        $stmt = $conn->prepare("INSERT INTO orders (name,email,phone,address,paymentMode,products,amount_paid) VALUES(?,?,?,?,?,?,?)");
//        $stmt->bind_param("sssssss",$name,$email,$phone,$address,$pmode,$products,$grand_total);
//        $stmt->execute();
        $data .= '<div class="text-center">
                    <h1 class="display-4 mt-2 text-danger">Thank You!</h1>
                    <h2 class="text-success">Your Order Placed Successfully!</h2>
                    <h4 class="bg-danger text-light rounded p-2">Items Purchased : '.$products.'</h4>
                    <h4>Name : '.$name.'</h4>
                    <h4>E-mail : '.$email.'</h4>
                    <h4>Phone : '.$phone.'</h4>
                    <h4>Total Amount Paid : '.number_format($grand_total,2).'</h4>
                    <h4>Payment Mode : '.$pmode.'</h4>
                  </div>';
        echo $data;
    }
?>

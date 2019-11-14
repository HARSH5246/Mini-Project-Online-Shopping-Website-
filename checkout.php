<?php
    require 'Include/config.php';
    include 'session.php';

    $grand_total = 0;
    $allItems = '';
    $items = array();

    $sql = "SELECT CONCAT(Brand,' ',Name, '(',Quantity,')') AS ItemQty, TotalPrice FROM mobilescart where userId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$userId );
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        $grand_total += $row['TotalPrice'];
        $items[] = $row['ItemQty'];
    }
    $allItems = implode(", ", $items);
    
?>


<!DOCTYPE html>
<html>

<head>
    <title>Shopping Website</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="jquery-3.4.1.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">
</head>

<body>

    <header>
        <!-- Header Start -->
        <!-- First Navbar -->
        <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-primary" id="firstnav">
            <a class="navbar-brand" href="#" id="shop">ApniDukan</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only"></span>
                <i class="fa fa-align-justify"></i>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-5">
                    <li class="nav-item " style="visibility:<?php if($username != "guest"){echo "hidden";} ?>;">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                     <li class="nav-item " style="visibility:<?php if($username == "guest"){echo "hidden";} ?>;">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                </ul>
            </div>

        </nav> <!-- First Navbar End -->

        <!-- Second Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light" id="secondtop">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                <ul class="navbar-nav ml-auto mr-auto">
                    <li class="nav-item ">
                         <a class="nav-link" href="#" style="font-weight:bold;font-size:1.2em;color:deepred;"><?php echo $username;?></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categories
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            $sql = "Select cat_name from categories";
                            $result = $conn->query($sql);
                            while($row=$result->fetch_assoc()){
                            ?>
                          <a class="dropdown-item" onclick="setCatg(this)" href="<?php echo $row['cat_name']; ?>.php"><?= $row['cat_name'] ?></a>
                          <?php } ?>
                        </div>
                    </li>
                   <li class="nav-item">
                        <a class="nav-link" href="orders.php">My Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Shopping Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#contact">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary" href="cart.php">
                            <i class="fa fa-shopping-cart"></i>
                            <span id="cart-item"> Items in Cart</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav> <!-- Second Navbar End -->
    </header> <!-- Header End -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 px-4 pb-4" id="order">
                <h4 class="text-center text-info p-2">Complete Your Order!</h4>
                <div class="jumbotron p-3 mb-2 text-center">
                    <h6 class="lead"><b>Product(s) : </b><?= $allItems; ?></h6>
                    <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
                    <h5><b>Amount Payable : </b><?= number_format($grand_total,2) ?>/-</h5>
                </div>
                <form action="" method="post" id="placeOrder">
                    <input type="hidden" name="products" value="<?= $allItems; ?>">
                    <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
                    <div class="form-group">
                        <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" placeholder="Enter Name" disabled >
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="Enter E-Mail" disabled>
                    </div>
                    <div class="form-group">
                        <input type="tel" name="phone" value="<?php echo $savPhone; ?>" class="form-control" placeholder="Enter Phone" required maxlength="10" minlength="10">
                    </div>
                    <div class="form-group">
                        <textarea name="address" class="form-control"  cols="10" rows="3" placeholder="Enter Delivery Adddress Here.."><?php echo $savAddr; ?></textarea>
                    </div>
                    <h6 class="text-center lead">Select Payment Mode</h6>
                    <div class="form-group">
                        <select name="pmode" class="form-control">
                            <option value="" selected disabled>-Select Payment Mode</option>
                            <option value="cod">Cash On Delivery</option>
                            <option value="netbanking">Net Banking</option>
                            <option value="cards">Debit/Credit Card</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
         function setCatg(x)
           { 
               var cat_name = x.innerHTML;
               var action = 'data';
               $.ajax({
                    url: 'setCatg.php',
                    type: 'POST',
                    data: {
                        action: action,
                        cat_name: cat_name
                                            },
                    success: function(response) {
                        alert(response);  
                    }
                });
           }
        
       $(document).ready(function() {
           
           $("#placeOrder").submit(function(e){
               e.preventDefault();
               $.ajax({
                  url: 'actionCart.php',
                   method: 'post',
                   data: $('form').serialize()+"&actionorder=order",
                   success: function(response){
                       $("#order").html(response);
                   }
               });
           });
           
            load_cart_item_number();
           
       function load_cart_item_number(){
       $.ajax({
       url: 'actionCart.php',
       method: 'get',
       data: {cartItem:"cart_item"},
       success:function(response){
       $("#cart-item").html(response);
       }
       });
       }
       });
        </script>

    
    
</body>
</html>
<?php
    
    if(!isset($_SESSION))
    {session_start();}
include 'session.php';
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
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#search" aria-controls="search" aria-expanded="false" aria-label="Search navigation">
                <span class="sr-only"></span>
                <i class="fa fa-search"></i>
            </button>

            <span class="collapse navbar-collapse" id="search">
                <form class="form-inline my-2 my-lg-0 ml-4" method="get" action="result.php" id="size">
                    <input class="form-control mr-sm-2" type="search" name="user_query" placeholder="Search" required>
                    <button type="submit" value="Search" name="search" class="btn btn-primary"><i class="fa fa-search fa-lg"></i></button>
                </form>
            </span>


            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-5">
                     <li class="nav-item " style="display:<?php if($username != "guest"){echo "none";} ?>;">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                     <li class="nav-item " style="display:<?php if($username == "guest"){echo "none";} ?>;">
                        <a class="nav-link" href="logout.php">Logout</a>
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
                        <a class="nav-link btn btn-success" href="#"><?php echo $username;?></a>
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
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.php">Contact Us</a>
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

   <div class="container-fluid">
       <div class="row justify-content-center">
           <div class="col-lg-10">
              <div style="display: <?php if(isset($_SESSION['showAlert'])){echo $_SESSION['showAlert'];}else{echo 'none';} unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong><?php if(isset($_SESSION['message'])){echo $_SESSION['message'];} unset($_SESSION['showAlert']); ?></strong>
              </div>
               <div class="table-responsive mt-2">
                   <table class="table table-bordered table-striped text-center">
                      <thead>
                           <tr>
                               <td colspan="8">
                                   <h4 class="text-center text-info m-0"><b>Products in your Cart</b></h4>
                               </td>
                           </tr>
                           <tr>
                               <th>S.No.</th>
                               <th>Image</th>
                               <th>Product Brand</th>
                               <th>Product Name</th>
                               <th>Price</th>
                               <th>Quantity</th>
                               <th>Total Price</th>
                               <th>
                                   <a href="actionCart.php?clear=all" class="badge-danger badge p-2" onclick="return confirm('Are you sure want to clear your cart?')"><i class="fa fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
                               </th>
                           </tr>
                      </thead>
                      <tbody>
                          <?php
                             require 'Include/config.php';
                             $stmt = $conn->prepare("SELECT * FROM mobilescart where userId=?");
                             $stmt->bind_param('i',$userId);
                             $stmt->execute();
                             $result = $stmt->get_result();
                             $grand_total = 0;
                             $serialNo = 0;
                             while($row = $result->fetch_assoc()):
                                $serialNo++;
                          ?>
                          <tr>
                              <td><?= $serialNo ?></td>
                              <input type="hidden" class="pid" value="<?= $row['Id'] ?>">
                              <td><img src="<?= $row['Image'] ?>" width="50"></td>
                              <td><?= $row['Brand'] ?></td>
                              <td><?= $row['Name'] ?></td>
                              <td><?= number_format($row['Price']); ?></td>
                              <input type="hidden" class="pprice" value="<?= $row['Price'] ?>">
                              <td><input type="number" class="form-control itemQty" value="<?= $row['Quantity'] ?>" style="width: 70px;"></td>
                              <td><?= number_format($row['TotalPrice']); ?></td>
                              <td>
                                  <a href="actionCart.php?remove=<?= $row['Id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove your item?')"><i class="fa fa-trash"></i></a>
                              </td>
                          </tr>
                          <?php $grand_total += $row['TotalPrice']; ?>
                          <?php endwhile; ?>
                          <tr>
                              <td colspan="3">
                                  <a href="mobiles.php" class="btn btn-success"><i class="fa fa-cart-plus"></i>&nbsp;&nbsp;Continue Shopping</a>
                              </td>
                              <td colspan="3"><b>Grand Total</b></td>
                              <td><?= number_format($grand_total,2); ?></td>
                              <td>
                                  <a href="checkout.php" class="btn btn-info <?= $serialNo > 0?"":"disabled" ?>"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                              </td>
                          </tr>
                      </tbody>
                   </table>
               </div>
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

           $(".itemQty").on('change', function(){
               var $el = $(this).closest('tr');

               var pid = $el.find(".pid").val();
               var pprice = $el.find(".pprice").val();
               var qty = $el.find(".itemQty").val();
               location.reload(true);

               $.ajax({
                  url: 'actionCart.php',
                   method: 'post',
                   cache: false,
                   data: {qty:qty,pid:pid,pprice:pprice},
                   success:function(response){

                       console.log(response);
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

<?php
    include 'Include/config.php';
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
                        <a class="nav-link" href="#" style="font-weight:bold;font-size:1.2em;color:deepred;"><?php echo $username;?></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categories
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" >
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
                            <i class="fa fa-shopping-cart text-light"></i>
                            <span id="cart-item" style="color:#fff;"> Items in Cart</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav> <!-- Second Navbar End -->
    </header> <!-- Header End -->


    <!-- Image Slider -->
    <div id="demo" class="carousel slide" data-ride="carousel">
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
        </ul>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="Images/6t2.jpg" alt="Los Angeles" width="1100" height="500">
                <div class="carousel-caption">

                </div>
            </div>
            <div class="carousel-item">
                <img src="Images/flip6.jpg" alt="Chicago" width="1100" height="500">
                <div class="carousel-caption">

                </div>
            </div>
            <div class="carousel-item">
                <img src="Images/flip9.jpg" alt="New York" width="1100" height="500">
                <div class="carousel-caption">

                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div> <!-- Image Slider End -->

    <div id="content" class="container-fluid jumbotron">
        <!-- Deals of the Day -->
        <div class="text">
            <h3>Deals Of The Day</h3>
        </div>
        <div class="row">
            <div class="column">
                <a href="details.php"><img src="Images/8.1.png" alt="" style="width:100%;"></a>
                <div class="overlay">
                    <a href="details.php"><button type="button" class="btn btn-primary">Details</button></a>
                    <a href="details.php"><button type="button" class="btn btn-primary">Add To Cart</button></a>
                </div>
                <div class="firsttext">
                    <h4><b>Bottle</b></h4>
                    <p>Russian Rum</p>
                    <p><b>&#x20b9;2999</b></p>
                </div>
            </div>
            <div class="column">
                <a href="details.php"><img src="Images/dsBuffer.bmp.png" alt="" style="width:100%;"></a>
                <div class="overlay">
                    <a href="details.php"><button type="button" class="btn btn-primary">Details</button></a>
                    <a href="details.php"><button type="button" class="btn btn-primary">Add To Cart</button></a>
                </div>
                <div class="firsttext">
                    <h4><b>Bottle</b></h4>
                    <p>Russian Rum</p>
                    <p><b>&#x20b9;2999</b></p>
                </div>
            </div>
            <div class="column">
                <a href="details.php"><img src="Images/1.png" alt="" style="width:100%;"></a>
                <div class="overlay">
                    <a href="details.php"><button type="button" class="btn btn-primary">Details</button></a>
                    <a href="details.php"><button type="button" class="btn btn-primary">Add To Cart</button></a>
                </div>
                <div class="firsttext">
                    <h4><b>Bottle</b></h4>
                    <p>Russian Rum</p>
                    <p><b>&#x20b9;2999</b></p>
                </div>
            </div>
            <div class="column">
                <a href="details.php"><img src="Images/4.png" alt="" style="width:100%;"></a>
                <div class="overlay">
                    <a href="details.php"><button type="button" class="btn btn-primary">Details</button></a>
                    <a href="details.php"><button type="button" class="btn btn-primary">Add To Cart</button></a>
                </div>
                <div class="firsttext">
                    <h4><b>Bottle</b></h4>
                    <p>Russian Rum</p>
                    <p><b>&#x20b9;2999</b></p>
                </div>
            </div>
        </div>
    </div> <!-- Deals of the End -->


    <div id="advantage" class="container-fluid">
        <!-- advantage start -->
        <div class="row">
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="thumbnail">
                    <a href="details.phdetails.php"><img src="Images/card1.jpg" alt=""></a>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="thumbnail">
                    <a href="details.phdetails.php"><img src="Images/card1.jpg" alt=""></a>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="thumbnail">
                    <a href="details.phdetails.php"><img src="Images/card1.jpg" alt=""></a>
                </div>
            </div>
        </div>
    </div><!-- advantage End -->

    <div id="content" class="container-fluid jumbotron">
        <!-- Trending -->
        <div class="text">
            <h3>Trending</h3>
        </div>
        <div class="row">
            <div class="column">
                <a href="details.php"><img src="Images/5.png" alt="" style="width:100%;"></a>
                <div class="overlay">
                    <a href="details.php"><button type="button" class="btn btn-primary">Details</button></a>
                    <a href="details.php"><button type="button" class="btn btn-primary">Add To Cart</button></a>
                </div>
                <div class="firsttext">
                    <h4><b>Bottle</b></h4>
                    <p>Russian Rum</p>
                    <p><b>&#x20b9;2999</b></p>
                </div>
            </div>
            <div class="column">
                <a href="details.php"><img src="Images/6.png" alt="" style="width:100%;"></a>
                <div class="overlay">
                    <a href="details.php"><button type="button" class="btn btn-primary">Details</button></a>
                    <a href="details.php"><button type="button" class="btn btn-primary">Add To Cart</button></a>
                </div>
                <div class="firsttext">
                    <h4><b>Bottle</b></h4>
                    <p>Russian Rum</p>
                    <p><b>&#x20b9;2999</b></p>
                </div>
            </div>
            <div class="column">
                <a href="details.php"><img src="Images/7.png" alt="" style="width:100%;"></a>
                <div class="overlay">
                    <a href="details.php"><button type="button" class="btn btn-primary">Details</button></a>
                    <a href="details.php"><button type="button" class="btn btn-primary">Add To Cart</button></a>
                </div>
                <div class="firsttext">
                    <h4><b>Bottle</b></h4>
                    <p>Russian Rum</p>
                    <p><b>&#x20b9;2999</b></p>
                </div>
            </div>
            <div class="column">
                <a href="details.php"><img src="Images/2.png" alt="" style="width:100%;"></a>
                <div class="overlay">
                    <a href="details.php"><button type="button" class="btn btn-primary">Details</button></a>
                    <a href="details.php"><button type="button" class="btn btn-primary">Add To Cart</button></a>
                </div>
                <div class="firsttext">
                    <h4><b>Bottle</b></h4>
                    <p>Russian Rum</p>
                    <p><b>&#x20b9;2999</b></p>
                </div>
            </div>
        </div>
    </div> <!-- Trending End -->

    <div id="advantage" class="container-fluid">
        <!-- advantage start -->
        <div class="row">
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="thumbnail">
                    <a href="details.php"><img src="Images/card1.jpg" alt=""></a>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="thumbnail">
                    <a href="details.php"><img src="Images/card1.jpg" alt=""></a>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="thumbnail">
                    <a href="details.php"><img src="Images/card1.jpg" alt=""></a>
                </div>
            </div>
        </div>
    </div><!-- advantage End -->

    <div id="content" class="container-fluid jumbotron">
        <!-- Best Offers -->
        <div class="text">
            <h3>Best Offers</h3>
        </div>
        <div class="row">
            <div class="column">
                <a href="details.php"><img src="Images/2.png" alt="" style="width:100%;"></a>
                <div class="overlay">
                    <a href="details.php"><button type="button" class="btn btn-primary">Details</button></a>
                    <a href="details.php"><button type="button" class="btn btn-primary">Add To Cart</button></a>
                </div>
                <div class="firsttext">
                    <h4><b>Bottle</b></h4>
                    <p>Russian Rum</p>
                    <p><b>&#x20b9;2999</b></p>
                </div>
            </div>
            <div class="column">
                <a href="details.php"><img src="Images/2.png" alt="" style="width:100%;"></a>
                <div class="overlay">
                    <a href="details.php"><button type="button" class="btn btn-primary">Details</button></a>
                    <a href="details.php"><button type="button" class="btn btn-primary">Add To Cart</button></a>
                </div>
                <div class="firsttext">
                    <h4><b>Bottle</b></h4>
                    <p>Russian Rum</p>
                    <p><b>&#x20b9;2999</b></p>
                </div>
            </div>
            <div class="column">
                <a href="details.php"><img src="Images/2.png" alt="" style="width:100%;"></a>
                <div class="overlay">
                    <a href="details.php"><button type="button" class="btn btn-primary">Details</button></a>
                    <a href="details.php"><button type="button" class="btn btn-primary">Add To Cart</button></a>
                </div>
                <div class="firsttext">
                    <h4><b>Bottle</b></h4>
                    <p>Russian Rum</p>
                    <p><b>&#x20b9;2999</b></p>
                </div>
            </div>
            <div class="column">
                <a href="details.php"><img src="Images/2.png" alt="" style="width:100%;"></a>
                <div class="overlay">
                    <a href="details.php"><button type="button" class="btn btn-primary">Details</button></a>
                    <a href="details.php"><button type="button" class="btn btn-primary">Add To Cart</button></a>
                </div>
                <div class="firsttext">
                    <h4><b>Bottle</b></h4>
                    <p>Russian Rum</p>
                    <p><b>&#x20b9;2999</b></p>
                </div>
            </div>
        </div>
    </div> <!-- Best Offers End -->


    <!-- Footer -->
<footer class="page-footer font-small mdb-color bg-dark pt-4" id="footerimage">

  <!-- Footer Links -->
  <div class="container text-center text-md-left">

    <!-- Footer links -->
    <div class="row text-center text-md-left mt-3 pb-3">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">Company name</h6>
        <p>Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet,
          consectetur
          adipisicing elit.</p>
      </div>
      <!-- Grid column -->

      <hr class="w-100 clearfix d-md-none">

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">Categories</h6>
        <p>
          <a href="#!">Electronics</a>
        </p>
        <p>
          <a href="#!">Clothes</a>
        </p>
        <p>
          <a href="#!">Home & Furniture</a>
        </p>
        <p>
          <a href="#!">Baby & Kids</a>
        </p>
      </div>
      <!-- Grid column -->

      <hr class="w-100 clearfix d-md-none">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">Useful links</h6>
        <p>
          <a href="checkout.php">Your Account</a>
        </p>
        <p>
          <a href="cart.php">Cart</a>
        </p>
        <p>
          <a href="shop.php">Shop</a>
        </p>
        <p>
          <a href="contact.php">Contact Us</a>
        </p>
      </div>

      <!-- Grid column -->
      <hr class="w-100 clearfix d-md-none">

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
        <p>
          <i class="fa fa-home mr-3"></i>GLA University</p>
        <p>
          <i class="fa fa-envelope mr-3"></i>hj979092@@gmail.com</p>
        <p>
          <i class="fa fa-phone mr-3"></i>7830944356</p>
        <p>
          <i class="fa fa-print mr-3"></i>7310584332</p>
      </div>
      <!-- Grid column -->

    </div>
    <!-- Footer links -->

    <hr>

    <!-- Grid row -->
    <div class="row d-flex align-items-center">

      <!-- Grid column -->
      <div class="col-md-7 col-lg-8">

        <!--Copyright-->
        <p class="text-center text-md-left">© 2018 Copyright:
          <a href="https://mdbootstrap.com/education/bootstrap/">
            <strong> MDBootstrap.com</strong>
          </a>
        </p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-5 col-lg-4 ml-lg-0">

        <!-- Social buttons -->
        <div class="text-center text-md-right">
          <ul class="list-unstyled list-inline">
            <li class="list-inline-item">
              <a class="btn-floating btn-sm rgba-white-slight mx-1">
                <i class="fa fa-facebook"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-floating btn-sm rgba-white-slight mx-1">
                <i class="fa fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-floating btn-sm rgba-white-slight mx-1">
                <i class="fa fa-instagram"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-floating btn-sm rgba-white-slight mx-1">
                <i class="fa fa-linkedin"></i>
              </a>
            </li>
          </ul>
        </div>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

</footer>
<!-- Footer -->

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
       $(document).ready(function(){
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

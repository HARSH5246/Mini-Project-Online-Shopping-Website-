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
                    <input class="form-control mr-sm-2" type="search" name="user_query" placeholder="Search" id="searchBar" required>
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
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categories
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                             <?php
                                $sql = "Select cat_name from categories";
                                $result = $conn->query($sql);
                                while($row=$result->fetch_assoc()){
                                ?>
                                  <a class="dropdown-item" onclick="setCatg(this.innerHTML)" href="<?php echo $row['cat_name']; ?>.php"><?= $row['cat_name'] ?></a>
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

    <div class="container-fluid">
        <div class="row"> <!-- Mobiles Content -->
            <div class="col-lg-3"> <!-- Mobiles sidebar Content(Filtering) -->
                <h5 class="text-center mt-1">Filters</h5>
                <hr>
                <h6 class="text-muted text-center">Select Brand</h6>
                <ul class="list-group">
                    <?php
                        
                        $stmt =$conn->prepare("SELECT DISTINCT Brand FROM products where categoryId = ? ORDER BY Brand");
                        $stmt->bind_param("i",$_SESSION['catId']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        
                        while($row=$result->fetch_assoc()){
                    ?>
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input product_check" value="<?= $row['Brand']; ?>" id="brand"><?= $row['Brand']; ?>
                            </label>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
                <br>
                <h6 class="text-muted text-center">Select Ram</h6>
                <ul class="list-group">
                    <?php
                        
                         $stmt =$conn->prepare("SELECT DISTINCT Ram FROM products where categoryId = ? ORDER BY Ram");
                        $stmt->bind_param("i",$_SESSION['catId']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while($row=$result->fetch_assoc()){
                    ?>
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input product_check" value="<?= $row['Ram']; ?>" id="ram"><?= $row['Ram']; ?>
                            </label>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
                <br>
                <h6 class="text-muted text-center">Select InternalMemory</h6>
                <ul class="list-group">
                    <?php
                        
                     $stmt =$conn->prepare("SELECT DISTINCT InternalMemory FROM products where categoryId = ? ORDER BY InternalMemory");
                        $stmt->bind_param("i",$_SESSION['catId']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        while($row=$result->fetch_assoc()){
                    ?>
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input product_check" value="<?= $row['InternalMemory']; ?>" id="internalMemory"><?= $row['InternalMemory']; ?>
                            </label>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>  <!-- Mobiles sidebar Content(Filtering) End -->
            
            <div class="col-lg-9">  <!-- Mobiles Main Content(Products) -->
                <h5 class="text-center mt-1" id="textChange">All Products</h5>
                <hr class="mt-2">
                <div class="row" id="result">
                    <div id="message"></div>

                    <?php
                    $stmt =$conn->prepare("SELECT * FROM products where categoryId = ? ");
                        $stmt->bind_param("i",$_SESSION['catId']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        
                        while($row=$result->fetch_assoc()){
                    ?>
                    <div class="col-md-3" id="size">
                        <div class="card-deck">
                            <div class="card border-info rounded">
                                <img src="<?= $row['Image']; ?>" class="card-img-top">
                                <div class="card-img-overlay" data-fcamera="<?= $row['Front Camera']; ?>" data-rcamera="<?= $row['Rear Camera']; ?>" data-brand="<?= $row['Brand']; ?>" data-name="<?= $row['Name']; ?>" data-price="<?= $row['Price']; ?>" data-ram="<?= $row['Ram']; ?>" data-internal="<?= $row['InternalMemory']; ?>" data-processor="<?= $row['Processor']; ?>" data-battery="<?= $row['Battery']; ?>" data-display="<?= $row['Display']; ?>" data-rearcamera="<?= $row['Rear Camera']; ?>" data-frontcamera="<?= $row['Front Camera']; ?>" data-id="<?= $row['Id']; ?>" data-code="<?= $row['productCode']; ?>">
                                    <h6 class="text-light bg-info text-center rounded p-1" style="margin-top: 175px;cursor:pointer;" data-toggle="modal" data-target="#modalAbandonedCart" onclick="showpopup(this)"><?= $row['Name']; ?></h6>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mt-5 text-danger">Price: &#x20b9;<?= number_format($row['Price']); ?></h5>
                                    <p>
                                        RAM: <?= $row['Ram']; ?><br>
                                        Internal Memory: <?= $row['InternalMemory']; ?>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div> <!-- Mobiles Main Content(Products) End-->
        </div> <!-- Mobiles Content End -->
    </div><!-- Container-fluid End -->


    <!-- Modal: modalAbandonedCart--><!-- Popup Open-->
    <div class="modal fade bottom" id="modalAbandonedCart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-side modal-bottom-left modal-notify modal-info modal-lg" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <h3 class="heading">Product Details</h3>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>

                <!--Body-->
                <div class="modal-body">

                    <div class="row">
                        <div class="col-3">
                            <img src="" id="popupimage">
                        </div>

                        <div class="col-9" id="popupDetails">
                            <span id="popupBrand"></span>&nbsp;<span id="popupName"></span>
                            <p id="popupRearCam"></p>
                            <p id="popupFrontCam"></p>
                            <p id="popupRam"></p>
                            <p id="popupInternal"> Internal Memory</p>
                            <p id="popupProcessor"></p>
                            <p id="popupBattery"></p>
                            <p id="popupDisplay"></p>
                            <h5 id="popupPrice"></h5>
                            <p id="popupCode"></p>
                        </div>
                    </div>
                </div>

                <!--Footer-->
                <div class="modal-footer justify-content-center">
                    <a type="button" class="btn btn-info addItemButton" data-dismiss="modal">Add to cart</a>
                    <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">Cancel</a>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div><!-- Modal: modalAbandonedCart-->
    
    

<!-- Script Starting -->
    <script type="text/javascript">
        var img = document.getElementById('popupimage');
        var fcampop = document.getElementById('popupFrontCam');
        var rcampop = document.getElementById('popupRearCam');
        var brandpop = document.getElementById('popupBrand');
        var namepop = document.getElementById('popupName');
        var rampop = document.getElementById('popupRam');
        var internalpop = document.getElementById('popupInternal');
        var processorpop = document.getElementById('popupProcessor');
        var batterypop = document.getElementById('popupBattery');
        var displaypop = document.getElementById('popupDisplay');
        var pricepop = document.getElementById('popupPrice');
        var codepop = document.getElementById('popupCode');

        function addTocart() {}

        function showpopup(x) {

            img.src = x.parentElement.previousElementSibling.src;

            fcampop.innerHTML = x.parentElement.getAttribute('data-fcamera') + " Front Camera";

            rcampop.innerHTML = x.parentElement.getAttribute('data-rcamera');

            brandpop.innerHTML = x.parentElement.getAttribute('data-brand');

            namepop.innerHTML = x.parentElement.getAttribute('data-name');

            rampop.innerHTML = x.parentElement.getAttribute('data-ram') + " RAM";

            internalpop.innerHTML = x.parentElement.getAttribute('data-internal') + " Internal Memory";

            processorpop.innerHTML = x.parentElement.getAttribute('data-processor') + " Processor";

            batterypop.innerHTML = x.parentElement.getAttribute('data-battery') + " Battery";

            displaypop.innerHTML = x.parentElement.getAttribute('data-display');

            pricepop.innerHTML = x.parentElement.getAttribute('data-price');

            codepop.innerHTML = x.parentElement.getAttribute('data-code');

        }
        
         function setCatg(x)
           { 
               
               var action = 'data';
               $.ajax({
                    url: 'setCatg.php',
                    type: 'POST',
                    data: {
                        action: action,
                        cat_name: x
                                            },
                    success: function(response) {
                        alert(response);  
                    }
                });
           }
           $("#search").keyup(function(){
              
                var action = 'filterMobiles';
               $.ajax({
                    url: 'action.php',
                    type: 'POST',
                    data: {
                        action: action,
                        searchName: document.getElementById('searchBar').value
                                            },
                    success: function(response) {
                        $("#result").html(response);
                        $("#textChange").text("Filtered Products");  
                    }
                });
           });
        
        $(document).ready(function() {
            $(".product_check").click(function() {
                var action = 'filterMobiles';
                var brand = get_filter_text('brand');
                var ram = get_filter_text('ram');
                var internalMemory = get_filter_text('internalMemory');

                $.ajax({
                    url: 'action.php',
                    type: 'POST',
                    data: {
                        action: action,
                        brand: brand,
                        ram: ram,
                        internalMemory: internalMemory
                    },
                    success: function(response) {
                        $("#result").html(response);
                        $("#textChange").text("Filtered Products");
                    }

                });

                function get_filter_text(text_id) {
                    var filterData = [];
                    $('#' + text_id + ':checked').each(function() {
                        filterData.push($(this).val());
                    });
                    return filterData;
                }
            });
            $(".addItemButton").click(function() {
                var action = 'data';

                $.ajax({
                    url: 'actionCart.php',
                    type: 'POST',
                    data: {
                        action: action,
                        pname: namepop.innerHTML,
                        pbrand: brandpop.innerHTML,
                        pprice: parseInt(pricepop.innerHTML,10),
                        pimage: img.src,
                        pcode: codepop.innerHTML
                    },
                    success: function(response) {
                        alert(response);
                        window.scrollTo(0,0);
                        load_cart_item_number();
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
    <!-- Script End -->

</body>

</html>

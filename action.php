
   <?php

    include 'Include/config.php';
    include 'session.php';

    if(isset($_POST['action']) && $_POST['action']=='filterMobiles'){
        $sql = "SELECT * FROM products WHERE categoryId = ? AND Brand !=''";

        if(isset($_POST['brand'])){

            $brand = implode("','",$_POST['brand']);
            $sql .="AND Brand IN('".$brand."')";

        }
        if(isset($_POST['ram'])){
            $ram = implode("','",$_POST['ram']);
            $sql .="AND Ram IN('".$ram."')";
        }
        if(isset($_POST['internalMemory'])){
            $internalMemory = implode("','",$_POST['internalMemory']);
            $sql .="AND InternalMemory IN('".$internalMemory."')";
        }
        $stmt = $conn->prepare($sql);
       
                        $stmt->bind_param("i",$_SESSION['catId']);
                        $stmt->execute();
                        $result = $stmt->get_result();
       
        $output = '';
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $output .= ' <div class="col-md-3 mb-2">
                        <div class="card-deck">
                            <div class="card border-secondary">
                                <img src="'.$row['Image'].'" class="card-img-top">
                                <div class="card-img-overlay" data-fcamera="'.$row['Front Camera'].'" data-rcamera="'.$row['Rear Camera'].'" data-brand="'.$row['Brand'].'" data-name="'.$row['Name'].'" data-price="'.$row['Price'].'" data-ram="'.$row['Ram'].'" data-internal="'.$row['InternalMemory'].'" data-processor="'.$row['Processor'].'" data-battery="'.$row['Battery'].'" data-display="'.$row['Display'].'" data-rearcamera="'.$row['Rear Camera'].'" data-frontcamera="'.$row['Front Camera'].'" data-code="'.$row['productCode'].'">
                                    <h6 class="text-light bg-info text-center rounded p-1" style="margin-top: 175px;cursor:pointer;" data-toggle="modal" data-target="#modalAbandonedCart" onclick="showpopup(this)">'. $row['Name'].'</h6>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mt-5 text-danger">Price: &#x20b9;'.number_format($row['Price']).'</h5>
                                    <p>
                                        RAM: '.$row['Ram'].'<br>
                                        Internal Memory: '.$row['InternalMemory'].'
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>';
            }
        }
        else{
            //$output = "<h4>No Products Found!</h4>";
            $output = $_SESSION['catId'];
        }
        echo $output;
    }


    if(isset($_POST['action']) && $_POST['action']=='filterLaptops'){
        $sql = "SELECT * FROM products WHERE categoryId = ? AND  Brand !=''";

        if(isset($_POST['brand'])){

            $brand = implode("','",$_POST['brand']);
            $sql .="AND Brand IN('".$brand."')";

        }
        if(isset($_POST['ram'])){
            $ram = implode("','",$_POST['ram']);
            $sql .="AND Ram IN('".$ram."')";
        }
        if(isset($_POST['hardDisk'])){
            $hardDisk = implode("','",$_POST['hardDisk']);
            $sql .="AND HardDisk IN('".$hardDisk."')";
        }

        $stmt = $conn->prepare($sql);
       
                        $stmt->bind_param("i",$_SESSION['catId']);
                        $stmt->execute();
                        $result = $stmt->get_result();
        $output = '';
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $output .= '<div class="col-md-3">
                        <div class="card-deck">
                            <div class="card border-secondary">
                                <img src="'.$row['Image'].'" class="card-img-top">
                                <div class="card-img-overlay" data-brand="'.$row['Brand'].'" data-name="'.$row['Name'].'" data-price="'.$row['Price'].'" data-ram="'.$row['Ram'].'" data-hardDisk="'.$row['HardDisk'].'" data-processor="'.$row['Processor'].'" data-display="'.$row['Display'].'" data-id="'.$row['Id'].'" data-code="'.$row['productCode'].'">
                                    <h6 class="text-light bg-info text-center rounded p-1" style="margin-top: 175px;cursor:pointer;" data-toggle="modal" data-target="#modalAbandonedCart" onclick="showpopup(this)">'.$row['Name'].'</h6>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mt-5 text-danger">Price: &#x20b9;'.number_format($row['Price']).'</h5>
                                    <p>
                                        RAM: '.$row['Ram'].'<br>
                                        Processor: '.$row['Processor'].'
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>';
            }
        }
        else{
            $output = "<h4>No Products Found!</h4>";
        }
        echo $output;
    }

    if(isset($_POST['action']) && $_POST['action']=='filterTelevisions'){
        $sql = "SELECT * FROM products WHERE categoryId = ? AND Brand !=''";

        if(isset($_POST['brand'])){

            $brand = implode("','",$_POST['brand']);
            $sql .="AND Brand IN('".$brand."')";

        }
        if(isset($_POST['size'])){
            $size = implode("','",$_POST['size']);
            $sql .="AND Size IN('".$size."')";
        }
        if(isset($_POST['speakerOutput'])){
            $speakerOutput = implode("','",$_POST['speakerOutput']);
            $sql .="AND SpeakerOutput IN('".$speakerOutput."')";
        }

       $stmt = $conn->prepare($sql);
       
                        $stmt->bind_param("i",$_SESSION['catId']);
                        $stmt->execute();
                        $result = $stmt->get_result();
        $output = '';
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $output .= ' <div class="col-md-3">
                        <div class="card-deck">
                            <div class="card border-secondary">
                                <img src="'.$row['Image'].'" class="card-img-top">
                                <div class="card-img-overlay" data-brand="'.$row['Brand'].'" data-name="'.$row['Name'].'" data-price="'.$row['Price'].'" data-resolution="'.$row['Resolution'].'" data-size="'.$row['Size'].'" data-speakerOutput="'.$row['SpeakerOutput'].'" data-ports="'.$row['Ports'].'" data-id="'.$row['Id'].'" data-code="'.$row['productCode'].'">
                                    <h6 class="text-light bg-info text-center rounded p-1" style="margin-top: 175px;cursor:pointer;" data-toggle="modal" data-target="#modalAbandonedCart" onclick="showpopup(this)">'.$row['Name'].'</h6>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mt-5 text-danger">Price: &#x20b9;'.number_format($row['Price']).'</h5>
                                    <p>
                                        Size: '.$row['Size'].'<br>
                                        SpeakerOutput: '.$row['SpeakerOutput'].'
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>';
            }
        }
        else{
            $output = "<h4>No Products Found!</h4>";
        }
        echo $output;
    }

    if(isset($_POST['action']) && $_POST['action']=='filterRefrigerators'){
        $sql = "SELECT * FROM products WHERE categoryId = ? AND Brand !=''";

        if(isset($_POST['brand'])){
            $brand = implode("','",$_POST['brand']);
            $sql .="AND Brand IN('".$brand."')";
        }
        if(isset($_POST['weight'])){
            $weight = implode("','",$_POST['weight']);
            $sql .="AND Weight IN('".$weight."')";
        }

        $stmt = $conn->prepare($sql);
       
                        $stmt->bind_param("i",$_SESSION['catId']);
                        $stmt->execute();
                        $result = $stmt->get_result();
        $output = '';
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $output .= ' <div class="col-md-3">
                        <div class="card-deck">
                            <div class="card border-secondary">
                                <img src="'.$row['Image'].'" class="card-img-top">
                                <div class="card-img-overlay" data-brand="'.$row['Brand'].'" data-name="'.$row['Name'].'" data-price="'.$row['Price'].'" data-volume="'.$row['Volume'].'" data-type="'.$row['Type'].'" data-dimensions="'.$row['Dimensions'].'" data-weight="'.$row['Weight'].'" data-id="'.$row['Id'].'" data-code="'.$row['productCode'].'">
                                    <h6 class="text-light bg-info text-center rounded p-1" style="margin-top: 175px;cursor:pointer;" data-toggle="modal" data-target="#modalAbandonedCart" onclick="showpopup(this)">'.$row['Name'].'</h6>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mt-5 text-danger">Price: &#x20b9;'.number_format($row['Price']).'</h5>
                                    <p>
                                        Type: '.$row['Type'].'<br>
                                        Weight: '.$row['Weight'].'
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>';
            }
        }
        else{
            $output = "<h4>No Products Found!</h4>";
        }
        echo $output;
    }
?>

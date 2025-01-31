<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && isset($_SESSION['userRole']) && $_SESSION['userRole']=="Storekeeper") {
$itemId=$_GET['updateid'];
$sql="Select * from `item` where itemID=$itemId";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$medicineName = $row['item_name'];
$companyName = $row['companyName'];
$unitType = $row['unitType'];
$unitCost = $row['unit_price'];

?> 

<?php

if(isset($_POST['update'])){

    // $itemId = $_POST['itemID'];
    $medicineName = $_POST['medicineName'];
    $companyName = $_POST['companyName'];
    $unitType = $_POST['unitType'];
    $unitCost = $_POST['unitCost'];
    

    $sql="update `item` set item_name='$medicineName',companyName='$companyName',unitType='$unitType',unit_price=$unitCost where itemID=$itemId ";
    $result=mysqli_query($con,$sql);

    header("Location: storekeeperTotalMedicine.php");
    exit();
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/storekeeperStyle.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/storekeeperAddMedicine.css' ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .next {
            position: initial;
            height: auto;
        }
    </style>
    <title>Storekeeper Update Medicine</title>
</head>
<body>
<div class="user">
    <?php
    $name = urlencode( $_SESSION['name']);
    include(BASEURL . '/Components/storekeeperSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=".$name);?>
    <div class="userContents" id="center">
        <div class="title">
            <img src="<?php echo BASEURL . '/images/logo5.png' ?>" alt="logo">
            Royal Hospital
        </div>
        <ul>
            <li class="userType"><img src=<?php echo BASEURL . '/images/userInPage.svg' ?> alt="Storekeeper">
                Storekeeper
            </li>
            <li class="logout"><a href="<?php echo BASEURL . '/Homepage/logout.php?logout' ?>">Logout
                    <img
                            src=<?php echo BASEURL . '/images/logout.svg' ?> alt="logout"></a>
            </li>
        </ul>
        <div class="arrow">
            <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Update Medicine
        </div>

        <!-- <div class="pad">
            
        </div> -->
        <div class="form-content">

        <div class="pad">
            
        </div>



        <div class="form-box">
        <h1>UPDATE MEDICINE</h1>
        
        <form method="post">
            
            <div class="row">
                
            <div class="column">
                    <label>Medicine name</label>
                    <input name="medicineName" type="text" id="email" placeholder="Enter Medicine name here" value=<?php echo $medicineName;?>>
                </div>
                
            </div>
            <div class="row">
            <div class="column">
                    <label>Company Name</label>
                    <input name="companyName" type="text" id="name" placeholder="Enter Company Name here" value=<?php echo $companyName;?>>
                </div>
                
                
                
            </div>
            <div class="row">
                <div class="column">
                    <label>Unit Type</label>
                    <select name="unitType" id="" >
                        <option value="">Select type</option>
                        <option value="cards">cards</option>
                        <option value="bottles">bottles</option>
                        <option value="pills">pills</option>
                        <option value="injections">injections</option>
                        <option value="tablets">tablets</option>

                    </select>
                </div>

            </div>

            <div class="row">
            <div class="column">
                    <label>Unit Cost</label>
                    <input name="unitCost" type="text" id="contact" placeholder="Enter Unit Cost here" value=<?php echo $unitCost;?>>
                </div>
                
            </div>
            <button name="update">Update</button>
        </form>
    </div>
            
        </div>
        <?php include(BASEURL . '/Components/Footer.php'); ?>
    </div>
</div>
</body>
</html>

    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>
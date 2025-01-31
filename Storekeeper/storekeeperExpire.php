<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && isset($_SESSION['userRole']) && $_SESSION['userRole']=="Storekeeper") {
?> 

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/storekeeperExpire.css' ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .next {
            position: initial;
            height: auto;
        }
    </style>
    <title>Storekeeper Expired Stocks</title>
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
            <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Expired Stocks
        </div>

        <div class="pad">
            
        </div>
        <!-- content start -->

        <div class="wrapper">
            <div class="table">
                <div class="row headerT">
                    <div class="cell">Batch number</div>
                    <div class="cell">Medicine name</div>
                    <div class="cell">Quantity</div>
                    <div class="cell">Expired date</div>
                </div>
                <?php
                $sql = "SELECT inventory.badgeNo, item.item_name, inventory.quantity, inventory.expiredDate  from inventory INNER JOIN item on inventory.itemID=item.itemID where expiredDate < CURRENT_DATE;";
                $result = mysqli_query($con, $sql);
                $num = mysqli_num_rows($result);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $batchNo = $row['badgeNo'];
                        $name= $row['item_name'];
                        $quantity = $row['quantity'];
                        $expDate = $row['expiredDate'];
                        ?>
                        <div class="row">

                            <div class="cell" data-title="Batch number">
                                <?php echo $batchNo; ?>
                            </div>
                            <div class="cell" data-title="Medicine number">
                                <?php echo $name; ?>
                            </div>
                            <div class="cell" data-title="Quantity">
                                <?php echo $quantity; ?>
                            </div>
                            <div class="cell" data-title="Expired date">
                                <?php echo $expDate; ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>



        </div>
        </div>


    </div>
</div>
</body>
</html>

    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>
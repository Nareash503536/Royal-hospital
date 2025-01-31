<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Nurse') {
    ?>

<?php
if(isset($_POST['submit'])){
    // $patientID =  $_POST['patientID'];
    $RoomNo = $_POST['room_no'];
    $admit_date = $_POST['admit_date'];
    $admit_time = $_POST['admit_time'];

    $sql="INSERT INTO inpatient(admit_time,admit_date,room_no) values('$admit_time','$admit_date','$RoomNo');";
    $result=mysqli_query($con,$sql);

    if($result){
        // echo "Date inserted successfully";
        header('location:display.php');
    }else{
        die(mysqli_error($con));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/nurseStyle.css' ?>">
    <style>
        .next {
            position: initial;
            height: auto;
        }
    </style>
    <title>Patient</title>
 
</head>
<body>
    <div class="user">
    <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL . '/Components/nurseSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
        <div class="userContents">
        <?php
            $name = urlencode( $_SESSION['name']);
            include(BASEURL.'/Components/nursetopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
            ?>

            <div class="main-container">
                <h3 class="nurse_heads">In-Patients List</h3>
                <input type="text" id="myInputName" onkeyup="filterByName()" placeholder="Search for names.." title="Type in a name">
                <script src=<?php echo BASEURL . '/js/filterElements.js' ?>></script>

                <button class="button" id="admission-button">
                    New Admission
                </button>

                <div class="wrapper">
                    <div class="table">
                        <div class="row headerT">
                            <div class="cell">Name</div>
                            <div class="cell">Room No</div>
                            <div class="cell">Admit Date</div>
                            <div class="cell">Admit Time</div>
                            <div class="cell">Drug Allergies</div>
                            <div class="cell">Option</div>
                        </div>
                        <?php
                                $sql="select user.name,inpatient.room_no,inpatient.admit_date,inpatient.admit_time,patient.drug_allergies,patient.emergency_contact from user join patient on user.nic=patient.nic join inpatient on inpatient.patientID=patient.patientID;";
                                $result=mysqli_query($con,$sql);

                                if($result){
                                while($row=mysqli_fetch_assoc($result)){
                                $name =  $row['name'];
                                $RoomNo = $row['room_no'];
                                $admit_date = $row['admit_date'];
                                $admit_time = $row['admit_time'];
                                $drug_allergies = $row['drug_allergies'];
                                $emergency_contact = $row['emergency_contact']; ?>
                        <div class="row">
                            <div class="cell"><?php echo $name?></div>
                            <div class="cell"><?php echo $RoomNo?></div>
                            <div class="cell"><?php echo $admit_date?></div>
                            <div class="cell"><?php echo $admit_time?></div>
                            <div class="cell"><?php echo $drug_allergies?></div>
                            <div class="cell"><?php echo $emergency_contact?></div>
                        </div>
                             <?php   }
                                }
                            ?>    
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="popup" id="admission-popup">
        <div class="popup-content">  
            <img src="../images/close.png" alt="close" class="close">
            <form method="post">
                <h3>Admission Form</h3>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" placeholder="Enter name" name="name">
                </div>
                <div class="form-group">
                    <label>Room No</label>
                    <input type="text" class="form-control" placeholder="Enter room No" name="room_no" >
                </div>
                <div class="form-group">
                    <label>Admit date</label>
                    <input type="date" min=date("Y/m/d") name ="admit_date"value ="<?php echo date('Y-m-d') ?>">
                </div>
                <div class="form-group">
                    <label>Admit time</label>
                    <input type="time" id="time" name="admit_time" min="" required>
                </div>
                <button class="submit" type="submit" name ="submit">Submit</button>
            </form>
        </div>
    </div>
<script>
    let objectDate = new Date();

    var time = objectDate.toLocaleTimeString([], {
      hourCycle: 'h24',
      hour: '2-digit',
      minute: '2-digit'
    });
    document.getElementById('time').value = time;

   document.getElementById("admission-button").addEventListener("click", function(){
        document.querySelector("#admission-popup").style.display = "flex";
    })
    document.querySelector(".close").addEventListener("click", function(){
        document.querySelector("#admission-popup").style.display = "none";
    })
</script>

</body>
</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>

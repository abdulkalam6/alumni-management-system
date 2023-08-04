<?php session_start();
//error_reporting(0);
include('dbconnect.php');
if(!(isset($_SESSION['logged_in']))){
    header("Location: index.php");  
} else{
    if(isset($_POST['submit']))
  {
$id=$_SESSION['logged_in'];
$designation=$_POST['designation'];
$phone_number=$_POST['phone_number'];
$address=$_POST['address'];
// $tdate=$_POST['joiningdate'];
$linkedin=$_POST['linkedin'];
$twitter=$_POST['twitter'];
$facebook=$_POST['facebook']; 
 
// $tdate=$_POST['joiningdate'];
if (!empty($_FILES["profile"]["name"])) {
    // Picture was uploaded
    $propic = md5($_FILES["profile"]["name"]) . time();
    move_uploaded_file($_FILES["profile"]["tmp_name"], "images/" . $propic);

    $sql = "UPDATE alumnilogin SET designation=:designation, phone_number=:phone_number, address=:address,
             linkedin=:linkedin, twitter=:twitter, facebook=:facebook,
           profile=:profile
            WHERE id=:id";
} else {
    // Picture was not uploaded
    $sql = "UPDATE alumnilogin SET designation=:designation, phone_number=:phone_number, address=:address,
            linkedin=:linkedin, twitter=:twitter, facebook=:facebook,
            
            WHERE id=:id";

    // Unset $propic since the picture was not uploaded (no need to bind it)
    unset($propic);
}

// Assuming you have a valid PDO connection in the $dbh variable
$query = $con->prepare($sql);

// Assuming you have the required variables set to appropriate values
$query->bindParam(':designation', $designation, PDO::PARAM_STR);
$query->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
$query->bindParam(':mobilenumber', $address, PDO::PARAM_STR);
$query->bindParam(':address', $address, PDO::PARAM_STR);
$query->bindParam(':linkedin', $linkedin, PDO::PARAM_STR);
$query->bindParam(':twitter', $twitter, PDO::PARAM_STR);
$query->bindParam(':facebook', $facebook, PDO::PARAM_STR);
$query->bindParam(':id', $id, PDO::PARAM_STR);


// Bind $propic only if it was uploaded
if (isset($propic)) {
    $query->bindParam(':profile', $propic, PDO::PARAM_STR);
}

$query->bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();



$sql="update alumnilogin set designation=:designation, phone_number=:phone_number, address=:address,
linkedin=:linkedin, twitter=:twitter ,facebook=:facebook where id=:id";
$query = $con->prepare($sql);
$query->bindParam(':designation',$designation,PDO::PARAM_STR);
$query->bindParam(':phone_number',$phone_number,PDO::PARAM_STR);
$query->bindParam(':mobilenumber',$address,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
// $query->bindParam(':joiningdate',$tdate,PDO::PARAM_STR);
$query->bindParam(':linkedin',$linkedin,PDO::PARAM_STR);
$query->bindParam(':twitter',$twitter,PDO::PARAM_STR);
$query->bindParam(':facebook',$facebook,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
echo '<script>alert("Your profile succesfull updated.")</script>';
echo "<script>window.location.href='profile.php'</script>";

  }
  ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
   

  
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="../assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>



</head>

<body>
    <!-- Left Panel -->

   

    <div id="right-panel" class="right-panel">

  

        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">
                  
                    <!--/.col-->
                    <div class="col-lg-6" style="float-left:left !important">
                        <div class="card" style="width:900px;">
                            <form name="" method="post" action="" enctype="multipart/form-data">
                                
                            <div class="card-body card-block">
 <?php
$id = $_SESSION['logged_in'];
$sql = "SELECT * from alumnilogin where id=?";
$query = $con->prepare($sql);
$query->bind_param('i', $id); // Assuming 'id' is an integer, use 'i' for integer placeholder
$query->execute();
$results = $query->get_result();
$cnt=1;
if ($results->num_rows > 0) {
    $row = $results->fetch_object();
    ?>
<div class="form-group">
<label for="company" class=" form-control-label">designation</label>
<input type="text" name="designation" value="<?php  echo $row->designation;?>" class="form-control" id="designation" required="true">
</div>


<div class="form-group">
<label for="street" class=" form-control-label">Phone Number</label>
<input type="text" name="phone_number" value="<?php  echo $row->phone_number;?>" id="phone_number" class="form-control" required="true">
</div>



<div class="row form-group">
<div class="col-12">
<div class="form-group"><label for="city" class=" form-control-label">Address</label>
<input type="text" name="address" id="address" value="<?php  echo $row->address;?>" class="form-control" required="true">
</div>
</div>
</div>


<div class="row form-group">
<div class="col-12">
<div class="form-group"><label for="city" class=" form-control-label">Linkedin</label>
<input type="text" name="linkedin" id="linkedin" value="<?php  echo $row->linkedin;?>" class="form-control">
</div>
</div>
</div>


<div class="row form-group">
<div class="col-12">
<div class="form-group"><label for="city" class=" form-control-label">Twitter</label>
<input type="text" name="twitter" id="twitter" value="<?php  echo $row->twitter;?>" class="form-control">
</div>
</div>
</div>


<div class="row form-group">
<div class="col-12">
<div class="form-group"><label for="city" class=" form-control-label">Facebook</label>
<input type="text" name="facebook" id="facebook" value="<?php  echo $row->facebook;?>" class="form-control">
</div>
</div>
</div>


<div class="form-group"><label for="company" class=" form-control-label">Profile Picture</label>
<br> 
<?php if($row->profile==''):?>

    
<img src="images/no-image.png"  alt="NO Image">
<?php else: ?>    
<img src="images/<?php echo $row->profile;?>" width="450" height="20%" value="<?php  echo $row->profile;?>">
<?php endif;?>
                                </div>
<div class="form-group">
    <input type="file" name="profile" value="" class="form-control" id="profile" >
    <p>If not need to update then leave it empty</p>
</div>
                    </div>
                    </div>




</div>
</div>
<?php $cnt = $cnt + 1;
         }
     }
?>
    <p style="text-align: center; "><button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit"><i class="fa fa-dot-circle-o"></i> Update</button></p> 

    </form>
   <? php }?>
    </div>


    </div>
    </div><!-- .animated -->
    </div><!-- .content -->
    </div><!-- /#right-panel -->
    <!-- Right Panel -->


                            <script src="../vendors/jquery/dist/jquery.min.js"></script>
                            <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>

                            <script src="../vendors/jquery-validation/dist/jquery.validate.min.js"></script>
                            <script src="../vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js"></script>

                            <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
                            <script src="../assets/js/main.js"></script>
</body>
</html>

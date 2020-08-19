<?php
session_start();
include "includes/db.php";

# You should probably store user id in the session rather than email
$email = $_SESSION['email'];


$query = "SELECT * FROM users where email = '$email'";
$result = mysqli_query($connection, $query);
if(!$result){
    die('Query failed' . mysqli_error());
}

# You don't need to loop here as there should only be 1 user with your email address
# $row = mysqli_fetch_assoc($result);
# $location = $row['location'];

while($row = mysqli_fetch_assoc($result)){
    $location = $row['location'];
}

# You can change this to
# if (! isset( $_SESSION['email'] ) ) {
# redirect
# }

if ( isset( $_SESSION['email'] ) ) {
} else {
    // Redirect them to the login page
    header("Location: login.php");
}


# Action when you hit the submit button
if(isset($_POST['submit'])) {
  # Form has been submitted so lets see where they want to fly to
  $new_location = $_POST['fly'];
  # Make sure the new location is an ID
  if(is_numeric($new_location)){

    # Check user is not already in this country
    #if($new_location != $current_location_id){

      # Get price to fly to new country
      $query = "SELECT country, price FROM airport WHERE id = $new_location";
      $result = mysqli_query($connection, $query);

      # Check the user has enough cash to fly
      # if ($user_cash >= $result['price']) {

        $query = mysqli_query($connection, "UPDATE users SET location = '$country', cash = cash-$price WHERE email = '$email'");
        echo "Sucess Well Done! you flew to $row['country']";

      # } else {
      # echo 'You don\'t have enough money to pay for this flight';
      # }
    # }
  }
}

?>
<!-- Make  file called header.php and put everything from here -->
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css"href="includes/style.css">
	<title>Cartel Wars</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-12"  style="height: 150px;"><?php include "userstats.php";?></div></div>
  <?php include "navbar.php"?>
<!--- Down to here then just include() it - then if you want to make a change you don't have to edit every file! -->

 <div class="col-9 text-center" style="background-color:pink;">
 	<p> Welcome to <b><?php echo"$location"; ?></b> airport here you take a flight to another country be sure to smuggle some drugs without getting caught! </p>
</p>


<!-- Redoing the section from below -->
<form action ="airport.php" method="post">
<?php
# You can update this query to say WHERE id != "$current_location_id"
$query = "SELECT id, country, price FROM airport";
$result = mysqli_query($connection, $query);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    ?>
      <div class="radio">
        <label>
          <input type="radio" name="fly" value="<?php echo "$id";?>"><?php echo"$country" , "$price";} ?>
        </label>
      </div>
    <?php 
      }
    ?>
    <button type="submit" class="btn btn-default" name="submit" value="Submit">Fly</button>
</form>



<!-- <?php
$query = "SELECT id, country, price FROM airport";
$result = mysqli_query($connection, $query);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

    $id = $row['id'];
    $country = $row['country'];
    $price = $row['price'];


 ?>
    <form action ="airport.php" method="post">
<div class="radio">
   <label><input type="radio" name="fly" value="<?php echo "$id";?>"><?php echo"$country" , "$price";}
   if(isset($_POST['fly'])) {
  $selected_flight = $_POST['fly'];
 switch ($selected_flight) {
   case '1':
    echo "Sucess Well Done! you flew to $country";
    $query = "UPDATE users SET ";
     $query .= "location = '$country', ";
     $query .= "cash = cash-$price ";
      $query .= "WHERE email = '$email' " ;
       $result = mysqli_query($connection, $query);


     break;
   
   case '2':
    echo "Sucess Well Done! you flew to $country";
    $query = "UPDATE users SET ";
     $query .= "location = '$country', ";
     $query .= "cash = cash-$price ";
      $query .= "WHERE email = '$email' " ;
       $result = mysqli_query($connection, $query);
     break;

     case '3': 
    echo "Sucess Well Done! you flew to $country";
    $query = "UPDATE users SET ";
     $query .= "location = '$country', ";
     $query .= "cash = cash-$price ";
      $query .= "WHERE email = '$email' " ;
       $result = mysqli_query($connection, $query);     break;

     case '4':
    echo "Sucess Well Done! you flew to $country";
    $query = "UPDATE users SET ";
     $query .= "location = '$country', ";
     $query .= "cash = cash-$price ";
      $query .= "WHERE email = '$email' " ;
       $result = mysqli_query($connection, $query);
     break;
 }
}?>
 </label></div>
   <button type="Submit" class="btn btn-default" name="Submit" value="Submit">Fly</button>
</div></div>
<?php
  } else {
  echo "no results";
} ?> -->

  
  <div class="row">


        <div class="col-12" style="background-color:red;">Footer</div>
         </form>
     </body></html>
<?php

$username = "";
$email    = "";
$date1 = "";
$city = "" ;
$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'registration.');

    
if (isset($_POST['reg_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $date1 = mysqli_real_escape_string($db, $_POST['date']);
  $city = mysqli_real_escape_string($db, $_POST['city']);



  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($date1)) { array_push($errors, "enter your Birthday"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($city)) { array_push($errors, "enter your city"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
 

  
  if ($user) { 
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  if (count($errors) == 0) {
  	$password = md5($password_1);
    $file = $_FILES['uploadfile']['name'];
    $temp = $_FILES['uploadfile']['tmp_name'];

   $inserto = move_uploaded_file($temp , "uploads/" . $file);
  	$query = "INSERT INTO users (username, email, password, city, date, image) 
  			  VALUES('$username', '$email', '$password', '$city', '$date1','$file')";
  	mysqli_query($db, $query);
    session_start();
  	$_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['city'] = $city;
    $_SESSION['date'] = $date1;
    

  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    echo 'in 0 erros if';
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) ==1 ) {
      session_start();
  	  $_SESSION['username'] = $username;
      $_SESSION['city'] = $city;
      $_SESSION['date'] = $date1;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}
if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM users WHERE id=$id");
	header('location: table.php');
}
?>

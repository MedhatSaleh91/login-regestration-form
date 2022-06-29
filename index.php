
<?php 
require 'google-api/vendor/autoload.php';
 session_start(); 
// Creating new google client instance
$client = new Google_Client();

// Enter your Client ID
$client->setClientId('893290771545-5j0g5qf4200mkn17oj79ocpftqeglrbs.apps.googleusercontent.com');
// Enter your Client Secrect
$client->setClientSecret('W0Mfvkc_4H_9LhiCBMDYwHC2');
// Enter the Redirect URL
$client->setRedirectUri('http://localhost/newregst/index.php');
// Adding those scopes which we want to get (email & profile Information)
$client->addScope("email");
$client->addScope("profile");


if(isset($_GET['code'])):

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // getting profile information
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();

    // showing profile info
    echo "<pre>";
    var_dump($google_account_info);

else: 
    // Google Login Url = $client->createAuthUrl(); 
?>

    <a class="login-btn" href="<?php echo $client->createAuthUrl(); ?>">Login</a>

<?php endif; ?>


<?php 
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
  	header("location: login.php");
  }
  
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
	<?php 
       include('server.php');  
   $userID = $_SESSION['username'];
   $nm = "SELECT * FROM users where '$userID' = username";
   $res = mysqli_query($db,$nm);
   $row1 = mysqli_fetch_assoc($res);
   $city2 = $row1['city'];
   $daty = $row1['date'];
   $userw = $row1['username'];
  
	?>
	
    	<p>Welcome <strong><?php echo $userw; ?></strong></p>
		<p>your date of birth <strong><?php echo $daty; ?></strong><br></p>
		<p>your city <strong><?php echo $city2; ?></strong><br></p> 

        <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>

	
 
</div>
		
</body>
</html>

</html>
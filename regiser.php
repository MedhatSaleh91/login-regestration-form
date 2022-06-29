<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="server.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
      <div class="input-group">
  	  <label>birthday</label>
  	  <input type="date" name="date">
      </div> 
      <div class="input-group">
  	  <label>city</label>
  	  <input type="text" name="city" >
      </div> 
  	
  	  <label>Image</label>
		<form method="post" action="uploadimg.php" enctype="multipart/form-data">
    <input type="file" name="uploadfile"/>
	<input type = "submit" name='submit' />

    </div>

    <div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
	  
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>

</form>
  	
  </form>
</body>
</html>
<?php include('server.php') ?>
<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM users WHERE id=$id");

		if ($record-> num_rows == 1){
			$n = mysqli_fetch_array($record);
			$name = $n['username'];
			$city = $n['city'];
            $email =$n['email'];
            $date = $n['date'];
            
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit users</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>EDIT</h2>
  </div>
	 
  <form method="post" >
  	<?php include('errors.php'); ?>
  	<div class="input-group">
      <input type="hidden" name="id" value="<?php echo $id; ?>">

  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $name; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
      <div class="input-group">
  	  <label>birthday</label>
  	  <input type="date" name="date" value="<?php echo $date; ?>">
      </div> 
      <div class="input-group">
  	  <label>city</label>
  	  <input type="text" name="city"  value="<?php echo $city; ?>">
      </div> 




      <div class="input-group">
			<button class="btn" type="submit" name="save" >Save</button>

            <?php if ($update == true): ?>
	<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
<?php else: ?>
	<button class="btn" type="submit" name="save" >Save</button>
   
<?php endif ?>

<?php if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$name = $_POST['username'];
	$city = $_POST['city'];
    $email = $_POST['email'];
    $date = $_POST['date'];

	mysqli_query($db, "UPDATE users SET username='$name', city='$city' , email='$email' , date='$date' WHERE id=$id");
	$_SESSION['message'] = " updated!"; 
	header('location: table.php');
}
?>
<?php
if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM users WHERE id=$id");
	$_SESSION['message'] = " deleted!"; 
	header('location: table.php');
}
?>
  </form>
</body>
</html>
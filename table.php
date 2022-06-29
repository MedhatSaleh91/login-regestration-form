<?php include('server.php') ?>
<?php
$sql = "SELECT * FROM users ";
$result = $db->query($sql);
$db->close(); 
?>
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="UTF-8">
    <title>name</title>
    <style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
  
        h1 {
            text-align: center;
            color: #006600;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT', 
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }
  
        td {
            background-color:white;
            border: 1px solid black;
        }
  
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
  
        td {
            font-weight: lighter;
        }
    </style>
</head>
  
<body>
    <section>
        <h1>user info</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>City</th>
                <th>Date</th>
                <th>Mail</th>
                <th colspan="2">Action</th>
            </tr>
            <?php   
                while($rows=$result->fetch_assoc())
                {
             ?>
            <tr>
                <td><?php echo $rows['username'];?></td>
                <td><?php echo $rows['city'];?></td>
                <td><?php echo $rows['date'];?></td>
                <td><?php echo $rows['email'];?></td>
				<td><a href="edit.php?edit=<?php echo $rows['id']; ?>" class="edit_btn" >Edit</a></td>
                <td><a href="server.php?del=<?php echo $rows['id']; ?>" class="del_btn">Delete</a></td>


            </tr>
            <?php
                }
                
             ?>
        </table>
    </section>
</body>
  
</html>

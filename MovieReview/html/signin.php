<!DOCTYPE html>
<html>
<head>
	<title>Sign in</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		p{
			text-align: center;
			font-size: 25px;
			font-family: monospace;
			color: #272727;
		}
		body{
			background-image: url("../images/wall2.png");
		}
		.container{
			box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			border-radius: 3px;
			padding: 10px;
			background-color: #fafafa;
			width:35%;
			margin: 20px auto;
		}
		label,.from-control{
			font-family: monospace;
			font-size: 15px;
		}
		.btn{
			background-color: #272727;
			color: #fafafa;
			font-family: monospace;
			font-size: 17px;
			width: 32%;
		}
	</style>
</head>
<body>
	<div class="container">
		<form method="POST" action="signin.php" enctype="multipart/form-data">
			<p>Sign In</p>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Username</label>
			    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username" required="">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Password</label>
			    <input type="password"  name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password" required="">
			  </div>
			  <div class="form-group form-check">
			    <input type="checkbox" class="form-check-input" id="exampleCheck1">
			    <label class="form-check-label" for="exampleCheck1" >Check me out</label>
			  </div>
			  <div class="buttons">
				  <button type="submit" name="submit" class="btn">Sign in</button>
				  <a href = "register.php" ><input type="button" class="btn" value="Register"></a>
				  <a href = "index.php"><input type="button" class="btn" value="Guest"></a>
			  </div>
			</form>
			<?php
				// Create connection
				//$conn = new mysqli('localhost', 'root', 'rootSubash786', 'MovieReview');
				// Check connection
				include '../php/connect.php';
				mysql_select_db('MovieReview');

				if(isset($_POST['submit'])){
					//$file = addslashes(file_get_contents($_FILES['file']['tmp_name"']));
					$name = $_POST['username'];
					$pass = $_POST['pass'];
					$sql = "SELECT * FROM login where name='$name' AND pass ='$pass'";
					$retval = mysql_query($sql);
						
					if(! $retval ) {
					    die('Could not get data: ' . mysql_error());
					}
						   
					if($row = mysql_fetch_array($retval)) {
						echo "<script>alert('Sucessfully Registered');</script>";
						header("Location: index.php?name=$name");
					}else{
						echo "<script>alert('Not Registered');</script>";
					}
				}
			?>
	</div>
</body>
</html>
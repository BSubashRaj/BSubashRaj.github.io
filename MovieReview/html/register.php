<!DOCTYPE html>
<html>
<head>
	<?php
		if(isset($_GET['error'])){
			$error = $_GET['error'];
		}
	?>
	<title>Register</title>
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
		.alert{
			font-family: monospace;
			font-size: 14px;
			text-align: left;
			background: rgba(255, 0, 0, 0.3);
			padding: 2px 10px 2px 10px;
			color: #272727;
			border-radius: 3px;
		}
	</style>
</head>
<body>
	<div class="container">
		<form method="POST" action="register.php" enctype="multipart/form-data">
			<p>Register</p>
			<?php  if(isset($error)) { ?>
				<p class="alert"><?php echo $error ?></p>
			<?php  } ?>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Username</label>
			    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username" required="">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Password</label>
			    <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password" required="">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Re-Password</label>
			    <input type="password" name="repass"class="form-control" id="exampleInputPassword1" placeholder="Password" required="">
			  </div>
			 <div class="form-group">
			      <label for="inputState">Secret Question</label>
			      <select id="inputState" name="question" class="form-control" required="">
			        <option value="#"selected>Choose...</option>
			        <option value="What's your pet name ?"">What's your pet name ?</option>
			        <option value="What's your girl friend name ?">What's your girl friend name ?</option>
			        <option value="What's your nick name ?">What's your nick name ?</option>
			      </select>
			    </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Answer</label>
			    <input type="text" name="answer" class="form-control" id="exampleInputPassword1" placeholder="Answer" required="">
			  </div>
			  <div class="form-group form-check">
			    <input type="checkbox" class="form-check-input" id="exampleCheck1">
			    <label class="form-check-label" for="exampleCheck1">Check me out</label>
			  </div>
			  <div class="buttons">
				  <button type="submit" name="register" class="btn">Register</button>
				  <a href = "signin.php" ><input type="button" class="btn" value="Sign in"></a>
			  </div>
			</form>
			<?php
				// Create connection
				$conn = new mysqli('localhost', 'root', 'rootSubash786', 'MovieReview');
				// Check connection
				if ($conn->connect_error) {
				    die("Connection failed: " . $conn->connect_error);
				}
				if(isset($_POST['register'])){
					//$file = addslashes(file_get_contents($_FILES['file']['tmp_name']));
					if($_POST['pass'] == $_POST['repass']){
						$name =$_POST['name'];
						$res = $conn->query("SELECT * FROM login where name = '$name'");
						if ($res->num_rows > 0) {
						    // output data of each row
						    if($row = $res->fetch_assoc()) {
						        header("Location: register.php?error=User%20$name%20Alrady%20Exist");
						    }
						} else {
					 	 	$stmt = $conn->prepare("INSERT INTO login (name,pass, secretQuestion, secretAnswer) VALUES (?,?,?,?)");
							$stmt->bind_param("ssss", $n,$p,$q,$a);

							// set parameters and execute
							$n = mysqli_real_escape_string($conn,$_POST['name']);
							$p = mysqli_real_escape_string($conn,$_POST['pass']);
							$q = mysqli_real_escape_string($conn,$_POST['question']);
							$a = mysqli_real_escape_string($conn,$_POST['answer']);

							if($stmt->execute()){
								echo "<script>alert('Sucessfully Registered');</script>";
								header("Location: index.php?name=$n");
							}else{
								echo "<script>alert('Not Registered');</script>";
							} 
						}
					}else{
						header("Location: register.php?error=Password%20Mismatch");
					}
				}
			?>
	</div>
</body>
</html>
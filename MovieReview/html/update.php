<html>
<head>
	<?php

		if(isset($_GET['name'])){
			$name = $_GET['name']; 
		}
			// Create connection
			$conn = new mysqli('localhost', 'root', 'rootSubash786', 'MovieReview');
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}

			if(isset($_POST['update'])){
				$file = addslashes(file_get_contents($_FILES['file']['tmp_name']));
				$stmt = $conn->prepare("INSERT INTO movies(image,title, gener, director, music, producer, budget, boxoffice, synopsis, rating) VALUES ('$file',?,?,?,?,?,?,?,?,?)");
				$stmt->bind_param("sssssiisd", $t, $g, $d, $m, $p, $b, $bo, $s, $r);

				// set parameters and execute
				$t = mysqli_real_escape_string($conn,$_POST['title']);
				$g = mysqli_real_escape_string($conn,$_POST['genre']);
				$d = mysqli_real_escape_string($conn,$_POST['director']);
				$m = mysqli_real_escape_string($conn,$_POST['music']);
				$p = mysqli_real_escape_string($conn,$_POST['producer']);
				$b = mysqli_real_escape_string($conn,$_POST['budget']);
				$bo = mysqli_real_escape_string($conn,$_POST['boxoffice']);
				$s = mysqli_real_escape_string($conn,$_POST['synopsis']);
				$r = mysqli_real_escape_string($conn,$_POST['rating']);

				if($stmt->execute()){
					echo "<script>alert('Sucessfully updated');</script>";
				}else{
					echo "<script>alert('Not Updated');</script>";
				}

			}
	?>
	<title>Index page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/updatecss.css">
	<script src="../js/script.js" ></script>
</head>
<body>
	<div class="contain">
		<div class="topbar">
  			<a class="log">M R</a>
  			<?php if(isset($name)){ ?>
  				<a class="sig" href="signin.php">Log out</a>
  				<a class="sig"><?php echo $name; ?></a>
  			<?php }else{?>
  				<a class="sig" href="register.php">Register</a>
  				<a class="sig" href="signin.php">Sign in</a>
  			<?php } ?>
  			<div class="clr"></div>
  			<form method="POST" action='<?php echo $_SERVER["PHP_SELF"];?>'>
  				<input type="text" name="title" placeholder="Search your movie">
  				<input type="submit" value="Search" name="submit">
  				<?php
  					if(isset($_POST['submit'])){
  						if(isset($name)){
  							header("Location: ../html/index.php?uptitle=".$_POST['title']."&name=$name");
  						}else{
  							header("Location: ../html/index.php?uptitle=".$_POST['title']."");
  						}
  					}
  				?>
  			</form>
		</div>

		<div class="topnav" id="myTopnav">
		  <a href="index.php">Home</a>
		  <div class="dropdown">
		    <button class="dropbtn">Categories
		      <i class="fa fa-caret-down"></i>
		    </button>
		    <div class="dropdown-content">
		      <a href="#">Actio</a>
		      <a href="#">Adventure</a>
		      <a href="#">Comedy</a>
		      <a href="#">Crime</a>
		      <a href="#">Drama</a>
		      <a href="#">Fantacy</a>
		      <a href="#">History</a>
		      <a href="#">Horror</a>
		      <a href="#">Mystery</a>
		      <a href="#">Thriller</a>
		      <a href="#">Si-Fi</a>
		      <a href="#">war</a>
		    </div>
		  </div> 
		  <a href="#news">WhishList</a>
		  <a href="#contact">Contact Us</a>
		  <a href="#about">About Us</a>
		  <div class="dropdown">
		    <button class="dropbtn active">More
		      <i class="fa fa-caret-down"></i>
		    </button>
		    <div class="dropdown-content">
		      <a href="update.php">Admin</a>
		    </div>
		  </div> 
		  <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
		</div>

		<div class="main">
			<div class="container">
				<img src="../images/wall2copy.png" style='width:100%;'>
				<div class="row">
					<div class="col-md-6-left det">
						<h3> Update new Movie Details</h3>
						<div class="center">
						<form method = "POST" action="update.php" enctype="multipart/form-data">
						  <div class="form-group">
						    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" placeholder="Title" required="">
						  </div>
						  <div class="form-group">
						    <input type="text" class="form-control" id="director" name="director" placeholder="Director" required="">
						  </div>
						  <div class="form-group">
						      <select id="inputState" name="question" class="form-control" required="">
						        <option value="#"selected>Choose...</option>
						        <option value="Action">Action</option>
						        <option value="Adventure">Adventure</option>
						        <option value="Comedy">Comedy</option>
						        <option value="Crime">Crime</option>
						        <option value="Drama">Drama</option>
						        <option value="Fantacy">Fantacy</option>
						         <option value="History">History</option>
						        <option value="Horror">Horror</option>
						        <option value="Mystery">Mystery</option>
						         <option value="Thriller">Thriller</option>
						        <option value="Si-Fi">Si-Fi</option>
						        <option value="War">War</option>
						      </select>
					      </div>
						  <div class="form-group">
						    <input type="text" class="form-control" id="music" name="music" placeholder="Music" required="">
						  </div>
						  <div class="form-group">
						    <input type="text" class="form-control" id="producer" name="producer" aria-describedby="emailHelp" placeholder="Producer" required="">
						  </div>
						  <div class="form-group">
						    <input type="number" class="form-control" id="budget" name="budget" placeholder="Budget" required="">
						  </div>
						  <div class="form-group">
						    <input type="number" class="form-control" id="boxoffice" name="boxoffice" aria-describedby="emailHelp" placeholder="Box Office" required="">
						  </div>
						  <div class="form-group">
						    <input type="text-area" row=5 class="form-control" id="synopsis" name="synopsis" placeholder="Synopsis" required="">
						  </div>
						  <div class="form-group">
						    <input type="number" step = '0.1'class="form-control" id="rating" name="rating" aria-describedby="emailHelp" placeholder="Rating" required="">
						  </div>
						  <div class="form-group">
						    <input type="file" class="form-control" id="file" name="file" required="">
						  </div>
						  
						  <button type="submit" name="update" class="btn">Submit</button>
						</form>
						</div>
					</div>
					<div class="col-md-6-right">
						<div class="imgs">
							<img src="../images/back3.jpg" style = width:100%;height:auto;/> 
							<img src="../images/back.jpg" style = width:100%;height:auto;/> 
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<script>
				$(document).ready(function(){
					$('#update').click(function(){
						var image_name = ('#file').val();
						var extention = ('#file').val().split('.').pop().toLowerCase();
						if(jQuery.inArray(extention,['gif','png','jpg','jpeg') == -1){
							alert("Invalid image file");
							$('#file').val('');
							return false;
						}else{

						}
					});
				});

			</script>
			<div class="clear"></div>
		</div>

		<footer>
			<p>Copyright &copy; 2019-2020</p>
		</footer>
	</div>
</body>
</html>
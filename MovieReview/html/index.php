<html>
<head>
	<?php
		include '../php/connect.php';

		if(isset($_GET['name'])){
			$name = $_GET['name']; 
		}
	?>
	<title>Index page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script src="../js/script.js" ></script>
</head>
<body>
	<div class="contain">
		<div class="topbar">
  			<a class="logo">M R</a>
  			<?php if(isset($name)){ ?>
  				<a class="sig" href="signin.php">Log out</a>
  				<a class="sig"><?php echo $name; ?></a>
  			<?php }else{?>
  				<a class="sig" href="register.php">Register</a>
  				<a class="sig" href="signin.php">Sign in</a>
  			<?php } ?>
  			<div class="clr"></div>
  			<?php if(isset($name)){ ?>
  				<form method="POST" action="index.php?name=<?php echo $name ?>">
  			<?php }else{?>
  				<form method="POST" action="index.php">
  			<?php } ?>
  				<input type="text" name="title" placeholder="Search your movie">
  				<input type="submit" value="Search" name="submit">
  			</form>
		</div>

		<div class="topnav" id="myTopnav">
		  <a href="index.php" class="active">Home</a>
		  <div class="dropdown">
		    <button class="dropbtn">Categories
		      <i class="fa fa-caret-down"></i>
		    </button>
		    <div class="dropdown-content">
		      <a href="#">Actio</a>
		      <a href="#">Action</a>
		      <a href="#">Comedy</a>
		      <a href="#">Crime</a>
		      <a href="#">Drama</a>
		      <a href="#">Fantasy</a>
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
		    <button class="dropbtn">More
		      <i class="fa fa-caret-down"></i>
		    </button>
		    <div class="dropdown-content">
		     <?php if(isset($name)){ ?>
  				<a href="update.php?name=<?php echo $name ?>">Admin</a>
  			<?php }else{?>
  				<a href="update.php">Admin</a>
  			<?php } ?>
		    </div>
		  </div> 
		  <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
		</div>

		<div class="main">
			<img src="../images/wall2copy.png" style='width:100%;'>
			<?php 
				$getTitle = '';
				if(isset($_GET['uptitle'])){
					$getTitle = $_GET['uptitle'];
				}
				if(isset($_POST['submit']) || $getTitle !=  ''){
					if(isset($_POST['submit']) && $_POST['title'] == ''){
						echo "<p class='nomovies ff' style='text-align:center;'>No Movies to show</p>";
					}else{
						$title = $getTitle != '' ?  $getTitle : $_POST['title'];
						mysql_select_db('MovieReview');
			         	$sql = "SELECT * FROM movies where title like '$title%'";
						$retval = mysql_query( $sql, $conn);
						
						if(! $retval ) {
						    die('Could not get data: ' . mysql_error());
						}
							   
						while($row = mysql_fetch_array($retval)) {
						echo "
							<div class='single'>
								<div class='leftside'>
									<h1 class='title' name='title'>".$row['title']."</h1>
									<div class='movie_image' name='movie_image'>
										<img src='data:image/jpeg;base64,".base64_encode($row['image'])."'/>
									</div>

								</div>
								<div class='rightside'>
									<h2>Details</h2>
									<p class='ff'>Gener : ".$row['gener']."</p>
									<p class='ff'>Director : ".$row['director']."</p>
									<p class='ff'>Music :".$row['music']."</p>
									<p class='ff'>Producer : ".$row['producer']." </p>
									<p class='ff'>Budget : ".$row['budget']."Cr </p>
									<p class='ff'>Box Office : ".$row['boxoffice']."Cr </p>
									<p class='ff'>Synopsis : ".$row['synopsis']." </p>
									<p class='ff'>Rating : ".$row['rating']." </p>
								</div>
								<div class='cls'></div>
								<div class='side'>
									<p>	
										Oh he decisively impression attachment friendship so if everything. Whose her enjoy chief new young. Felicity if ye required likewise so doubtful. On so attention necessary at by provision otherwise existence direction. Unpleasing up announcing unpleasant themselves oh do on. Way advantage age led listening belonging supposing. 
									</p>
								</div>
								<br><br><div class='clear'></div>
							</div>";
						}
					}
				}
				mysql_close($conn);
			?>
			<div class="clear"></div>
		</div>

		<footer>
			<p>Copyright &copy; 2019-2020</p>
		</footer>
	</div>
</body>
</html>
<?php
	if(isset($_POST['submit'])){
		if($_POST['title'] == "2.0"){
			header("Location: ../html/movie.html");
		}else{
			echo "404 Page not found error";
		}
		exit;
	}
?>
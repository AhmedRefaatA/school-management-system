<?php 
	require "../helper/helper.php";
    require "../layouts/home_header.php";
    require "../layouts/nav.php";
?>


<style type="text/css">
	@import url('https://fonts.googleapis.com/css?family=Sniglet:400,800');

		body{
			font-family: 'Sniglet', cursive;
		}
		h1{
			text-align: center;
			font-size: 190px;
			font-weight: 400;
			margin: 0;
		}
		.fa{
			font-size: 120px;
			text-align: center;
			display: block;
			padding-top: 100px;
			margin: 0 auto;
			color: #A93226;
		}
		#error p{
			text-align: center;
			font-size: 36px;
			color: red;
		}
		a.back{
			text-align: center;
			margin: 0 auto;
			display: block;
			text-decoration: none;
			font-size: 24px;
			background: #3cbca3;
			border-radius: 10px;
			width: 10%;
			padding: 4px;
			color: #fff; 

		}
		footer p{
			padding-top: 160px;
			text-align: center;
		}
		a.w3hubs{
			text-decoration: none;
			color: #A93226;
		}
		@media(max-width: 550px){
			a.back{
				width: 20%;
			}
		}
		@media(max-width: 425px){
			h1{
				    padding-top: 20px;
			}
			.fa{
				padding-top: 100px;
			}
		}
</style>

<section id="error">
	<div class="content">
		<i class="fa fa-warning"></i>
		<h1>401</h1>
		<p>Error occurred! - Not Authorization User</p>
		<a class="back" href="<?php echo $host;?>index.php">Back</a>
	</div>
</section>



<?php
    require "../layouts/home_footer.php"
?>
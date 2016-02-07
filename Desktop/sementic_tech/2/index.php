<!DOCTYPE html>
<html>
<head>
	 <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
	<link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css"/> 
	<link rel="stylesheet" href="css/style.css">
	<title>
		Querying RDF data of hotels belog to several countries using SPARQL endpoints and display them in HTML and PHP format.
	</title>
</head>
<body>
	<div class="wrapper">
		<div class="header">
		</div>

		<div class="content">
			<div class="section1"> 
				 <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
				 <!-- <input type="text" name="test"> -->
					<span class="lblHotel"> Hotel chosen by the country : </span>
					<select name="country">
						<option> England </option>
						<option> Germany </option>
						<option> Italy </option>
						<option> USA </option>
						<option> India </option>
					</select>
					<button type="submit" name="submit_btn" class="btn btn-default">Submit</button> 
				</form>
			</div>

			<?php
			if(isset($_POST['submit_btn']))
			{
				if ($_POST['country']=='England'){
					$country='England';
				}
				elseif ($_POST['country']=='Germany') {
					$country='Germany';
				}
				elseif ($_POST['country']=='Italy') {
					$country ='Italy';
				}
				elseif ($_POST['country']=='USA') {
					$country ='USA';
				}
				elseif ($_POST['country']=='India') {
					$country ='India';
				}

				if(isset($_POST['country']))
				{
					//echo $country;
					require_once('hotellist.php');
				}
			} 
			?>

		</div>
	</div>

</body>

</html>
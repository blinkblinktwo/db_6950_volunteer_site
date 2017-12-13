<?php

// This page will have a form to which data can be inputted to be inserted into a table.


if (isset($_POST['submit']))
{
	// Makes sure we have the DB configuration information for the "try" section comming up.
	require "../config.php";
	require "../common.php";

	// Connect to our DB using the PDO interfacing method and setting things up.
	try 
	{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$new_user = array(
			"firstname" => $_POST['firstname'],
			"lastname"  => $_POST['lastname'],
			"email"     => $_POST['email'],
			"phone"     => $_POST['phone'],
			"location"  => $_POST['location']
		);

		$sql = sprintf(
				"INSERT INTO %s (%s) values (%s)",
				"users",
				implode(", ", array_keys($new_user)),
				":" . implode(", :", array_keys($new_user))
		);
		
		$statement = $connection->prepare($sql);
		$statement->execute($new_user);
	}

	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}
	
}
?>

<!-- Pull in our header file -->
<?php require "templates/header.php"; ?>



<!-- Setting the class for the header with markdown 12 colors for the page -->
<?php 
if (isset($_POST['submit']) && $statement) 
{ ?>
	<blockquote><?php echo $_POST['firstname']; ?> successfully added.</blockquote>
<?php 
} ?>

<!-- Bootstraping the "add a user" style -->
<h2 class="col-md-12">Add a user</h2>


<!-- The fields for which will will add data to be placed into our DB -->
<form method="post">
	<!-- col-md-12 puts this into the bootstrap grid, which invisibly partitions the page for alignment -->
	<div class="col-md-12">
		<input type="text" name="firstname" id="firstname" class=col-md-4>
		<label for="firstname" class="col-md-2">First Name</label>
	</div>
	<!-- col-md-12 puts this into the bootstrap grid, which invisibly partitions the page for alignment -->
	<div class="col-md-12">
		<input type="text" name="lastname" id="lastname" class=col-md-4>
		<label for="lastname" class=col-md-2>Last Name</label>
	</div>
	<!-- col-md-12 puts this into the bootstrap grid, which invisibly partitions the page for alignment -->
	<div class="col-md-12">
		<input type="text" name="email" id="email" class="col-md-4">
		<label for="email" class="col-md-2">Email Address</label>
	</div>
	<!-- col-md-12 puts this into the bootstrap grid, which invisibly partitions the page for alignment -->
	<div class="col-md-12">
		<input type="text" name="phone" id="phone" class="col-md-4">
		<label for="phone" class="col-md-6">Phone # (No Spaces or Hyphens)</label>
	</div>
	<!-- col-md-12 puts this into the bootstrap grid, which invisibly partitions the page for alignment -->
	<div class="col-md-12">
		<input type="text" name="location" id="location" class="col-md-4">
		<label for="location" class="col-md-2">Location</label>
	</div>
	<!-- col-md-12 puts this into the bootstrap grid, which invisibly partitions the page for alignment -->
	<div class="col-md-12">
		<br /><input type="submit" name="submit" value="Submit">
	</div>
</form>


<!-- Pull in our footer -->
<?php require "templates/footer.php"; ?>
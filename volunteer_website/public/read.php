<?php

// This page will take information information inputted into our search box
// and return matches in the phone, location, or last name column.
	

	if (isset($_POST['submit'])) 
	{
		
		try 
		{
			// Make sure we have information needed to open the DB from the config file.
			require "../config.php";
			require "../common.php";


			// Open our connection to the DB using the PDO interfacing method.
			$connection = new PDO($dsn, $username, $password, $options);



			$sql = "SELECT * 
							FROM users
							# Search for the variable 'location' three diffrent atributes
							# So some reason, I had trouble changing it from location to
							# name without breakage.
							WHERE location = :location OR lastname = :location OR phone = :location";

			$location = $_POST['location'];

			$statement = $connection->prepare($sql);
			$statement->bindParam(':location', $location, PDO::PARAM_STR);
			$statement->execute();

			$result = $statement->fetchAll();
		}
		
		catch(PDOException $error) 
		{
			echo $sql . "<br>" . $error->getMessage();
		}
	}
?>

<!-- Include our universal header in this PHP page -->
<?php require "templates/header.php"; ?>

		
<?php  
if (isset($_POST['submit'])) 
{
	if ($result && $statement->rowCount() > 0) 
	{ ?>
		<h2 class="col-md-12">Results</h2>

		<!-- Uses bootstrap to set the table alternating colors, with hover highlights, and with lines.
			Then, populates the table with DB info. -->
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<!-- Table entires and coloring in the background as RGB -->
				<tr style="background-color: rgb(200,200,200)">
					<th>#</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email Address</th>
					<th>Phone</th>
					<th>Location</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach ($result as $row) 
					{ ?>
						<tr>
							<td><?php echo escape($row["id"]); ?></td>
							<td><?php echo escape($row["firstname"]); ?></td>
							<td><?php echo escape($row["lastname"]); ?></td>
							<td><?php echo escape($row["email"]); ?></td>
							<td><?php echo escape($row["phone"]); ?></td>
							<td><?php echo escape($row["location"]); ?></td>
							<td><?php echo escape($row["date"]); ?> </td>
						</tr>
				<?php 
					} ?>
					</tbody>
		</table>


<?php 
	} 
	else 
	{ ?>
		<blockquote>No results found for <?php echo escape($_POST['location']); ?>.</blockquote>
<?php
	} 
}?> 

<!-- Setting the class for the header with markdown 12 colors for the page -->
<h2 class="col-md-12">Find users based on location or phone number</h2>

<form method="post">
	<div class="col-md-12">
		<input type="text" id="location" name="location">
		<input type="submit" name="submit" value="Search">
	</div>
</form>


<!-- Include our universal footer in this page -->
<?php require "templates/footer.php"; ?>
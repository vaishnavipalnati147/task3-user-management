<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
//including the database connection file
include_once("connection.php");

//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM tasks   ORDER BY id DESC");
?>

<html>
<head>
	<title>Homepage</title>
</head>

<body>
	<a href="index.php">Home</a> | <a href="add_task.php">Add New Data</a> | <a href="logout.php">Logout</a>
	<br/><br/>
	
	<table width='80%' border=0>
		<tr bgcolor='#CCCCCC'>
			<td> Task Name</td>
			<td>Description</td>
			<td>Status</td>
			<td>Due Date</td>
		</tr>
		<?php
		while($res = mysqli_fetch_array($result)) {		
			echo "<tr>";
			echo "<td>".$res['task_name']."</td>";
			echo "<td>".$res['description']."</td>";
			echo "<td>".$res['status']."</td>";	
			echo "<td>".$res['due_date']."</td>";	
			echo "<td><a href='edit_task.php?id=".$res['id']."'>Edit</a></td>";
            echo "<td><a href='delete_task.php?id=".$res['id']."'>Delete</a></td>";
		}
		?>
	</table>	
</body>
</html>

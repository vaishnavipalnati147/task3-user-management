<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("connection.php");

if(isset($_POST['Submit'])) {	
	$task_name = $_POST['task_name'];
	$description = $_POST['description'];
	$status = $_POST['status'];
	$due_date = $_POST['due_date'];
	$loginId = $_SESSION['id'];
		
	// checking empty fields
	if(empty($task_name) || empty($description) || empty($status) || empty($due_date)) {
				
		if(empty($task_name)) {
			echo "<font color='red'> task Name field is empty.</font><br/>";
		}
		
		if(empty($description)) {
			echo "<font color='red'>description field is empty.</font><br/>";
		}
		
		if(empty($status)) {
			echo "<font color='red'>status field is empty.</font><br/>";
		}
		if(empty($due_date)) {
			echo "<font color='red'>due date field is empty.</font><br/>";
		}
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		$result = mysqli_query($mysqli, "INSERT INTO tasks(task_name, description, status , due_date) VALUES('$task_name','$description','$status', '$due_date')");
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='view_task.php'>View Result</a>";
	}
}
?>
</body>
</html>

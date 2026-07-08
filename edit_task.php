<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
// including the database connection file
include_once("connection.php");

if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	
	$task_name = $_POST['task_name'];
	$description = $_POST['description'];
	$status = $_POST['status'];	
	$due_date = $_POST['due_date'];	
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
	} else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE tasks SET task_name='$task_name', description='$description', status='$status', due_date='$due_date' WHERE id='$id'");
		
		//redirectig to the display page. In our case, it is view.php
		header("Location: view_task.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM tasks WHERE id='$id'");

while($res = mysqli_fetch_array($result))
{
	$task_name = $res['task_name'];
	$description= $res['description'];
	$status = $res['status'];
	$due_date = $res['due_date'];
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a> | <a href="view_task.php">View tasks</a> | <a href="logout.php">Logout</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit_task.php">
		<table border="0">
			<tr> 
				<td> Task Name</td>
				<td><input type="text" name="task_name" value="<?php echo $task_name;?>"></td>
			</tr>
			<tr> 
				<td>description</td>
				<td><input type="text" name="description" value="<?php echo $description;?>"></td>
			</tr>
			<tr> 
				<td>status</td>
				<td><input type="text" name="status" value="<?php echo $status;?>"></td>
			</tr>
			<tr> 
				<td>due date</td>
				<td><input type="date" name="due_date" value="<?php echo $due_date;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value="<?php echo $id;?>"></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>

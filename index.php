<?php
	$errors = "";

		$db = mysqli_connect('fdb31.runhosting.com', '4108959_root', 'R*j?X*%y3QgpbXzf', '4108959_root');

		if (isset($_POST['submit'])){
			$task = $_POST['task'];
			if (empty($task)) {
				$errors = "This task is boring!";
			}else{

			mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
			header('location: index.php');
			}
		}

		if (isset($_GET['del_task'])){
			$id = $_GET['del_task'];
			mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
			header('location: index.php');

		}

		$tasks = mysqli_query($db, "SELECT * FROM tasks");
	
	?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>Task List From My Mom</title>
	<link rel="stylesheet" href="main.css" />
</head>
<body>
	<header>
		<h1>ToDoList From JustGody</h1>
		<?php if (isset($errors)) { ?>
				<div><p><?php echo $errors; ?></p></div>
			<?php } ?>
		<form id="new-task-form" method="POST" action="index.php">
			
			
		<input type="text" name="task" class="task_input" id="new-task-input" placeholder="What do you have planned?">
		<button type="submit" class="add_btn" name="submit" id="new-task-submit">Add Task</button>
		</form>
	</header>
	<main>

	<section class="task-list">
	<table>
	<h2>To do:</h2>	
		<thead>
			<tr>
				<th>N</th>
				<th>Task</th>
				<th>Action</th>
			</tr>
		</thead>

		<tbody>
		<?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr class="content">
				<td><?php echo $row['id']; ?></td>
				<td class="task"><?php echo $row['task']; ?></td>
				<td class="delete">
					<a href="index.php?del_task=<?php echo $row['id']; ?>">x</a>
				</td>
			</tr>
		<?php $i++; } ?>
			
		</tbody>


	</table>
	</section>
	</main>
	
</body>
</html>